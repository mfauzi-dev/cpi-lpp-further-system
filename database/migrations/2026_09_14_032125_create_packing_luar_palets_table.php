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
        Schema::create('packing_luar_palets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_luar_id')
                ->constrained('packing_luars')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();
            $table->unsignedInteger('no_palet');
            $table->unsignedInteger('jumlah_pack')->nullable();
            $table->string('no_bstb');
            $table->decimal('jumlah_box', 12, 2)->nullable();
            $table->decimal('jumlah_kg', 12, 2)->nullable();
            $table->decimal('jumlah_wip_keluar_bag', 12, 2)->nullable();
            $table->decimal('jumlah_wip_keluar_kg', 12, 2)->nullable();
            $table->decimal('jumlah_wip_keluar_lot', 12, 2)->nullable();
            $table->decimal('jumlah_wip_masuk', 12, 2)->nullable();
            $table->string('checker_fg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_luar_palets');
    }
};
