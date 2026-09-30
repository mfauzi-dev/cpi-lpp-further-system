<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tumbler extends Model
{
    use HasFactory;

     protected $fillable = [
        'production_batch_id',
        'tumbler',
        'drum_on',
        'drum_off',
        'vacuum_a',
        'vacuum_b',
        'waktu_mulai',
        'waktu_selesai',
        'downtime',
        'keterangan',
        'petugas',
        'line',
        'pic_produksi',
    ];

    protected $casts = [
        'drum_on' => 'decimal:2',
        'drum_off' => 'decimal:2',
        'vacuum' => 'decimal:2',
    ];

    public function productionBatch()
    {
        return $this->belongsTo(ProductionBatch::class);
    }
}
