<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TourGuide;
use App\Models\Photo;
use App\Models\Blog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //returns my own blogs
        Gate::authorize('isTourGuide');
        $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
        Gate::authorize('TourGuideAccepted',$tourGuide);
        $blogs =[];
        foreach ($tourGuide->blogs as $blog) {
            array_push($blogs,[
                'id'=>$blog->id,
                'description'=>$blog->description,
                'created_at'=>$blog->created_at,
                'photos'=>$blog->photos
            ]);
        }
        return response()->json([
           
            "blogs"=>$blogs
          
             ],200);
    }

  
    public function store(Request $request)
    {
        // description , images 
        Gate::authorize('isTourGuide');
        $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
        Gate::authorize('TourGuideAccepted',$tourGuide);
        $validator = Validator::make($request->all(), [
            'description'=>[ 'min:1' , 'max:255'],
            'images'=>['array','min:1' , 'max:6'],
            'images.*' => [ 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048']
           
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }

            if($request->description || $request->images){

                $blog =new Blog();
                $blog->tour_guide_id =$tourGuide->id;
                $blog->description =$request->description;
                $blog->save();
        
                if ($request->hasFile('images')) {
                   
                      
                    $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/blogs/'.$blog->id;
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
        
                    foreach ($request->file('images') as $mainPhoto) {
                       
                        $fileName =  $mainPhoto->getClientOriginalName();
                        
                        // Move the file to the destination path
                        $mainPhoto->move($destinationPath, $fileName);
                        $relativePath = '/images/blogs/'.$blog->id.'/' . $fileName;
                        $photo = new Photo();
                        $photo->path= $relativePath;
                        $photo->blog_id=$blog->id;
                        $photo->save();
                        
                    }
                }
                return response()->json([
                 "message"=>"blog created SuccessFully",
                 'id'=>$blog->id,
                 'description'=>$blog->description,
                 'created_at'=>$blog->created_at,
                 'photos'=>$blog->photos
               
                  ],200);
            }

             return response()->json([
                 "message"=>"blog must contain a body",
               
               
                  ],400);
       

    }

    
    public function show(string $id)
    {
        Gate::authorize('isTourGuide');
        $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
        Gate::authorize('TourGuideAccepted',$tourGuide);
        $blog = Blog::findOrFail($id);
        if($blog->tour_guide_id === $tourGuide->id){
           return response()->json([
            'id'=>$blog->id,
            'description'=>$blog->description,
            'created_at'=>$blog->created_at,
            'photos'=>$blog->photos

           ]
            , 200);
        }else{
            return response()->json([
                "message"=>"not authorized"
            ], 403);
        }
    }

   
   
   
    public function update(Request $request)
    {
          // description , images 
          Gate::authorize('isTourGuide');
          $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
          Gate::authorize('TourGuideAccepted',$tourGuide);
          $validator = Validator::make($request->all(), [
            'blog_id'=>['required','exists:blogs,id'],
              'description'=>[ 'min:1' , 'max:255'],
              'images'=>['array','min:1' , 'max:6'],
              'images.*' => [ 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048']
             
          ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'message' => 'Validation errors',
                  'errors' => $validator->errors(),  // Return validation errors
              ], 422);  // 422 Unprocessable Entity
          }
                $blog =Blog::findOrFail($request->blog_id);
            
                Gate::authorize('OwnBlog',$blog);
                
  
              if($request->description || $request->images){

                 
                  $blog->description =$request->description;
                  $blog->save();
          
                  if ($request->hasFile('images')) {
                     
                        
                      $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/blogs/'.$blog->id;
                      if (!file_exists($destinationPath)) {
                          mkdir($destinationPath, 0777, true);
                      }
          
                      foreach ($request->file('images') as $mainPhoto) {
                         
                          $fileName =  $mainPhoto->getClientOriginalName();
                          
                          // Move the file to the destination path
                          $mainPhoto->move($destinationPath, $fileName);
                          $relativePath = '/images/blogs/'.$blog->id.'/' . $fileName;
                          $photo = new Photo();
                          $photo->path= $relativePath;
                          $photo->blog_id=$blog->id;
                          $photo->save();
                          
                      }
                  }
                  return response()->json([
                   "message"=>"blog Updated SuccessFully",
                   'id'=>$blog->id,
                   'description'=>$blog->description,
                   'created_at'=>$blog->created_at,
                   'photos'=>$blog->photos
                 
                    ],201);
              }
  
               return response()->json([
                   "message"=>"blog must contain a body",

                    ],400);
        
    }

   
    public function destroy(string $id)
    {
        Gate::authorize('isTourGuide');
        $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
        Gate::authorize('TourGuideAccepted',$tourGuide);
        $blog =Blog::findOrFail($id);
        Gate::authorize('OwnBlog',$blog);
        
        if($blog->photos){
            foreach($blog->photos as $photo){
                $file = $_SERVER['DOCUMENT_ROOT'].$photo->path;
                unlink($file);
                $photo->delete();
            }
            $blog->delete();
            return response()->json([
                'message' => 'blog deleted successfully!',
            ], 200);
        }
        
    }

    // delete a photo from a blog
    public function delPhoto(Request $request){
        Gate::authorize('isTourGuide');
        $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
        Gate::authorize('TourGuideAccepted',$tourGuide);
        $validator = Validator::make($request->all(), [
            'photo_id'=>[ 'required','exists:photos,id']
           
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }
        $photo=Photo::findOrFail($request->photo_id);

        $blog =Blog::findOrFail($photo->blog_id);
        Gate::authorize('OwnBlog',$blog);
        $file = $_SERVER['DOCUMENT_ROOT'].$photo->path;
        unlink($file);
        $photo->delete();
        return response()->json([
            'message' => 'photo deleted successfully!',
            'id'=>$blog->id,
            'description'=>$blog->description,
            'created_at'=>$blog->created_at,
            'photos'=>$blog->photos
        ], 200);
    }
}
