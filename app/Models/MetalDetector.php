<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetalDetector extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'batch_type',
        'metal_detector',
        'waktu_awal',
        'waktu_akhir',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
