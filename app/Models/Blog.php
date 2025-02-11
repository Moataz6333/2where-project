<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
use App\Models\Like;
use App\Models\Comment;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'description',
        'tour_guide_id'
    ];

    public function photos(){
        return $this->hasMany(Photo::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
