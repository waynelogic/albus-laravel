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
        Schema::create($this->prefix . 'property_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained($this->prefix . 'properties')->cascadeOnDelete();

            $table->morphs('assignable'); // assignable_id + assignable_type

            $table->string('value_text')->nullable();
            $table->decimal('value_number', 15, 4)->nullable();
            $table->boolean('value_boolean')->nullable();
            $table->json('value_json')->nullable();
            $table->foreignId('value_id')->nullable()->constrained($this->prefix . 'property_values')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'property_assignments');
    }
};
