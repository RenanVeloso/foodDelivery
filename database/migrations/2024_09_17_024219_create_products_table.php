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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->longText('description')->nullable();
            $table->decimal('price')->nullable();
            $table->tinyInteger('size')->nullable();
            $table->json('macronutrients')->nullable();
            $table->tinyInteger('preparation_time')->nullable();
            $table->boolean('is_avaliable')->default(true);
            $table->string('image_url', 256)->nullable();
            $table->timestamps();


            $table->foreignId('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
            $table->foreignId('group_id')->references('id')->on('groups')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
