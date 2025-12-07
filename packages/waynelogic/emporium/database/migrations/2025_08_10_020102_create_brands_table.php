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
        Schema::create($this->prefix . 'brands', function (Blueprint $table) {
            $table->id();
            $table->external_id();
            $table->string('name');
            $table->slug(nullable: false);
            $table->text('preview_text')->nullable();
            $table->longText('description')->nullable();
            $table->string('website')->nullable();
            $table->active();
            $table->json('attribute_data')->nullable();

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
        Schema::dropIfExists($this->prefix . 'brands');
    }
};
