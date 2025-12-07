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
        Schema::create($this->prefix . 'countries', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->foreignId('currency_id')->nullable()->constrained($this->prefix . 'currencies')->nullOnDelete();
            $table->string('name');
            $table->string('iso')->unique()->nullable();
            $table->string('phone_code')->nullable();
            $table->string('capital')->nullable();
            $table->string('lang')->nullable();
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
        Schema::dropIfExists($this->prefix . 'countries');
    }
};
