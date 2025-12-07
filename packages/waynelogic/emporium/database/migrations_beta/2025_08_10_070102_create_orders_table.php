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
        Schema::create($this->prefix . 'orders', function (Blueprint $table) {
            $table->id();
            $table->external_id(column: 'number');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('order_status_id')->nullable()->constrained($this->prefix .'order_statuses')->nullOnDelete();
            $table->foreignId('organization_id')->nullable()->constrained($this->prefix .'organizations')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained($this->prefix .'currencies')->nullOnDelete();
            $table->foreignId('price_type_id')->nullable()->constrained($this->prefix .'price_types')->nullOnDelete();
            $table->foreignId('shipping_type_id')->nullable()->constrained($this->prefix .'shipping_types')->nullOnDelete();
            $table->foreignId('payment_method_id')->nullable()->constrained($this->prefix .'payment_methods')->nullOnDelete();
            $table->string('secret_key')->nullable();
            $table->decimal('total_price', 12, 2)->nullable();
            $table->decimal('shipping_price', 15, 2)->nullable();
            $table->text('notes')->nullable();
            $table->text('user_data')->nullable();
            $table->json('attribute_data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'orders');
    }
};
