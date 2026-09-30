<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredustBreader extends Model
{
    use HasFactory;

     protected $fillable = [
        'production_batch_id',
        'predust_breader',
        'superflex',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'superflex' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
