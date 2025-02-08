<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaruant;
use App\Models\Place;
use App\Models\Hotel;

class Plan extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
    ];
    

    public function restaruants()
    {
        return $this->belongsToMany(Restaruant::class);
    }
    public function places()
    {
        return $this->belongsToMany(Place::class);
    }
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class);
    }
}
