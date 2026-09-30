<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingDalamSampling extends Model
{
    use HasFactory;

     protected $fillable = [
        'packing_dalam_id',
        'sampling_ke',
        'berat_kemasan',
        'berat_per_bag',
        'range_berat',
    ];

    protected $casts = [
        'sampling_ke' => 'integer',
        'berat_kemasan' => 'decimal:2',
        'berat_per_bag' => 'decimal:2',
    ];

    public function packingDalam()
    {
        return $this->belongsTo(
            PackingDalam::class
        );
    }
}
