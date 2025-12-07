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
        Schema::create($this->prefix . 'product_associations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_parent_id')->constrained($this->prefix . 'products')->cascadeOnDelete();
            $table->foreignId('product_target_id')->constrained($this->prefix . 'products')->cascadeOnDelete();
            $table->string('type')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'product_associations');
    }
};
