<?php
namespace App\Http\Controllers;
use App\Models\Direction;
use App\Http\Requests\UpdateDirectionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directions = Direction::all();
        $directions = Direction::paginate();
        return view('directions.index', compact('directions'));
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
        $names =    $request->validate([
                    'name' => 'required|string|max:50',
                ]);
        $directionExist = Direction::where('name',$names)->first();
        if($directionExist) {
            return redirect()->back()->with('error', 'Direction déjà existante');
        }else{
            $directions = new Direction();
            $directions->name = $request->name;
            $directions->save();
        }
        return redirect()->back()->with('message', 'Direction créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direction $direction)
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
    public function destroy(Direction $direction )
    {
        
        $direction->delete();
        return back()->with('message', 'Direction supprimée avec succès');
    }
}
