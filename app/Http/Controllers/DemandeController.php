<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Demande;
use App\Mail\DemandeMail;
use Illuminate\Http\Request;
use App\Models\DemandeDetail;
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
        $demandes = Demande::with(['user', 'demande_details', 'service'])->paginate(10);
        $service_id = Auth::user()->id;//signifie que c'est l'utilisateur qui est connecté

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
            $service_manager = (int)($demande->user->compte->manager);
            $manager= User::find($service_manager);
            $demande['manager'] = $manager->name;
            
            // Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
            Mail::to($manager->email, $manager->name)->send(new DemandeMail($demande, true));
            
            return redirect()->route('demandes.index')->with('success', 'Demande enregistrée avec succès');
        }

            return back();
            

    }

    /**
     * Display the specified resource.
     */
    public function show(Demande $demande)
    {
        //
        return view('demandes.index', compact('demandes'));
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
}
