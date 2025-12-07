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
        Schema::create($this->prefix . 'prices', function (Blueprint $table) {
            $table->id();
            $table->morphs('priceable');
            $table->foreignId('price_type_id')->nullable()->constrained($this->prefix . 'price_types')->cascadeOnDelete();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('old_price', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'prices');
    }
};
