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
        Schema::create('metal_detectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->enum('batch_type', ['HALF BATCH', 'FULL BATCH'])->nullable();
            $table->enum('metal_detector', ['1', '2', '3', '4', '5', '6'])->nullable();
            $table->time('waktu_awal')->nullable();
            $table->time('waktu_akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metal_detectors');
    }
};
