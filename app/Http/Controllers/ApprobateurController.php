<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Approbateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApprobateurController extends Controller
{
    public function index()
    {
        $users = User::all();
        $approbateurs = Approbateur::query()
        ->orderBy('level','asc')
        ->get();
        return view('approbateurs.index', compact('approbateurs','users'));
    }
    public function create()
    {
       //
    }
    public function store(Request $request)
        {
            $levels = $request->input('level');
            $names = $request->input('name');
            $fonctions = $request->input('fonction');
            $emails = $request->input('email');
        
            for ($i = 0; $i < count($levels); $i++) {
                $user = User::where('name', $names[$i])->where('email', $emails[$i])->first();
        
                if ($user) {
                    $existEmail = Approbateur::where('email', $emails[$i])->first();
                    $existName = Approbateur::where('name', $names[$i])->first();
        
                    if ($existEmail || $existName) {
                        return redirect()->back()->with('error', 'Un approbateur avec cet email ou nom existe déjà.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Aucun utilisateur correspondant trouvé pour le nom et l\'email fournis.');
                }
            }
            for ($i = 0; $i < count($levels); $i++) {
                $user = User::where('name', $names[$i])->where('email', $emails[$i])->first();
                if ($user) {
                    Approbateur::create([
                        'level' => $levels[$i],
                        'name' => $user->name,
                        'fonction' => $fonctions[$i],
                        'email' => $user->email,
                    ]);
                }
            }    
            return redirect()->back()->with('message', 'Approbateur ajouté avec succès');
        }
    public function edit($id)
    {
        $approbateurs = Approbateur::findOrFail($id);
        return view('approbateurs.index', compact('approbateurs'));
    }
    public function update(Request $request, $id)
    {
        $dataVal = $request->validate([
            'approbateurs' => 'required|array',
            'approbateurs.*.id' => 'nullable|exists:approbateurs,id',
            'approbateurs.*.level' => 'required|integer',
            'approbateurs.*.name' => 'required|string|max:255',
            'approbateurs.*.fonction' => 'required|string|max:255',
            'approbateurs.*.email' => 'required|email|max:255',
        ]);
        foreach ($dataVal['approbateurs'] as $Data) {
            if (isset($Data['id'])) {
                $approbateur = Approbateur::find($Data['id']);
                $approbateur->update($Data);
            } else { 
                Approbateur::create($Data);
            }
        }
        return back();
    }
    public function destroy($id)
    {
        $approbateur = Approbateur::findOrFail($id);
        $approbateur->delete();
            $approubateurs = Approbateur::orderBy('level')->get();
            foreach ($approubateurs as $index => $approubateur) {
                $approubateur->update(['level' => $index + 1]);
            }
                return  redirect()->back()->with('message', 'Approbateur supprimé avec succès');
    }
    public function updateLevels(Request $request)
    {
        $approbateurIds = $request->input('approbateurIds');
        $datas = [];
        foreach ($approbateurIds as $key => $id) {
            $approbateur = Approbateur::where('id', $id)->first();
            $datas[$key]['email'] = $approbateur['email'];
            $datas[$key]['name'] = $approbateur['name'];
            $datas[$key]['fonction'] = $approbateur['fonction'];
            $datas[$key]['level'] = $key + 1;
        }
            Approbateur::truncate();
        foreach ($datas as $data) {
            DB::table('approbateurs')->Insert($data);
            
        }
        $stock = Approbateur::all();
        return response()->json([
            'message' => 'Niveaux des approbateurs mis à jour avec succès.',
            'data' => $stock,
        ]);
    }
}