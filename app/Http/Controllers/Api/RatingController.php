<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateRequest;
use App\Models\Hotel;
use App\Models\Place;
use App\Models\Plan;
use App\Models\Rating;
use App\Models\Restaruant;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rate(RateRequest $request) {
        switch ($request->type) {
            case 'place':
                $place=Place::findOrFail($request->id);
                    $rate=Rating::where('place_id',$place->id)->first();
                    if ($rate) {
                        $rate->place_id=$place->id;
                        $rate->sum=$rate->sum + $request->rating;
                        $rate->counts++;
                        $rate->ave=$rate->sum/$rate->counts;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }else{
                        $rate=new Rating();
                        $rate->place_id=$place->id;
                        $rate->sum=(int) $request->rating;
                        $rate->counts=1;
                        $rate->ave=$rate->sum/1;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }
                break;

            case 'rest':
               $rest=Restaruant::findOrFail($request->id);
                    $rate=Rating::where('rest_id',$rest->id)->first();
                    if ($rate) {
                        $rate->rest_id=$rest->id;
                        $rate->sum=$rate->sum + $request->rating;
                        $rate->counts++;
                        $rate->ave=$rate->sum/$rate->counts;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }else{
                        $rate=new Rating();
                        $rate->rest_id=$rest->id;
                        $rate->sum=(int) $request->rating;
                        $rate->counts=1;
                        $rate->ave=$rate->sum/1;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }

                break;

            case 'hotel':
                $hotel=Hotel::findOrFail($request->id);
                      $rate=Rating::where('hotel_id',$hotel->id)->first();
                    if ($rate) {
                        $rate->hotel_id=$hotel->id;
                        $rate->sum=$rate->sum + $request->rating;
                        $rate->counts++;
                        $rate->ave=$rate->sum/$rate->counts;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }else{
                        $rate=new Rating();
                        $rate->hotel_id=$hotel->id;
                        $rate->sum=(int) $request->rating;
                        $rate->counts=1;
                        $rate->ave=$rate->sum/1;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }
                break;

            case 'plan':
                $plan=Plan::findOrFail($request->id);
                    $rate=Rating::where('plan_id',$plan->id)->first();
                    if ($rate) {
                        $rate->plan_id=$plan->id;
                        $rate->sum=$rate->sum + $request->rating;
                        $rate->counts++;
                        $rate->ave=$rate->sum/$rate->counts;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }else{
                        $rate=new Rating();
                        $rate->plan_id=$plan->id;
                        $rate->sum=(int) $request->rating;
                        $rate->counts=1;
                        $rate->ave=$rate->sum/1;
                        $rate->save();
                        return response()->json(['message'=>'Your Rating Sended Successfully!'], 200);
                    }
                break;
            
            default:
                return response()->json(['message'=>'please enter vaild resource'], 404);
                break;
        }

    }
}
