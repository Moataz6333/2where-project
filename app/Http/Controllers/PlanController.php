<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Restaruant;
use App\Models\Hotel;
use App\Models\Plan;
class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans =Plan::all();
        return view('plans.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $places =Place::all();
        $rests =Restaruant::all();
        $hotels =Hotel::all();
        return view('plans.create',compact('places','rests','hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $plan =new Plan();
        $plan->title=$request->title;
        $plan->description=$request->description;
        $plan->save();

       if(!empty($request->places)){
            $plan->places()->sync($request->places);
       }
       if(!empty($request->hotels)){
            $plan->hotels()->sync($request->hotels);
       }
       if(!empty($request->rests)){
            $plan->restaruants()->sync($request->rests);
       }
       return redirect()->back()->with('success','plan created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $plan=Plan::find($id);
        return view('plans.show',compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
      
        $plan =Plan::find($id);
        $plan_places=[];
        foreach($plan->places as $place){
            array_push($plan_places,$place->id);
        }
        $plan_rests=[];
        foreach($plan->restaruants as $rest){
            array_push($plan_rests,$rest->id);
        }
        $plan_hotels=[];
        foreach($plan->hotels as $hotel){
            array_push($plan_hotels,$hotel->id);
        }
        $places =Place::all();
        $rests=Restaruant::all();
        $hotels=Hotel::all();
       
        return view('plans.edit',compact('plan','places','rests','hotels','plan_places','plan_rests','plan_hotels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $plan =Plan::find($id);
        $plan->title=$request->title;
        $plan->description=$request->description;
        

       if(!empty($request->places)){
            $plan->places()->sync($request->places);
       }
       if(!empty($request->hotels)){
            $plan->hotels()->sync($request->hotels);
       }
       if(!empty($request->rests)){
            $plan->restaruants()->sync($request->rests);
        }
        $plan->save();
       return redirect()->back()->with('success','plan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan =Plan::find($id);
        $plan->delete();
        return redirect()->back()->with('success','plan deleted successfully!');
    }
}
