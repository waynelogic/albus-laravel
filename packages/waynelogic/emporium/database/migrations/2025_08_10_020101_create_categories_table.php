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
        Schema::create($this->prefix . 'categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained($this->prefix . 'categories')->nullOnDelete();
            $table->external_id();
            $table->active();

            $table->string('name');
            $table->slug(nullable: false);
            $table->string('fullslug')->nullable();
            $table->text('preview_text')->nullable();
            $table->longText('description')->nullable();
            $table->integer('sort_order')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'categories');
    }
};
