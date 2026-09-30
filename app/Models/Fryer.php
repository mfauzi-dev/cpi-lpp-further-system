<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fryer extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'fryer',
        'suhu_setting',
        'suhu_aktual',
        'suhu_pusat',
        'suhu_minimum',
        'organoleptik',
        'lama_pemasakan',
        'tpm_minyak',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'suhu_setting' => 'decimal:2',
        'suhu_aktual' => 'decimal:2',
        'suhu_pusat' => 'decimal:2',
        'suhu_minimum' => 'decimal:2',
        'lama_pemasakan' => 'decimal:2',
        'tpm_minyak' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }

    public function getSuhuPusatStatusAttribute(): ?string
    {
        if ($this->suhu_pusat === null) {
            return null;
        }

        $suhu = (float) $this->suhu_pusat;

        if ($suhu >= 76.5 && $suhu <= 79.5) {
            return 'success';
        }

        if (($suhu >= 76 && $suhu < 76.5) || ($suhu > 79.5 && $suhu <= 80)) {
            return 'warning';
        }
        
        return 'danger';
    }
}
