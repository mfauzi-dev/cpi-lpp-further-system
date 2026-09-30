<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hlt extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_batch_id',
        'suhu_awal_daging',
        'suhu_infeed',
        'suhu_outfeed',
        'steam_valve',
        'speed_ventilator',
        'lama_pemasakan',
        'suhu_pusat_ct',
        'organoleptik',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'suhu_awal_daging' => 'decimal:2',
        'suhu_infeed' => 'decimal:2',
        'suhu_outfeed' => 'decimal:2',
        'steam_valve' => 'decimal:2',
        'speed_ventilator' => 'decimal:2',
        'lama_pemasakan' => 'decimal:2',
        'suhu_pusat_ct' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
