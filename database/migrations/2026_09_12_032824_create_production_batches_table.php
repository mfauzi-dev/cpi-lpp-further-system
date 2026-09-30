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
        Schema::create('production_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();
            $table->string('no_batch');
            $table->date('tanggal_produksi');
            $table->string('line')->nullable();
            $table->unsignedInteger('waktu_kerja')->nullable();
            $table->decimal('yield', 8, 2)->nullable();
            $table->decimal('persen_rijek', 8, 2)->nullable();
            $table->decimal('produktifitas', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_batches');
    }
};
