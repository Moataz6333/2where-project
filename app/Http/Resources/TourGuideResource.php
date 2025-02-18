<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Albums;

class TourGuideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $photo="";
        if($this->user->photo->where('type','profile')->first()){
            $photo =url($this->user->photo->where('type','profile')->first()->path);
        }
        $photos=[];
        foreach($this->albums as $album){
            $images =[];
            foreach($album->photos as $image){
                array_push($images,[
                    "id"=>$image->id,
                    "path"=>url($image->path)]);
            }
            array_push($photos,[
                "id"=>$album->id,
                "title"=>$album->title,
                "photos"=>$images]);
        }

        return [
            "id"=>$this->id,
            "name"=> $this->user->name,
            "photo"=> $photo,
            "about"=> $this->about,
            "areas"=> $this->areas,
            "languages"=> $this->languages,
            "rate"=> $this->rate,
            "experience"=> $this->experience,
            "albums"=>$photos,
            "blogs"=>BlogResource::collection($this->blogs)
            

        ];
    }
}
