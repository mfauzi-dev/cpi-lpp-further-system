<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingLuarSampling extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'packing_luar_id',
        'sampling_ke',
        'berat_per_box',
        'range_berat',
    ];

    protected $casts = [
        'sampling_ke' => 'integer',
        'berat_per_box' => 'decimal:2',
    ];

    public function packingLuar()
    {
        return $this->belongsTo(PackingLuar::class);
    }
}
