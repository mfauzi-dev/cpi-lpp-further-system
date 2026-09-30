<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forming extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'alat',
        'suhu_adonan',
        'pressure',
        'speed',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'suhu_adonan' => 'decimal:2',
        'pressure' => 'decimal:2',
        'speed' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
