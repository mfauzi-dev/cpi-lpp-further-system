<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingLuar extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'pengisian_ke_dalam_box',
        'sealer_box',
        'check_weigher_box',
        'petugas',
        'pic_produksi',
        'waktu_awal',
        'waktu_akhir',
    ];

    protected $casts = [
        //
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }

    public function samplings()
    {
        return $this->hasMany(PackingLuarSampling::class)
            ->orderBy('sampling_ke');
    }

    public function kemasans()
    {
        return $this->hasMany(PackingLuarKemasan::class);
    }

    public function palets()
    {
        return $this->hasMany(PackingLuarPalet::class)
            ->orderBy('no_palet');
    }
}
