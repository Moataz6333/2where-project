<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CitesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RestaruantController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\TourGideController;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;




//all cities
Route::get('/cities',[CitesController::class,'index']);
Route::get('/cities/safty/{id}',[CitesController::class,'safty']);
//alex
Route::get('/cities/{id}',[CitesController::class,'show']);
//all places for alex
Route::get('/places/posts',[CitesController::class,'posts']);
Route::get('/places/{city}',[CitesController::class,'places']);
Route::get('/place/{place}',[CitesController::class,'place']);
Route::get('/safty/{city}',[CitesController::class,'safty']);
Route::get('/places/posts/{city}',[CitesController::class,'place_post']);

//restrans
Route::get('/rests',[CitesController::class,'rests']);
Route::get('/rest/{id}',[CitesController::class,'rest']);
//hotels
Route::get('/hotels',[CitesController::class,'hotels']);
Route::get('/hotel/{id}',[CitesController::class,'hotel']);





//----------------------------------------
//users

Route::post('/register',[UserController::class,'store']);
Route::post('/login',[UserController::class,'login']);

//subsecripe
Route::post('/subsecripe',[UserController::class,'subsecripe']);


//request for rest
Route::post('/request-rest',[RestaruantController::class,'store'])->middleware('auth:sanctum');
Route::post('/request-hotel',[HotelController::class,'store'])->middleware('auth:sanctum');

//get user's places
Route::get('/user-requests/{id}',[UserController::class,'requests'])->middleware('auth:sanctum');

//get auth user
Route::get('/me',[UserController::class,'me'])->middleware('auth:sanctum');
//logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

//polices
Route::post('/accept-policies',[UserController::class,'acceptPolicy'])->middleware('auth:sanctum');

//contact-us
Route::post('/contact-us',[UserController::class,'contactUs']);

// about
Route::get('/about',[CitesController::class,'about']);

// user profile photo
Route::post('/addprofilePic', [UserController::class,'profilePic'])->middleware('auth:sanctum');
Route::post('/deleteprofilePic', [UserController::class,'deleteProfilePic'])->middleware('auth:sanctum');

// tour guide section
Route::post('/tourGide-request',[TourGideController::class,'request'])->middleware('auth:sanctum');
// get all the tourguides
Route::get('tourGuides', [TourGideController::class,'tourGuides']);
Route::get('tourGuide/{id}', [TourGideController::class,'tourGuide']);
// add album
Route::post('addAlbum', [AlbumController::class,'create'])->middleware('auth:sanctum');
Route::post('addPhoto', [AlbumController::class,'add'])->middleware('auth:sanctum');
Route::post('deletePhoto', [AlbumController::class,'deletePhoto'])->middleware('auth:sanctum');
Route::post('deleteAlbum', [AlbumController::class,'deleteAlbum'])->middleware('auth:sanctum');


// Blogs (private)
Route::post('addBlog',[BlogController::class,'store'])->middleware('auth:sanctum');
Route::get('/blogs/{id}',[BlogController::class,'index']);
Route::get('/blog/{id}',[BlogController::class,'show']);
Route::post('/editBlog',[BlogController::class,'update'])->middleware('auth:sanctum');
Route::post('/delBlog/{id}',[BlogController::class,'destroy'])->middleware('auth:sanctum');
Route::post('/delBlogPhoto',[BlogController::class,'delPhoto'])->middleware('auth:sanctum');
// all blogs (public)
Route::get('/blogs', [BlogController::class,'blogs']);
// like
Route::post('/like',[BlogController::class,'like'])->middleware('auth:sanctum');
// comment
Route::post('/comment',[BlogController::class,'comment'])->middleware('auth:sanctum');
Route::post('/delComment',[BlogController::class,'deleteComment'])->middleware('auth:sanctum');


// test uploading photo
Route::post('/upload', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'images.*' =>  ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    if ($request->hasFile('images')) {
        // $mainPhoto = $request->file('image');
          
        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/react';
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        foreach ($request->file('images') as $mainPhoto) {
           
            $fileName =  $mainPhoto->getClientOriginalName();
            
            // Move the file to the destination path
            $mainPhoto->move($destinationPath, $fileName);
            $relativePath = '/images/react/' . $fileName;
    
            // $filePath = url($relativePath); // Get full URL
        }

        return response()->json(['message' => "photos saves successfully",200]);
    }

    return response()->json(['error' => 'File not uploaded'], 400);
});

// google auth
Route::get('auth/google/redirect', [UserController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);

// search
Route::post('/search',[CitesController::class,'search'] );

// chat
Route::post('create-chat', [ChatController::class,'create' ])->middleware('auth:sanctum');
Route::get('chat/{uuid}', [ChatController::class,'chat' ])->middleware('auth:sanctum');
Route::post('sendMessage', [ChatController::class,'sendMessage' ])->middleware('auth:sanctum');
Route::get('mychats', [ChatController::class,'mychats' ])->middleware('auth:sanctum');

//plan
Route::get('/plans',[CitesController::class,'plans']);
Route::get('/plan/{id}',[CitesController::class,'plan']);
Route::get('/company/{id}',[CitesController::class,'company']);

Route::post('/register/{id}',[PlanController::class, 'register'])->middleware('auth:sanctum');

Route::post('/rate',[RatingController::class, 'rate']);