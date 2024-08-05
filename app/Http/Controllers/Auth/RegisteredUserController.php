<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Compte;
use App\Models\Direction;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $users = User::all();
        $directions = Direction::all();
        $services = Compte::select('service')->distinct()->get();
        if (Session::has('user')) {
            return view('auth.register', compact('users', 'directions', 'services'));
        } else {
            return redirect()->route('login')->with('error', 'Veuillez d\'abord vous connecter');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'direction' => ['required', 'string'],
            'manager' => ['required', 'string'],
            'service' => ['required', 'string'],
        ]);

        // dd($request->all());
        $manager = User::where('name', '=', $request->manager)->first();
        $direction = Direction::where('name', '=', $request->direction)->first();
        $username = session('user');

        $response = Http::get("http://10.143.41.70:8000/promo2/odcapi/?method=getUserByUsername&username=$username");
        if ($response->successful()) {
            $userResponse = $response->json();
            $userData = $userResponse['users'][0];
            $user = User::create([
                'name' => $userData['first_name'] .  ' ' . $userData['last_name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
            ]);
            Session::put('authUser', $user);
            if ($user) {
                Compte::create([
                    "manager" => $manager->id,
                    "user_id" => $user->id,
                    "service" => $request->service,
                    "direction_id" => $direction->id
                ]);
            }
            event(new Registered($user));

            Auth::login($user);
            return redirect()->route('demandes.index');
        }
        return back();
    }
}
