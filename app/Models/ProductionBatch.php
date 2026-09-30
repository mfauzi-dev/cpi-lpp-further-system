<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'no_batch',
        'tipe_proses',
        'tanggal_produksi',
        'line',
        'waktu_kerja',
        'yield',
        'persen_rijek',
        'produktifitas',
    ];

    protected $casts = [
        'tanggal_produksi' => 'date',
        'waktu_kerja' => 'integer',
        'yield' => 'decimal:2',
        'persen_rijek' => 'decimal:2',
        'produktifitas' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function formings()
    {
        return $this->hasMany(Forming::class);
    }

    public function bowlCutters()
    {
        return $this->hasMany(BowlCutter::class);
    }

    public function grinders()
    {
        return $this->hasMany(Grinder::class);
    }

    public function preparasiFlas()
    {
        return $this->hasMany(PreparasiFla::class);
    }

    public function tumblers()
    {
        return $this->hasMany(Tumbler::class);
    }

    public function mixings()
    {
        return $this->hasMany(Mixing::class);
    }

    public function batters()
    {
        return $this->hasMany(Batter::class);
    }

    public function hlts()
    {
        return $this->hasMany(Hlt::class);
    }

    public function predustBreaders()
    {
        return $this->hasMany(PredustBreader::class);
    }

    public function fryers()
    {
        return $this->hasMany(Fryer::class);
    }

    public function pembekuans()
    {
        return $this->hasMany(Pembekuan::class);
    }

    public function packingDalams()
    {
        return $this->hasMany(PackingDalam::class);
    }

    public function packingLuars()
    {
        return $this->hasMany(PackingLuar::class);
    }

    public function kemasanRijeks()
    {
        return $this->hasMany(KemasanRijek::class);
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function metalDetectors()
    {
        return $this->hasMany(MetalDetector::class);
    }

    public function suhuRuangs()
    {
        return $this->hasMany(SuhuRuang::class);
    }
}
