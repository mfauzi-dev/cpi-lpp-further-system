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
        Schema::create('production_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')
                ->constrained('productions')->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products')->cascadeOnDelete();
            $table->string('kode_batch')->nullable();
            $table->decimal('suhu', 5, 2)->nullable();
            $table->decimal('berat_kg', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_details');
    }
};
