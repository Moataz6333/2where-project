<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Album;
use App\Models\Blog;

class TourGuide extends Model
{
    use HasFactory;
    protected $fillable=[
        'about',
        'areas',
        'languages',
        'rate',
        'experience',
        'accepted',
        'licence',
        'national_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function albums() {
        return $this->hasMany(Album::class,"tourGuide_id");
    }
    public function blogs() {
        return $this->hasMany(Blog::class);
    }

}
