<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Restaruant;
use Illuminate\Support\Facades\Validator;


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
        


        
        return response()->json($rest,200,['message'=>'Restaruant requested successfully!']);
    }
    
}
