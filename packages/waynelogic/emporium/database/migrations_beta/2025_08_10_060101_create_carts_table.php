<?php

use Waynelogic\Emporium\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->prefix . 'carts', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->foreignId('customer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('price_type_id')->nullable()->constrained($this->prefix .'price_types')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained($this->prefix .'currencies')->nullOnDelete();
            $table->foreignId('shipping_type_id')->nullable()->constrained($this->prefix .'shipping_types')->nullOnDelete();
            $table->foreignId('payment_method_id')->nullable()->constrained($this->prefix .'payment_methods')->nullOnDelete();
            $table->string('coupon_code')->index()->nullable();
            $table->dateTime('completed_at')->nullable()->index();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'carts');
    }
};
