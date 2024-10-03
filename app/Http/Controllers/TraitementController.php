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
use App\Mail\DemandeMail;

class TraitementController extends Controller
{
    /*
        * Manage the request's validation flow 
    */
    public function validate(Request $request, Demande $demande)
    {
        $en_cours = Traitement::where('demande_id', $demande->id)
            ->where('status', 'en_cours')
            ->first();
        $validateur = User::find($en_cours->approbateur_id);
        if ($request->status === 'valide') {
            if ($en_cours->level === Approbateur::count()) { // Si c'est la fin du flow
                $success = $en_cours->update([
                    'status' => $request->status
                ]);
                if ($success) {
                    MailModel::where('traitement_id', $en_cours->id)->delete();
                    $demande['validated'] = true;
                    $demande['validateur'] = $validateur->name;
                    $demande['deliverable'] = true;
                    $demande['success'] = true;
                    Mail::to($validateur->email, $validateur->name)->send(new DemandeMail($demande, true));
                    Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
                }
                return redirect()->back()->with('success', 'Validation reussie');
            } else { // Pendant le passage des flow
                $prochain_level = (int)($en_cours->level) + 1;
                $prochain_approb = User::where('email', Approbateur::where('level', $prochain_level)->first()->email)->first();
                // dd($prochain_approb);
                $success = $en_cours->update([
                    'status' => $request->status
                ]);

                if ($success) {
                    $prochain_traitement = Traitement::create([
                        'level' => $en_cours->level + 1,
                        'demande_id' => $demande->id,
                        'demandeur_id' => $en_cours->demandeur_id,
                        'approbateur_id' => $prochain_approb->id
                    ]);

                    if ($prochain_traitement) { // Prochain flow
                        MailModel::where('traitement_id', $en_cours->id)->delete();
                        MailModel::create([
                            'traitement_id' => $prochain_traitement->id,
                        ]);

                        $demande['success'] = true;
                        $demande['validateur'] = $validateur->name;
                        $demande['validated'] = true;
                        $demande['level'] = $prochain_traitement->level;

                        Mail::to($validateur->email, $validateur->name)->send(new DemandeMail($demande, true));
                        Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
                    }
                }
                return redirect()->back()->with('success', 'Validation reussie');
            }
        } elseif ($request->status === 'rejete') {
            $cloture_traitement = $en_cours->update([
                'status' => $request->status,
                'observation' => $request->observation
            ]);

            if ($cloture_traitement) {
                $demande['validateur'] = $validateur->name;
                MailModel::where('traitement_id', $en_cours->id)->delete();
                $demande['observation'] = $request->observation;

                Mail::to($validateur->email, $validateur->name)->send(new DemandeMail($demande, true));
                Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
            }

            return redirect()->back()->with('success', 'Demande rejetée avec succès');
        } else {
            return redirect()->back();
        }
    }
}
