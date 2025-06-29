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
        Schema::create('compainies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable()->default('text');
            $table->string('phone', 20);
            $table->string('phone2', 20)->nullable();
            $table->string('email');
            $table->string('BankIBAN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compainies');
    }
};
