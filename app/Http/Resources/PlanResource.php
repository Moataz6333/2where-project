<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\RestResource;
use App\Http\Resources\HotelResource;
class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $places=[];
        $rests=[];
        $hotels=[];
        if($this->places != null){
            $places=PostResource::collection($this->places);

        }
        if($this->restaruants != null){
            $rests=RestResource::collection($this->restaruants);

        }
        if($this->hotels != null){
            $hotels=HotelResource::collection($this->hotels);

        }
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'descrption'=>$this->description,
            'company'=>[
                'id'=>$this->company->id,
                'name'=>$this->company->name,
            ],
            'date'=>$this->date ?  date_create($this->date )->format('d-m-Y  h:i a') : '' ,
            'price'=>$this->price .' EGP',
            'places'=>$places,
            'rests'=>$rests,
            'hotels'=>$hotels,
        ];
    }
}
