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
        Schema::create('kemasan_rijeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_batch_id')
                ->constrained('production_batches')
                ->cascadeOnDelete();

            $table->decimal('rusak_cooking', 12, 2)->default(0);
            $table->decimal('rusak_packing', 12, 2)->default(0);

            $table->decimal('jatuh_lantai_cooking', 12, 2)->default(0);
            $table->decimal('jatuh_lantai_packing', 12, 2)->default(0);

            $table->decimal('kulit_cooking', 12, 2)->default(0);
            $table->decimal('kulit_packing', 12, 2)->default(0);

            $table->decimal('waste_bread_crumb_cooking', 12, 2)->default(0);
            $table->decimal('waste_bread_crumb_packing', 12, 2)->default(0);

            $table->decimal('waste_bread_predust_cooking', 12, 2)->default(0);
            $table->decimal('waste_bread_predust_packing', 12, 2)->default(0);

            $table->decimal('scrap_adonan_cooking', 12, 2)->default(0);
            $table->decimal('scrap_adonan_packing', 12, 2)->default(0);

            $table->decimal('gosong_cooking', 12, 2)->default(0);
            $table->decimal('gosong_packing', 12, 2)->default(0);

            $table->decimal('overweight_underweight_cooking', 12, 2)->default(0);
            $table->decimal('overweight_underweight_packing', 12, 2)->default(0);

            $table->decimal('sampel_qc_cooking', 12, 2)->default(0);
            $table->decimal('sampel_qc_packing', 12, 2)->default(0);

            $table->string('lain_lain_cooking')->nullable();
            $table->decimal('lain_lain_cooking_kg', 10, 2)->nullable();

            $table->string('lain_lain_packing')->nullable();
            $table->decimal('lain_lain_packing_kg', 10, 2)->nullable();

            $table->decimal('total_rijek_cooking_kg', 10, 2)->nullable();
            $table->decimal('total_rijek_packing_kg', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kemasan_rijeks');
    }
};