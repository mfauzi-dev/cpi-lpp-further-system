<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KemasanRijek extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'rusak_cooking',
        'rusak_packing',
        'jatuh_lantai_cooking',
        'jatuh_lantai_packing',
        'kulit_cooking',
        'kulit_packing',
        'waste_bread_crumb_cooking',
        'waste_bread_crumb_packing',
        'waste_bread_predust_cooking',
        'waste_bread_predust_packing',
        'scrap_adonan_cooking',
        'scrap_adonan_packing',
        'gosong_cooking',
        'gosong_packing',
        'overweight_underweight_cooking',
        'overweight_underweight_packing',
        'sampel_qc_cooking',
        'sampel_qc_packing',
        'lain_lain_cooking',
        'lain_lain_cooking_kg',
        'total_rijek_cooking_kg',
        'lain_lain_packing',
        'lain_lain_packing_kg',
        'total_rijek_packing_kg',
    ];

    protected $casts = [
        'rusak_cooking' => 'decimal:2',
        'rusak_packing' => 'decimal:2',
        'jatuh_lantai_cooking' => 'decimal:2',
        'jatuh_lantai_packing' => 'decimal:2',
        'kulit_cooking' => 'decimal:2',
        'kulit_packing' => 'decimal:2',
        'waste_bread_crumb_cooking' => 'decimal:2',
        'waste_bread_crumb_packing' => 'decimal:2',
        'waste_bread_predust_cooking' => 'decimal:2',
        'waste_bread_predust_packing' => 'decimal:2',
        'scrap_adonan_cooking' => 'decimal:2',
        'scrap_adonan_packing' => 'decimal:2',
        'gosong_cooking' => 'decimal:2',
        'gosong_packing' => 'decimal:2',
        'overweight_underweight_cooking' => 'decimal:2',
        'overweight_underweight_packing' => 'decimal:2',
        'sampel_qc_cooking' => 'decimal:2',
        'sampel_qc_packing' => 'decimal:2',
        'lain_lain_cooking_kg' => 'decimal:2',
        'lain_lain_packing_kg' => 'decimal:2',
        'total_rijek_cooking_kg' => 'decimal:2',
        'total_rijek_packing_kg' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}