<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fryers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();

            $table->enum('fryer', ['1', '2', '3', '4', '5'])->nullable();

            $table->decimal('suhu_setting', 8, 2)->nullable();
            $table->decimal('suhu_aktual', 8, 2)->nullable();
            $table->decimal('suhu_pusat', 8, 2)->nullable();
            $table->decimal('suhu_minimum', 8, 2)->nullable();

            $table->enum('organoleptik', ['Ok', 'Tidak'])->nullable();

            $table->decimal('lama_pemasakan', 8, 2)->nullable();
            $table->decimal('tpm_minyak', 8, 2)->nullable();

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

    public function down(): void
    {
        Schema::dropIfExists('fryers');
    }
};