<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Compte;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        //
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
