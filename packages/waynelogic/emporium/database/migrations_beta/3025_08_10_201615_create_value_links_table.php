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
        Schema::create($this->prefix . 'value_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('value_id')->constrained($this->prefix . 'attribute_values')->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained($this->prefix . 'attributes')->cascadeOnDelete();
            $table->morphs('value_linkable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value_links');
    }
};
