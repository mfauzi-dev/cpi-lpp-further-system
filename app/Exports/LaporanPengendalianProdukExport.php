<?php

namespace App\Exports;

use App\Models\ProductionBatch;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanPengendalianProdukExport implements WithMultipleSheets
{
    protected ProductionBatch $productionBatch;

    public function __construct(int $productionBatchId)
    {
        $this->productionBatch = ProductionBatch::with([
            'product',
            'produksiBahanBakus.items.bahanBaku',
            'produksiBahanBakus.items.productFormula',
            'suhuRuangs',
            'bowlCutters',
            'grinders',
            'preparasiFlas',
            'mixings',
            'tumblers',
            'formings',
            'batters',
            'predustBreaders',
            'fryers',
            'hlts',
            'pembekuans',
            'packingDalams.samplings',
            'packingDalams.plastiks.bahanBaku',
            'metalDetectors',
            'packingLuars.samplings',
            'packingLuars.kemasans.bahanBaku',
            'packingLuars.palets.bahanBaku',
            'kemasanRijeks',
        ])->findOrFail($productionBatchId);
    }

    public function sheets(): array
    {
        return [
            new LaporanPengendalianProdukIdentitasSheet($this->productionBatch),
            new LaporanPengendalianProdukProsesSheet($this->productionBatch),
            new LaporanPengendalianProdukCookingSheet($this->productionBatch),
            new LaporanPengendalianProdukPackingDalamSheet($this->productionBatch),
            new LaporanPengendalianProdukKemasanRijekSheet($this->productionBatch),
            new LaporanPengendalianProdukPackingLuarSheet($this->productionBatch),
        ];
    }
}