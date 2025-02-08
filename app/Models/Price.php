<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable=[
        'place_id',
        'egyptions',
        'foreigners',
        'entry',
        'foreigners_price',
        'epyption_price',
        'entry_price',
    ];
}
