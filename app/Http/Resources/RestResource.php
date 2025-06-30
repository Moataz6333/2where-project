<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $postPhoto=$this->post->where('type','post')->first();
        $records=$this->post->where('type','slider');
        $photos=[]; 
        foreach($records as $record){
            array_push($photos,url($record->path));
        }
        $menu=[];
        $records=$this->post->where('type','menu');
        foreach($records as $record){
            array_push($menu,url($record->path));
        }
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'address'=>$this->address,
            'features'=>explode(' ',$this->categories),
            'price'=>$this->price,
             'rate'=>$this->rating ? $this->rating->ave : $this->rate,
            'postPhoto'=>url($postPhoto->path),
            'photos'=>$photos,
            'menu'=>$menu,

        ];
    }
}
