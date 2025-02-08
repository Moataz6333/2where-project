<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // dd($request);
        $mainPhotos=$this->photos;
       $photos=[];
    //    dd($mainPhotos);
        foreach($mainPhotos as $photo){

            array_push($photos,url($photo->path));
        }
       

       return [
            'title'=>$this->title,
            'description'=>$this->description,
            'photos'=>$photos,
            'rate'=>$this->rate,
       ];
    }
}
