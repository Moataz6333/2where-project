<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
class Restaruant extends Model
{
    use HasFactory;
    protected $fillable =[
        'city_id',
        'title',
        'rate',
        'categories',
        'price',
        'address',
        'postPhoto',
        'hours',
        'user_id',
        'status',
    ];

    public function post(){
        return $this->hasMany(Photo::class);
    }
     public function rating()  {
        return $this->hasOne(Rating::class,'rest_id');
    }
}
