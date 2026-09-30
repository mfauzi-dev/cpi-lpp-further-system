<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingLuarKemasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'packing_luar_id',
        'product_id',
        'jumlah',
        'pemakaian',
        'sisa',
        'rijek',
        'petugas',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'pemakaian' => 'decimal:2',
        'sisa' => 'decimal:2',
        'rijek' => 'decimal:2',
    ];

    public function packingLuar()
    {
        return $this->belongsTo(PackingLuar::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
