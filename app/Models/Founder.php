<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    use HasFactory;
     protected $fillable=[
        'name',
        'phone',
        'national_id',
        'company_id',
        
    ];
}
