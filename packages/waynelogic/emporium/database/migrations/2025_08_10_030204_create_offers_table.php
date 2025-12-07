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
        Schema::create($this->prefix . 'offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained($this->prefix . 'products')->cascadeOnDelete();
            $table->external_id(long: true);

            // Attributes
            $table->active();
            $table->string('name');
            $table->slug(nullable: false);
            $table->longText('description')->nullable();

            // Учет
            $table->string('code')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();

            // Dimensions
            $table->foreignId('dimension_unit_id')->nullable()->constrained($this->prefix . 'units')->nullOnDelete();
            $table->foreignId('weight_unit_id')->nullable()->constrained($this->prefix . 'units')->nullOnDelete();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'offers');
    }
};
