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

    protected function suhuPusatThreshold(): array
    {
        $tipeProses = $this->productionBatch?->tipe_proses;
 
        if (in_array($tipeProses, ['non_forming', 'non_forming_roasted'], true)) {
            return ['low' => 76, 'greenLow' => 76.5, 'greenHigh' => 94, 'high' => 95];
        }
 
        // forming / null / default
        return ['low' => 76, 'greenLow' => 76.5, 'greenHigh' => 79.5, 'high' => 80];
    }
 
    public function getSuhuPusatStatusAttribute(): ?string
    {
        if ($this->suhu_pusat === null) {
            return null;
        }
 
        $t = $this->suhuPusatThreshold();
        $suhu = (float) $this->suhu_pusat;
 
        if ($suhu >= $t['greenLow'] && $suhu <= $t['greenHigh']) {
            return 'success';
        }
 
        if (($suhu >= $t['low'] && $suhu < $t['greenLow']) || ($suhu > $t['greenHigh'] && $suhu <= $t['high'])) {
            return 'warning';
        }
 
        return 'danger';
    }
}
