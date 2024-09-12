<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Models\Compte;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        $response = Http::get("http://10.143.41.70:8000/promo2/odcapi/?method=getUsers");
        if ($response->successful()) {
            $users = $response->json()['users'];
        }

        $directions = Direction::all();


        $services = Compte::select('service')->distinct()->get();

        $city = Compte::select('city')->distinct()->get();

        if (Session::has('user')) {
            return view('auth.register', compact('users', 'directions', 'services', 'city'));
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
            'city' => ['required', 'string'],
        ]);

        if (Direction::where('name', $request->direction)->exists()) {
            $direction = Direction::where('name', '=', $request->direction)->first();
        } else {
            if (Session::get('admin') === null) {
                return back()->with('error', 'Cette direction n\'existe pas!');
            } else {
                $direction = Direction::create([
                    'name' => $request->direction
                ]);
            }
        }

        if (Compte::where('city', $request->city)->exists()) {
            $city = Compte::select('city')->distinct()->where('city', $request->city)->first()->city;
        } else {
            $city = $request->city;
        }

        if (User::where('name', $request->manager)->exists()) {
            $exist_manager = User::where('name', $request->manager)->first();
            $manager = $exist_manager->id;
        } else {
            $user_array = explode(' ', $request->manager);
            $response = Http::get("http://10.143.41.70:8000/promo2/odcapi/?method=getUserByName&name=$user_array[0]");
            if ($response->successful()) {
                $userResponse = $response->json();
                $managerData = $userResponse['users'][0];
                $manager = $managerData['id'];
            }
        }
        if (Session::has('admin')) {
            $adminData = Session::get('user');
            $userInsert = DB::table('users')->insert([
                'id' => $adminData['id'],
                'name' => $adminData['first_name'] .  ' ' . $adminData['last_name'],
                'email' => $adminData['email'],
                'password' => Hash::make($adminData['password']),
            ]);
            if ($userInsert) {
                $user = User::find($adminData['id']);
                Compte::create([
                    "manager" => $user->id,
                    "user_id" => $user->id,
                    "service" => $request->service,
                    "direction_id" => $direction->id,
                    "role" => RoleEnum::ADMIN,
                    "city" => $city
                ]);
                Session::put('user', $adminData['username']);
            }
        } else {
            $username = session('user')['username'];
            $response = Http::get("http://10.143.41.70:8000/promo2/odcapi/?method=getUserByUsername&username=$username");

            if ($response->successful()) {
                $userResponse = $response->json();
                $userData = $userResponse['users'][0];
                $userInsert = DB::table('users')->insert([
                    'id' => $userData['id'],
                    'name' => $userData['first_name'] .  ' ' . $userData['last_name'],
                    'email' => $userData['email'],
                    'password' => Hash::make('password')
                ]);
                if ($userInsert) {

                    $user = User::find($userData['id']);
                    Compte::create([
                        "manager" => $manager,
                        "user_id" => $user->id,
                        "service" => $request->service,
                        "direction_id" => $direction->id,
                        "role" => RoleEnum::USER,
                        "city" => $city
                    ]);
                    Session::put('user', $userData['username']);
                }
            }
        }
        if ($user) {
            Session::put('authUser', $user);
            if ($user->compte->role->value === 'livraison') {
                return redirect()->route('dashboard');
            } elseif ($user->compte->role->value === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->compte->role->value === 'user') {
                return redirect()->route('demandes.index');
            }
        } else {
            return back();
        }
    }
}
