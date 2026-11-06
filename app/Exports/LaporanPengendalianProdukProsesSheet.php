<?php

namespace App\Exports;

class LaporanPengendalianProdukProsesSheet extends LaporanPengendalianProdukBaseSheet
{
    protected function sheetNumber(): int
    {
        return 2;
    }

    protected function sheetTitle(): string
    {
        return '2. Proses Produksi';
    }

    protected function buildContent($sheet, int $row): int
    {
        $pb = $this->productionBatch;

        // SUHU RUANG
        $rows = [];

        foreach ($pb->suhuRuangs as $item) {
            $rows[] = [
                $this->number($item->suhu_ruang_meatprep),
                $this->number($item->suhu_ruang_chillroom),
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
            'SUHU RUANG',
            [
                'Suhu Meatprep',
                'Suhu Chillroom',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // BOWL CUTTER
        $rows = [];

        foreach ($pb->bowlCutters as $item) {
            $rows[] = [
                $this->number($item->speed),
                $this->number($item->suhu_emulasi),
                $this->val($item->homeganisasi_orlap),
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
            'BOWL CUTTER',
            [
                'Speed',
                'Suhu Emulasi',
                'Homeganisasi/Orlap',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // GRINDER
        $rows = [];

        foreach ($pb->grinders as $item) {
            $rows[] = [
                $this->val($item->ukuran_saringan),
                $this->val($item->hasil),
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
            'GRINDER',
            [
                'Ukuran Saringan',
                'Hasil',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // MIXING
        $rows = [];

        foreach ($pb->mixings as $item) {
            $rows[] = [
                $this->val($item->mixer_preparation),
                $this->number($item->suhu_air),
                $this->number($item->lama_pengadukan),
                $this->val($item->filter),
                $this->number($item->salinity),
                $this->number($item->brix),
                $this->val($item->mixer),
                $this->number($item->suhu_adonan),
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
            'MIXING',
            [
                'Mixer Prep.',
                'Suhu Air',
                'Lama Aduk',
                'Filter',
                'Salinity',
                'Brix',
                'Mixer',
                'Suhu Adonan',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // PREPARASI FLA
        $rows = [];

        foreach ($pb->preparasiFlas as $item) {
            $rows[] = [
                $this->val($item->homeganisasi_orlap),
                $this->number($item->suhu_fla_after_cooling_down),
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
            'PREPARASI FLA',
            [
                'Homeganisasi/Orlap',
                'Suhu Fla',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // TUMBLER
        $rows = [];

        foreach ($pb->tumblers as $item) {
            $rows[] = [
                $this->val($item->tumbler),
                $this->number($item->drum_on),
                $this->number($item->drum_off),
                $this->number($item->vacuum_a),
                $this->number($item->vacuum_b),
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
            'TUMBLER',
            [
                'Tumbler',
                'Drum On',
                'Drum Off',
                'Vacuum A',
                'Vacuum B',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        // FORMING
        $rows = [];

        foreach ($pb->formings as $item) {
            $rows[] = [
                $this->val($item->alat),
                $this->number($item->suhu_adonan),
                $this->number($item->pressure),
                $this->number($item->speed),
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
            'FORMING',
            [
                'Alat',
                'Suhu Adonan',
                'Pressure',
                'Speed',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi',
            ],
            $rows
        );

        return $row;
    }
}