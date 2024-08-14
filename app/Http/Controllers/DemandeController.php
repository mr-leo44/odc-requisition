<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Demande;
use App\Mail\DemandeMail;
use App\Models\Livraison;
use App\Models\Traitement;
use App\Models\Approbateur;
use Illuminate\Http\Request;
use App\Models\DemandeDetail;
use App\Models\Mail as MailModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $connected_user = Session::get('authUser'); //signifie que c'est l'utilisateur qui est connecté
        if ($connected_user->compte->role->value === 'user') {
            $isManager = User::whereHas('compte', function (Builder $query) use ($connected_user) {
                $query->where('manager', $connected_user->id);
            })->exists();

            $isValidator = Approbateur::where('email', $connected_user->email)->exists();

            if ($isManager || $isValidator) {
                $demandes = Demande::whereHas('traitement', function (Builder $query) use ($connected_user) {
                    $query->where('approbateur_id', $connected_user->id)
                        ->where('status', 'en cours');
                })
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
            } else {
                $demandes = Demande::whereHas('traitement', function ($query) use ($connected_user) {
                    $query->where('demandeur_id', $connected_user->id)->where('status', 'en cours');
                })
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
            }

            foreach ($demandes as $demande) {
                $dernier_traitement = Traitement::where('demande_id', $demande->id)->get()->last();
                $demande['level'] = $dernier_traitement->level;
            }
        }

        if ($connected_user->compte->role->value === 'livraison') {
            $reqs = Demande::all();
            $all_demandes = [];
            foreach ($reqs as $key => $req) {
                $last = Traitement::where('demande_id', $req->id)->orderBy('id', 'DESC')->first();
                if ($last->status === 'validé') {
                    $all_demandes[$key] = $req;
                }
            }
            $demandes_array = collect($all_demandes);
            $demandes = Demande::whereIn('id', $demandes_array->pluck('id'))->orderBy('created_at', 'desc')->paginate(15);
        }
        return view('demandes.index', compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('demandes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Demande::count() === 0 ? 1 : Demande::get()->last()->id + 1;
        $ref = "REQ-{$order}-" . Carbon::now()->year;
        $demande = Demande::create([
            'numero' => $ref,
            'service' => Session::get('authUser')->compte->service,
            'user_id' => Session::get('authUser')->id
        ]);
        if ($demande) {
            foreach ($request->demandes as $item) {
                DemandeDetail::create([
                    'designation' => $item["designation"],
                    'qte_demandee' => $item["qte_demandee"],
                    'qte_livree' => 0,
                    'demande_id' => $demande->id
                ]);
            }

            $traitement1 = Traitement::create([
                'demande_id' => $demande->id,
                'approbateur_id' => $demande->user->id,
                'demandeur_id' => $demande->user->id,
                'status' => 'validé',
            ]);

            if ($traitement1) {

                $traitement2 = Traitement::create([
                    'demande_id' => $demande->id,
                    'approbateur_id' => $demande->user->compte->manager,
                    'demandeur_id' => $demande->user->id,
                ]);
                if ($traitement2) {
                    MailModel::create([
                        'traitement_id' => $traitement2->id,
                    ]);

                    $demande['success'] = true;

                    Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
                }
            }

            return redirect()->route('demandes.index')->with('success', 'Demande enregistrée avec succès');
        }

        return redirect()->route('demandes.index')->with('success', 'Demande enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demande $demande)
    { {
            $en_cours = Traitement::where('demande_id', $demande->id)
                ->orderBy('id', 'DESC')
                ->first();
            $manager_id = User::find($demande->user->compte->manager);

            $approbateurs = Approbateur::orderBy('level', 'ASC')->get()->keyBy('email');

            $traitements = Traitement::where('demande_id', $demande->id)
                ->orderBy('level', 'ASC')
                ->get();
            $users = User::all();

            $users_approbateurs = [];
            $validated_levels = [];
            foreach ($traitements as $traitement) {
                if (in_array($traitement->status, ['validé', 'rejeté'])) {
                    $validated_levels[] = $traitement->level;
                }
            }
            // les autres approbateurs
            foreach ($users as $user) {
                if (isset($approbateurs[$user->email])) {
                    $approbateur = $approbateurs[$user->email];
                    $a_valide = in_array($approbateur->level, $validated_levels);
                    // Ajouter seulement si les niveaux inférieurs sont validés
                    if (empty($validated_levels) || max($validated_levels) >= ($approbateur->level - 1)) {
                        $users_approbateurs[] = [
                            'user' => $user,
                            'level' => $approbateur->level,
                            'validated' => $a_valide,
                        ];
                    }
                }
            }
            // Trier les approbateurs
            $users_approbateurs = collect($users_approbateurs)->sortBy(function ($item) {
                return $item['validated'] ? -1 : $item['level'];
            });
            // informations finales pour la vue
            $final_approbateurs = $users_approbateurs->pluck('user');
            $date_validate = [];
            foreach ($traitements as $traitement) {
                $date_validate[] = $traitement->updated_at->format('d-m-Y H:i:s');
            }
            $demande['manager'] = $manager_id;
            $demande['approbateurs'] = $final_approbateurs;
            return view('demandes.show', compact('demande', 'traitements', 'en_cours', 'date_validate'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demande $demande)
    {
        //

        return view('demandes.index', compact('demandes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demande $demande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        $demande->delete();
        return redirect()->route('demandes.index')->with('success', 'Suppression éffectuée avec succès');
    }
    public function historique()
    {
        $connected_user = Session::get('authUser')->id;

        $isDemandeur = Demande::whereHas('traitement', function ($query) use ($connected_user) {
            $query->where('demandeur_id', $connected_user);
        })->exists();

        if ($isDemandeur) {
            $demandes = Demande::whereHas('traitement', function (Builder $query) use ($connected_user) {
                $query->where('demandeur_id', $connected_user)
                    ->where('status', '!=', 'en cours');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } else {
            $demandes = Demande::whereHas('traitement', function ($query) use ($connected_user) {
                $query->where('approbateur_id', $connected_user)
                    ->where('status', '!=', 'en cours');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        }

        return view('demandes.historique', compact('demandes'));
    }

    public function updateLivraison(Request $request)
    {
        // dd($request->input('details'));
        $validatedData = $request->validate([
            'details' => 'required|array',

        ]);

        foreach ($validatedData['details'] as $detail) {
            Livraison::updateOrCreate(
                ['demande_detail_id' => $detail['id']],
                ['quantite' => $detail['quantite']]
            );

        // Mettre à jour la colonne qte_livree de la table demande_details
        $demandeDetail = DemandeDetail::find($detail['id']);
        if ($demandeDetail) {
            $demandeDetail->qte_livree = $detail['quantite'];
            $demandeDetail->save();
        }
        }

        return redirect()->back()->with('success', 'Livraison mise à jour avec succès');
    }
}
