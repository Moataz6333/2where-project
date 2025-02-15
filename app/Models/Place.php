<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
use App\Models\Price;
use App\Models\Accessability;

class Place extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'body',
        'city_id',
        'address_title',
        'address_details',
        'rate',
        'post_title',
        'post_description',
        'features',
        'timeTables'

    ];
    public function postPhoto(){
        return $this->hasMany(Photo::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }
    public function prices(){
        return $this->hasOne(Price::class);
    }
    public function accessability(){
        return $this->hasOne(Accessability::class);
    }
    
}
