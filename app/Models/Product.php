<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

      protected $fillable = [
        'kode',
        'nama',
        'gramasi',
        'pack_per_box',
    ];

    protected $casts = [
        'gramasi' => 'decimal:2',
        'pack_per_box' => 'integer',
    ];

    public function formulas()
    {
        return $this->hasMany(ProductFormula::class);
    }
}