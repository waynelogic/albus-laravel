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
        Schema::create($this->prefix . 'attribute_values', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->foreignId('attribute_id')->constrained($this->prefix . 'attributes')->cascadeOnDelete();
            $table->string('value');
            $table->string('slug')->nullable();
            $table->sortable();
            $table->timestamps();
        });

        Schema::table($this->prefix . 'attributes', function (Blueprint $table) {
            if (!Schema::hasColumn($this->prefix . 'attributes', 'default_value_id')) {
                $table->foreignId('default_value_id')->nullable()->constrained($this->prefix . 'attribute_values')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->prefix . 'attributes', function (Blueprint $table) {
            if (Schema::hasColumn($this->prefix . 'attributes', 'default_value_id')) {
                $table->dropForeign(['default_value_id']);
            }
        });
        Schema::dropIfExists($this->prefix . 'attribute_values');
    }
};
