<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->slug(nullable: false);
            $table->active();
            $table->mediumText('preview_text')->nullable();
            $table->text('content')->nullable();
            $table->string('web_site')->nullable();
            $table->enum('type', ['partner', 'client'])->default('partner');
            $table->sortable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
