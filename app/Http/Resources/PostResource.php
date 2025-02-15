<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $post_description=explode("\r\n",$this->post_description);
        return [
            'id'=>$this->id,
            'post_title'=>$this->post_title,
            'post_description'=>$this->post_description,
            'address_title'=>$this->address_title,
            'rate'=>$this->rate,
            'post_photo'=>url($this->post->where('type','post')->first()->path),
        ];
    }
}
