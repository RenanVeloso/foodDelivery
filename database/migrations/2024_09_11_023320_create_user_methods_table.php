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
        Schema::create('user_methods', function (Blueprint $table) {
            $table->id();
            $table->string('number_card', 256);
            $table->string('code', 5);
            $table->date('valid_date');
            $table->tinyInteger('type');
            $table->string('doc', 15);
            $table->tinyInteger('brand');
            $table->string('name', 256);
            $table->string('byname', 256)->nullable();
            $table->timestamps();


            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_methods');
    }
};
