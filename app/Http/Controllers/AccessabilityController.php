<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Accessability;

class AccessabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $place=Place::find($id);
        return view('access.index',['place'=>$place]);
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
    public function store(Request $request,$id)
    {
        Accessability::create([
            'place_id'=>$id,
            'description'=>$request->description,
        'ramps'=>$request->ramps,
        'elevators'=>$request->elevators,
        'facilities'=>$request->facilities
        ]);

        return redirect()->back()->with('success', 'Accessability Added successfully!');
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $access=Accessability::where('place_id',$id)->first();
        $access->description=$request->description;
        $access->ramps=$request->ramps;
        $access->elevators=$request->elevators;
        $access->facilities=$request->facilities;
        $access->save();
        return redirect()->back()->with('success', 'Accessability Updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
