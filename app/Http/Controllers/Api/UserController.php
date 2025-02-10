<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Resend\Laravel\Facades\Resend;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sub;
use App\Models\Photo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RestResource;
use App\Http\Resources\HotelResource;

class UserController extends Controller
{
    
public function login()
{
    $credentials = request()->only(['email', 'password']);

    if (auth()->attempt($credentials, request()->filled('remember'))) {
       
        $user = auth()->user();

        // Generate a token for the user
        $token = $user->createToken('2where')->plainTextToken;
            
        // Gate::authorize('isUser');

        return response()->json([
            'message' => 'User is logged in successfully!',
            'token' => $token, // Return the access token
            'user'=>$user,
        ],200);
    }

    return response()->json([
        'message' => 'Invalid email or password',
    ], 401);
}


     public function store(Request $request){
      
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
    
        // Step 2: Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }
        
        $user =new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->role='user';
        $user->birthDate=$request->birthDate;
        $user->save();

       return response()->json([
        'message' => 'User registered successfully!',
        'user' => $user,
    ], 201);
    
   
    }

    public function me(Request $request){

        if (Auth::check()) {
            $photo="";
            $id="";
            if($request->user()->photo->where('type','profile')->first()){
                $id=$request->user()->photo->where('type','profile')->first()->id;
                $photo= url($request->user()->photo->where('type','profile')->first()->path);
            }
            return response()->json([
                'id' => $request->user()->id,
                'name' => $request->user()->name,
                'role' => $request->user()->role,
                'email' => $request->user()->email,
                'email_verified_at' => $request->user()->email_verified_at,
                'created_at' => $request->user()->created_at,
                'birthDate' => $request->user()->birthDate,
                'info' => $request->user()->info,
                'accept_policies' => $request->user()->accept_policies,
                'profile' => [
                    'id'=>$id,
                    'path'=>$photo
                ],
            ], 200);
        }

       
        return response()->json([
            'message' => 'Not authenticated'
        ], 403); 
    
    }

    public function subsecripe(Request $request){
        $validator = Validator::make($request->all(), [
         
            'email' => ['required', 'email', 'unique:users'],
            
        ]);
    
       
        if ($validator->fails()) {
            return response()->json([
                'message' => 'You are already registered!',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }

        $sub =new Sub();
        $sub->email =$request->email;
        $sub->save();
        return response()->json([
            'message' => 'You will get all updates now!',
          
        ], 201);

    }

    public function requests($id){
        $user =User::findOrFail($id);
        Gate::authorize('isOwner');
        if(count($user->restaruants ) != 0 || count($user->hotels) !=0){
            if(count($user->restaruants) !=0  && count($user->hotels) != 0){

                return response()->json(['restaruants'=> RestResource::collection($user->restaruants),'hotels'=>HotelResource::collection($user->hotels)],200);
            }
            if(count($user->restaruants) != 0){
                return response()->json(['restaruants'=> RestResource::collection($user->restaruants)],200);

            }
            if(count($user->hotels) !=0 ){
                return response()->json(['hotels'=>HotelResource::collection($user->hotels)],200);

            }
           
        }else{
            //nothing
            return response()->json(['message'=>'there is no requests for you!'],200);
        }
    }
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
    public function acceptPolicy(){
        Gate::authorize('isUser');
        $user =auth()->user();
        if($user){

            $user->accept_policies=true;
            $user->save();
            return response()->json(['message'=>'user with id='.$user->id.'accept policies successfully!','user'=>$user],200);
        }
        return response()->json(['message'=>'user not found'],404);

    }
    public function contactUs(Request $request){
       
        $validator = Validator::make($request->all(), [
         'name'=>['required','min:2','max:50'],
            'email' => ['required', 'email'],
            'phone'=>['required','min:11','max:11'],
            'text'=>['required','min:2']
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Email not sended',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }

       
        $name=$request->name;
        $body=$request->text;
        $email=$request->email;
        $phone=$request->phone;
        
        
        
          
            $html=view('subsecripers.contact-us',['name'=>$name,'body'=>$body,'email'=>$email,'phone'=>$phone])->render();
            Resend::emails()->send([
                'from' => 'Acme <onboarding@resend.dev>',
                'to' => ['moatazahmedghander2003@gmail.com'],
                'subject' => 'new Updated',
                'html' => $html,
            ]);

      

        return response()->json(['message'=>'Email sended successfully , we will see it soon!'],200);
    }
    // user profile pic
    public function profilePic(Request $request) {

        $validator = Validator::make($request->all(), [
            'image' =>  ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
           
        ]);
    
        // Step 2: Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),  // Return validation errors
            ], 422);  // 422 Unprocessable Entity
        }

        //  photo (url)
        $user = auth()->user();
        $photo = Photo::where('user_id',$user->id)->where('type','profile')->first();
        if ($photo) {
            // update
            if ($request->hasFile('image')) {

                $mainPhoto = $request->file('image');
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/profiles';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $fileName =  $mainPhoto->getClientOriginalName();

                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/profiles/' . $fileName;  
        
                $photo->path=$relativePath;
                $photo->type = "profile";
                $photo->save();
             return response()->json([
                'message'=>"profile photo updated successfully"
             ], 201);
            }
            
        }else{
            // create

            $photo =new Photo();
            $photo->user_id = $user->id;
            if ($request->hasFile('image')) {

                $mainPhoto = $request->file('image');
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/profiles';
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $fileName =  $mainPhoto->getClientOriginalName();

                $mainPhoto->move($destinationPath, $fileName);
                $relativePath = '/images/profiles/' . $fileName;  
        
                $photo->path=$relativePath;
                $photo->type = "profile";
                $photo->save();
             return response()->json([
                'message'=>"profile photo added successfully"
             ], 200);
            }
        }

    }
   
    public function deleteProfilePic(Request $request){
        // user_id , photo
        $user = auth()->user();
        $photo =Photo::where('user_id',$user->id)->where('type','profile')->get()->first();
        if($photo){
          
            $photo->delete()  ;

            return response()->json([
                'message'=>"profile photo deleted successfully"
             ], 201);
        }
         return response()->json([
            'message'=>"profile photo not found"
         ], 404);
    }

}
