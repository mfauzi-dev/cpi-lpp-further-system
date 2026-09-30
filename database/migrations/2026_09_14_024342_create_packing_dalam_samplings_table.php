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
        Schema::create('packing_dalam_samplings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_dalam_id')
                ->constrained('packing_dalams')
                ->cascadeOnDelete();
            $table->unsignedInteger('sampling_ke');
            $table->decimal('berat_kemasan', 10, 2)->nullable();
            $table->decimal('berat_per_bag', 10, 2)->nullable();
            $table->string('range_berat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_dalam_samplings');
    }
};
