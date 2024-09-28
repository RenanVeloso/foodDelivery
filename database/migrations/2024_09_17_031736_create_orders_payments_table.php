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
        Schema::create('orders_payments', function (Blueprint $table) {
            $table->string('name', 256);
            $table->string('doc', 15);
            $table->string('last_four', 4);
            $table->string('brand', 30);
            $table->tinyInteger('type')->default(0);

            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_payments');
    }
};
