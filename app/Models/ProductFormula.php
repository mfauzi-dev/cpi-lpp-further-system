<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFormula extends Model
{
    use HasFactory;

     protected $fillable = [
        'product_id',
        'bahan_baku_id',
        'name',
        'total_kg',
    ];

    protected $casts = [
        'total_kg' => 'decimal:3',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}
