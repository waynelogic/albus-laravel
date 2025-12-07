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
        Schema::create($this->prefix . 'shipping_types', function (Blueprint $table) {
            $table->id();
            $table->active(default: false);
            $table->string('name');
            $table->slug('code', false);
            $table->decimal('price', 10, 2);
            $table->string('provider')->nullable();
            $table->text('preview_text')->nullable();
            $table->text('description')->nullable();
            $table->string('svg-icon')->nullable();

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
        Schema::dropIfExists($this->prefix . 'shipping_types');
    }
};
