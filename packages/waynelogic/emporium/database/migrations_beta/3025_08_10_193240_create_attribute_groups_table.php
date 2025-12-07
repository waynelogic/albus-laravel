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
        Schema::create($this->prefix . 'attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('attributable_type')->index();
            $table->string('name');
            $table->slug('handle', false);

            // Trait fields
            $table->sortable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'attribute_groups');
    }
};
