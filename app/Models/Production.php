<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'process_type_id',
        'total_bahan_baku',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }

    public function processType()
    {
        return $this->belongsTo(ProcessType::class);
    }

    public function details()
    {
        return $this->hasMany(ProductionDetail::class);
    }
}