<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{

    public function index()
    {
        //
        return view('demandes.index',compact('demandes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    // etc

}
