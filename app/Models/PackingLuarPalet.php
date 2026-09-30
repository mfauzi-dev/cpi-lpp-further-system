<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingLuarPalet extends Model
{
    use HasFactory;

    protected $fillable = [
        'packing_luar_id',
        'product_id',
        'no_palet',
        'jumlah_pack',
        'jumlah_box',
        'jumlah_kg',
        'no_bstb',
        'jumlah_wip_keluar_bag',
        'jumlah_wip_keluar_kg',
        'jumlah_wip_keluar_lot',
        'jumlah_wip_masuk',
        'checker_fg',
    ];

    protected $casts = [
        'no_palet' => 'integer',
        'jumlah_pack' => 'integer',
        'jumlah_box' => 'decimal:2',
        'jumlah_kg' => 'decimal:2',
        'jumlah_wip_keluar_bag' => 'decimal:2',
        'jumlah_wip_keluar_kg' => 'decimal:2',
        'jumlah_wip_keluar_lot' => 'decimal:2',
        'jumlah_wip_masuk' => 'decimal:2',
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