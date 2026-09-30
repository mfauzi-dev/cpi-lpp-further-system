<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suhu_ruangs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();

            $table->decimal('suhu_ruang_meatprep', 5, 2)->nullable();
            $table->decimal('suhu_ruang_chillroom', 5, 2)->nullable();

            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();

            $table->string('downtime', 100)->nullable();
            $table->text('keterangan')->nullable();

            $table->string('petugas', 100)->nullable();
            $table->string('line', 100)->nullable();
            $table->string('pic_produksi', 100)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suhu_ruangs');
    }
};