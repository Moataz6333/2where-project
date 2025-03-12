<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;


class BlogPublicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // tourGuide
        $tourGuide =$this->tourGuide;
        $tourGuide_photo="";
        if($tourGuide->user->photo->where('type','profile')->first()){
            $tourGuide_photo =url($this->user->photo->where('type','profile')->first()->path);
        }



        $likes =[];
        $comments =[];
        $photos =[];
      
        

        foreach ($this->likes as $like) {
            $profile="";
            if($like->user->photo->where('type','profile')->first()){
                $profile=url($like->user->photo->where('type','profile')->first()->path);
            }
        
            array_push($likes,[
                "id"=>$like->id,
                "name"=>$like->user->name,
                "profile"=>$profile
            ]);
        }
        foreach ($this->comments as $comment) {
            $profile="";
            if($comment->user->photo->where('type','profile')->first()){
                $profile=url($comment->user->photo->where('type','profile')->first()->path);
            }
            array_push($comments,[
                "id"=>$comment->id,
                "name"=>$comment->user->name,
                "comment"=>$comment->comment,
                "profile"=>$profile,
                "created_at"=>Carbon::parse($comment->created_at)->diffForHumans()
            ]);
        }
        foreach ($this->photos as $photo) {
            array_push($photos,[
                "id"=>$photo->id,
                "path"=>url($photo->path)
            ]);
        }
        

       return [
            'tourGuide'=>[
                'id'=>$this->tourGuide->id,
                'name'=>$this->tourGuide->user->name,
                'profile'=>$tourGuide_photo
            ],
            'id'=>$this->id,
            'description'=>$this->description,
            'location'=>$this->location,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans(),
            'photos'=>$photos,
            'likes'=>$likes,
            'comments'=>$comments
       ];

    }
}
