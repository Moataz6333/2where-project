<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tradition;
use App\Models\Place;
use App\Models\Safty;
use App\Models\Photo;
use App\Models\Hotel;
use App\Models\Restaruant;
class City extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'rate',
        'safty',
    ];

    public function traditions(){
        return $this->hasMany(Tradition::class);
    }
    public function places(){
        return $this->hasMany(Place::class);
    }
    public function SaftyKeys(){
        return $this->hasMany(Safty::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }
    public function restaruants(){
        return $this->hasMany(Restaruant::class);
    }
    public function hotels(){
        return $this->hasMany(Hotel::class);
    }
}
