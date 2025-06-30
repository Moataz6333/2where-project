<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->description,
            'phone'=>$this->phone,
            'phone2'=>$this->phone2,
            'email'=>$this->email,
            'founder'=>$this->founder->name,
            'photo'=>url($this->photo->path),
        ];
    }
}
