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
        Schema::create($this->prefix . 'currencies', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->active();
            $table->string('name');
            $table->string('code')->unique();
            $table->integer('number')->unique();
            $table->string('symbol')->nullable();
            $table->decimal('rate')->default(1);
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
        Schema::dropIfExists($this->prefix . 'currencies');
    }
};
