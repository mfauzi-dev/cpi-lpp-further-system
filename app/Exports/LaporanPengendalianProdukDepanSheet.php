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

class LaporanPengendalianProdukDepanSheet implements
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
        return 'Lembar Depan';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, 'B' => 15, 'C' => 15, 'D' => 15, 'E' => 15, 'F' => 15, 'G' => 15,
            'H' => 15, 'I' => 15, 'J' => 15, 'K' => 15, 'L' => 15, 'M' => 15, 'N' => 15,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $this->setupPage($sheet);
                $this->buildHeader($sheet);

                $row = 6;

                $row = $this->buildProduction($sheet, $row);
                $row = $this->buildBahanBaku($sheet, $row);

                $sections = [
                    ['title' => 'SUHU RUANG', 'data' => $this->suhuRuangs()],
                    ['title' => 'BOWL CUTTER', 'data' => $this->bowlCutters()],
                    ['title' => 'GRINDER', 'data' => $this->grinders()],
                    ['title' => 'MIXING', 'data' => $this->mixings()],
                    ['title' => 'PREPARASI FLA', 'data' => $this->preparasiFlas()],
                    ['title' => 'TUMBLER', 'data' => $this->tumblers()],
                    ['title' => 'FORMING', 'data' => $this->formings()],
                    ['title' => 'BATTER', 'data' => $this->batters()],
                    ['title' => 'PREDUST BREADER', 'data' => $this->predustBreaders()],
                    ['title' => 'FRYER', 'data' => $this->fryers()],
                    ['title' => 'HLT', 'data' => $this->hlts()],
                    ['title' => 'METAL DETECTOR', 'data' => $this->metalDetectors()],
                ];

                foreach ($sections as $section) {
                    $row = $this->buildProcessTable(
                        $sheet,
                        $row,
                        $section['title'],
                        $section['data']['columns'],
                        $section['data']['rows']
                    );
                }

                $row = $this->buildKemasanRijekBlock($sheet, $row);

                $this->buildApproval($sheet, $row);

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
        $sheet->mergeCells('A1:N1');
        $sheet->setCellValue('A1', 'PT CHAROEN POKPHAND INDONESIA');

        $sheet->mergeCells('A2:N2');
        $sheet->setCellValue('A2', 'FOOD DIVISION');

        $sheet->mergeCells('A3:N3');
        $sheet->setCellValue('A3', 'LAPORAN PENGENDALIAN PRODUK');

        $sheet->mergeCells('A4:N4');
        $sheet->setCellValue(
            'A4',
            'PRODUCTION BATCH : ' . ($this->productionBatch->no_batch ?? '-')
        );

        $sheet->getStyle('A1:N4')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A4')->getFont()->setBold(true)->setSize(14);

        $sheet->getRowDimension(1)->setRowHeight(32);
        $sheet->getRowDimension(2)->setRowHeight(28);
        $sheet->getRowDimension(3)->setRowHeight(34);
        $sheet->getRowDimension(4)->setRowHeight(30);
    }

    protected function buildProduction($sheet, int $row): int
    {
        $fields = [
            [
                'label' => 'Tanggal Produksi',
                'value' => $this->productionBatch->tanggal_produksi
                    ? $this->productionBatch->tanggal_produksi->format('d/m/Y')
                    : '-',
                'span' => ['A', 'B']
            ],
            [
                'label' => 'No. Batch',
                'value' => $this->productionBatch->no_batch ?? '-',
                'span' => ['C', 'D']
            ],
            [
                'label' => 'Product',
                'value' => $this->productionBatch->product->nama ?? '-',
                'span' => ['E', 'G']
            ],
            [
                'label' => 'Line',
                'value' => $this->productionBatch->line ?? '-',
                'span' => ['H', 'H']
            ],
            [
                'label' => 'Waktu Kerja',
                'value' => $this->productionBatch->waktu_kerja ?? '-',
                'span' => ['I', 'J']
            ],
            [
                'label' => 'Yield',
                'value' => $this->number($this->productionBatch->yield),
                'span' => ['K', 'K']
            ],
            [
                'label' => '% Rijek',
                'value' => $this->number($this->productionBatch->persen_rijek),
                'span' => ['L', 'L']
            ],
            [
                'label' => 'Produktifitas',
                'value' => $this->number($this->productionBatch->produktifitas),
                'span' => ['M', 'N']
            ],
        ];

        $labelRow = $row;
        $valueRow = $row + 1;

        foreach ($fields as $field) {
            [$c1, $c2] = $field['span'];

            if ($c1 !== $c2) {
                $sheet->mergeCells("{$c1}{$labelRow}:{$c2}{$labelRow}");
                $sheet->mergeCells("{$c1}{$valueRow}:{$c2}{$valueRow}");
            }

            $sheet->setCellValue("{$c1}{$labelRow}", $field['label']);
            $sheet->setCellValue("{$c1}{$valueRow}", $field['value']);
        }

        $sheet->getStyle("A{$labelRow}:N{$labelRow}")
            ->getFont()
            ->setBold(true)
            ->setSize(11)
            ->getColor()
            ->setRGB('FFFFFF');

        $sheet->getStyle("A{$labelRow}:N{$labelRow}")
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('404040');

        $sheet->getStyle("A{$valueRow}:N{$valueRow}")
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle("A{$labelRow}:N{$valueRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle("A{$labelRow}:N{$valueRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        $sheet->getRowDimension($labelRow)->setRowHeight(20);
        $sheet->getRowDimension($valueRow)->setRowHeight(30);

        return $valueRow + 2;
    }

    protected function buildBahanBaku($sheet, int $row): int
    {
        $this->sectionTitle($sheet, $row, 'BAHAN - BAHAN BAKU', 'A', 'N');
        $row++;

        $spans = [
            ['A', 'C'],
            ['D', 'F'],
            ['G', 'H'],
            ['I', 'N']
        ];

        $headers = [
            'PRODUCT',
            'KODE BATCH',
            'SUHU',
            'BERAT'
        ];

        foreach ($headers as $i => $label) {
            [$c1, $c2] = $spans[$i];

            $sheet->mergeCells("{$c1}{$row}:{$c2}{$row}");
            $sheet->setCellValue("{$c1}{$row}", $label);
        }

        $this->styleRow($sheet, $row, 12, true);
        $sheet->getRowDimension($row)->setRowHeight(28);
        $row++;

        $productions = $this->productionBatch->productions;

        if ($productions->isEmpty()) {
            $this->emptyBlockRow($sheet, $row, 'A', 'N');
            $row++;

            return $row + 1;
        }

        foreach ($productions as $production) {
            $details = $production->details;

            if ($details->isEmpty()) {
                $sheet->mergeCells("A{$row}:N{$row}");
                $sheet->setCellValue("A{$row}", 'Tidak ada detail');

                $this->styleRow($sheet, $row, 12, true);
                $sheet->getRowDimension($row)->setRowHeight(26);
                $row++;
            } else {
                foreach ($details as $detail) {
                    $values = [
                        $detail->product->nama ?? '-',
                        $detail->kode_batch ?? '-',
                        $this->number($detail->suhu),
                        $this->number($detail->berat_kg) . ' Kg',
                    ];

                    foreach ($values as $i => $value) {
                        [$c1, $c2] = $spans[$i];

                        $sheet->mergeCells("{$c1}{$row}:{$c2}{$row}");
                        $sheet->setCellValue("{$c1}{$row}", $value);
                    }

                    $this->styleRow($sheet, $row, 12, false);
                    $sheet->getRowDimension($row)->setRowHeight(24);
                    $row++;
                }
            }

            $sumTotal = $production->sum_total;

            if ($sumTotal === null || $sumTotal === '') {
                $sumTotal = $details->sum(
                    fn ($d) => (float) ($d->berat_kg ?? 0)
                );
            }

            $sheet->mergeCells("A{$row}:H{$row}");
            $sheet->setCellValue("A{$row}", 'SUM TOTAL');

            $sheet->mergeCells("I{$row}:N{$row}");
            $sheet->setCellValue(
                "I{$row}",
                $this->number($sumTotal) . ' Kg'
            );

            $sheet->getStyle("A{$row}:N{$row}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            $sheet->getStyle("A{$row}:N{$row}")
                ->getFont()
                ->setBold(true)
                ->setSize(13);

            $sheet->getStyle("A{$row}:H{$row}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_RIGHT)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("I{$row}:N{$row}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getRowDimension($row)->setRowHeight(28);
            $row++;
        }

        $sheet->mergeCells("A{$row}:H{$row}");
        $sheet->setCellValue("A{$row}", 'GRAND TOTAL');

        $sheet->mergeCells("I{$row}:N{$row}");
        $sheet->setCellValue(
            "I{$row}",
            $this->number($this->grandTotalProduction()) . ' Kg'
        );

        $sheet->getStyle("A{$row}:N{$row}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle("A{$row}:N{$row}")
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle("A{$row}:H{$row}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle("I{$row}:N{$row}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getRowDimension($row)->setRowHeight(30);
        $row++;

        return $row + 1;
    }

    protected function buildProcessTable(
        $sheet,
        int $row,
        string $title,
        array $columns,
        array $rows
    ): int {
        $this->sectionTitle($sheet, $row, $title, 'A', 'N');
        $row++;

        $spans = $this->distributeColumns(count($columns));

        foreach ($columns as $i => $label) {
            [$c1, $c2] = $spans[$i];

            if ($c1 !== $c2) {
                $sheet->mergeCells("{$c1}{$row}:{$c2}{$row}");
            }

            $sheet->setCellValue("{$c1}{$row}", $label);
        }

        $this->styleRow($sheet, $row, 11, true);
        $sheet->getRowDimension($row)->setRowHeight(28);
        $row++;

        if (empty($rows)) {
            $this->emptyBlockRow($sheet, $row, 'A', 'N');
            $row++;

            return $row + 1;
        }

        foreach ($rows as $record) {
            foreach ($record as $i => $value) {
                [$c1, $c2] = $spans[$i];

                if ($c1 !== $c2) {
                    $sheet->mergeCells("{$c1}{$row}:{$c2}{$row}");
                }

                $sheet->setCellValue("{$c1}{$row}", $value);
            }

            $this->styleRow($sheet, $row, 11, false);
            $sheet->getRowDimension($row)->setRowHeight(26);
            $row++;
        }

        return $row + 1;
    }

    protected function distributeColumns(int $n): array
    {
        $letters = range('A', 'N');
        $n = max(1, min($n, 14));

        $base = intdiv(14, $n);
        $extra = 14 % $n;
        $cursor = 0;
        $spans = [];

        for ($i = 0; $i < $n; $i++) {
            $width = $base + ($i < $extra ? 1 : 0);

            $start = $letters[$cursor];
            $end = $letters[$cursor + $width - 1];

            $spans[] = [$start, $end];

            $cursor += $width;
        }

        return $spans;
    }

    protected function styleRow($sheet, int $row, int $size, bool $header): void
    {
        $range = "A{$row}:N{$row}";

        $sheet->getStyle($range)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle($range)
            ->getFont()
            ->setBold(true)
            ->setSize($size);

        $sheet->getStyle($range)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);

        if ($header) {
            $sheet->getStyle($range)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('E5E5E5');
        }
    }

    protected function emptyBlockRow(
        $sheet,
        int $row,
        string $startCol,
        string $endCol
    ): void {
        $sheet->mergeCells("{$startCol}{$row}:{$endCol}{$row}");
        $sheet->setCellValue("{$startCol}{$row}", 'Tidak ada data');

        $sheet->getStyle("{$startCol}{$row}:{$endCol}{$row}")
            ->getFont()
            ->setItalic(true)
            ->setBold(true)
            ->setSize(13);

        $sheet->getStyle("{$startCol}{$row}:{$endCol}{$row}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle("{$startCol}{$row}:{$endCol}{$row}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)->setRowHeight(30);
    }

    protected function buildKemasanRijekBlock($sheet, int $row): int
    {
        $this->sectionTitle($sheet, $row, 'KEMASAN RIJEK', 'A', 'N');
        $row++;

        $rijek = $this->productionBatch->kemasanRijeks->first();

        $sheet->mergeCells("A{$row}:G{$row}");
        $sheet->setCellValue("A{$row}", 'KATEGORI');

        $sheet->mergeCells("H{$row}:N{$row}");
        $sheet->setCellValue("H{$row}", 'COOKING / PACKING (Kg)');

        $this->styleRow($sheet, $row, 12, true);
        $sheet->getRowDimension($row)->setRowHeight(28);
        $row++;

        if (!$rijek) {
            $this->emptyBlockRow($sheet, $row, 'A', 'N');
            $row++;

            return $row + 1;
        }

        foreach ($this->kemasanRijekCategories() as $category) {
            $value = $this->number($rijek->{$category['cooking']} ?? 0)
                . ' / '
                . $this->number($rijek->{$category['packing']} ?? 0)
                . ' Kg';

            if (
                isset($category['note_cooking'], $category['note_packing'])
            ) {
                $noteCooking = $rijek->{$category['note_cooking']} ?? null;
                $notePacking = $rijek->{$category['note_packing']} ?? null;

                if ($noteCooking || $notePacking) {
                    $value .= ' ('
                        . ($noteCooking ?: '-')
                        . ' / '
                        . ($notePacking ?: '-')
                        . ')';
                }
            }

            $sheet->mergeCells("A{$row}:G{$row}");
            $sheet->setCellValue("A{$row}", $category['label']);

            $sheet->mergeCells("H{$row}:N{$row}");
            $sheet->setCellValue("H{$row}", $value);

            $sheet->getStyle("A{$row}:N{$row}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            $sheet->getStyle("A{$row}:N{$row}")
                ->getFont()
                ->setBold(true)
                ->setSize(12);

            $sheet->getStyle("A{$row}:G{$row}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("H{$row}:N{$row}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getRowDimension($row)->setRowHeight(24);
            $row++;
        }

        return $row + 1;
    }

    protected function buildApproval($sheet, int $row): void
    {
        $leftStart = 'A';
        $leftEnd = 'F';
        $rightStart = 'I';
        $rightEnd = 'N';

        $sheet->mergeCells("{$leftStart}{$row}:{$leftEnd}{$row}");
        $sheet->setCellValue("{$leftStart}{$row}", 'Dibuat Oleh');

        $sheet->mergeCells("{$rightStart}{$row}:{$rightEnd}{$row}");
        $sheet->setCellValue("{$rightStart}{$row}", 'Diperiksa Oleh');

        $sheet->getStyle("A{$row}:N{$row}")
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle("A{$row}:N{$row}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle("{$leftStart}{$row}:{$leftEnd}{$row}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle("{$rightStart}{$row}:{$rightEnd}{$row}")
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
            "{$leftStart}{$row}:{$leftEnd}{$endTtdRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle(
            "{$rightStart}{$row}:{$rightEnd}{$endTtdRow}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        for ($i = $row; $i <= $endTtdRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }

        $row = $endTtdRow + 1;

        $sheet->mergeCells("{$leftStart}{$row}:{$leftEnd}{$row}");
        $sheet->setCellValue(
            "{$leftStart}{$row}",
            '(................................)'
        );

        $sheet->mergeCells("{$rightStart}{$row}:{$rightEnd}{$row}");
        $sheet->setCellValue(
            "{$rightStart}{$row}",
            '(................................)'
        );

        $sheet->getStyle(
            "{$leftStart}{$row}:{$leftEnd}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(12);

        $sheet->getStyle(
            "{$rightStart}{$row}:{$rightEnd}{$row}"
        )
            ->getFont()
            ->setBold(true)
            ->setSize(12);

        $sheet->getStyle(
            "{$leftStart}{$row}:{$leftEnd}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle(
            "{$rightStart}{$row}:{$rightEnd}{$row}"
        )
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getRowDimension($row)->setRowHeight(28);
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
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle(
            "{$startCol}{$row}:{$endCol}{$row}"
        )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)->setRowHeight(30);
    }

    protected function grandTotalProduction(): float
    {
        $grandTotal = 0;

        foreach ($this->productionBatch->productions as $production) {
            $sumTotal = $production->sum_total;

            if ($sumTotal === null || $sumTotal === '') {
                $sumTotal = $production->details->sum(
                    fn ($d) => (float) ($d->berat_kg ?? 0)
                );
            }

            $grandTotal += (float) $sumTotal;
        }

        return $grandTotal;
    }

    protected function suhuRuangs(): array
    {
        return [
            'columns' => [
                'Suhu Meatprep',
                'Suhu Chillroom',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->suhuRuangs->map(fn ($item) => [
                $this->number($item->suhu_ruang_meatprep),
                $this->number($item->suhu_ruang_chillroom),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function bowlCutters(): array
    {
        return [
            'columns' => [
                'Speed',
                'Suhu Emulasi',
                'Homeganisasi/Orlap',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->bowlCutters->map(fn ($item) => [
                $this->number($item->speed),
                $this->number($item->suhu_emulasi),
                $item->homeganisasi_orlap ?? '-',
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function grinders(): array
    {
        return [
            'columns' => [
                'Ukuran Saringan',
                'Hasil',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->grinders->map(fn ($item) => [
                $item->ukuran_saringan ?? '-',
                $item->hasil ?? '-',
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function mixings(): array
    {
        return [
            'columns' => [
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
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->mixings->map(fn ($item) => [
                $item->mixer_preparation ?? '-',
                $this->number($item->suhu_air),
                $this->number($item->lama_pengadukan),
                $item->filter ?? '-',
                $this->number($item->salinity),
                $this->number($item->brix),
                $item->mixer ?? '-',
                $this->number($item->suhu_adonan),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function preparasiFlas(): array
    {
        return [
            'columns' => [
                'Homeganisasi/Orlap',
                'Suhu Fla',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->preparasiFlas->map(fn ($item) => [
                $item->homeganisasi_orlap ?? '-',
                $this->number($item->suhu_fla_after_cooling_down),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function tumblers(): array
    {
        return [
            'columns' => [
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
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->tumblers->map(fn ($item) => [
                $item->tumbler ?? '-',
                $this->number($item->drum_on),
                $this->number($item->drum_off),
                $this->number($item->vacuum_a),
                $this->number($item->vacuum_b),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function formings(): array
    {
        return [
            'columns' => [
                'Alat',
                'Suhu Adonan',
                'Pressure',
                'Speed',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->formings->map(fn ($item) => [
                $item->alat ?? '-',
                $this->number($item->suhu_adonan),
                $this->number($item->pressure),
                $this->number($item->speed),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function batters(): array
    {
        return [
            'columns' => [
                'Alat Batter',
                'Suhu Batter',
                'Viskositas',
                'Salinity',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->batters->map(fn ($item) => [
                $item->batter ?? '-',
                $this->number($item->suhu_batter),
                $this->number($item->viskositas),
                $this->number($item->salinity),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function predustBreaders(): array
    {
        return [
            'columns' => [
                'Predust Breader',
                'Superflex',
                'Mulai',
                'Selesai',
                'Downtime',
                'Keterangan',
                'Petugas',
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->predustBreaders->map(fn ($item) => [
                $item->predust_breader ?? '-',
                $this->number($item->superflex),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function fryers(): array
    {
        return [
            'columns' => [
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
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->fryers->map(fn ($item) => [
                $item->fryer ?? '-',
                $this->number($item->suhu_setting),
                $this->number($item->suhu_aktual),
                $this->number($item->suhu_pusat),
                $this->number($item->suhu_minimum),
                $item->organoleptik ?? '-',
                $this->number($item->lama_pemasakan),
                $this->number($item->tpm_minyak),
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function hlts(): array
    {
        return [
            'columns' => [
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
                'PIC Produksi'
            ],
            'rows' => $this->productionBatch->hlts->map(fn ($item) => [
                $this->number($item->suhu_awal_daging),
                $this->number($item->suhu_infeed),
                $this->number($item->suhu_outfeed),
                $this->number($item->steam_valve),
                $this->number($item->speed_ventilator),
                $this->number($item->lama_pemasakan),
                $this->number($item->suhu_pusat_ct),
                $item->organoleptik ?? '-',
                $this->time($item->waktu_mulai),
                $this->time($item->waktu_selesai),
                $this->number($item->downtime),
                $item->keterangan ?? '-',
                $item->petugas ?? '-',
                $item->pic_produksi ?? '-',
            ])->values()->all(),
        ];
    }

    protected function metalDetectors(): array
    {
        return [
            'columns' => [
                'Batch Type',
                'Metal Detector',
                'Waktu Awal',
                'Waktu Akhir'
            ],
            'rows' => $this->productionBatch->metalDetectors->map(fn ($item) => [
                $item->batch_type ?? '-',
                $item->metal_detector ?? '-',
                $this->time($item->waktu_awal),
                $this->time($item->waktu_akhir),
            ])->values()->all(),
        ];
    }

    protected function kemasanRijekCategories(): array
    {
        return [
            [
                'label' => 'Rusak',
                'cooking' => 'rusak_cooking',
                'packing' => 'rusak_packing'
            ],
            [
                'label' => 'Jatuh Lantai',
                'cooking' => 'jatuh_lantai_cooking',
                'packing' => 'jatuh_lantai_packing'
            ],
            [
                'label' => 'Kulit',
                'cooking' => 'kulit_cooking',
                'packing' => 'kulit_packing'
            ],
            [
                'label' => 'Waste Bread Crumb',
                'cooking' => 'waste_bread_crumb_cooking',
                'packing' => 'waste_bread_crumb_packing'
            ],
            [
                'label' => 'Waste Bread Predust',
                'cooking' => 'waste_bread_predust_cooking',
                'packing' => 'waste_bread_predust_packing'
            ],
            [
                'label' => 'Scrap Adonan',
                'cooking' => 'scrap_adonan_cooking',
                'packing' => 'scrap_adonan_packing'
            ],
            [
                'label' => 'Gosong',
                'cooking' => 'gosong_cooking',
                'packing' => 'gosong_packing'
            ],
            [
                'label' => 'Overweight/Underweight',
                'cooking' => 'overweight_underweight_cooking',
                'packing' => 'overweight_underweight_packing'
            ],
            [
                'label' => 'Sampel QC',
                'cooking' => 'sampel_qc_cooking',
                'packing' => 'sampel_qc_packing'
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
                'packing' => 'total_rijek_packing_kg'
            ],
        ];
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

        return substr((string) $value, 0, 5);
    }
}