<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TourGuide;
use App\Models\Photo;
use App\Models\Blog;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // return blogs with tourguide with id
       
       $blogs =BlogResource::collection(TourGuide::findOrFail($id)->blogs);
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
                 'blog'=>new BlogResource($blog),
                 
               
                  ],200);
            }

             return response()->json([
                 "message"=>"blog must contain a body",
               
               
                  ],400);
       

    }

    
    public function show(string $id)
    {
        
        $blog = Blog::findOrFail($id);
       
           return response()->json([
            'blog'=>new BlogResource($blog)

           ]
            , 200);
        
    }

   
   
   
    public function update(Request $request)
    {
          // description , images 
          Gate::authorize('isTourGuide');
          $tourGuide =TourGuide::where('user_id',auth()->user()->id)->first();
          Gate::authorize('TourGuideAccepted',$tourGuide);
          $validator = Validator::make($request->all(), [
            'blog_id'=>['required','exists:blogs,id'],
              'description'=>['required', 'min:1' , 'max:255'],
              
             
          ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'message' => 'Validation errors',
                  'errors' => $validator->errors(),  // Return validation errors
              ], 422);  // 422 Unprocessable Entity
          }
                $blog =Blog::findOrFail($request->blog_id);
            
                Gate::authorize('OwnBlog',$blog);
        
                 
                  $blog->description =$request->description;
                  $blog->save();
          
                 
                  return response()->json([
                    'blog'=>new BlogResource($blog)
                 
                    ],201);
              
  
              
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
            'blog'=>new BlogResource($blog)
        ], 200);
    }

    // like a blog
    public function like(Request $request){
        $validator = Validator::make($request->all(), [
            'blog_id'=>['required','exists:blogs,id'],
             
          ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'message' => 'Validation errors',
                  'errors' => $validator->errors(),  // Return validation errors
              ], 422);  // 422 Unprocessable Entity
          }
              if (Like::where('blog_id',$request->blog_id)->where('user_id',auth()->user()->id)->first()) {
                Like::where('blog_id',$request->blog_id)->where('user_id',auth()->user()->id)->first()->delete();
                return response()->json([
                    "message"=> "unliked successfully!"
                ], 200);
              } else {
                $like =new Like();
                $like->user_id=auth()->user()->id;
                $like->blog_id =$request->blog_id;
                $like->save();
                return response()->json([
                    "message"=> "liked successfully!"
                ], 200);
              }
              

    }
    // comment
    public function comment(Request $request){
        $validator = Validator::make($request->all(), [
            'blog_id'=>['required','exists:blogs,id'],
            'comment'=>['required','min:1','max:400'],
             
          ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'message' => 'Validation errors',
                  'errors' => $validator->errors(),  // Return validation errors
              ], 422);  // 422 Unprocessable Entity
          }

          $comment =new Comment();
          $comment->user_id =auth()->user()->id;
          $comment->blog_id =$request->blog_id;
          $comment->comment =$request->comment;
          $comment->save();

          return response()->json([
            "message"=> "comment created successfully!"
          ], 200);
    }
    // delete comment
    public function deleteComment(Request $request){
        $validator = Validator::make($request->all(), [
            
            'comment_id'=>['required','exists:comments,id'],
             
          ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'message' => 'Validation errors',
                  'errors' => $validator->errors(),  // Return validation errors
              ], 422);  // 422 Unprocessable Entity
          }
        //   own comment
        $comment =Comment::findOrFail($request->comment_id);
        Gate::authorize('OwnComment',$comment);
          $comment->delete();
          return response()->json([
            "message"=>"comment deleted successfully"
          ], 200);
    }
}
