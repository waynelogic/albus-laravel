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
        Schema::create($this->prefix . 'property_values', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->foreignId('property_id')->constrained($this->prefix . 'properties')->cascadeOnDelete();
            $table->string('value');
            $table->slug();
            $table->sortable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'property_values');
    }
};
