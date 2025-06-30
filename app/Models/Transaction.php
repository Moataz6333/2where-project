<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
    'registeration_id',
    'InvoiceId',
    'InvoiceStatus',
    'InvoiceValue',
    'CustomerName',
    'CustomerReference',
    'CustomerMobile',
    'DueDeposit',
    'DepositStatus',
    'PaymentGateway',
    'PaymentId',
    'PaidCurrency',
    'CardNumber',
];
public function register()  {
    return $this->belongsTo(Registeration::class,'registeration_id');
}
}
