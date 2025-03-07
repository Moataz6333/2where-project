<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Restaruant;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RestResource;

class RestaruantController extends Controller
{
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title'=>['required'],
            'address'=>['required'],
            'postPhoto' =>  ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'images.*' =>  [ 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'menu.*' =>  [ 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'proofs'=>['required','array'],
            'proofs.*' =>  [ 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],

            
        ]);
    
       
        if ($validator->fails()) {
            return response()->json([
                'message' => 'You are already registered!',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }
        // first or create
        $rest = Restaruant::where('user_id',auth()->user()->id)->first();
        if($rest){
            // update
            $rest->title = $request->title;
            $rest->rate = (int) $request->rate;
            $rest->categories = $request->categories;
            $rest->price = $request->price;
            $rest->address = $request->address;
            $rest->hours=$request->hours;
            $rest->save();
            if ($request->hasFile('postPhoto')) {

                $photo=Photo::where('restaruant_id',$rest->id)->where('type','post')->first(); 
                $file = $_SERVER['DOCUMENT_ROOT'].$photo->path;
                unlink($file);

                $mainPhoto = $request->file('postPhoto');
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $fileName =  $mainPhoto->getClientOriginalName();
    
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/userRests/' . $fileName; 
                
              
                $photo->path=$relativePath;

                $photo->save();
           
            } 
             if ($request->hasFile('menu')) {
                // delete the old ones
                $oldMenu =Photo::where('restaruant_id',$rest->id)->where('type','menu')->get();
                foreach($oldMenu as $menu){
                    $file = $_SERVER['DOCUMENT_ROOT'].$menu->path;
                    unlink($file);
                    $menu->delete();
                }
                  
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests/'.$rest->id.'/menus';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                foreach ($request->file('menu') as $mainPhoto) {

                    $fileName =  $mainPhoto->getClientOriginalName();
                    
                    // Move the file to the destination path
                    $mainPhoto->move($destinationPath, $fileName);
                    $relativePath = '/images/userRests/'.$rest->id.'/menus/' . $fileName;
                    $photo = new Photo();
                    $photo->restaruant_id=$rest->id;
                    $photo->path= $relativePath;
                    $photo->type='menu';
                    $photo->save();
                    
                }
           }
            if ($request->hasFile('images')) {
                // del the old photos
                $oldimages =Photo::where('restaruant_id',$rest->id)->where('type','slider')->get();
                foreach($oldimages as $oldImage){
                    $file = $_SERVER['DOCUMENT_ROOT'].$oldImage->path;
                    unlink($file);
                    $oldImage->delete();
                }
                  
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests/'.$rest->id;
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                foreach ($request->file('images') as $mainPhoto) {
                   
                    $fileName =  $mainPhoto->getClientOriginalName();
                    
                    // Move the file to the destination path
                    $mainPhoto->move($destinationPath, $fileName);
                    $relativePath = '/images/userRests/'.$rest->id.'/' . $fileName;
                    $photo = new Photo();
                    $photo->restaruant_id=$rest->id;
                    $photo->path= $relativePath;
                    $photo->type='slider';
                    $photo->save();
                    
                }
           }
            if ($request->hasFile('proofs')) {
                // del
                   // del the old photos
                   $oldimages =Photo::where('restaruant_id',$rest->id)->where('type','proofs')->get();
                   foreach($oldimages as $oldImage){
                       $file = $_SERVER['DOCUMENT_ROOT'].$oldImage->path;
                       unlink($file);
                       $oldImage->delete();
                   }
                  
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests/'.$rest->id;
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                foreach ($request->file('proofs') as $mainPhoto) {
                   
                    $fileName =  $mainPhoto->getClientOriginalName();
                    
                    // Move the file to the destination path
                    $mainPhoto->move($destinationPath, $fileName);
                    $relativePath = '/images/userRests/'.$rest->id.'/' . $fileName;
                    $photo = new Photo();
                    $photo->restaruant_id=$rest->id;
                    $photo->path= $relativePath;
                    $photo->type='proofs';
                    $photo->save();
                    
                }
           }

        return response()->json(['rest'=>new RestResource($rest) ,
           
    "message"=>"resturant updated successfully"],200);


        }else{
            // create
        
        $rest =new Restaruant();

        $rest->city_id=1;
        $rest->title = $request->title;
        $rest->rate = (int) $request->rate;
        $rest->categories = $request->categories;
        $rest->price = $request->price;
        $rest->address = $request->address;
        $rest->hours=$request->hours;
        $rest->status='pending';
        $rest->user_id=auth()->user()->id;
        
        $rest->save();

        //post photo
       
        if ($request->hasFile('postPhoto')) {

            $mainPhoto = $request->file('postPhoto');
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName =  $mainPhoto->getClientOriginalName();

            $mainPhoto->move($destinationPath, $fileName);
            $relativePath = '/images/userRests/' . $fileName; 
            $photo=new Photo();
            $photo->restaruant_id=$rest->id; 
            $photo->path=$relativePath;
            $photo->type = "post";
            $photo->save();
       
        }else{
            return response()->json([
                'message'=>"something went wrong about postphoto"
             ], 402);
        }       
       
    
        if ($request->hasFile('menu')) {
            // $mainPhoto = $request->file('image');
              
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests/'.$rest->id.'/menus';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            foreach ($request->file('menu') as $mainPhoto) {
               
                $fileName =  $mainPhoto->getClientOriginalName();
                
                // Move the file to the destination path
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/userRests/'.$rest->id.'/menus/' . $fileName;
                $photo = new Photo();
                $photo->restaruant_id=$rest->id;
                $photo->path= $relativePath;
                $photo->type='menu';
                $photo->save();
                
            }
       }
        if ($request->hasFile('images')) {
            // $mainPhoto = $request->file('image');
              
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests/'.$rest->id;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            foreach ($request->file('images') as $mainPhoto) {
               
                $fileName =  $mainPhoto->getClientOriginalName();
                
                // Move the file to the destination path
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/userRests/'.$rest->id.'/' . $fileName;
                $photo = new Photo();
                $photo->restaruant_id=$rest->id;
                $photo->path= $relativePath;
                $photo->type='slider';
                $photo->save();
                
            }
       }
        if ($request->hasFile('proofs')) {
            // $mainPhoto = $request->file('image');
              
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userRests/'.$rest->id;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            foreach ($request->file('proofs') as $mainPhoto) {
               
                $fileName =  $mainPhoto->getClientOriginalName();
                
                // Move the file to the destination path
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/userRests/'.$rest->id.'/' . $fileName;
                $photo = new Photo();
                $photo->restaruant_id=$rest->id;
                $photo->path= $relativePath;
                $photo->type='proofs';
                $photo->save();
                
            }
       }else{
                return response()->json([
                    
                    "message"=>"Proofs is required",
                ], 400);
            }
        


        
        return response()->json(['rest'=>new RestResource($rest),
            'message'=>'Restaruant requested successfully!'],200);
      }
    }
    
}
