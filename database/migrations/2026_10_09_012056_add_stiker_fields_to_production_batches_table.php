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
            $table->string('stiker_komposisi')
                ->nullable()
                ->after('produktifitas');

            $table->string('stiker_cppb_qi_bb')
                ->nullable()
                ->after('stiker_komposisi');

            $table->string('stiker_bpom')
                ->nullable()
                ->after('stiker_cppb_qi_bb');

            $table->string('stiker_kode_cetak')
                ->nullable()
                ->after('stiker_bpom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('production_batches', function (Blueprint $table) {
            $table->dropColumn([
                'stiker_komposisi',
                'stiker_cppb_qi_bb',
                'stiker_bpom',
                'stiker_kode_cetak',
            ]);
        });
    }
};
