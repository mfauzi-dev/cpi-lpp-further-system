<?php

namespace App\Exports;

class LaporanPengendalianProdukIdentitasSheet extends LaporanPengendalianProdukBaseSheet
{
    // Kolom stiker Kartu Rute di tabel production_batches
    protected string $kartuRuteField = 'kartu_rute';

    protected function sheetNumber(): int
    {
        return 1;
    }

    protected function sheetTitle(): string
    {
        return '1. Identitas & Bahan Baku';
    }

    protected function buildContent($sheet, int $row): int
    {
        $row = $this->buildBahanBaku($sheet, $row);

        // Kartu Rute: kotak besar di tengah (kolom D sampai K = 8 kolom)
        $row = $this->stickerBox(
            $sheet,
            $row,
            'STIKER KARTU RUTE',
            'D',
            'K',
            8,
            $this->kartuRuteField
        );

        return $row;
    }

    protected function buildBahanBaku($sheet, int $row): int
    {
        $produksiBahanBakus = $this->productionBatch->produksiBahanBakus;

        if (count($produksiBahanBakus) == 0) {
            return $this->emptySection($sheet, $row, 'BAHAN - BAHAN BAKU');
        }

        $grandTotal = 0;
        $judul = 'BAHAN - BAHAN BAKU';

        foreach ($produksiBahanBakus as $produksiBahanBaku) {
            $grandTotal += (float) ($produksiBahanBaku->total ?? 0);

            $rows = [];

            foreach ($produksiBahanBaku->items as $item) {
                $rows[] = [
                    $this->val($item->bahanBaku->name ?? null),
                    $this->number($item->productFormula->total_kg ?? null),
                    $this->val($item->kode_batch),
                    $this->val($item->keterangan),
                ];
            }

            // Judul section hanya di tabel pertama
            $row = $this->table(
                $sheet,
                $row,
                $judul,
                [
                    'Bahan Baku',
                    'Formula (Kg)',
                    'Kode Batch',
                    'Keterangan',
                ],
                $rows
            );

            $judul = null;

            $row = $this->table(
                $sheet,
                $row,
                null,
                [
                    'TOTAL (Kg)',
                    'PENGGUNAAN (Kg)',
                    'SISA (Kg)',
                ],
                [
                    [
                        $this->number($produksiBahanBaku->total),
                        $this->number($produksiBahanBaku->penggunaan),
                        $this->number($produksiBahanBaku->sisa),
                    ],
                ]
            );
        }

        $row = $this->table(
            $sheet,
            $row,
            null,
            ['GRAND TOTAL BAHAN BAKU (Kg)'],
            [
                [$this->number($grandTotal)],
            ]
        );

        return $row;
    }
}