<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Compte;
use App\Models\Service;
use App\Models\Direction;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $services = Service::all();
        if (Session::has('user')) {
            return view('auth.register', compact('users', 'directions', 'services'));
        } else {
            return redirect()->route('login');
        }
    }

    public function search_service(Request $request)
    {
        $data = Service::select("name", "id")
            ->where('name', 'LIKE', '%' . $request->get('search_service') . '%')
            ->get();
        return response()->json($data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'direction' => ['required', 'string','exists:directions,name'],
            'manager' => ['required', 'string','exists:users,name'],
            'service' => ['required', 'string'],
        ],['direction.exists'=>'Direction non trouvée.']);
        $manager = User::where('name', '=', $request->manager)->first();
        if ($manager){
            $manager_id = $manager->id;
        }else{
            return back()->withErrors('Manager non trouvé');
        }
        $direction = Direction::where('name', '=', $request->direction)->first();
        if ($direction){
            $direction_id = $direction->id;
        }
        else{
            return back()->withError('Direction non trouvée');
        }
        $direction_id = $direction['id'];

        $service =DB::table('services')
            ->select('id')
            ->where('direction_id','=', $direction_id)
            ->first();

        if ($service) {
            $service_id=$service->id;
        }else{
            return back()->withErrors(['service'=>'Aucun service correspondant']);
        }
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
                    "manager" => $manager_id,
                    "user_id" => $user->id,
                    "service_id" => $service_id,
                ]);
            }
            event(new Registered($user));

            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return back();
    }
}
