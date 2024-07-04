<?php
namespace App\Http\Controllers;
use App\Models\Approbateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class approbateurController extends Controller
{
    public function index()
    {
        $approbateurs = Approbateur::query()
        ->orderBy('level','asc')
        ->get();
        return view('approbateurs.index', compact('approbateurs'));
    }
    public function create()
    {
       //
    }
    public function store(Request $request)
    {
            $data = $request->all();
            $level = $request->input('level');
            $name = $request->input('name');
            $fonction = $request->input('fonction');
            $email = $request->input('email');
        for ($i=0; $i < count($level); $i++){
                $data = [
                    'level'=>$level[$i],
                    'name'=>$name[$i],
                    'fonction'=>$fonction[$i],
                    'email'=>$email[$i]
            ];
            DB::table('approbateurs')->Insert($data);
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
        return redirect()->back()->with('message', 'Approbateurs mis à jour avec succès');
    }
    public function destroy($id)
    {
        $approbateur = Approbateur::findOrFail($id);
        $approbateur->delete();
            $approubateurs = Approbateur::orderBy('level')->get();
            foreach ($approubateurs as $index => $approubateur) {
                $approubateur->update(['level' => $index + 1]);
            }
                return back();
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