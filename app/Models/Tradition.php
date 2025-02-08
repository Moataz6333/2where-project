<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
class Tradition extends Model
{
    use HasFactory;
    protected $fillable=[
        'city_id',
        'title',
        'description',
    ];
    public function photo(){
        return $this->hasMany(Photo::class);
    }
}
