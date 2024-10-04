<?php

namespace App\Http\Controllers;

use App\Models\Approbateur;
use App\Models\User;
use App\Models\Compte;
use App\Models\Delegation;
use Illuminate\Http\Request;
use App\View\Components\users;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\returnSelf;

class DelegationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $delegations = Delegation::all();
        // return view('components.delegations',compact('delegations'));
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
        $name = $request->input('delegue');
        $delegant = $request->input('delegant');
        $motif = $request->input('motif');
        $date1 = $request->input('date_debut');
        $date2 = $request->input('date_fin');

        $dateDebut = \Carbon\Carbon::parse($date1);
        $dateFin = \Carbon\Carbon::parse($date2);
        $dateCourante = \Carbon\Carbon::now();

        if ($dateDebut->lt($dateCourante)) {
            return redirect()->back()->with('error', 'La date de début ne peut pas être inférieure à la date actuelle.');
        }
        if ($dateDebut->gte($dateFin)) {
            return redirect()->back()->with('error','La date de début doit être inférieure à la date de fin.');
        }
        $user_id = User::where('name', $name)->value('id');
        $data = [
            'user_id' => $user_id,
            'motif' => $motif,
            'date_debut' => $date1,
            'date_fin' => $date2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        if (is_null($user_id)) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }
        $delegant_id = User::where('name', $delegant)->value('id');
        $manager_id = Compte::where('manager', '=', $delegant_id)->value('manager');
        $approver_id = Approbateur::where('name','=',$name)->value('id');
        $livreur_id = Compte::where('role','!=','user')->value('id');
        if ($this->checkIdInAPI($name) !== false) {
            if( is_null($manager_id) && is_null($approver_id) && is_null($livreur_id)) {
                return redirect()->back()->with('error','Aucun utilisateur trouvé');
            }elseif( Delegation::where('user_id', $user_id)->where('status','=',1)->exists() || Delegation::where('delegant', $delegant_id)->where('status','=',1)->exists()) {
                return redirect()->back()->with('error', 'Délégation en cours');
            }else {
                $data['delegant'] = $delegant_id;
                Delegation::create($data);
            }
            return redirect()->back()->with('delegation', 'Délégation effectuée avec succès !');
        }

        return redirect()->back()->with('error','Erreur lors de la vérification de l\'ID.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Delegation $delegation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delegation $delegation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delegation $delegation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delegation = Delegation::findOrFail($id);
        $delegation->delete();
        return redirect()->back()->with('delegation', "Délégué supprimé avec succès.");
    }
    private function checkIdInAPI($name)
    {
        $response = Http::get('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers');
        if ($response->successful()) {
            $data = $response->json();
            if ($data['success']) {
                $users = $data['users'];
                foreach ($users as $user) {
                    if ($user['first_name'] . ' ' . $user['last_name'] === $name) {
                        return $user['id'];
                    }
                }
            }
        }
        return false;
    }
}
