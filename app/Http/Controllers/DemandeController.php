<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Demande;
use App\Mail\DemandeMail;
use App\Models\Traitement;
use App\Models\Approbateur;
use Illuminate\Http\Request;
use App\Models\DemandeDetail;
use App\Models\Mail as MailModel;
use App\Http\Controllers\Controller;
use FontLib\Table\Type\cvt;
use Illuminate\Support\Facades\Auth;
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
        $connected_user = Session::get('authUser')->id; //signifie que c'est l'utilisateur qui est connecté
        $isDemandeur = Demande::whereHas('traitement', function ($query) use ($connected_user) {
            $query->where('demandeur_id', $connected_user);
        $connected_user = Session::get('authUser'); //signifie que c'est l'utilisateur qui est connecté
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

            $dernierTraitement = $demande->traitement()->orderBy('id', 'DESC')->first();
            $demande['level'] = $dernierTraitement->level;
        }

            $dernier_traitement = Traitement::where('demande_id', $demande->id)->get()->last();
            $demande['level'] = $dernier_traitement->level;
        });

        return view('demandes.index', compact('demandes', 'isDemandeur'));
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
            'service_id' => 1,
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

                    $validateur = User::find($traitement2->approbateur_id);
                    $demande['validateur'] = $validateur->name;

                    Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
                    Mail::to($validateur->email, $validateur->name)->send(new DemandeMail($demande, true));
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
    {
        $en_cours = Traitement::where('demande_id', $demande->id)
            ->orderBy('id', 'DESC')
            ->first();
        $manager_id = User::find($demande->user->compte->manager);
        $approbateurs = Approbateur::orderBy('level', 'ASC')->get();
        $traitements = Traitement::where('demande_id', $demande->id)->orderBy('level', 'ASC')->get();

        $date_validate = [];
        foreach ($traitements as $traitement) {
            $date_validate[] = $traitement->updated_at->format('d-m-Y H:i:s');
        }
        $demande['manager'] = $manager_id;
        $demande['approbateurs'] = $approbateurs;
        return view('demandes.show', compact('demande', 'traitements', 'en_cours', 'date_validate'));
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
}
