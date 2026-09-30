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
        Schema::create('packing_luars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->string('pengisian_ke_dalam_box')->nullable();
            $table->string('sealer_box')->nullable();
            $table->string('check_weigher_box')->nullable();
            $table->string('petugas')->nullable();
            $table->string('pic_produksi')->nullable();
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
        Schema::dropIfExists('packing_luars');
    }
};
