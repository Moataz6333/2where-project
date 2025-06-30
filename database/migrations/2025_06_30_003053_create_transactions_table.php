<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
          $table->unsignedBigInteger('registeration_id');
            $table->foreign('registeration_id')->references('id')->on('registerations')->onDelete('cascade');
            $table->string('InvoiceId');
            $table->string('InvoiceStatus');
            $table->string('CustomerReference');
            $table->double('InvoiceValue');
            $table->string('CustomerName');
            $table->string('CustomerMobile');
            $table->double('DueDeposit');
            $table->string('DepositStatus');
            $table->string('PaymentGateway');
            $table->string('PaymentId');
            $table->string('PaidCurrency');
            $table->string('CardNumber');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
