<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create()
    {

        // if(Session::has('user')){
        //     return redirect()->route('dashboard');
        // }
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $data = [
            "username" => $request->username,
            "password" => $request->password
        ];
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('http://10.143.41.70:8000/promo2/odcapi/?method=login', $data);
        if ($response->successful()) {
            $request->session()->regenerate();
            $responsefinal = $response->json();
            $user= User::where('email', $responsefinal['user']['email'])->first();
            if ($user) {
                Session::put('authUser', $user);
                return redirect()->route('dashboard');
            } else {
                $id = $responsefinal['user']['id'];
                Session::put('user', $request->username);
                return redirect()->route('register')->with('id',$id);
            }
        } else {
            return redirect()->route('login');
        }
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        // Deconnecte l'utilisateur
        // Auth::guard('web')->logout();

        // Invalide la session 
        // $request->session()->invalidate();
        // Génère un nouveau jeton pour la session
        // $request->session()->regenerateToken();
        // Redirege l'utilisateur vers la page d'acceuil
        // return redirect('dashboard');

        Session::forget('user');
        Session::forget('authUser');
        Auth::guard('web')->logout();
        return redirect('/');
    }

    // public function storeRegister(Request $request)
    // {
    //     $user = Auth::user();
    //     $user->manager_id = $request->compte;
    //     $user->service_id = $request->compte;
    //     $user->direction_id = $request->compte;


    //     return redirect()->route('dashboard');
    // }
}