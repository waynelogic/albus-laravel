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
        Schema::create($this->prefix . 'payment_methods', function (Blueprint $table) {
            $table->id();
            $table->active(default: false);
            $table->string('name');
            $table->slug('code', false);
            $table->text('preview_text')->nullable();
            $table->enum('payment_type', ['cash', 'online', 'bill']);
            $table->foreignId('before_status_id')->nullable()->constrained($this->prefix . 'order_statuses')->nullOnDelete();
            $table->foreignId('after_status_id')->nullable()->constrained($this->prefix . 'order_statuses')->nullOnDelete();
            $table->foreignId('cancel_status_id')->nullable()->constrained($this->prefix . 'order_statuses')->nullOnDelete();
            $table->foreignId('failed_status_id')->nullable()->constrained($this->prefix . 'order_statuses')->nullOnDelete();
            $table->string('provider')->nullable();
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
        Schema::dropIfExists($this->prefix . 'payment_methods');
    }
};
