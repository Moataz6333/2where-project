<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tradition;
use App\Models\City;
use App\Models\Photo;

class TraditionsController extends Controller
{
    public function traditions($id){
        $city=City::find($id);
       
       $traditions=$city->traditions;
      
        return view('traditions.index',['city'=>$city,'traditions'=>$traditions]);
    }
    public function create($id){
        $city=City::find($id);
        return view('traditions.create',['city'=>$city]);
    }
    public function store(Request $request, $id){
        // dd($request->all());
        $tradition=new Tradition();
        $tradition->city_id=$id;
        $tradition->title=$request->title;
        $tradition->description=$request->description;
        $tradition->save();

        $photo=new Photo();
        $photo->tradition_id=$tradition->id;

        $tradition_Photo = $request->file('tradition_Photo');
    
        
        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/traditions';
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        // You can rename the file or keep the original name
        $fileName =  $tradition_Photo->getClientOriginalName();
        
        // Move the file to the destination path
        $tradition_Photo->move($destinationPath, $fileName);
        $relativePath = '/images/traditions/' . $fileName;
        // Optionally save file info to the database, if needed
        $photo->path=$relativePath;
        // $photo->url=url($relativePath);
        $photo->type='traditon';
        $photo->save();
        return back()->with('success', 'Tradition Created successfully!');


    }
    public function edit($id){
        $tradition=Tradition::find($id);
        return view('traditions.edit',['trad'=>$tradition]);
    }
    public function update(Request $request,$id){
        $tradition=Tradition::find($id);

      
        $tradition->title=$request->title;
        $tradition->description=$request->description;
        $tradition->save();

        $photo=$tradition->photo->first();
        $photo->tradition_id=$tradition->id;
        if($request->hasFile('tradition_Photo')){
            $tradition_Photo = $request->file('tradition_Photo');
    
        
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/traditions';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            // You can rename the file or keep the original name
            $fileName =  $tradition_Photo->getClientOriginalName();
            
            // Move the file to the destination path
            $tradition_Photo->move($destinationPath, $fileName);
            $relativePath = '/images/traditions/' . $fileName;
            // Optionally save file info to the database, if needed
            $photo->path=$relativePath;
            // $photo->url=url($relativePath);
            $photo->type='traditon';
            $photo->save();
        }

       
        return back()->with('success', 'Tradition Updated successfully!');
    }
    public function destroy($id){
        $tradition=Tradition::find($id);
        $tradition->photo->first()->delete();
        $tradition->delete();
        return back()->with('success', 'Tradition Deleted successfully!');

    }
}
