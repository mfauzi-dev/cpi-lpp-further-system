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
use PhpOffice\PhpSpreadsheet\Style\Fill;
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
            'A' => 15,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 5,
            'H' => 5,
            'I' => 15,
            'J' => 15,
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

                $leftRow = 6;
                $rightRow = 6;

                $leftRow = $this->buildPembekuan($sheet, $leftRow);
                $leftRow = $this->buildPackingDalam($sheet, $leftRow);
                $leftRow = $this->buildMetalDetector($sheet, $leftRow);

                $rightRow = $this->buildPackingLuar($sheet, $rightRow);

                $approvalRow = max($leftRow, $rightRow) + 1;

                $this->buildApproval($sheet, $approvalRow);

                $sheet->setShowGridlines(false);
            },
        ];
    }

    protected function setupPage($sheet): void
    {
        $pageSetup = $sheet->getPageSetup();

        $pageSetup
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(PageSetup::PAPERSIZE_A4)
            ->setFitToWidth(1)
            ->setFitToHeight(0);

        $sheet->getPageMargins()
            ->setTop(0.15)
            ->setRight(0.15)
            ->setBottom(0.15)
            ->setLeft(0.15);

        $sheet->getSheetView()->setZoomScale(85);
    }

    protected function buildHeader($sheet): void
    {
        $sheet->mergeCells('A1:O1');
        $sheet->setCellValue(
            'A1',
            'PT CHAROEN POKPHAND INDONESIA'
        );

        $sheet->mergeCells('A2:O2');
        $sheet->setCellValue(
            'A2',
            'FOOD DIVISION'
        );

        $sheet->mergeCells('A3:O3');
        $sheet->setCellValue(
            'A3',
            'LAPORAN PENGENDALIAN PRODUK'
        );

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

        $sheet->getRowDimension(1)->setRowHeight(32);
        $sheet->getRowDimension(2)->setRowHeight(28);
        $sheet->getRowDimension(3)->setRowHeight(34);
        $sheet->getRowDimension(4)->setRowHeight(30);
    }

    protected function buildPembekuan($sheet, int $row): int
    {
        $this->sectionTitle(
            $sheet,
            $row,
            'PEMBEKUAN',
            'A',
            'F'
        );

        $row++;

        $pembekuan = $this->productionBatch->pembekuans->first();

        if (!$pembekuan) {
            $this->emptyBlockRow(
                $sheet,
                $row,
                'A',
                'F'
            );

            return $row + 2;
        }

        $data = [
            'Suhu Ruang Packing' => $this->number(
                $pembekuan->suhu_ruang_packing
            ),
            'Suhu Ruang IQF' => $this->number(
                $pembekuan->suhu_ruang_iqf
            ),
            'Speed Conveyor' => $this->number(
                $pembekuan->speed_conveyor
            ),
            'Suhu Pusat' => $this->number(
                $pembekuan->suhu_pusat
            ),
            'Waktu Mulai' => $this->time(
                $pembekuan->waktu_mulai
            ),
            'Waktu Selesai' => $this->time(
                $pembekuan->waktu_selesai
            ),
            'Lama Waktu Kerusakan' => $this->number(
                $pembekuan->lama_waktu_kerusakan
            ),
            'Lama Waktu Istirahat' => $this->number(
                $pembekuan->lama_waktu_istirahat
            ),
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

        return $row + 1;
    }

    protected function buildPackingDalam($sheet, int $row): int
    {
        $this->sectionTitle(
            $sheet,
            $row,
            'PACKING DALAM',
            'A',
            'F'
        );

        $row++;

        $packingDalam = $this->productionBatch->packingDalams->first();

        if (!$packingDalam) {
            $this->emptyBlockRow(
                $sheet,
                $row,
                'A',
                'F'
            );

            return $row + 2;
        }

        $data = [
            'MHW / Korin' => $packingDalam->mhw_korin ?? '-',
            'Heating Level' => $this->number(
                $packingDalam->heating_level
            ),
            'Speed' => $this->number(
                $packingDalam->speed
            ),
            'Pressure' => $this->number(
                $packingDalam->pressure
            ),
            'Packing Manual' => $packingDalam->packing_manual ?? '-',
            'Timbangan' => $packingDalam->timbangan ?? '-',
            'Heating Level Packing Manual' => $this->number(
                $packingDalam->heating_level_packing_manual
            ),
            'Metal Detector' => $packingDalam->metal_detector ?? '-',
            'Fe / Sus / Non Fe' => $packingDalam->fe_sus_non_fe ?? '-',
            'Checkweigher PAC' => $packingDalam->checkweigher_pac ?? '-',
            'Petugas Sortasi After IQF' => $packingDalam->petugas_sortasi_after_iqf ?? '-',
            'Operator MD' => $packingDalam->operator_md ?? '-',
            'Leader Produksi' => $packingDalam->leader_produksi ?? '-',
            'Waktu Awal' => $this->time(
                $packingDalam->waktu_awal
            ),
            'Waktu Akhir' => $this->time(
                $packingDalam->waktu_akhir
            ),
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

        $row += 1;

        $row = $this->writePackingDalamSampling(
            $sheet,
            $row,
            $packingDalam
        );

        $row += 1;

        $row = $this->writePackingDalamPlastik(
            $sheet,
            $row,
            $packingDalam
        );

        return $row + 1;
    }

    protected function buildMetalDetector($sheet, int $row): int
    {
        $this->sectionTitle(
            $sheet,
            $row,
            'METAL DETECTOR',
            'A',
            'F'
        );

        $row++;

        $metalDetectors = $this->productionBatch->metalDetectors;

        if ($metalDetectors->isEmpty()) {
            $this->emptyBlockRow(
                $sheet,
                $row,
                'A',
                'F'
            );

            return $row + 2;
        }

        $headers = [
            'Batch Type',
            'Metal Detector',
            'Waktu Awal',
            'Waktu Akhir',
        ];

        $spans = [
            ['A', 'B'],
            ['C', 'D'],
            ['E', 'E'],
            ['F', 'F'],
        ];

        foreach ($headers as $index => $header) {
            [$start, $end] = $spans[$index];

            if ($start !== $end) {
                $sheet->mergeCells(
                    "{$start}{$row}:{$end}{$row}"
                );
            }

            $sheet->setCellValue(
                "{$start}{$row}",
                $header
            );
        }

        $headerRow = $row;

        $this->styleTable(
            $sheet,
            "A{$headerRow}:F{$headerRow}",
            11
        );

        $sheet->getRowDimension($row)->setRowHeight(30);

        foreach ($metalDetectors as $item) {
            $row++;

            $values = [
                $item->batch_type ?? '-',
                $item->metal_detector ?? '-',
                $this->time($item->waktu_awal),
                $this->time($item->waktu_akhir),
            ];

            foreach ($values as $index => $value) {
                [$start, $end] = $spans[$index];

                if ($start !== $end) {
                    $sheet->mergeCells(
                        "{$start}{$row}:{$end}{$row}"
                    );
                }

                $sheet->setCellValue(
                    "{$start}{$row}",
                    $value
                );
            }

            $this->styleTable(
                $sheet,
                "A{$row}:F{$row}",
                11
            );

            $sheet->getRowDimension($row)->setRowHeight(28);
        }

        return $row + 1;
    }

    protected function buildPackingLuar($sheet, int $row): int
    {
        $this->sectionTitle(
            $sheet,
            $row,
            'PACKING LUAR',
            'I',
            'O'
        );

        $row++;

        $packingLuar = $this->productionBatch->packingLuars->first();

        if (!$packingLuar) {
            $this->emptyBlockRow(
                $sheet,
                $row,
                'I',
                'O'
            );

            return $row + 2;
        }

        $data = [
            'Pengisian Ke Dalam Box' => $packingLuar->pengisian_ke_dalam_box ?? '-',
            'Sealer Box' => $packingLuar->sealer_box ?? '-',
            'Check Weigher Box' => $packingLuar->check_weigher_box ?? '-',
            'Petugas' => $packingLuar->petugas ?? '-',
            'PIC Produksi' => $packingLuar->pic_produksi ?? '-',
            'Waktu Awal' => $this->time(
                $packingLuar->waktu_awal
            ),
            'Waktu Akhir' => $this->time(
                $packingLuar->waktu_akhir
            ),
        ];

        $row = $this->writeVertical(
            $sheet,
            $row,
            $data,
            'I',
            'O'
        );

        $row += 1;

        $row = $this->writePackingLuarSampling(
            $sheet,
            $row,
            $packingLuar
        );

        $row += 1;

        $row = $this->writePackingLuarKemasan(
            $sheet,
            $row,
            $packingLuar
        );

        $row += 1;

        $row = $this->writePackingLuarPalet(
            $sheet,
            $row,
            $packingLuar
        );

        return $row + 1;
    }

    protected function writeVertical(
        $sheet,
        int $row,
        array $data,
        string $start,
        string $end
    ): int {
        $startIndex = ord($start);
        $endIndex = ord($end);

        $totalColumns = $endIndex - $startIndex + 1;
        $labelColumns = (int) floor($totalColumns / 2);
        $valueColumns = $totalColumns - $labelColumns;

        $labelEnd = chr(
            $startIndex + $labelColumns - 1
        );

        $valueStart = chr(
            $startIndex + $labelColumns
        );

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
                ->setBorderStyle(
                    Border::BORDER_THIN
                );

            $sheet->getStyle(
                "{$start}{$row}:{$labelEnd}{$row}"
            )
                ->getFont()
                ->setBold(true)
                ->setSize(11);

            $sheet->getStyle(
                "{$valueStart}{$row}:{$end}{$row}"
            )
                ->getFont()
                ->setBold(true)
                ->setSize(12);

            $sheet->getStyle(
                "{$start}{$row}:{$end}{$row}"
            )
                ->getAlignment()
                ->setVertical(
                    Alignment::VERTICAL_CENTER
                )
                ->setWrapText(true);

            $sheet->getStyle(
                "{$valueStart}{$row}:{$end}{$row}"
            )
                ->getAlignment()
                ->setHorizontal(
                    Alignment::HORIZONTAL_CENTER
                );

            $sheet->getRowDimension($row)
                ->setRowHeight(26);

            $row++;
        }

        return $row;
    }

    protected function writePackingDalamSampling(
        $sheet,
        int $row,
        $packingDalam
    ): int {
        $this->sectionTitle(
            $sheet,
            $row,
            'SAMPLING PACKING DALAM',
            'A',
            'F'
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

            $sheet->setCellValue(
                "A{$row}",
                $index + 1
            );

            $sheet->setCellValue(
                "B{$row}",
                $sampling->sampling_ke
            );

            $sheet->setCellValue(
                "C{$row}",
                $this->number(
                    $sampling->berat_kemasan
                )
            );

            $sheet->setCellValue(
                "D{$row}",
                $this->number(
                    $sampling->berat_per_bag
                )
            );

            $sheet->setCellValue(
                "E{$row}",
                $sampling->range_berat ?? '-'
            );

            $sheet->setCellValue(
                "F{$row}",
                '-'
            );
        }

        $endRow = max($row, $headerRow);

        $this->styleTable(
            $sheet,
            "A{$headerRow}:F{$endRow}",
            11
        );

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(28);
        }

        return $row + 1;
    }

    protected function writePackingDalamPlastik(
        $sheet,
        int $row,
        $packingDalam
    ): int {
        $this->sectionTitle(
            $sheet,
            $row,
            'PENGGUNAAN PLASTIK',
            'A',
            'F'
        );

        $row++;

        $headerRow = $row;

        $sheet->mergeCells("A{$row}:B{$row}");
        $sheet->setCellValue(
            "A{$row}",
            'Product'
        );

        $sheet->setCellValue(
            "C{$row}",
            'Jumlah'
        );

        $sheet->setCellValue(
            "D{$row}",
            'Pemakaian'
        );

        $sheet->setCellValue(
            "E{$row}",
            'Sisa'
        );

        $sheet->setCellValue(
            "F{$row}",
            'Rijek'
        );

        foreach ($packingDalam->plastiks as $plastik) {
            $row++;

            $sheet->mergeCells("A{$row}:B{$row}");

            $sheet->setCellValue(
                "A{$row}",
                $plastik->product->nama ?? '-'
            );

            $sheet->setCellValue(
                "C{$row}",
                $this->number($plastik->jumlah)
            );

            $sheet->setCellValue(
                "D{$row}",
                $this->number($plastik->pemakaian)
            );

            $sheet->setCellValue(
                "E{$row}",
                $this->number($plastik->sisa)
            );

            $sheet->setCellValue(
                "F{$row}",
                $this->number($plastik->rijek)
            );
        }

        $endRow = max($row, $headerRow);

        $this->styleTable(
            $sheet,
            "A{$headerRow}:F{$endRow}",
            11
        );

        $sheet->getStyle(
            "A{$headerRow}:B{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_LEFT
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            )
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(
                    $i === $headerRow ? 30 : 36
                );
        }

        return $row + 1;
    }

    protected function writePackingLuarSampling(
        $sheet,
        int $row,
        $packingLuar
    ): int {
        $this->sectionTitle(
            $sheet,
            $row,
            'SAMPLING PACKING LUAR',
            'I',
            'O'
        );

        $row++;

        $headerRow = $row;

        $sheet->setCellValue(
            "I{$row}",
            'No'
        );

        $sheet->setCellValue(
            "J{$row}",
            'Sampling Ke'
        );

        $sheet->setCellValue(
            "K{$row}",
            'Berat / Box'
        );

        $sheet->mergeCells(
            "L{$row}:O{$row}"
        );

        $sheet->setCellValue(
            "L{$row}",
            'Range Berat'
        );

        foreach ($packingLuar->samplings as $index => $sampling) {
            $row++;

            $sheet->setCellValue(
                "I{$row}",
                $index + 1
            );

            $sheet->setCellValue(
                "J{$row}",
                $sampling->sampling_ke
            );

            $sheet->setCellValue(
                "K{$row}",
                $this->number(
                    $sampling->berat_per_box
                )
            );

            $sheet->mergeCells(
                "L{$row}:O{$row}"
            );

            $sheet->setCellValue(
                "L{$row}",
                $sampling->range_berat ?? '-'
            );
        }

        $endRow = max($row, $headerRow);

        $this->styleTable(
            $sheet,
            "I{$headerRow}:O{$endRow}",
            11
        );

        $sheet->getStyle(
            "L{$headerRow}:O{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            )
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(28);
        }

        return $row + 1;
    }

    protected function writePackingLuarKemasan(
        $sheet,
        int $row,
        $packingLuar
    ): int {
        $this->sectionTitle(
            $sheet,
            $row,
            'PENGEMASAN BOX',
            'I',
            'O'
        );

        $row++;

        $headerRow = $row;

        $sheet->mergeCells("I{$row}:J{$row}");

        $sheet->setCellValue(
            "I{$row}",
            'Product'
        );

        $sheet->setCellValue(
            "K{$row}",
            'Jumlah'
        );

        $sheet->setCellValue(
            "L{$row}",
            'Pemakaian'
        );

        $sheet->setCellValue(
            "M{$row}",
            'Sisa'
        );

        $sheet->setCellValue(
            "N{$row}",
            'Rijek'
        );

        $sheet->setCellValue(
            "O{$row}",
            'Petugas'
        );

        foreach ($packingLuar->kemasans as $kemasan) {
            $row++;

            $sheet->mergeCells(
                "I{$row}:J{$row}"
            );

            $sheet->setCellValue(
                "I{$row}",
                $kemasan->product->nama ?? '-'
            );

            $sheet->setCellValue(
                "K{$row}",
                $this->number($kemasan->jumlah)
            );

            $sheet->setCellValue(
                "L{$row}",
                $this->number($kemasan->pemakaian)
            );

            $sheet->setCellValue(
                "M{$row}",
                $this->number($kemasan->sisa)
            );

            $sheet->setCellValue(
                "N{$row}",
                $this->number($kemasan->rijek)
            );

            $sheet->setCellValue(
                "O{$row}",
                $kemasan->petugas ?? '-'
            );
        }

        $endRow = max($row, $headerRow);

        $this->styleTable(
            $sheet,
            "I{$headerRow}:O{$endRow}",
            11
        );

        $sheet->getStyle(
            "I{$headerRow}:J{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_LEFT
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            )
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(
                    $i === $headerRow ? 30 : 36
                );
        }

        return $row + 1;
    }

    protected function writePackingLuarPalet(
        $sheet,
        int $row,
        $packingLuar
    ): int {
        $this->sectionTitle(
            $sheet,
            $row,
            'PALET',
            'I',
            'O'
        );

        $row++;

        $headerRow = $row;

        $sheet->setCellValue(
            "I{$row}",
            'No Palet'
        );

        $sheet->mergeCells(
            "J{$row}:K{$row}"
        );

        $sheet->setCellValue(
            "J{$row}",
            'Product'
        );

        $sheet->setCellValue(
            "L{$row}",
            'Pack'
        );

        $sheet->setCellValue(
            "M{$row}",
            'Box'
        );

        $sheet->setCellValue(
            "N{$row}",
            'Kg'
        );

        $sheet->setCellValue(
            "O{$row}",
            'BSTB'
        );

        foreach ($packingLuar->palets as $palet) {
            $row++;

            $sheet->setCellValue(
                "I{$row}",
                $palet->no_palet ?? '-'
            );

            $sheet->mergeCells(
                "J{$row}:K{$row}"
            );

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
                $this->number($palet->jumlah_box)
            );

            $sheet->setCellValue(
                "N{$row}",
                $this->number($palet->jumlah_kg)
            );

            $sheet->setCellValue(
                "O{$row}",
                $palet->no_bstb ?? '-'
            );
        }

        $endRow = max($row, $headerRow);

        $this->styleTable(
            $sheet,
            "I{$headerRow}:O{$endRow}",
            11
        );

        $sheet->getStyle(
            "J{$headerRow}:K{$endRow}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_LEFT
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            )
            ->setWrapText(true);

        for ($i = $headerRow; $i <= $endRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(
                    $i === $headerRow ? 30 : 36
                );
        }

        return $row + 1;
    }

    protected function buildApproval(
        $sheet,
        int $row
    ): void {
        $this->approvalBox(
            $sheet,
            $row,
            'A',
            'F',
            'Dibuat Oleh'
        );

        $this->approvalBox(
            $sheet,
            $row,
            'I',
            'O',
            'Diperiksa Oleh'
        );

        $row += 7;

        $this->approvalBox(
            $sheet,
            $row,
            'A',
            'F',
            'STEMPEL BOX'
        );

        $sheet->mergeCells(
            "A" . ($row + 1) . ":F" . ($row + 6)
        );

        $sheet->setCellValue(
            "A" . ($row + 1),
            'TEMPAT STEMPEL BOX'
        );

        $sheet->getStyle(
            "A" . ($row + 1) . ":F" . ($row + 6)
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );

        $sheet->getStyle(
            "A" . ($row + 1) . ":F" . ($row + 6)
        )
            ->getFont()
            ->setBold(true)
            ->setSize(13);

        $sheet->getStyle(
            "A" . ($row + 1) . ":F" . ($row + 6)
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            );

        for ($i = $row + 1; $i <= $row + 6; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(24);
        }
    }

    protected function approvalBox(
        $sheet,
        int $row,
        string $start,
        string $end,
        string $title
    ): void {
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
            ->setSize(13);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );

        $sheet->getRowDimension($row)
            ->setRowHeight(28);

        $row++;

        $endTtdRow = $row + 3;

        $sheet->mergeCells(
            "{$start}{$row}:{$end}{$endTtdRow}"
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$endTtdRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );

        for ($i = $row; $i <= $endTtdRow; $i++) {
            $sheet->getRowDimension($i)
                ->setRowHeight(24);
        }

        $row = $endTtdRow + 1;

        $sheet->mergeCells(
            "{$start}{$row}:{$end}{$row}"
        );

        $sheet->setCellValue(
            "{$start}{$row}",
            '(................................)'
        );

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(11);

        $sheet->getStyle(
            "{$start}{$row}:{$end}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            );

        $sheet->getRowDimension($row)
            ->setRowHeight(26);
    }

    protected function sectionTitle(
        $sheet,
        int $row,
        string $title,
        string $startCol,
        string $endCol
    ): void {
        $sheet->mergeCells(
            "{$startCol}{$row}:{$endCol}{$row}"
        );

        $sheet->setCellValue(
            "{$startCol}{$row}",
            $title
        );

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(15);

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            );

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getFill()
            ->setFillType(
                Fill::FILL_SOLID
            )
            ->getStartColor()
            ->setRGB('E5E5E5');

        $sheet->getRowDimension($row)
            ->setRowHeight(30);
    }

    protected function styleTable(
        $sheet,
        string $range,
        int $size = 11
    ): void {
        $sheet->getStyle($range)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );

        $sheet->getStyle($range)
            ->getFont()
            ->setBold(true)
            ->setSize($size);

        $sheet->getStyle($range)
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            )
            ->setWrapText(true);

        $sheet->getStyle($range)
            ->getFill()
            ->setFillType(
                Fill::FILL_SOLID
            )
            ->getStartColor()
            ->setRGB('F8F8F8');
    }

    protected function emptyBlockRow(
        $sheet,
        int $row,
        string $startCol,
        string $endCol
    ): void {
        $sheet->mergeCells(
            "{$startCol}{$row}:{$endCol}{$row}"
        );

        $sheet->setCellValue(
            "{$startCol}{$row}",
            'Tidak ada data'
        );

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getFont()
            ->setItalic(true)
            ->setBold(true)
            ->setSize(13);

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            )
            ->setVertical(
                Alignment::VERTICAL_CENTER
            );

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );

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