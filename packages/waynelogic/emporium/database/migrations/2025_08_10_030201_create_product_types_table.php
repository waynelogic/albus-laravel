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
        Schema::create($this->prefix . 'product_types', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->string('name');
            $table->slug(nullable: false);
            $table->foreignId('default_brand_id')->nullable()->constrained($this->prefix . 'brands')->nullOnDelete();
            $table->foreignId('default_category_id')->nullable()->constrained($this->prefix . 'categories')->nullOnDelete();
            $table->foreignId('default_country_id')->nullable()->constrained($this->prefix . 'countries')->nullOnDelete();
            $table->foreignId('default_unit_id')->nullable()->constrained($this->prefix . 'units')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create($this->prefix . 'product_types_properties', function (Blueprint $table) {
            $table->foreignId('product_type_id')->constrained($this->prefix . 'product_types')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained($this->prefix . 'properties')->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->string('filter_type')->nullable();
            $table->boolean('show_in_filter')->default(false);
            $table->boolean('is_required')->default(false);
            $table->sortable();
        });

        Schema::create($this->prefix . 'product_types_options', function (Blueprint $table) {
            $table->foreignId('product_type_id')->constrained($this->prefix . 'product_types')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained($this->prefix . 'properties')->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->string('filter_type')->nullable();
            $table->boolean('show_in_filter')->default(false);
            $table->boolean('is_required')->default(false);
            $table->sortable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'product_types_properties');
        Schema::dropIfExists($this->prefix . 'product_types_options');
        Schema::dropIfExists($this->prefix . 'product_types');
    }
};
