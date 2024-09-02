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
use App\Mail\DemandeMail;
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
            if ($en_cours->level === Approbateur::count()) { // Si c'est la fin du flow
                $success = $en_cours->update([
                    'status' => $request->status
                ]);
                if ($success) {
                    MailModel::where('traitement_id', $en_cours->id)->delete();
                    $validateur = User::find($en_cours->approbateur_id);
                    $demande['validated'] = true;
                    $demande['success'] = true;
                    Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
                    Mail::to($validateur->email, $validateur->name)->send(new DemandeMail($demande, true));
                }
                return redirect()->back()->with('success', 'Validation reussie');
            } else { // Pendant le passage des flow
                $prochain_level = (int)($en_cours->level) + 1;
                $prochain_approb = Approbateur::where('level', $prochain_level)->first();
                $validateur = User::where('email', $prochain_approb->email)->first();
                $success = $en_cours->update([
                    'status' => $request->status
                ]);

                if ($success) {
                    $prochain_traitement = Traitement::create([
                        'level' => $en_cours->level + 1,
                        'demande_id' => $demande->id,
                        'demandeur_id' => $en_cours->demandeur_id,
                        'approbateur_id' => $validateur->id
                    ]);

                    if ($prochain_traitement) { // Prochain flow
                        MailModel::where('traitement_id', $en_cours->id)->delete();
                        MailModel::create([
                            'traitement_id' => $prochain_traitement->id,
                        ]);

                        $demande['success'] = true;
                        $demande['level'] = $prochain_traitement->level;

                        Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande)); 
                    }
                }
                return redirect()->back()->with('success', 'Validation reussie');
            }
        } elseif ($request->status === 'rejeté') {
            $cloture_traitement = $en_cours->update([
                'status' => $request->status,
                'observation' => $request->observation
            ]);

            if ($cloture_traitement) {
                MailModel::where('traitement_id', $en_cours->id)->delete();
                $demande['observation'] = $request->observation;
                $demande['success'] = false;

                // dd($demande);
                Mail::to($demande->user->email, $demande->user->name)->send(new DemandeMail($demande));
            }

            return redirect()->back()->with('success', 'Demande rejetée avec succès');
        } else {
            return redirect()->back();
        }
    }
}
