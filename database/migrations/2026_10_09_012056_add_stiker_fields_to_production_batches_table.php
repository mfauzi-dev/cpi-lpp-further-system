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
        Schema::table('production_batches', function (Blueprint $table) {
            $table->string('kartu_rute')
                ->nullable()
                ->after('produktifitas');

            $table->string('cppb_qi_bb')
                ->nullable()
                ->after('kartu_rute');

            $table->string('komposisi')
                ->nullable()
                ->after('cppb_qi_bb');

            $table->string('kode_cetak')
                ->nullable()
                ->after('komposisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('production_batches', function (Blueprint $table) {
            $table->dropColumn([
                'kartu_rute',
                'cppb_qi_bb',
                'komposisi',
                'kode_cetak',
            ]);
        });
    }
};
