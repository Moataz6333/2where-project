<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable=[
        'city_id',
        'place_id',
        'tradition_id',
        'restaruant_id',
        'hotel_id',
        'user_id',
        'album_id',
        'company_id',
        'path',
        'type',
        'url',
    ];
}
