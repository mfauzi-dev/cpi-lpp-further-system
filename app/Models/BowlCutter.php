<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BowlCutter extends Model
{
    use HasFactory;

   protected $fillable = [
        'production_batch_id',
        'speed',
        'suhu_emulasi',
        'homeganisasi_orlap',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'suhu_emulasi' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
