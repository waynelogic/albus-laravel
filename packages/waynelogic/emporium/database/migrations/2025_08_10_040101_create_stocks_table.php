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
        Schema::create($this->prefix . 'stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained($this->prefix . 'warehouses')->cascadeOnDelete();
            $table->morphs('stockable');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'stocks');
    }
};
