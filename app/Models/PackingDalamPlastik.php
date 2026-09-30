<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingDalamPlastik extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'packing_dalam_id',
        'product_id',
        'jumlah',
        'pemakaian',
        'sisa',
        'rijek',
        'operator_mhw',
        'checker_ds',
        'leader',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'pemakaian' => 'decimal:2',
        'sisa' => 'decimal:2',
        'rijek' => 'decimal:2',
    ];

    public function packingDalam()
    {
        return $this->belongsTo(PackingDalam::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
