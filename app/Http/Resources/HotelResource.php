<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $postPhoto=$this->post->first();
        $records=$this->post->where('type','slider');
        $photos=[];

        foreach($records as $record){
            array_push($photos,url($record->path));
        }
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'address'=>$this->address,
            'features'=>explode('  ',$this->features),
            // 'features'=>$this->features,
            'price'=>$this->price,
            'rate'=>$this->rating ? $this->rating->ave : $this->rate,
            'link'=>$this->link,
            'postPhoto'=>url($postPhoto->path),
            'photos'=>$photos,
            'status'=>$this->status,
        ];
    }
}
