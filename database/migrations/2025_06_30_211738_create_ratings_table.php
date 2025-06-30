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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id')->nullable();
            $table->unsignedBigInteger('rest_id')->nullable();
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('rest_id')->references('id')->on('restaruants')->onDelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->integer('sum')->default(1);
            $table->integer('counts')->default(1);
            $table->float('ave')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
