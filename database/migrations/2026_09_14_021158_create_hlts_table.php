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
        Schema::create('hlts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->decimal('suhu_awal_daging', 8, 2)->nullable();
            $table->decimal('suhu_infeed', 8, 2)->nullable();
            $table->decimal('suhu_outfeed', 8, 2)->nullable();
            $table->decimal('steam_valve', 8, 2)->nullable();
            $table->decimal('speed_ventilator', 8, 2)->nullable();
            $table->decimal('lama_pemasakan', 8, 2)->nullable();
            $table->decimal('suhu_pusat_ct', 8, 2)->nullable();
            $table->text('organoleptik')->nullable();
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
        Schema::dropIfExists('hlts');
    }
};
