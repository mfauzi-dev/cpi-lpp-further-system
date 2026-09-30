<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuhuRuang extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'suhu_ruang_meatprep',
        'suhu_ruang_chillroom',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}