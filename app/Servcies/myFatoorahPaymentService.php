<?php
namespace App\Servcies;

class myFatoorahPaymentService 
{
    
     public function pay($uuid) {
        return url('/myfatoorah?oid='.$uuid);
    }
}
