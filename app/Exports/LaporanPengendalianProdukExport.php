<?php

namespace App\Exports;

use App\Models\ProductionBatch;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanPengendalianProdukExport implements WithMultipleSheets
{
    protected int $productionBatchId;

    protected ?ProductionBatch $productionBatch = null;

    public function __construct(int $productionBatchId)
    {
        $this->productionBatchId = $productionBatchId;

        $this->productionBatch = ProductionBatch::with([
            'product.productGroup',
            'productions.processType',
            'productions.details.product',
            'bowlCutters',
            'grinders',
            'preparasiFlas',
            'mixings',
            'tumblers',
            'batters',
            'predustBreaders',
            'fryers',
            'hlts',
            'pembekuans',
            'packingDalams.samplings',
            'packingDalams.plastiks.product',
            'packingLuars.samplings',
            'packingLuars.kemasans.product',
            'packingLuars.palets.product',
            'kemasanRijeks',
            'formings',
        ])->findOrFail($productionBatchId);
    }

    public function sheets(): array
    {
        return [
            new LaporanPengendalianProdukDepanSheet($this->productionBatch),
            new LaporanPengendalianProdukBelakangSheet($this->productionBatch),
        ];
    }
}