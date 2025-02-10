<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\TourGuide;


class AlbumController extends Controller
{
    public function create(Request $request){
            // photos[url , url ,...]
            Gate::authorize('isTourGuide');
            Gate::authorize('TourGuideAccepted',TourGuide::where('user_id',auth()->user()->id)->first());
            $validator = Validator::make($request->all(), [
                'title'=>['required','min:3' , 'max:255'],
                'images'=>['required','array'],
                'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048']
               
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation errors',
                    'errors' => $validator->errors(),  // Return validation errors
                ], 422);  // 422 Unprocessable Entity
            }
                $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
                $album =new Album();
                $album->title=$request->title;
                $album->tourGuide_id = $tourGuide->id;
                $album->save();

                if ($request->hasFile('images')) {
                    // $mainPhoto = $request->file('image');
                      
                    $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/albums/'.$album->id;
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    foreach ($request->file('images') as $mainPhoto) {
                       
                        $fileName =  $mainPhoto->getClientOriginalName();
                        
                        // Move the file to the destination path
                        $mainPhoto->move($destinationPath, $fileName);
                        $relativePath = '/images/albums/'.$album->id.'/' . $fileName;
                        $photo = new Photo();
                        $photo->path= $relativePath;
                        $photo->album_id=$album->id;
                        $photo->save();
                        
                    }
              return response()->json([
               "message"=>"album created SuccessFully",
             
            ],200);
        }
        
        return response()->json(['message' => "something went wrong",400]);

          

    }
    // add photo to album
    public function add(Request $request)  {
        // album_id , photos
        Gate::authorize('isTourGuide');
        Gate::authorize('TourGuideAccepted',TourGuide::where('user_id',auth()->user()->id)->first());
        $validator = Validator::make($request->all(), [
            'album_id'=>['required'],
            'images.*' =>  ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
           
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }
            $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
          
        $album = Album::findOrFail($request->album_id);
            if($album->tourGuide_id == $tourGuide->id){
                if ($request->hasFile('images')) {
                    // $mainPhoto = $request->file('image');
                      
                    $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/albums/'.$album->id;
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    foreach ($request->file('images') as $mainPhoto) {
                       
                        $fileName =  $mainPhoto->getClientOriginalName();
                        
                        // Move the file to the destination path
                        $mainPhoto->move($destinationPath, $fileName);
                        $relativePath = '/images/albums/'.$album->id.'/' . $fileName;
                        $photo = new Photo();
                        $photo->path= $relativePath;
                        $photo->album_id=$album->id;
                        $photo->save();
                        
                    }
              return response()->json([
               "message"=>"album updated SuccessFully",
            ],200);
        }  
            }
            return response()->json([
                'message' => 'unauthorize action',
            ], 403);
    }
    // delete photo from album
    public function deletePhoto(Request $request){
        Gate::authorize('isTourGuide');
        Gate::authorize('TourGuideAccepted',TourGuide::where('user_id',auth()->user()->id)->first());
        $validator = Validator::make($request->all(), [
            'photo_id' => ['required'],
           
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }

        $photo = Photo::findOrFail($request->photo_id);
        $album =Album::findorFail($photo->album_id);
        $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
        if($album->tourGuide_id == $tourGuide->id){
            //delete
            $file = $_SERVER['DOCUMENT_ROOT'].$photo->path;
            unlink($file);
            $photo->delete();
            return response()->json([
                'message' => 'photo deleted successfully!',
            ], 200);
        }
        return response()->json([
            'message' => 'unauthorize action',
        ], 403);

    }
    // delete  album
    public function deleteAlbum(Request $request){
        Gate::authorize('isTourGuide');
        Gate::authorize('TourGuideAccepted',TourGuide::where('user_id',auth()->user()->id)->first());
        $validator = Validator::make($request->all(), [
            'album_id' => ['required'],
           
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }

        $album =Album::findorFail($request->album_id);
        $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
        if($album->tourGuide_id == $tourGuide->id){
            //delete
            foreach($album->photos as $photo){
                $file = $_SERVER['DOCUMENT_ROOT'].$photo->path;
                unlink($file);
                $photo->delete();
            }
            $album->delete();
            return response()->json([
                'message' => 'album deleted successfully!',
            ], 200);
        }
        return response()->json([
            'message' => 'unauthorize action',
        ], 403);

    }
}
