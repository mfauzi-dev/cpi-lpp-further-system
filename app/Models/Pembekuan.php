<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembekuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'suhu_ruang_packing',
        'suhu_ruang_iqf',
        'speed_conveyor',
        'suhu_pusat',
        'suhu_minimum',
        'waktu_mulai',
        'waktu_selesai',
        'lama_waktu_kerusakan',
        'lama_waktu_istirahat',
        'operator',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'suhu_ruang_packing' => 'decimal:2',
        'suhu_ruang_iqf' => 'decimal:2',
        'speed_conveyor' => 'decimal:2',
        'suhu_pusat' => 'decimal:2',
        'suhu_minimum' => 'decimal:2',
        'lama_waktu_kerusakan' => 'decimal:2',
        'lama_waktu_istirahat' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}