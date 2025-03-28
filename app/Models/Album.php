<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;

class Album extends Model
{
    use HasFactory;
    protected $fillable =[
        'tourGuide_id',
        'title',
    ];

    public function photos(){
        return $this->hasMany(Photo::class);
    }

   

}
