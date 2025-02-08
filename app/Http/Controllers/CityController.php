<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities=City::all();
        
        return view('cities.index',['cities'=>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $city = new City();
        $city->title=$request->title;
        $city->description=$request->description;
        $city->rate=(int) $request->rate;
        $city->safty=$request->safty;
        $city->save();
        return redirect()->back()->with('success', 'City Created successfully!');
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
    public function edit( $id)
    {
        $city=City::find($id);
        return view('cities.edit',['city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city=City::find($id);
        $city->title=$request->title;
        $city->description=$request->description;
        $city->rate=(int) $request->rate;
        $city->safty=$request->safty;
        $city->save();
        return redirect()->back()->with('success', 'City Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $city =City::find($id);
        $city->delete();
        return redirect()->back()->with('success', 'City Deleted successfully!');
    }
}
