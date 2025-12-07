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
        Schema::create($this->prefix . 'order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->slug('code');
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_cancel')->default(false);
            $table->boolean('is_complete')->default(false);
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
        Schema::dropIfExists($this->prefix . 'order_statuses');
    }
};
