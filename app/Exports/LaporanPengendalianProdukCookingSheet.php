<?php

namespace App\Exports;

class LaporanPengendalianProdukCookingSheet extends LaporanPengendalianProdukBaseSheet
{
    protected function sheetNumber(): int
    {
        return 3;
    }

    protected function sheetTitle(): string
    {
        return '3. Cooking & Pembekuan';
    }

    protected function buildContent($sheet, int $row): int
    {
        $pb = $this->productionBatch;

        // BATTER
        $rows = [];

        foreach ($pb->batters as $item) {
            $rows[] = [
                $this->val($item->batter),
                $this->number($item->suhu_batter),
                $this->number($item->viskositas),
                $this->number($item->salinity),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $this->val($item->keterangan),
                $this->val($item->petugas),
                $this->val($item->pic_produksi),
            ];
        }

        $row = $this->table(
            $sheet,
            $row,
            'BATTER',
            [
                'Alat Batter',
                'Suhu Batter',
                'Viskositas',
                'Salinity',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // PREDUST BREADER
        $rows = [];

        foreach ($pb->predustBreaders as $item) {
            $rows[] = [
                $this->val($item->predust_breader),
                $this->number($item->superflex),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $this->val($item->keterangan),
                $this->val($item->petugas),
                $this->val($item->pic_produksi),
            ];
        }

        $row = $this->table(
            $sheet,
            $row,
            'PREDUST BREADER',
            [
                'Predust Breader',
                'Superflex',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // FRYER
        $rows = [];

        foreach ($pb->fryers as $item) {
            $rows[] = [
                $this->val($item->fryer),
                $this->number($item->suhu_setting),
                $this->number($item->suhu_aktual),
                $this->number($item->suhu_pusat),
                $this->number($item->suhu_minimum),
                $this->val($item->organoleptik),
                $this->number($item->lama_pemasakan),
                $this->number($item->tpm_minyak),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $this->val($item->keterangan),
                $this->val($item->petugas),
                $this->val($item->pic_produksi),
            ];
        }

        $row = $this->table(
            $sheet,
            $row,
            'FRYER',
            [
                'Fryer',
                'Suhu Setting',
                'Suhu Aktual',
                'Suhu Pusat',
                'Suhu Minimum',
                'Organoleptik',
                'Lama Masak',
                'TPM Minyak',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // HLT
        $rows = [];

        foreach ($pb->hlts as $item) {
            $rows[] = [
                $this->number($item->suhu_awal_daging),
                $this->number($item->suhu_infeed),
                $this->number($item->suhu_outfeed),
                $this->number($item->steam_valve),
                $this->number($item->speed_ventilator),
                $this->number($item->lama_pemasakan),
                $this->number($item->suhu_pusat_ct),
                $this->val($item->organoleptik),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $this->val($item->keterangan),
                $this->val($item->petugas),
                $this->val($item->pic_produksi),
            ];
        }

        $row = $this->table(
            $sheet,
            $row,
            'HLT',
            [
                'Suhu Awal Daging',
                'Suhu Infeed',
                'Suhu Outfeed',
                'Steam Valve',
                'Speed Vent.',
                'Lama Masak',
                'Suhu Pusat CT',
                'Organoleptik',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // PEMBEKUAN
        $pembekuan = $pb->pembekuans->first();

        if (!$pembekuan) {
            $row = $this->emptySection($sheet, $row, 'PEMBEKUAN');

            return $row;
        }

        $this->sectionTitle($sheet, $row, 'PEMBEKUAN', 'A', 'N');

        $row++;

        $data = [
            'Suhu Ruang Packing' => $this->number($pembekuan->suhu_ruang_packing),
            'Suhu Ruang IQF' => $this->number($pembekuan->suhu_ruang_iqf),
            'Speed Conveyor' => $this->number($pembekuan->speed_conveyor),
            'Suhu Pusat' => $this->number($pembekuan->suhu_pusat),
            'Waktu Mulai' => $this->time($pembekuan->waktu_mulai),
            'Waktu Selesai' => $this->time($pembekuan->waktu_selesai),
            'Lama Waktu Kerusakan' => $this->number($pembekuan->lama_waktu_kerusakan),
            'Lama Waktu Istirahat' => $this->number($pembekuan->lama_waktu_istirahat),
            'Operator' => $this->val($pembekuan->operator),
            'Line' => $this->val($pembekuan->line),
            'PIC Produksi' => $this->val($pembekuan->pic_produksi),
        ];

        $row = $this->keyValue($sheet, $row, $data);

        return $row;
    }
}