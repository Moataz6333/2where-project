<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourGuide;
use Resend\Laravel\Facades\Resend;

class TourGideController extends Controller
{
    public function index(){

        $tourGuides=TourGuide::where('accepted',false)->get();
        return view('tourGuide.index',['tourGuides'=>$tourGuides]);
    }

    public function accept($id){
         

        $tourGuide=TourGuide::findOrFail($id);
        $tourGuide->accepted=true;
        $tourGuide->save();
        // first change the role of the user
        $user =User::find($tourGuide->user_id);
        $user->role="tourGuide";
        $user->save();


        // send congratiolations email
        $user = $tourGuide->user->name ;
        // return view('tourGuide.congrats',['user'=>$user]);
        $html=view('tourGuide.congrats',['user'=>$user])->render();
        Resend::emails()->send([
            'from' => 'Acme <onboarding@resend.dev>',
            'to' => ['moatazahmedghander2003@gmail.com'],
            'subject' => 'Tour-Guide Verification.',
            'html' => $html,
        ]);

        return redirect()->back()->with('success','Tour Guide accepted successfully!');
    }

    public function email($id){
        $tourGuide =TourGuide::findOrFail($id);

        return view('tourGuide.email',['tourGuide'=>$tourGuide]);
    }

    public function send_email(Request $request,$id){
        $tourGuide =TourGuide::findOrFail($id);
        $user = $tourGuide->user->name ;
        $title =$request->title;
        $body =$request->body;

        // return view('tourGuide.design',['user'=>$user,'title'=>$title,'body'=>$body]);
        $html=view('tourGuide.design',['user'=>$user,'title'=>$title,'body'=>$body])->render();
        Resend::emails()->send([
            'from' => 'Acme <onboarding@resend.dev>',
            'to' => ['moatazahmedghander2003@gmail.com'],
            'subject' => '2Where Team',
            'html' => $html,
        ]);

        return to_route('tourGuide.index')->with('success','Email sended Successfully!');
   
        
    }

    public function destroy($id) {
        $tourGuide =TourGuide::findOrFail($id);
        $tourGuide->delete();
        return redirect()->back()->with('success','Tour Guide Deleted successfully!');
    }
}
