<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourGuide;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TourGuideResource;

class TourGideController extends Controller
{
    // index
    public function tourGuides()  {
        $tourGuides =TourGuide::where('accepted',true)->get();
       
        return response(TourGuideResource::collection($tourGuides),200,[]);
    }
    public function tourGuide(Request $request)  {
        // id
        $tourGuide = TourGuide::findOrFail($request->id);
        if($tourGuide->accepted){

            return response()->json(new TourGuideResource($tourGuide),200);
        }
            return response()->json([
                "message"=>"tourGuide not found"
            ],404);
      
    }
    // request to be a tour guide
    public function request(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id','unique:tour_guides'],
            'areas' => ['required','min:4' ,'max:255' ],
            'about' => ['required','min:10' ,'max:300' ],
            'languages' => ['required', 'min:3', 'max:300'],
            'experience'=>['required','min:3' , 'max:100'],
            'licence'=>['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'national_id'=>['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048']
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }


        // first change the role of the user
        $user =User::find($request->user_id);
        $user->role="tourGuide";
        $user->save();

        $tourGuide =new TourGuide();
        $tourGuide->user_id=$request->user_id;
        $tourGuide->about=$request->about;
        $tourGuide->areas=$request->areas;
        $tourGuide->languages=$request->languages;
        $tourGuide->experience=$request->experience;
        if ($request->hasFile('licence')) {

            $mainPhoto = $request->file('licence');
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/tour-guides';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName =  $mainPhoto->getClientOriginalName();

            $mainPhoto->move($destinationPath, $fileName);
            $relativePath = '/images/tour-guides/' . $fileName;  
    
           
           
            $tourGuide->licence=$relativePath;
         
        
        }else{
            return response()->json([
                'message' => 'Some errors happened',
            ], 422);
        }
        if ($request->hasFile('national_id')) {

            $mainPhoto = $request->file('national_id');
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/tour-guides';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName =  $mainPhoto->getClientOriginalName();

            $mainPhoto->move($destinationPath, $fileName);
            $relativePath = '/images/tour-guides/' . $fileName;  
    
           
           
            $tourGuide->national_id=$relativePath;
    
           
        
        }else{
            return response()->json([
                'message' => 'Some errors happened',
            ], 422);
        }
        
        $tourGuide->save();

        return response()->json([
            'message' => 'The Request Sended Successfully! , Wait For Acception',
            'user'=>$tourGuide,
        ], 200); 
       
    }
}
