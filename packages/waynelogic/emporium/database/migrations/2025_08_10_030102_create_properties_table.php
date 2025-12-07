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
        Schema::create($this->prefix . 'properties', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->foreignId('property_group_id')->constrained($this->prefix . 'property_groups')->cascadeOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained($this->prefix . 'units')->nullOnDelete();
            $table->string('name');
            $table->slug('handle', false);
            $table->string('section')->nullable();
            $table->string('type')->index();
            $table->boolean('is_required')->default(false);
            $table->json('configuration')->nullable();

            // Trait fields
            $table->sortable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'properties');
    }
};
