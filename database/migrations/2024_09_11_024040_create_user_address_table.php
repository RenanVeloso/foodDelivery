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
        Schema::create('user_address', function (Blueprint $table) {
            $table->id();
            $table->string('zipcode', 30);
            $table->string('street', 256);
            $table->string('number', 10);
            $table->string('city', 256);
            $table->string('state', 10);
            $table->string('country', 30);
            $table->string('complement', 256)->nullable();
            $table->string('reference', 256)->nullable();
            $table->tinyInteger('type')->default(1);
            $table->boolean('active')->default(1);
            $table->timestamps();
            
            
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_address');
    }
};
