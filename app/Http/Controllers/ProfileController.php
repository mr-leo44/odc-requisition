<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Demande;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function profile(): View
    {
        $user = Session::get('authUser');
        $manager = User::find($user->compte->manager)->name;
        $collaborateurs = User::whereHas('compte', function(Builder $query) use($user) {
            $query->where('manager', $user->id)->where('user_id', '!=', $user->id);
        })->get();

        foreach ($collaborateurs as $key => $collaborateur) {
            $reqs_count = Demande::where('user_id', $collaborateur->id)->count();
            $collaborateur['reqs_count'] = $reqs_count;
            $collab_last_reqs = Demande::where('user_id', $collaborateur->id)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
            $recent_reqs = Demande::where('user_id', $collaborateur->id)->whereMonth('created_at', Carbon::now()->month)->count(); 
            $collaborateur['recent_reqs'] = $recent_reqs;
            $collaborateur['collab_last_reqs'] = $collab_last_reqs;
        }
        // dd($collaborateurs);
        $last_month_req = Demande::where('user_id', $user->id)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $this_month_req = Demande::where('user_id', $user->id)->whereMonth('created_at', Carbon::now()->month)->count(); 
        $user['manager'] = $manager;
        $user['this_month_req'] = $this_month_req;
        $user['last_month_req'] = $last_month_req;
        return view('profile.index', compact('user', 'collaborateurs'));
    }

}
