<?php

namespace App\Exports;

class LaporanPengendalianProdukPackingLuarSheet extends LaporanPengendalianProdukBaseSheet
{
    protected function sheetNumber(): int
    {
        return 6;
    }

    protected function sheetTitle(): string
    {
        return '6. Packing Luar & Final Check';
    }

    protected function buildContent($sheet, int $row): int
    {
        $row = $this->buildPackingLuar($sheet, $row);
        $row = $this->buildStikerKelengkapan($sheet, $row);

        return $row;
    }

    protected function buildPackingLuar($sheet, int $row): int
    {
        $packingLuar = $this->productionBatch->packingLuars->first();

        if (!$packingLuar) {
            return $this->emptySection($sheet, $row, 'PACKING LUAR');
        }

        // PACKING LUAR
        $this->sectionTitle($sheet, $row, 'PACKING LUAR', 'A', 'N');

        $row++;

        $data = [
            'Pengisian Ke Dalam Box' => $this->val($packingLuar->pengisian_ke_dalam_box),
            'Sealer Box' => $this->val($packingLuar->sealer_box),
            'Check Weigher Box' => $this->val($packingLuar->check_weigher_box),
            'Petugas' => $this->val($packingLuar->petugas),
            'PIC Produksi' => $this->val($packingLuar->pic_produksi),
            'Waktu Awal' => $this->time($packingLuar->waktu_awal),
            'Waktu Akhir' => $this->time($packingLuar->waktu_akhir),
        ];

        $row = $this->keyValue($sheet, $row, $data);

        // SAMPLING PACKING LUAR
        $rows = [];
        $no = 1;

        foreach ($packingLuar->samplings as $sampling) {
            $rows[] = [
                (string) $no,
                $this->val($sampling->sampling_ke),
                $this->number($sampling->berat_per_box),
                $this->val($sampling->range_berat),
            ];

            $no++;
        }

        $row = $this->table(
            $sheet,
            $row,
            'SAMPLING PACKING LUAR',
            [
                'No',
                'Sampling Ke',
                'Berat / Box',
                'Range Berat',
            ],
            $rows
        );

        // PENGEMASAN BOX
        $rows = [];

        foreach ($packingLuar->kemasans as $kemasan) {
            $rows[] = [
                $this->bahanBakuLabel($kemasan->bahanBaku),
                $this->number($kemasan->jumlah),
                $this->number($kemasan->pemakaian),
                $this->number($kemasan->sisa),
                $this->number($kemasan->rijek),
                $this->val($kemasan->petugas),
            ];
        }

        $row = $this->table(
            $sheet,
            $row,
            'PENGEMASAN BOX',
            [
                'Bahan Baku',
                'Jumlah',
                'Pemakaian',
                'Sisa',
                'Rijek',
                'Petugas',
            ],
            $rows
        );

        // PALET
        $rows = [];

        foreach ($packingLuar->palets as $palet) {
            $rows[] = [
                $this->val($palet->no_palet),
                $this->bahanBakuLabel($palet->bahanBaku),
                $this->val($palet->jumlah_pack),
                $this->number($palet->jumlah_box),
                $this->number($palet->jumlah_kg),
                $this->val($palet->no_bstb),
            ];
        }

        $row = $this->table(
            $sheet,
            $row,
            'PALET',
            [
                'No Palet',
                'Bahan Baku',
                'Pack',
                'Box',
                'Kg',
                'BSTB',
            ],
            $rows
        );

        return $row;
    }

    // 3 stiker dalam satu baris: CPPB QI BB, Komposisi, Kode Cetak
    // (lebar dibagi sesuai 'weight', ubah angkanya kalau mau proporsi lain)
    protected function buildStikerKelengkapan($sheet, int $row): int
    {
        $items = [];

        if ($this->hasSticker('cppb_qi_bb')) {
            $items[] = [
                'weight' => 2,
                'path' => $this->productionBatch->cppb_qi_bb,
            ];
        }

        if ($this->hasSticker('komposisi')) {
            $items[] = [
                'weight' => 2,
                'path' => $this->productionBatch->komposisi,
            ];
        }

        if ($this->hasSticker('kode_cetak')) {
            $items[] = [
                'weight' => 3,
                'path' => $this->productionBatch->kode_cetak,
            ];
        }

        if (count($items) == 0) {
            return $this->emptySection($sheet, $row, 'STIKER KELENGKAPAN LABEL');
        }

        $this->sectionTitle($sheet, $row, 'STIKER KELENGKAPAN LABEL', 'A', 'N');

        $row++;

        $rowEnd = $row + 5;

        $this->stickerGroup($sheet, $row, $rowEnd, 'A', 'N', $items);

        return $rowEnd + 2;
    }
}