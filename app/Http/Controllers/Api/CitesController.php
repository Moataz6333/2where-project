<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Resources\SaftyResource;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\RestResource;
use App\Http\Resources\HotelResource;
use App\Http\Resources\PlanResource;
use App\Models\City;
use App\Models\Place;
use App\Models\Restaruant;
use App\Models\Hotel;
use App\Models\Plan;
class CitesController extends Controller
{
    public function index(){
        $cities=City::all();
        return response($cities,200,[]);
    }
    public function show($id){
        $city=new CityResource(City::find($id));
        return response($city,200,[]);
    }
    public function safty($id){
        $city=City::find($id);
        $safty=$city->safty;
        $keys=SaftyResource::collection($city->SaftyKeys);
        $data=['safty_description'=>$safty,'keys'=>$keys];
        return response($data,200,['the safty of alex']);
    }
    public function places($id){
       $places =PlaceResource::collection(City::find($id)->places);
        return response($places,200,[]);
        
    }
    public function place_post($id){
        $places =PostResource::collection(City::find($id)->places);
        return response($places,200);

    }

    public function place($id){
        return response(new PlaceResource(Place::find($id)),200,[]);
    }
    public function posts(){
        $posts =PostResource::collection(Place::all());
        return response($posts,200,[]);
    }
    //rests , hotels , plans

    public function rests(){
        $rests=RestResource::collection(Restaruant::where('status','accepted')->get());
       
        return response($rests,200,[]);
    }
    public function rest($id){
            // Auth
        return response(new RestResource(Restaruant::findOrFail($id)),200,[]);
    }
    public function hotels(){
        $hotels=HotelResource::collection(Hotel::all());
        return response($hotels,200,[]);
    }
    public function hotel($id){

        return response(new HotelResource(Hotel::findOrFail($id)),200,[]);
    }
    public function plans(){
        $plans =PlanResource::collection(Plan::all());
        return response($plans,200,[]);
    }

    public function plan($id){
        return response(new PlanResource(Plan::find($id)),200,[]);

    }

    //about
  

        public function about() {
            $regions = [
                [
                    "img" => asset('images/about/img1.jpg'),
                    "title" => "Egypt",
                    "text" => "By 2028, we aim to explore all of Egypt, sharing its history, beauty, and culture. From the Nile to ancient sites and lively cities, Egypt offers experiences that captivate and inspire. Join us in discovering one of the world’s most storied lands."
                ],
                [
                    "img" => asset('images/about/img2.jpg'),
                    "title" => "Africa",
                    "text" => "By 2030, we’ll expand across Africa, revealing its diversity. From open savannas to cultural heritage and vibrant cities, Africa’s landscapes and history await you. Come along as we showcase the heart of this extraordinary continent."
                ],
                [
                    "img" => asset('images/about/img3.jpg'),
                    "title" => "Europe",
                    "text" => "By 2032, we’ll cover Europe, offering travelers insights into historic cities, scenic countryside, and coastal beauty. Europe combines tradition and innovation. Discover with us what makes each destination in Europe unique and memorable."
                ],
                [
                    "img" => asset('images/about/img4.jpg'),
                    "title" => "World",
                    "text" => "By 2035, our mission is to reach every corner of the globe, connecting travelers with cultural wonders. From natural marvels to iconic landmarks, we’ll guide you through a world full of unforgettable destinations and rich experiences."
                ],
                [
                    "head"=>asset('images/about/head.jpg'),
                ]
            ];
            
            $jsonData = json_encode($regions, JSON_PRETTY_PRINT);
            $jsonData = str_replace('\/', '/', $jsonData);
        
            return response($jsonData, 200)->header('Content-Type', 'application/json');
        }
        
    

    

}
