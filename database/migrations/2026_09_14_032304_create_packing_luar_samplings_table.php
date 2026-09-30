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
        Schema::create('packing_luar_samplings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_luar_id')
                ->constrained('packing_luars')
                ->cascadeOnDelete();
            $table->unsignedTinyInteger('sampling_ke');
            $table->decimal('berat_per_box', 12, 2)->nullable();
            $table->string('range_berat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_luar_samplings');
    }
};
