<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Restaruant;
use App\Models\TourGuide;
class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
           
        $rests = count(Restaruant::where('status','pending')->get());
        $hotels = count(Hotel::where('status','pending')->get());
        $requests=$rests + $hotels;
        $tourGuides=count(TourGuide::where('accepted',false)->get());
        return view('dashboard',compact('requests','tourGuides'));
    }
}
