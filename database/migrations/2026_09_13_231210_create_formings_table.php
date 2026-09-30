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
        Schema::create('formings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->enum('alat', [
                'Revo 600',
                'Revo 400',
                'Rheon',
                'Forming 600'
            ])->nullable();
            $table->decimal('suhu_adonan', 8, 2)->nullable();
            $table->decimal('pressure', 8, 2)->nullable();
            $table->decimal('speed', 8, 2)->nullable();
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
        Schema::dropIfExists('formings');
    }
};
