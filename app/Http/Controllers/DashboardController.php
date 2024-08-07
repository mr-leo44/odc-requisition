<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Direction;
use App\Models\User;
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
        $directions= Direction::all();
        $array_direction_req_count = [];
        foreach ($directions as $key => $direction) {
            $userD = User::whereHas('compte', function(Builder $query) use($direction) {
                $query->where('direction_id', $direction->id);
            })->get();
            if($userD) {
                $count = 0;
                foreach ($userD as $user) {
                    $req_count = Demande::where('user_id', $user->id)->count();
                    $count +=$req_count;
                }
            }
            $array_direction_req_count[$key] = $count;
            $direction['req_count'] = $count;
        }
        $best_direction = $directions->where('req_count', max($array_direction_req_count))->first();
        return view('dashboard',compact('nbre_demande', 'nbre_validated','directions', 'best_direction'));
    }
}
