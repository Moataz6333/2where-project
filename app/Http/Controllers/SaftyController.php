<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Safty;
use App\Models\Accessability;
class SaftyController extends Controller
{
    public function index($id){
        $city=City::find($id);
        
      
        return view('cities.safty',['city'=>$city,'keys'=>$city->SaftyKeys]);
    }
    public function store(Request $request,$id){
        Safty::create([
            'city_id'=>$id,
            'title'=>$request->title,
            'description'=>$request->description
        ]);

        return redirect()->back()->with('success','Key Added successfully!');
    }
    public function update(Request $request,$id){
        $safty =Safty::find($id);
        $safty->title=$request->title;
        $safty->description=$request->description;
        $safty->save();
        return redirect()->back()->with('success','Key Updated successfully!');

    }
    public function destroy($id){
        $safty =Safty::find($id);
        $safty->delete();
        return redirect()->back()->with('success','Key deleted successfully!');

    }
    public function updateSaftyDescription(Request $request,$id){
        $city=City::find($id);
        $city->safty=$request->safty;
        $city->save();
        return redirect()->back()->with('success','Safty description updated successfully!');

    }

}
