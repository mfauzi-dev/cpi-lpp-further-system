<?php

namespace App\Exports;

class LaporanPengendalianProdukPackingDalamSheet extends LaporanPengendalianProdukBaseSheet
{
    protected function sheetNumber(): int
    {
        return 4;
    }

    protected function sheetTitle(): string
    {
        return '4. Packing Dalam & Metal Det.';
    }

    protected function buildContent($sheet, int $row): int
    {
        $pb = $this->productionBatch;

        $packingDalam = $pb->packingDalams->first();

        if (!$packingDalam) {
            $row = $this->emptySection($sheet, $row, 'PACKING DALAM');
        } else {
            // PACKING DALAM
            $this->sectionTitle($sheet, $row, 'PACKING DALAM', 'A', 'N');

            $row++;

            $data = [
                'MHW / Korin' => $this->val($packingDalam->mhw_korin),
                'Heating Level' => $this->number($packingDalam->heating_level),
                'Speed' => $this->number($packingDalam->speed),
                'Pressure' => $this->number($packingDalam->pressure),
                'Packing Manual' => $this->val($packingDalam->packing_manual),
                'Timbangan' => $this->val($packingDalam->timbangan),
                'Heating Level Packing Manual' => $this->number($packingDalam->heating_level_packing_manual),
                'Metal Detector' => $this->val($packingDalam->metal_detector),
                'Fe / Sus / Non Fe' => $this->val($packingDalam->fe_sus_non_fe),
                'Checkweigher PAC' => $this->val($packingDalam->checkweigher_pac),
                'Petugas Sortasi After IQF' => $this->val($packingDalam->petugas_sortasi_after_iqf),
                'Operator MD' => $this->val($packingDalam->operator_md),
                'Leader Produksi' => $this->val($packingDalam->leader_produksi),
                'Waktu Awal' => $this->time($packingDalam->waktu_awal),
                'Waktu Akhir' => $this->time($packingDalam->waktu_akhir),
                'Line' => $this->val($packingDalam->line),
                'PIC Produksi' => $this->val($packingDalam->pic_produksi),
            ];

            $row = $this->keyValue($sheet, $row, $data);

            // SAMPLING PACKING DALAM
            $rows = [];
            $no = 1;

            foreach ($packingDalam->samplings as $sampling) {
                $rows[] = [
                    (string) $no,
                    $this->val($sampling->sampling_ke),
                    $this->number($sampling->berat_kemasan),
                    $this->number($sampling->berat_per_bag),
                    $this->val($sampling->range_berat),
                    '-',
                ];

                $no++;
            }

            $row = $this->table(
                $sheet,
                $row,
                'SAMPLING PACKING DALAM',
                [
                    'No',
                    'Sampling Ke',
                    'Berat Kemasan',
                    'Berat / Bag',
                    'Range Berat',
                    'Keterangan',
                ],
                $rows
            );

            // PENGGUNAAN PLASTIK
            $rows = [];

            foreach ($packingDalam->plastiks as $plastik) {
                $rows[] = [
                    $this->bahanBakuLabel($plastik->bahanBaku),
                    $this->number($plastik->jumlah),
                    $this->number($plastik->pemakaian),
                    $this->number($plastik->sisa),
                    $this->number($plastik->rijek),
                ];
            }

            $row = $this->table(
                $sheet,
                $row,
                'PENGGUNAAN PLASTIK',
                [
                    'Bahan Baku',
                    'Jumlah',
                    'Pemakaian',
                    'Sisa',
                    'Rijek',
                ],
                $rows
            );
        }

        // METAL DETECTOR
        $rows = [];

        foreach ($pb->metalDetectors as $item) {
            $rows[] = [
                $this->val($item->batch_type),
                $this->val($item->metal_detector),
                $this->time($item->waktu_awal),
                $this->time($item->waktu_akhir),
            ];
        }

        $row = $this->table(
            $sheet,
            $row,
            'METAL DETECTOR',
            [
                'Batch Type',
                'Metal Detector',
                'Waktu Awal',
                'Waktu Akhir',
            ],
            $rows
        );

        return $row;
    }
}