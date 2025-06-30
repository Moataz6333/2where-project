<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Registeration;
use App\Models\User;
use App\Servcies\myFatoorahPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class PlanController extends Controller
{
    public $paymentService;
    public function __construct(myFatoorahPaymentService $paymentService ) {
        $this->paymentService = $paymentService;
    }

    public function register($id){
        //user=73|4YgTugUWkAbVpU4FVHZuMHYpoCa8xBCPBTOGZY8r53b4032c
        $plan=Plan::findOrFail($id);
        $user=auth()->user();
        Gate::authorize('isUser');
            $registeration=Registeration::create([
                'user_id'=>$user->id,
                'plan_id'=>$plan->id,
                'uuid'=>(string) Str::uuid()
            ]);

            return $this->paymentService->pay($registeration->uuid);
    }
    
}
