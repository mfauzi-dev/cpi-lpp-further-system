<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mixing extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'mixer_preparation',
        'suhu_air',
        'lama_pengadukan',
        'filter',
        'salinity',
        'brix',
        'mixer',
        'suhu_adonan',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'suhu_air' => 'decimal:2',
        'lama_pengadukan' => 'decimal:2',
        'salinity' => 'decimal:2',
        'brix' => 'decimal:2',
        'suhu_adonan' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
