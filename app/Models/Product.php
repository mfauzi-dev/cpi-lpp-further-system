<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

      protected $fillable = [
        'kode_product',
        'nama',
        'product_group_id',
        'process_type_id',
        'gramasi',
        'pack_per_box',
    ];

    protected $casts = [
        'gramasi' => 'decimal:2',
        'pack_per_box' => 'integer',
    ];

    public function productGroup()
    {
        return $this->belongsTo(ProductGroup::class);
    }

    public function processType()
    {
        return $this->belongsTo(ProcessType::class);
    }
}