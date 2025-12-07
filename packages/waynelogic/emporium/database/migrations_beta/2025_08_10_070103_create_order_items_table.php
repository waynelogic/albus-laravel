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
        Schema::create($this->prefix . 'order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained($this->prefix . 'orders')->cascadeOnDelete();
            $table->morphs('orderable');
            $table->smallInteger('quantity')->unsigned();
            $table->json('meta')->nullable();
            $table->sortable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'order_items');
    }
};
