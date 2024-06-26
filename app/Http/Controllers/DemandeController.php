<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Demande;
use App\Mail\DemandeMail;
use App\Models\Traitement;
use Illuminate\Http\Request;
use App\Models\DemandeDetail;
use App\Models\Mail as MailModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $service_id = Auth::user()->id; //signifie que c'est l'utilisateur qui est connecté
        $demandes = Demande::with(['user', 'demande_details', 'service', 'traitement'])
            ->whereHas('traitement', function ($query) {
                $query->where('status', '=', 'en cours');
            })
            ->orderBy('created_at', 'desc')
            ->where('user_id', "=", $service_id)
            ->paginate(15);

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
        //dd($request->demandes);
        $order = Demande::count() === 0 ? 1 : Demande::get()->first()->id + 1;
        $ref = "REQ-{$order}-" . Carbon::now()->year;
        $demande = Demande::create([
            'numero' => $ref,
            'service_id' => 1,
            'user_id' => Auth::user()->id
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

            $traitement = Traitement::create([
                'demande_id' => $demande->id,
                'approbateur_id' => $demande->user->compte->manager,
                'demandeur_id' => $demande->user->id,
            ]);
            if ($traitement) {
                // dd($traitement);
                MailModel::create([
                    'traitement_id' => $traitement->id,
                ]);

                $validateur = User::find($traitement->approbateur_id);
                $demande['validateur'] = $validateur->name;
                
                Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
                Mail::to($validateur->email, $validateur->name)->send(new DemandeMail($demande, true));
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
        //
        // return view('demandes.index', compact('demandes'));
        // $demande = Demande::with('demande_details')->findOrFail($id);
        // dd($demande->demande_details);
        return view('demandes.show', compact('demande'));
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
        //
        $demande->delete();
        return redirect()->route('demandes.index')->with('success', 'Suppression éffectuée avec succès');
    }
    public function validate()
    {
        $service_id = Auth::user()->id;

        $demandes = Demande::with(['user', 'demande_details', 'service', 'traitement'])
            ->whereHas('traitement', function ($query) {
                $query->where('status', '=', 'approuvée');
            })
            ->orderBy('created_at', 'desc')
            ->where('user_id', '=', $service_id)
            ->paginate(15);

            return view('demandes.validate', compact('demandes'));
    }
}
