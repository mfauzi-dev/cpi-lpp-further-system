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
        Schema::create('packing_dalam_plastiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_dalam_id')
                  ->constrained('packing_dalams')
                  ->cascadeOnDelete();
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();
            $table->decimal('jumlah', 12, 2)->nullable();
            $table->decimal('pemakaian', 12, 2)->nullable();
            $table->decimal('sisa', 12, 2)->nullable();
            $table->decimal('rijek', 12, 2)->nullable();
            $table->string('operator_mhw')->nullable();
            $table->string('checker_ds')->nullable();
            $table->string('leader')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_dalam_plastiks');
    }
};
