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
        Schema::create('mixings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->string('mixer_preparation')->nullable();
            $table->decimal('suhu_air', 8, 2)->nullable();
            $table->decimal('lama_pengadukan', 8, 2)->nullable();
            $table->string('filter')->nullable();
            $table->decimal('salinity', 8, 2)->nullable();
            $table->string('brix')->nullable();
            $table->enum('mixer', [
                'Unimix',
                'Inotec'
            ])->nullable();
            $table->decimal('suhu_adonan', 8, 2)->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('downtime')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('petugas')->nullable();
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
        Schema::dropIfExists('mixings');
    }
};
