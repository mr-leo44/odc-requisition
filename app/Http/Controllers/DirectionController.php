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
        $request->validate([
            'name' => 'required|string|max:50',
        ]);
        $directions = new Direction();
        $directions->name = $request->name;
        $directions->save();
        return redirect()->route('directions.index')->with('success', 'Direction créée avec succès');
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
        $direction = Direction::find($request->id);
        $direction->update([
            'name' => $request->name,
        ]);
        return back()->with('success', 'Direction modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direction $direction )
    {
        
        $direction->delete();
        return back()->with('success', 'Direction supprimée avec succès');
    }
}
