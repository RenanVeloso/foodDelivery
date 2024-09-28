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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('description', 255);
            $table->tinyInteger('type')->default(1);
            $table->decimal('discount_value');
            $table->dateTime('expiration_date');
            $table->decimal('min_order_value')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('applies_all')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
