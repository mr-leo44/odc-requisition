<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Traitement;
use App\Models\Approbateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTraitementRequest;
use App\Http\Requests\UpdateTraitementRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TraitementController extends Controller
{
    /*
        * Manage the request's validation flow 
    */
    public function validate(Request $request, Demande $demande)
    {
        $en_cours = Traitement::where('demande_id', $demande->id)
            ->where('status', 'en cours')
            ->first();
        if ($request->status === 'validé') {
            $prochain_level = (int)($en_cours->level) + 1;
            $prochain_approb = Approbateur::where('level', $prochain_level)->first();
            $user_approb = User::where('email', $prochain_approb->email)->first();
            $success = $en_cours->update([
                'status' => $request->status
            ]);
            if ($success) {
                Traitement::create([
                    'level' => $en_cours->level + 1,
                    'demande_id' => $demande->id,
                    'demandeur_id' => $en_cours->demandeur_id,
                    'approbateur_id' => $user_approb->id
                ]);
            }
            return redirect()->back()->with('success','Validation reussie');
        } elseif ($request->status === 'rejeté') {
            $en_cours->update([
                'status'=> $request->status,
                'observation' => $request->observation
            ]);
            return redirect()->back()->with('success','Demande rejetée avec succès');
        } else {
            return redirect()->back();
        }
    }
}
