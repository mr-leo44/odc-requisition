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
                return redirect()->route('demandes.index');
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
        $request->session()->put('authUser', null);
        return redirect('login');
    }
}
