<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
class Hotel extends Model
{
    use HasFactory;
    protected $fillable=[
        'city_id',
        'title',
        'rate',
        'features',
        'price',
        'address',
        'link',
        'user_id',
        'status',
    ];

    public function post(){
        return $this->hasMany(Photo::class);
    }
}
