<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batter extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'batter',
        'suhu_batter',
        'viskositas',
        'salinity',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'suhu_batter' => 'decimal:2',
        'viskositas' => 'decimal:2',
        'salinity' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
