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
        Schema::create($this->prefix . 'warehouses', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->string('name');
            $table->slug();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();

            // Trait fields
            $table->sortable();
            $table->defaultable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'warehouses');
    }
};
