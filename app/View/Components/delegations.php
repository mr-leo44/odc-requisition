<?php

namespace App\View\Components;

use App\Models\Approbateur;
use Closure;
use App\Models\User;
use App\Models\Delegation;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class delegations extends Component
{
    /**
     * Create a new component instance.
     */
    public $delegations; 

    public function __construct($delegations)
    {
        $this->delegations = Delegation::all();
        
        foreach ($this->delegations as $delegation) {
            $manager = User::find($delegation->delegant);
            if ($manager && !is_null($manager->name)) {
                $delegation['manager_name'] = $manager->name; 
            }
        }
        
        foreach($this->delegations as $delegation) {
            $approbateur = Approbateur::find($delegation->delegant);
            if ($approbateur && !is_null($approbateur->name)) {
                $delegation['approbateur_name'] = $approbateur->name;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $users = User::all();
        $response = Http::get("http://10.143.41.70:8000/promo2/odcapi/?method=getUsers");
        if ($response->successful()) {
            $usersList = $response->json()['users'];
        }
        return view('components.delegations',compact('users','usersList'));
    }
}
