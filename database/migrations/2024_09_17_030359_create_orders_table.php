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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('order_date');
            $table->decimal('total_amount');
            $table->tinyInteger('status')->default(0);
            $table->decimal('discount_value')->nullable();
            $table->decimal('shipping_fee')->nullable();
            $table->decimal('net_amount');
            $table->timestamps();


            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
