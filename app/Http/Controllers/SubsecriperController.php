<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resend\Laravel\Facades\Resend;
use App\Models\Sub;
use App\Models\Place;
use App\Models\Restaruant;
use App\Models\Hotel;
class SubsecriperController extends Controller
{

    public function index(){
        $subs =Sub::all();
        $i=1;
        return view('subsecripers.index',compact('subs','i'));
    }

    public function create(Request $request){
        $sub = new Sub();
        $sub->email=$request->email;
        $sub->save();
        return response()->json('done',200);
    }
    public function destroy($id){
        $sub =Sub::find($id);
        $sub->delete();
        return redirect()->back()->with('success','deleted successfully');
    }
    public function email(){
        $places =Place::all()->reverse();
        $rests=Restaruant::all()->reverse();
        $hotels=Hotel::all()->reverse();
        return view('subsecripers.sendEmail',compact('places','rests','hotels'));
    }
    public function send(Request $request){
        $content="";
        $postPhoto="";
        // $url="";   later

        if($request->type == "places"){
            $content =Place::find($request->places);
            $postPhoto =url($content->postPhoto->path);
            
        }
        if($request->type == "rests"){
            $content =Restaruant::find($request->rests);
            $postPhoto =url($content->post->first()->path);
        }
        if($request->type == "hotels"){
            $content =Hotel::find($request->hotels);
            $postPhoto =url($content->post->first()->path);

        }
        //text content
        $title=$request->title;
        $body=$request->description;
        //test email
        
        
        // $subs =Sub::all();
        // foreach($subs as $sub){
            $user = 'moataz';
            $html=view('subsecripers.design',['user'=>$user,'title'=>$title,'body'=>$body,'photo'=>$postPhoto])->render();
            Resend::emails()->send([
                'from' => 'Acme <onboarding@resend.dev>',
                'to' => ['moatazahmedghander2003@gmail.com'],
                'subject' => 'new Updated',
                'html' => $html,
            ]);

        // }

        return redirect()->back()->with('success','emails sended successfully!');
    }
}
