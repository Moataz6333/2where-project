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
        'company_id',
        'date',
        'price',
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
    public function company()
    {
        return $this->belongsTo(Compainy::class,'company_id');
    }
    public function registers()  {
        return $this->hasMany(Registeration::class);
    }
     public function rating()  {
        return $this->hasOne(Rating::class);
    }
}
