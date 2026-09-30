<?php

namespace App\Exports;

use App\Models\ProductionBatch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class LaporanPengendalianProdukBelakangSheet implements
    FromCollection,
    WithColumnWidths,
    WithEvents,
    WithTitle
{
    protected ProductionBatch $productionBatch;

    public function __construct(ProductionBatch $productionBatch)
    {
        $this->productionBatch = $productionBatch;
    }

    public function collection()
    {
        return collect([]);
    }

    public function title(): string
    {
        return 'Lembar Belakang';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 18,
            'C' => 18,
            'D' => 18,
            'E' => 18,
            'F' => 18,
            'G' => 6,
            'H' => 6,
            'I' => 22,
            'J' => 22,
            'K' => 15,
            'L' => 15,
            'M' => 15,
            'N' => 15,
            'O' => 15,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $this->setupPage($sheet);
                $this->buildHeader($sheet);
                $this->buildPembekuanPackingDalam($sheet);
                $this->buildPackingLuar($sheet);

                $sheet->setShowGridlines(false);
            },
        ];
    }

    protected function setupPage($sheet)
    {
        $sheet->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        $sheet->getPageSetup()
            ->setPaperSize(PageSetup::PAPERSIZE_A4);

        $sheet->getPageSetup()
            ->setFitToWidth(1);

        $sheet->getPageSetup()
            ->setFitToHeight(1);

        $sheet->getPageMargins()
            ->setTop(0.25)
            ->setBottom(0.25)
            ->setLeft(0.25)
            ->setRight(0.25);

        $sheet->getPageSetup()
            ->setHorizontalCentered(true);

        $sheet->getSheetView()
            ->setZoomScale(80);
    }

    protected function buildHeader($sheet)
    {
        $sheet->mergeCells('A1:O1');
        $sheet->setCellValue('A1', 'PT CHAROEN POKPHAND INDONESIA');

        $sheet->mergeCells('A2:O2');
        $sheet->setCellValue('A2', 'FOOD DIVISION');

        $sheet->mergeCells('A3:O3');
        $sheet->setCellValue('A3', 'LAPORAN PENGENDALIAN PRODUK');

        $sheet->mergeCells('A4:O4');
        $sheet->setCellValue(
            'A4',
            'PRODUCTION BATCH : ' . ($this->productionBatch->no_batch ?? '-')
        );

        $sheet->getStyle('A1:O4')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle('A1')
            ->getFont()
            ->setBold(true)
            ->setSize(18);

        $sheet->getStyle('A2')
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle('A3')
            ->getFont()
            ->setBold(true)
            ->setSize(16);

        $sheet->getStyle('A4')
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getRowDimension(1)->setRowHeight(30);
        $sheet->getRowDimension(2)->setRowHeight(25);
        $sheet->getRowDimension(3)->setRowHeight(30);
        $sheet->getRowDimension(4)->setRowHeight(27);
    }

    protected function buildPembekuanPackingDalam($sheet)
    {
        $row = 6;

        $this->sectionTitleRange(
            $sheet,
            $row,
            'A',
            'F',
            'PEMBEKUAN'
        );

        $row++;

        $pembekuan = $this->productionBatch->pembekuans->first();

        if ($pembekuan) {
            $data = [
                'Suhu Ruang Packing' => $this->number($pembekuan->suhu_ruang_packing),
                'Suhu Ruang IQF' => $this->number($pembekuan->suhu_ruang_iqf),
                'Speed Conveyor' => $this->number($pembekuan->speed_conveyor),
                'Suhu Pusat' => $this->number($pembekuan->suhu_pusat),
                'Waktu Mulai' => $this->time($pembekuan->waktu_mulai),
                'Waktu Selesai' => $this->time($pembekuan->waktu_selesai),
                'Lama Waktu Kerusakan' => $this->number($pembekuan->lama_waktu_kerusakan),
                'Lama Waktu Istirahat' => $this->number($pembekuan->lama_waktu_istirahat),
                'Operator' => $pembekuan->operator ?? '-',
                'Line' => $pembekuan->line ?? '-',
                'PIC Produksi' => $pembekuan->pic_produksi ?? '-',
            ];

            $row = $this->writeVertical(
                $sheet,
                $row,
                $data,
                'A',
                'F'
            );
        } else {
            $sheet->mergeCells("A{$row}:F{$row}");
            $sheet->setCellValue("A{$row}", 'Tidak ada data pembekuan');

            $sheet->getStyle("A{$row}:F{$row}")
                ->getFont()
                ->setBold(true)
                ->setSize(14);

            $sheet->getStyle("A{$row}:F{$row}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("A{$row}:F{$row}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            $sheet->getRowDimension($row)->setRowHeight(28);

            $row += 2;
        }

        $row += 1;

        $this->sectionTitleRange(
            $sheet,
            $row,
            'A',
            'F',
            'PACKING DALAM'
        );

        $row++;

        $packingDalam = $this->productionBatch->packingDalams->first();

        if (!$packingDalam) {
            $sheet->mergeCells("A{$row}:F{$row}");
            $sheet->setCellValue("A{$row}", 'Tidak ada data packing dalam');

            $sheet->getStyle("A{$row}:F{$row}")
                ->getFont()
                ->setBold(true)
                ->setSize(14);

            $sheet->getStyle("A{$row}:F{$row}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("A{$row}:F{$row}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            $sheet->getRowDimension($row)->setRowHeight(28);

            $row += 2;
        } else {
            $data = [
                'MHW / Korin' => $packingDalam->mhw_korin ?? '-',
                'Heating Level' => $this->number($packingDalam->heating_level),
                'Speed' => $this->number($packingDalam->speed),
                'Pressure' => $this->number($packingDalam->pressure),
                'Packing Manual' => $packingDalam->packing_manual ?? '-',
                'Timbangan' => $packingDalam->timbangan ?? '-',
                'Heating Level Packing Manual' => $this->number($packingDalam->heating_level_packing_manual),
                'Metal Detector' => $packingDalam->metal_detector ?? '-',
                'Fe / Sus / Non Fe' => $packingDalam->fe_sus_non_fe ?? '-',
                'Checkweigher PAC' => $packingDalam->checkweigher_pac ?? '-',
                'Petugas Sortasi After IQF' => $packingDalam->petugas_sortasi_after_iqf ?? '-',
                'Operator MD' => $packingDalam->operator_md ?? '-',
                'Leader Produksi' => $packingDalam->leader_produksi ?? '-',
                'Waktu Awal' => $this->time($packingDalam->waktu_awal),
                'Waktu Akhir' => $this->time($packingDalam->waktu_akhir),
                'Line' => $packingDalam->line ?? '-',
                'PIC Produksi' => $packingDalam->pic_produksi ?? '-',
            ];

            $row = $this->writeVertical(
                $sheet,
                $row,
                $data,
                'A',
                'F'
            );

            $row += 2;

            $row = $this->writePackingDalamSampling(
                $sheet,
                $row,
                $packingDalam
            );

            $row += 2;

            $row = $this->writePackingDalamPlastik(
                $sheet,
                $row,
                $packingDalam
            );

            $row += 2;
        }

        $this->approvalBlockPembekuanPackingDalam(
            $sheet,
            $row,
            'A',
            'F'
        );
    }

    protected function buildPackingLuar($sheet)
    {
        $row = 6;

        $this->sectionTitleRange(
            $sheet,
            $row,
            'I',
            'O',
            'PACKING LUAR'
        );

        $row++;

        $packingLuar = $this->productionBatch->packingLuars->first();

        if (!$packingLuar) {
            $sheet->mergeCells("I{$row}:O{$row}");
            $sheet->setCellValue("I{$row}", 'Tidak ada data packing luar');

            $sheet->getStyle("I{$row}:O{$row}")
                ->getFont()
                ->setBold(true)
                ->setSize(14);

            $sheet->getStyle("I{$row}:O{$row}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("I{$row}:O{$row}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            $sheet->getRowDimension($row)->setRowHeight(28);

            return;
        }

        $data = [
            'Pengisian Ke Dalam Box' => $packingLuar->pengisian_ke_dalam_box ?? '-',
            'Sealer Box' => $packingLuar->sealer_box ?? '-',
            'Check Weigher Box' => $packingLuar->check_weigher_box ?? '-',
            'Petugas' => $packingLuar->petugas ?? '-',
            'PIC Produksi' => $packingLuar->pic_produksi ?? '-',
            'Waktu Awal' => $this->time($packingLuar->waktu_awal),
            'Waktu Akhir' => $this->time($packingLuar->waktu_akhir),
        ];

        $row = $this->writeVertical(
            $sheet,
            $row,
            $data,
            'I',
            'O'
        );

        $row += 2;

        $row = $this->writePackingLuarSampling(
            $sheet,
            $row,
            $packingLuar
        );

        $row += 2;

        $row = $this->writePackingLuarKemasan(
            $sheet,
            $row,
            $packingLuar
        );

        $row += 2;

        $row = $this->writePackingLuarPalet(
            $sheet,
            $row,
            $packingLuar
        );

        $row += 2;

        $this->approvalBlockPackingLuar(
            $sheet,
            $row,
            'I',
            'O'
        );
    }

    protected function writeVertical(
        $sheet,
        int $row,
        array $data,
        string $start,
        string $end
    ): int {
        $labelEnd = chr(ord($start) + 2);
        $valueStart = chr(ord($start) + 3);

        foreach ($data as $label => $value) {
            $sheet->mergeCells(
                "{$start}{$row}:{$labelEnd}{$row}"
            );

            $sheet->setCellValue(
                "{$start}{$row}",
                $label
            );

            $sheet->mergeCells(
                "{$valueStart}{$row}:{$end}{$row}"
            );

            $sheet->setCellValue(
                "{$valueStart}{$row}",
                $value
            );

            $sheet->getStyle(
                "{$start}{$row}:{$end}{$row}"
            )
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            $sheet->getStyle(
                "{$start}{$row}:{$labelEnd}{$row}"
            )
                ->getFont()
                ->setBold(true)
                ->setSize(14);

            $sheet->getStyle(
                "{$valueStart}{$row}:{$end}{$row}"
            )
                ->getFont()
                ->setBold(true)
                ->setSize(14);

            $sheet->getStyle(
                "{$start}{$row}:{$end}{$row}"
            )
                ->getAlignment()
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle(
                "{$valueStart}{$row}:{$end}{$row}"
            )
                ->getAlignment()
                ->setWrapText(true);

            $sheet->getRowDimension($row)
                ->setRowHeight(28);

            $row++;
        }

        return $row;
    }

    protected function writePackingDalamSampling(
        $sheet,
        int $row,
        $packingDalam
    ): int {
        $this->sectionTitleRange(
            $sheet,
            $row,
            'A',
            'F',
            'SAMPLING PACKING DALAM'
        );

        $row++;

        $headers = [
            'No',
            'Sampling Ke',
            'Berat Kemasan',
            'Berat / Bag',
            'Range Berat',
            'Keterangan',
        ];

        foreach ($headers as $index => $header) {
            $column = chr(65 + $index);

            $sheet->setCellValue(
                "{$column}{$row}",
                $header
            );
        }

        $headerRow = $row;

        foreach ($packingDalam->samplings as $index => $sampling) {
            $row++;

            $sheet->setCellValue("A{$row}", $index + 1);
            $sheet->setCellValue("B{$row}", $sampling->sampling_ke);
            $sheet->setCellValue("C{$row}", (float) ($sampling->berat_kemasan ?? 0));
            $sheet->setCellValue("D{$row}", (float) ($sampling->berat_per_bag ?? 0));
            $sheet->setCellValue("E{$row}", $sampling->range_berat ?? '-');
            $sheet->setCellValue("F{$row}", '-');
        }

        $endRow = max($row, $headerRow);

        $sheet->getStyle(
            "A{$headerRow}:F{$endRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle(
            "A{$headerRow}:F{$endRow}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "A{$headerRow}:F{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(30);
        }

        return $row + 1;
    }

    protected function writePackingDalamPlastik($sheet, int $row, $packingDalam): int
    {
        $this->sectionTitleRange($sheet, $row, 'A', 'F', 'PENGGUNAAN PLASTIK');
        $row++;

        $headerRow = $row;

        $sheet->mergeCells("A{$row}:B{$row}");
        $sheet->setCellValue("A{$row}", 'Product');

        $sheet->setCellValue("C{$row}", 'Jumlah');
        $sheet->setCellValue("D{$row}", 'Pemakaian');
        $sheet->setCellValue("E{$row}", 'Sisa');
        $sheet->setCellValue("F{$row}", 'Rijek');

        foreach ($packingDalam->plastiks as $plastik) {
            $row++;

            $sheet->mergeCells("A{$row}:B{$row}");

            $sheet->setCellValue(
                "A{$row}",
                $plastik->product->nama ?? '-'
            );

            $sheet->setCellValue(
                "C{$row}",
                (float) ($plastik->jumlah ?? 0)
            );

            $sheet->setCellValue(
                "D{$row}",
                (float) ($plastik->pemakaian ?? 0)
            );

            $sheet->setCellValue(
                "E{$row}",
                (float) ($plastik->sisa ?? 0)
            );

            $sheet->setCellValue(
                "F{$row}",
                (float) ($plastik->rijek ?? 0)
            );
        }

        $endRow = max($row, $headerRow);

        $sheet->getStyle("A{$headerRow}:F{$endRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle("A{$headerRow}:F{$endRow}")
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle("A{$headerRow}:F{$endRow}")
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $sheet->getStyle("A{$headerRow}:B{$endRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $sheet->getStyle("C{$headerRow}:F{$endRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight($i === $headerRow ? 35 : 42);
        }

        return $row + 1;
    }

    protected function writePackingLuarSampling(
        $sheet,
        int $row,
        $packingLuar
    ): int {
        $this->sectionTitleRange(
            $sheet,
            $row,
            'I',
            'L',
            'SAMPLING PACKING LUAR'
        );

        $row++;

        $headers = [
            'No',
            'Sampling Ke',
            'Berat / Box',
            'Range Berat',
        ];

        $columns = ['I', 'J', 'K', 'L'];

        foreach ($headers as $index => $header) {
            $sheet->setCellValue(
                $columns[$index] . $row,
                $header
            );
        }

        $headerRow = $row;

        foreach ($packingLuar->samplings as $index => $sampling) {
            $row++;

            $sheet->setCellValue("I{$row}", $index + 1);
            $sheet->setCellValue("J{$row}", $sampling->sampling_ke);
            $sheet->setCellValue("K{$row}", (float) ($sampling->berat_per_box ?? 0));
            $sheet->setCellValue("L{$row}", $sampling->range_berat ?? '-');
        }

        $endRow = max($row, $headerRow);

        $sheet->getStyle(
            "I{$headerRow}:L{$endRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle(
            "I{$headerRow}:L{$endRow}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "I{$headerRow}:L{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(30);
        }

        return $row + 1;
    }

    protected function writePackingLuarKemasan(
        $sheet,
        int $row,
        $packingLuar
    ): int {
        $this->sectionTitleRange(
            $sheet,
            $row,
            'I',
            'O',
            'PENGEMASAN BOX'
        );

        $row++;

        $headerRow = $row;

        $sheet->mergeCells("I{$row}:J{$row}");
        $sheet->setCellValue("I{$row}", 'Product');

        $sheet->setCellValue("K{$row}", 'Jumlah');
        $sheet->setCellValue("L{$row}", 'Pemakaian');
        $sheet->setCellValue("M{$row}", 'Sisa');
        $sheet->setCellValue("N{$row}", 'Rijek');
        $sheet->setCellValue("O{$row}", 'Petugas');

        foreach ($packingLuar->kemasans as $kemasan) {
            $row++;

            $sheet->mergeCells("I{$row}:J{$row}");

            $sheet->setCellValue(
                "I{$row}",
                $kemasan->product->nama ?? '-'
            );

            $sheet->setCellValue(
                "K{$row}",
                (float) ($kemasan->jumlah ?? 0)
            );

            $sheet->setCellValue(
                "L{$row}",
                (float) ($kemasan->pemakaian ?? 0)
            );

            $sheet->setCellValue(
                "M{$row}",
                (float) ($kemasan->sisa ?? 0)
            );

            $sheet->setCellValue(
                "N{$row}",
                (float) ($kemasan->rijek ?? 0)
            );

            $sheet->setCellValue(
                "O{$row}",
                $kemasan->petugas ?? '-'
            );
        }

        $endRow = max($row, $headerRow);

        $sheet->getStyle(
            "I{$headerRow}:O{$endRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle(
            "I{$headerRow}:O{$endRow}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "I{$headerRow}:O{$endRow}"
        )
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $sheet->getStyle(
            "I{$headerRow}:J{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $sheet->getStyle(
            "K{$headerRow}:O{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight($i === $headerRow ? 35 : 42);
        }

        return $row + 1;
    }

    protected function writePackingLuarPalet(
        $sheet,
        int $row,
        $packingLuar
    ): int {
        $this->sectionTitleRange(
            $sheet,
            $row,
            'I',
            'O',
            'PALET'
        );

        $row++;

        $headerRow = $row;

        $sheet->setCellValue("I{$row}", 'No Palet');

        $sheet->mergeCells("J{$row}:K{$row}");
        $sheet->setCellValue("J{$row}", 'Product');

        $sheet->setCellValue("L{$row}", 'Pack');
        $sheet->setCellValue("M{$row}", 'Box');
        $sheet->setCellValue("N{$row}", 'Kg');
        $sheet->setCellValue("O{$row}", 'BSTB');

        foreach ($packingLuar->palets as $palet) {
            $row++;

            $sheet->setCellValue(
                "I{$row}",
                $palet->no_palet ?? '-'
            );

            $sheet->mergeCells("J{$row}:K{$row}");

            $sheet->setCellValue(
                "J{$row}",
                $palet->product->nama ?? '-'
            );

            $sheet->setCellValue(
                "L{$row}",
                $palet->jumlah_pack ?? 0
            );

            $sheet->setCellValue(
                "M{$row}",
                (float) ($palet->jumlah_box ?? 0)
            );

            $sheet->setCellValue(
                "N{$row}",
                (float) ($palet->jumlah_kg ?? 0)
            );

            $sheet->setCellValue(
                "O{$row}",
                $palet->no_bstb ?? '-'
            );
        }

        $endRow = max($row, $headerRow);

        $sheet->getStyle(
            "I{$headerRow}:O{$endRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle(
            "I{$headerRow}:O{$endRow}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "I{$headerRow}:O{$endRow}"
        )
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $sheet->getStyle(
            "J{$headerRow}:K{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $sheet->getStyle(
            "I{$headerRow}:I{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle(
            "L{$headerRow}:O{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight($i === $headerRow ? 35 : 42);
        }

        return $row + 1;
    }

    protected function approvalBlockPembekuanPackingDalam(
        $sheet,
        int $row,
        string $start,
        string $end
    ) {
        $middle = chr(
            (ord($start) + ord($end)) / 2
        );

        $leftStart = $start;
        $leftEnd = chr(ord($middle) - 1);

        $rightStart = $middle;
        $rightEnd = $end;

        $sheet->mergeCells(
            "{$leftStart}{$row}:{$leftEnd}{$row}"
        );

        $sheet->setCellValue(
            "{$leftStart}{$row}",
            'Dibuat Oleh'
        );

        $sheet->mergeCells(
            "{$rightStart}{$row}:{$rightEnd}{$row}"
        );

        $sheet->setCellValue(
            "{$rightStart}{$row}",
            'Diperiksa Oleh'
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)->setRowHeight(28);

        $row++;

        $endTtdRow = $row + 3;

        $sheet->mergeCells(
            "{$leftStart}{$row}:{$leftEnd}{$endTtdRow}"
        );

        $sheet->mergeCells(
            "{$rightStart}{$row}:{$rightEnd}{$endTtdRow}"
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$endTtdRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        for ($i = $row; $i <= $endTtdRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }

        $row = $endTtdRow + 1;

        $sheet->mergeCells(
            "{$leftStart}{$row}:{$leftEnd}{$row}"
        );

        $sheet->setCellValue(
            "{$leftStart}{$row}",
            '(................................)'
        );

        $sheet->mergeCells(
            "{$rightStart}{$row}:{$rightEnd}{$row}"
        );

        $sheet->setCellValue(
            "{$rightStart}{$row}",
            '(................................)'
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(12);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getRowDimension($row)->setRowHeight(28);
    }

    protected function approvalBlockPackingLuar(
        $sheet,
        int $row,
        string $start,
        string $end
    ) {
        $sheet->mergeCells(
            "{$start}{$row}:{$end}{$row}"
        );

        $sheet->setCellValue(
            "{$start}{$row}",
            'STEMPEL BOX'
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)->setRowHeight(28);

        $row++;

        $endRow = $row + 5;

        $sheet->mergeCells(
            "{$start}{$row}:{$end}{$endRow}"
        );

        $sheet->setCellValue(
            "{$start}{$row}",
            'TEMPAT STEMPEL BOX'
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$endRow}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$endRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        for ($i = $row; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }
    }

    protected function sectionTitleRange(
        $sheet,
        int $row,
        string $start,
        string $end,
        string $title
    ) {
        $sheet->mergeCells(
            "{$start}{$row}:{$end}{$row}"
        );

        $sheet->setCellValue(
            "{$start}{$row}",
            $title
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)
            ->setRowHeight(30);
    }

    protected function number($value): string
    {
        if ($value === null || $value === '') {
            return '-';
        }

        return number_format(
            (float) $value,
            2,
            ',',
            '.'
        );
    }

    protected function time($value): string
    {
        if (!$value) {
            return '-';
        }

        return substr(
            (string) $value,
            0,
            5
        );
    }
}