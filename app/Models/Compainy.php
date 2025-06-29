<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compainy extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'phone',
        'phone2',
        'email',
        'BankIBAN',
    ];
    public function founder() {
        return $this->hasOne(Founder::class,'company_id');
    }
    public function photo() {
        return $this->hasOne(Photo::class,'company_id');
    }
}
