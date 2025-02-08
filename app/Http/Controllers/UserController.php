<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function login(){
       
 
        if(auth()->attempt(request()->only(['email','password']),
        request()->filled('remember'))){
        Gate::authorize('isAdmin');
         return to_route('dashboard');
        }
        return redirect()->back()->withErrors(['email'=>'invaild email'])->withInput();
 
     }
   

     public function store(Request $request){
      
        $request->validate([
            'f-name'=>['required','min:3'],
            'l-name'=>['required','min:3'],
            'email'=>['required', 'unique:users'],
            'password'=>['required','min:8','confirmed'],
            
        ]
        );
        

      
        User::create([
            'firstName'=>$request['f-name'],
            'lastName'=>$request['l-name'],
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'birthDate'=>$request->birthdate,
            'role'=>'user',
            
        ]);

       return redirect()->back()->with('success','New User regirtered successfully!');
   
    }
     
}

