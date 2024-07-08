<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use App\Models\Traitement;
use App\Models\Approbateur;
use Illuminate\Http\Request;
use App\Models\Mail as MailModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreTraitementRequest;
use App\Http\Requests\UpdateTraitementRequest;
use App\Mail\TraitementMail;

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
                $prochain_traitement = Traitement::create([
                    'level' => $en_cours->level + 1,
                    'demande_id' => $demande->id,
                    'demandeur_id' => $en_cours->demandeur_id,
                    'approbateur_id' => $user_approb->id
                ]);
                
                if($prochain_traitement) {
                    MailModel::create([
                        'traitement_id' => $prochain_traitement->id,
                    ]);

                    $validateur = User::find($prochain_traitement->approbateur->id);
                    $demande['validateur'] = $validateur->name;
                    $demande['level'] = $prochain_traitement->level;

                    Mail::to($demande->user->email, $demande->user->name)->send(new TraitementMail($demande, true));
                    Mail::to($validateur->email, $validateur->name)->send(new TraitementMail($demande, true, true));
                }    
            }

            return redirect()->route('demandes.manager')->with('success','Validation reussie');
        } elseif ($request->status === 'rejeté') {
            $cloture_traitement = $en_cours->update([
                'status'=> $request->status,
                'observation' => $request->observation
            ]);

            if($cloture_traitement) {
                $validateur = User::find($en_cours->approbateur_id);
                $demande['observation'] = $en_cours->observation;
                $demande['level'] = $en_cours->level;
                
                Mail::to($demande->user->email, $demande->user->name)->send(new TraitementMail($demande));
                Mail::to($validateur->email, $validateur->name)->send(new TraitementMail($demande, false, true));
            }

            return redirect()->route('demandes.manager')->with('success','Demande rejetée avec succès');
        } else {
            return redirect()->back();
        }
    }
}
