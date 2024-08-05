<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Traitement;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function dashboard(){
        $nbre_demande = Demande::count();
        $demandes = Demande::all();
        $validated = [];
        foreach ($demandes as $key => $demande) {
            $last = Traitement::where('demande_id', $demande->id)->orderBy('id', 'DESC')->first();
            if($last->status === 'validé') {
                $validated[$key] = $demande;
            }
        }
        $nbre_validated = count($validated);
        return view('dashboard',compact('nbre_demande', 'nbre_validated'));

    }




}
