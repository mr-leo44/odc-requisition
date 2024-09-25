<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Demande;
use App\Models\Direction;
use App\Models\Livraison;
use App\Models\Traitement;
use App\Models\DemandeDetail;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $demandes = Demande::all();
        $stats = [];

        $all_validated_keys = [];
        foreach ($demandes as $key => $demande) {
            $last = Traitement::where('demande_id', $demande->id)->orderBy('id', 'DESC')->first();
            if ($last->status === 'valide') {
                $all_validated_keys[$key] = $demande->id;
            }
        }
        $validated_reqs = Demande::whereIn('id', $all_validated_keys)->get();
        $stats['all_reqs'] = $validated_reqs->count();

        $validated_keys = [];
        foreach ($validated_reqs as $key => $validated) {
            $validated_keys[$key] = $validated->id;
        }

        $req_month_count = Demande::whereIn('id', $validated_keys)->whereMonth('created_at', Carbon::now()->month)->count();
        $stats['month_count'] = $req_month_count;

        Carbon::setlocale('fr');
        $months = [];
        for ($month = 0; $month <= 11; $month++) {
            $months[$month]['name'] = Carbon::create()->month($month + 1)->translatedFormat('F');
            $months[$month]['count'] = Demande::whereIn('id', $validated_keys)->whereMonth('created_at', $month + 1)->whereYear('created_at', Carbon::now()->year)->count();
        }

        $on_going = [];
        foreach ($validated_reqs as $key => $validated) {
            $req_details = DemandeDetail::where('demande_id', $validated->id)->get();
            $delivered = 0;
            foreach ($req_details as $req_detail) {
                $req_count = $req_detail->qte_demandee;
                $count = 0;
                if(Livraison::where('demande_detail_id', $req_detail->id)->exists()) {
                    $deliveries = Livraison::where('demande_detail_id', $req_detail->id)->get();
                    foreach ($deliveries as $key => $delivery) {
                        $count += $delivery->quantite;
                    }
                    if ($req_count === $count) {
                        $delivered += 1;
                    }
                }
            }
            if ($delivered < $req_details->count()) {
                $on_going[] = $validated;
            }
        }
        $reqs_array = collect($on_going);
        $ongoing_reqs = Demande::whereIn('id', $reqs_array->pluck('id'))->latest()->paginate(5);
        $reqs_count = Demande::whereIn('id', $reqs_array->pluck('id'))->count();
        $stats['ongoing_reqs'] = $ongoing_reqs;
        $stats['ongoing'] = $reqs_count;
        $directions = Direction::withTrashed()->get();
        // dd($directions);
        $array_direction_req_count = [];
        foreach ($directions as $key => $direction) {
            $userD = User::whereHas('compte', function (Builder $query) use ($direction) {
                $query->where('direction_id', $direction->id);
            })->get();
            if ($userD) {
                $users_count = 0;
                foreach ($userD as $user) {
                    $user_reqs = Demande::where('user_id', $user->id)->get();
                    $user_req_validated = [];
                    $user_count = 0;
                    if ($user_reqs !== []) {
                        foreach ($user_reqs as $key => $user_req) {
                            $last_tr = Traitement::where('demande_id', $user_req->id)->orderBy('id', 'desc')->first();
                            if ($last_tr !== null) {
                                if ($last_tr->status === 'valide') {
                                    $user_req_validated[$key] = $user_req;
                                }
                            }
                            $user_count = count($user_req_validated);
                        }
                    }
                    $users_count += $user_count;
                }
            }
            $direction['req_count'] = $users_count;
            $array_direction_req_count[$key] = $users_count;
        }
        $best_direction = $directions->where('req_count', max($array_direction_req_count))->first();
        return view('dashboard', compact('stats', 'directions', 'best_direction', 'months'));
    }
}
