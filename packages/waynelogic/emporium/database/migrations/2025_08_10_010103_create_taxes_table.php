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
        Schema::create($this->prefix . 'taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_global')->default(false);
            $table->decimal('percent', 5, 2)->nullable();
            $table->text('description')->nullable();

            // Trait fields
            $table->active(default: false);
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
        Schema::dropIfExists($this->prefix . 'taxes');
    }
};
