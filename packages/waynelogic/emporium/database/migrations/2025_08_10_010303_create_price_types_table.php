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
        Schema::create($this->prefix . 'price_types', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->foreignId('currency_id')->nullable()->constrained($this->prefix . 'currencies')->nullOnDelete();

            $table->active();
            $table->string('name');
            $table->string('code')->nullable();

            // Trait fields
            $table->sortable();
            $table->defaultable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'price_types');
    }
};
