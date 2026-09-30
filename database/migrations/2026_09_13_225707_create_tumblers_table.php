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
        Schema::create('tumblers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->enum('tumbler', [
                'Tumbler A',
                'Tumbler B'
            ])->nullable();
            $table->decimal('drum_on', 8, 2)->nullable();
            $table->decimal('drum_off', 8, 2)->nullable();
            $table->decimal('vacuum_a', 8, 2)->nullable();
            $table->decimal('vacuum_b', 8, 2)->nullable();
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
        Schema::dropIfExists('tumblers');
    }
};
