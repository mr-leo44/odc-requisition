<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Compte;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('compte')->where('id', '!=', Session::get('authUser')->id)->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'direction' => ['required', 'string'],
            'manager' => ['required', 'string'],
            'service' => ['required', 'string'],
        ]);

        $user_array = explode(' ', $request->name);
        $response = Http::get("http://10.143.41.70:8000/promo2/odcapi/?method=getUserByName&name=$user_array[0]");
        if ($response->successful()) {
            $userResponse = $response->json();
            $userData = $userResponse['users'][0];
        }
        $Users = new User();
        $Users->name = $request->name;
        $Users->save();
        return redirect()->route('Users.index')->with('success', 'User créée avec succès');
    }

    public function changeRole(Request $request, User $user)
    {
        $user = User::find($request->id);
        $profile = Compte::where('user_id', $user->id)->first();
        $profile->update([
            'role' => $request->role,
        ]);
        return back()->with('success', 'Rôle attribué avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        //
    }
}
