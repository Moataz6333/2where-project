<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $likes =[];
        $comments =[];

        foreach ($this->likes as $like) {
            array_push($likes,[
                "id"=>$like->id,
                "user"=>$like->user->name
            ]);
        }
        foreach ($this->comments as $comment) {
            array_push($comments,[
                "id"=>$comment->id,
                "user"=>$comment->user->name,
                "comment"=>$comment->comment
            ]);
        }


       return [
            'id'=>$this->id,
            'description'=>$this->description,
            'location'=>$this->location,
            'created_at'=>$this->created_at,
            'photos'=>$this->photos,
            'likes'=>$likes,
            'comments'=>$comments
       ];

    }
}
