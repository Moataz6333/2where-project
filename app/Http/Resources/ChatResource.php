<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'tourGuide'=>[
              'tourGuide_id'=>  $this->tourGuide_id,
              'name'=>$this->tourGuide->user->name
            ],
            'user'=>[
              'user_id'=>  $this->user_id,
              'name'=>$this->user->name
            ],
            'uuid'=>$this->uuid,
            'created_at'=>$this->created_at,
        ];
    }
}
