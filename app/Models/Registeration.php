<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registeration extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'plan_id',
        'paid',
        'uuid',
    ];
    public function transaction()  {
        return $this->hasOne(Transaction::class);
    }
    public function user()  {
        return $this->belongsTo(User::class);
    }
    public function plan()  {
        return $this->belongsTo(Plan::class);
    }
}
