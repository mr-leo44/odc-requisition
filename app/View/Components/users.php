<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class users extends Component
{
    /**
     * Create a new component instance.
     */
    public $users;

    public function __construct($users)
    {
        $this->users = User::with('compte')->where('id', '!=', Session::get('authUser')->id)->latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users');
    }
}
  