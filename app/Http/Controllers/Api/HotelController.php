<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Hotel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class HotelController extends Controller
{
    public function store(Request $request)
    {
        Gate::authorize('isOwner');
        
        $validator = Validator::make($request->all(), [
            'title'=>['required'],
            'address'=>['required'],
            
            'postPhoto' =>  ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'images.*' =>  [ 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ]);
    
       
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please enter valid data!',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }
        $hotel =new Hotel();

        $hotel->city_id=1;
        $hotel->title = $request->title;
        $hotel->rate = (int) $request->rate;
        $hotel->features = $request->features;
        $hotel->price = $request->price;
        $hotel->address = $request->address;
        $hotel->link=$request->link;
        $hotel->status='pending';
        $hotel->user_id=auth()->user()->id;
        
        $hotel->save();

        //post photo
        
        if ($request->hasFile('postPhoto')) {

            $mainPhoto = $request->file('postPhoto');
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userHotels';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName =  $mainPhoto->getClientOriginalName();

            $mainPhoto->move($destinationPath, $fileName);
            $relativePath = '/images/userHotels/' . $fileName; 
            $photo=new Photo();
            $photo->hotel_id=$hotel->id; 
            $photo->path=$relativePath;
            $photo->type = "post";
            $photo->save();
         
        }else{
            return response()->json([
                'message'=>"something went wrong about postphoto"
             ], 402);
        } 
       
    
        if ($request->hasFile('images')) {
            // $mainPhoto = $request->file('image');
              
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/userHotels/'.$hotel->id;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            foreach ($request->file('images') as $mainPhoto) {
               
                $fileName =  $mainPhoto->getClientOriginalName();
                
                // Move the file to the destination path
                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/userHotels/'.$hotel->id.'/' . $fileName;
                $photo = new Photo();
                $photo->hotel_id=$hotel->id;
                $photo->path= $relativePath;
                $photo->type='slider';
                $photo->save();
                
            }
       }
        


        
        return response()->json($hotel,201,['message'=>'Hotel requested successfully!']);
    }
}
