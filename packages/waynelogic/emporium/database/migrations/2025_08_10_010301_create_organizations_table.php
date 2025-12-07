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
        Schema::create($this->prefix . 'organizations', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->string('name');
            $table->slug();
            $table->string('full_name')->nullable();
            $table->string('prefix')->nullable();
            $table->string('legal_state')->nullable();
            $table->json('identifiers')->nullable();
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
        Schema::dropIfExists($this->prefix . 'organizations');
    }
};
