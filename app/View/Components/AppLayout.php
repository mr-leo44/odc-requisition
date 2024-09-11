<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Approbateur;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $connected_user = Session::get('authUser');
        $isManager = User::whereHas('compte', function (Builder $query) use ($connected_user) {
            $query->where('manager', $connected_user->id)->where('user_id', '!=', $connected_user->id);
        })->exists();
        $isValidator = Approbateur::where('email', $connected_user->email)->exists();
        if ($isValidator && $isManager) {
            $profile = "Manager et Approbateur";
        } elseif ($isValidator) {
            $profile = "Approbateur";
        } elseif ($isManager) {
            $profile = "Manager";
        } elseif ($connected_user->compte->role->value === 'livraison') {
            $profile = "Livreur";
        } else {
            $profile = "";
        }

        return view('layouts.app', compact('profile'));
    }
}
