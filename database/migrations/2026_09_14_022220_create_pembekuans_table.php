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
        Schema::create('pembekuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->decimal('suhu_ruang_packing', 8, 2)->nullable();
            $table->decimal('suhu_ruang_iqf', 8, 2)->nullable();
            $table->decimal('speed_conveyor', 8, 2)->nullable();
            $table->decimal('suhu_pusat', 8, 2)->nullable();
            $table->decimal('suhu_minimum', 8, 2)->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->decimal('lama_waktu_kerusakan', 8, 2)->nullable();
            $table->decimal('lama_waktu_istirahat', 8, 2)->nullable();
            $table->string('operator')->nullable();
            $table->string('line')->nullable();
            $table->string('pic_produksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembekuans');
    }
};
