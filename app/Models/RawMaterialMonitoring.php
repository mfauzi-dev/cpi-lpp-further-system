<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialMonitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'product_id',
        'kode_batch',
        'waktu_kerja',
        'suhu',
        'berat',
        'total_rm',
        'penggunaan',
        'sisa',
    ];
 
    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
        'waktu_kerja' => 'decimal:1',
        'suhu' => 'decimal:2',
        'berat' => 'decimal:2',
        'total_rm' => 'decimal:2',
        'penggunaan' => 'decimal:2',
        'sisa' => 'decimal:2',
    ];
 
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
