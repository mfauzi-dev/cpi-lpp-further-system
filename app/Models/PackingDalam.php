<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingDalam extends Model
{
    use HasFactory;

      protected $fillable = [
        'production_batch_id',
        'mhw_korin',
        'heating_level',
        'speed',
        'pressure',
        'packing_manual',
        'timbangan',
        'heating_level_packing_manual',
        'fe_sus_non_fe',
        'setting_x',
        'setting_y',
        'checkweigher_pac',
        'petugas_sortasi_after_iqf',
        'operator_md',
        'leader_produksi',
        'waktu_awal',
        'waktu_akhir',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'heating_level' => 'decimal:2',
        'speed' => 'decimal:2',
        'heating_level_packing_manual' => 'decimal:2',
        'setting_x' => 'decimal:2',
        'setting_y' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }

    public function samplings()
    {
        return $this->hasMany(PackingDalamSampling::class)
            ->orderBy('sampling_ke');
    }

    public function plastiks()
    {
        return $this->hasMany(PackingDalamPlastik::class);
    }

}
