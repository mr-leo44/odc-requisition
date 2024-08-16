<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Direction;
use App\Models\User;
use App\Models\Traitement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
class DashboardController extends Controller
{
    public function dashboard(){

        $demandes = Demande::all();
        $stats = [];
        
        $validated_reqs = [];
        foreach ($demandes as $key => $demande) {
            $last = Traitement::where('demande_id', $demande->id)->orderBy('id', 'DESC')->first();
            if($last->status === 'validé') {
                $validated_reqs[$key] = $demande;
            }
        }
        $stats['all_reqs'] = count($validated_reqs);
        
        $validated_keys = [];
        foreach($validated_reqs as $key=> $validated) {
            $validated_keys[$key] = $validated->id;
        }
        
        $req_month_count = Demande::whereIn('id', $validated_keys)->whereMonth('created_at', Carbon::now()->month)->count();
        $stats['month_count'] = $req_month_count;
        
        Carbon::setlocale('fr');
        $months = [];
        for($month = 0; $month <= 11; $month++) {
            $months[$month]['name'] = Carbon::create()->month($month + 1)->translatedFormat('F');
            $months[$month]['count'] = Demande::whereIn('id', $validated_keys)->whereMonth('created_at', $month + 1)->whereYear('created_at', Carbon::now()->year)->count();
        }

        $directions= Direction::all();
        $array_direction_req_count = [];
        foreach ($directions as $key => $direction) {
            $userD = User::whereHas('compte', function(Builder $query) use($direction) {
                $query->where('direction_id', $direction->id);
            })->get();
            if($userD) {
                $users_count = 0;
                foreach ($userD as $user) {
                    $user_reqs = Demande::where('user_id', $user->id)->get();
                    $user_req_validated = [];
                    $user_count = 0;
                    if($user_reqs !== []) {
                        foreach ($user_reqs as $key => $user_req) {
                            $last_tr = Traitement::where('demande_id', $user_req->id)->orderBy('id', 'desc')->first();
                            if($last_tr !== null) {
                                if($last_tr->status === 'validé') {
                                    $user_req_validated[$key] = $user_req;
                                }
                            }
                            $user_count = count($user_req_validated); 
                        }
                    }
                    $users_count +=$user_count; 
                }
            }
            $direction['req_count'] = $users_count;
            $array_direction_req_count[$key] = $users_count;
        }
        $best_direction = $directions->where('req_count', max($array_direction_req_count))->first();
        return view('dashboard',compact('stats','directions', 'best_direction', 'months'));
    }
}
