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
        Schema::create('packing_dalams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();
            $table->enum('mhw_korin', ['MHW', 'Korin'])->nullable();
            $table->decimal('heating_level', 8, 2)->nullable();
            $table->decimal('speed', 8, 2)->nullable();
            $table->string('pressure')->nullable();
            $table->string('packing_manual')->nullable();
            $table->string('timbangan')->nullable();
            $table->decimal('heating_level_packing_manual', 8, 2)->nullable();
            $table->string('fe_sus_non_fe')->nullable();
            $table->decimal('setting_x', 8, 2)->nullable();
            $table->decimal('setting_y', 8, 2)->nullable();
            $table->string('checkweigher_pac')->nullable();
            $table->string('petugas_sortasi_after_iqf')->nullable();
            $table->string('operator_md')->nullable();
            $table->string('leader_produksi')->nullable();
            $table->time('waktu_awal')->nullable();
            $table->time('waktu_akhir')->nullable();
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
        Schema::dropIfExists('packing_dalams');
    }
};
