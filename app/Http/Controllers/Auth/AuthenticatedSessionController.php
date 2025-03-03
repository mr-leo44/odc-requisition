<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Models\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
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
            $responseFinal = $response->json();
            if (User::all()->count() == 0) {
                $responseFinal['user']['password'] = $data['password'];
                Session::put('user', $responseFinal['user']);
                Session::put('admin', RoleEnum::ADMIN);
                return redirect()->route('register');
            } else {
                $user = User::where('email', $responseFinal['user']['email'])->first();
                if ($user) {
                    // dd($user->compte->is_activated);
                    if ($user->compte->is_activated === 0) {
                        return back()->with('error', 'Votre compte a été désactivé. veuillez contacter l\'admin pour activation');
                    } else {
                        Session::put('authUser', $user);
                        Session::put('user', $responseFinal['user']['username']);
                        if ($user->compte->role->value === 'admin') {
                            return redirect()->route('admin.index');
                        } elseif ($user->compte->role->value !== 'admin') {
                            return redirect()->route('demandes.index');
                        } else {
                            Session::put('admin', null);
                            Session::put('user', $responseFinal['user']);
                            return redirect()->route('register');
                        }
                    }
                } else {
                    Session::put('admin', null);
                    Session::put('user', $responseFinal['user']);
                    return redirect()->route('register');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Informations incorrects');
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
