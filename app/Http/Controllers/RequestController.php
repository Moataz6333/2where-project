<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaruant;
use App\Models\Hotel;
use App\Models\User;

class RequestController extends Controller
{
    public function index(){

        $rests =Restaruant::where('status','pending')->get();
        $hotels =Hotel::where('status','pending')->get();
        return view('requests.index',compact('rests','hotels'));
    }
    public function show($id){
        $rest=Restaruant::find($id);
        $user=User::find($rest->user_id);
        $menus=$rest->post->where('type','menu');
        $photos=$rest->post->where('type','slider');
        return view('requests.show',compact('rest','user','menus','photos'));
    }
    public function show_hotel($id){
        $hotel=Hotel::find($id);
        $user=User::find($hotel->user_id);
        $photos=$hotel->post->where('type','slider');
        return view('requests.show_hotel',compact('hotel','user','photos'));
    }
    public function accept($id){
        $rest=Restaruant::find($id);
        $rest->status='accepted';
        $rest->save();
        $rests=Restaruant::where('status','pending');
        return to_route('requests.index')->with('success','Restaraunt'.$rest->title.'accepted successfully');
    }
    public function accept_hotel($id){
        $hotel=Hotel::find($id);
        $hotel->status='accepted';
        $hotel->save();
        $hotels=Hotel::where('status','pending');
        
        return to_route('requests.index')->with('success','Hotel '.$hotel->title.'accepted successfully');
    }
}
