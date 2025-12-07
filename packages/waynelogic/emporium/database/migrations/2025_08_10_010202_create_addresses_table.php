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
        Schema::create($this->prefix . 'addresses', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->string('name')->nullable();

            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            $table->string('full_address');

            $table->timestamps();
        });

        Schema::create($this->prefix . 'addressables', function (Blueprint $table) {
            $table->foreignId('address_id')->constrained($this->prefix . 'addresses')->cascadeOnDelete();
            $table->morphs('addressable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'addressables');
        Schema::dropIfExists($this->prefix . 'addresses');
    }
};
