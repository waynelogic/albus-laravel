<?php

use Waynelogic\Emporium\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Waynelogic\Emporium\Enums\ProductKind;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->prefix . 'products', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->foreignId('product_type_id')->constrained($this->prefix . 'product_types')->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained($this->prefix . 'brands')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained($this->prefix . 'categories')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained($this->prefix . 'countries')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained($this->prefix . 'units')->nullOnDelete();

            // Attributes
            $table->string('name');
            $table->slug( nullable: false );
            $table->mediumText('preview_text')->nullable();
            $table->longText('description')->nullable();
            $table->active(name: 'is_published');
            $table->dateTime('published_at')->useCurrent()->nullable();

            // Учет
            $table->string('code')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();

            $table->boolean('backorder')->default(false);
            $table->boolean('is_virtual')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'products');
    }
};
