<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {   
        $features=explode("\r\n",$this->features);
        $timeTables=explode("\r\n",$this->timeTables);
        $mainPhotos=$this->photos;
        $photos=[];
     //    dd($mainPhotos);
         foreach($mainPhotos as $photo){
 
             array_push($photos,url($photo->path));
         }
         $accessabilities=['description'=>$this->accessability->description,
         'ramps'=>$this->accessability->ramps,
         'elevators'=>$this->accessability->elevators,
         'facilities'=>$this->accessability->facilities,
        ];
        //prices
        $prices=[
            'egyptions'=>$this->prices->egyptions,
            'foreigners'=>$this->prices->foreigners,
            'entry'=>$this->prices->entry,
            'egyptions_price'=>$this->prices->epyption_price,
            'foreigners_price'=>$this->prices->foreigners_price,
            'entry_price'=>$this->prices->entry_price
        

        ];
        return [
            'id' =>$this->id,
            'title' =>$this->title,
            'description'=>$this->body,
            'address_title'=>$this->address_title,
            'address_details'=>$this->address_details,
            'rate'=>$this->rate,
            'features'=>$features,
            'timeTables'=>$timeTables,
            'accessabilities'=>$accessabilities,
            'photos'=>$photos,
            'prices'=>$prices
        ];
    }
}
