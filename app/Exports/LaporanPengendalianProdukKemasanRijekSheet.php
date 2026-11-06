<?php

namespace App\Exports;

class LaporanPengendalianProdukKemasanRijekSheet extends LaporanPengendalianProdukBaseSheet
{
    protected function sheetNumber(): int
    {
        return 5;
    }

    protected function sheetTitle(): string
    {
        return '5. Kemasan Rijek';
    }

    protected function buildContent($sheet, int $row): int
    {
        $rijek = $this->productionBatch->kemasanRijeks->first();

        $rows = [];

        if ($rijek) {
            $categories = [
                [
                    'label' => 'Rusak',
                    'cooking' => 'rusak_cooking',
                    'packing' => 'rusak_packing',
                ],
                [
                    'label' => 'Jatuh Lantai',
                    'cooking' => 'jatuh_lantai_cooking',
                    'packing' => 'jatuh_lantai_packing',
                ],
                [
                    'label' => 'Kulit',
                    'cooking' => 'kulit_cooking',
                    'packing' => 'kulit_packing',
                ],
                [
                    'label' => 'Waste Bread Crumb',
                    'cooking' => 'waste_bread_crumb_cooking',
                    'packing' => 'waste_bread_crumb_packing',
                ],
                [
                    'label' => 'Waste Bread Predust',
                    'cooking' => 'waste_bread_predust_cooking',
                    'packing' => 'waste_bread_predust_packing',
                ],
                [
                    'label' => 'Scrap Adonan',
                    'cooking' => 'scrap_adonan_cooking',
                    'packing' => 'scrap_adonan_packing',
                ],
                [
                    'label' => 'Gosong',
                    'cooking' => 'gosong_cooking',
                    'packing' => 'gosong_packing',
                ],
                [
                    'label' => 'Overweight/Underweight',
                    'cooking' => 'overweight_underweight_cooking',
                    'packing' => 'overweight_underweight_packing',
                ],
                [
                    'label' => 'Sampel QC',
                    'cooking' => 'sampel_qc_cooking',
                    'packing' => 'sampel_qc_packing',
                ],
                [
                    'label' => 'Lain-lain',
                    'cooking' => 'lain_lain_cooking_kg',
                    'packing' => 'lain_lain_packing_kg',
                    'note_cooking' => 'lain_lain_cooking',
                    'note_packing' => 'lain_lain_packing',
                ],
                [
                    'label' => 'TOTAL RIJEK',
                    'cooking' => 'total_rijek_cooking_kg',
                    'packing' => 'total_rijek_packing_kg',
                ],
            ];

            foreach ($categories as $category) {
                $cookingKey = $category['cooking'];
                $packingKey = $category['packing'];

                $cookingValue = $rijek->{$cookingKey} ?? 0;
                $packingValue = $rijek->{$packingKey} ?? 0;

                // Keterangan hanya terisi untuk "Lain-lain"
                $keterangan = '-';

                if (isset($category['note_cooking'])) {
                    $noteCookingKey = $category['note_cooking'];
                    $notePackingKey = $category['note_packing'];

                    $noteCooking = $rijek->{$noteCookingKey} ?? null;
                    $notePacking = $rijek->{$notePackingKey} ?? null;

                    if ($noteCooking || $notePacking) {
                        $noteCookingText = '-';
                        $notePackingText = '-';

                        if ($noteCooking) {
                            $noteCookingText = $noteCooking;
                        }

                        if ($notePacking) {
                            $notePackingText = $notePacking;
                        }

                        $keterangan = 'Cooking: ' . $noteCookingText . ' / Packing: ' . $notePackingText;
                    }
                }

                $rows[] = [
                    $category['label'],
                    $this->number($cookingValue),
                    $this->number($packingValue),
                    $keterangan,
                ];
            }
        }

        return $this->table(
            $sheet,
            $row,
            'KEMASAN RIJEK',
            [
                'KATEGORI',
                'COOKING (Kg)',
                'PACKING (Kg)',
                'KETERANGAN',
            ],
            $rows
        );
    }
}