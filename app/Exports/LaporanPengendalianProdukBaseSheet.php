<?php

namespace App\Exports;

use App\Models\ProductionBatch;
use DateTimeInterface;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

abstract class LaporanPengendalianProdukBaseSheet implements
    FromCollection,
    WithColumnWidths,
    WithEvents,
    WithTitle
{
    protected ProductionBatch $productionBatch;

    protected string $lastCol = 'N';
    protected int $totalCols = 14;
    protected int $totalSheets = 6;

    // 0 = tinggi halaman otomatis (boleh lebih dari 1 halaman), 1 = paksa 1 halaman
    protected int $fitToHeight = 0;

    public function __construct(ProductionBatch $productionBatch)
    {
        $this->productionBatch = $productionBatch;
    }

    abstract protected function sheetNumber(): int;

    abstract protected function sheetTitle(): string;

    abstract protected function buildContent($sheet, int $row): int;

    public function collection()
    {
        return collect([]);
    }

    public function title(): string
    {
        return $this->sheetTitle();
    }

    public function columnWidths(): array
    {
        $widths = [];

        for ($i = 1; $i <= $this->totalCols; $i++) {
            $widths[Coordinate::stringFromColumnIndex($i)] = 15;
        }

        return $widths;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $this->setupPage($sheet);
                $this->buildHeader($sheet);

                $row = $this->buildInfo($sheet, 7);
                $row = $this->buildContent($sheet, $row);

                $this->buildApproval($sheet, $row);

                $lastRow = $sheet->getHighestRow();

                $sheet->getStyle("A1:{$this->lastCol}{$lastRow}")
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                $sheet->getPageSetup()
                    ->setPrintArea("A1:{$this->lastCol}{$lastRow}");

                $sheet->setShowGridlines(false);
            },
        ];
    }

    protected function setupPage($sheet): void
    {
        $sheet->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(PageSetup::PAPERSIZE_A4)
            ->setFitToPage(true)
            ->setFitToWidth(1)
            ->setFitToHeight(1)
            ->setHorizontalCentered(true)
            ->setVerticalCentered(false);

        $sheet->getPageMargins()
            ->setTop(0.1)
            ->setRight(0.05)
            ->setBottom(0.1)
            ->setLeft(0.05);

        $sheet->getSheetView()->setZoomScale(75);
        $sheet->getDefaultRowDimension()->setRowHeight(28);
    }

    protected function buildHeader($sheet): void
    {
        $pb = $this->productionBatch;

        $tanggal = '-';

        if ($pb->tanggal_produksi) {
            $tanggal = $pb->tanggal_produksi->format('d/m/Y');
        }

        $lines = [
            1 => ['PT CHAROEN POKPHAND INDONESIA', 18, 36],
            2 => ['FOOD DIVISION', 14, 30],
            3 => ['LAPORAN PENGENDALIAN PRODUK', 16, 38],
            4 => ['PRODUCTION BATCH : ' . $tanggal, 14, 34],
            5 => [
                'PRODUK : ' . $this->val($pb->product->nama ?? null)
                    . '   |   NO. BATCH : ' . $this->val($pb->no_batch)
                    . '   |   HALAMAN ' . $this->sheetNumber() . ' / ' . $this->totalSheets,
                12,
                30,
            ],
        ];

        foreach ($lines as $r => $line) {
            $text = $line[0];
            $size = $line[1];
            $height = $line[2];

            $sheet->mergeCells("A{$r}:{$this->lastCol}{$r}");
            $sheet->setCellValue("A{$r}", $text);

            $sheet->getStyle("A{$r}")
                ->getFont()
                ->setBold(true)
                ->setSize($size);

            $sheet->getStyle("A{$r}:{$this->lastCol}{$r}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER)
                ->setWrapText(true);

            $sheet->getRowDimension($r)->setRowHeight($height);
        }

        $sheet->getRowDimension(6)->setRowHeight(10);
    }

    // Info batch di bagian atas setiap sheet
    protected function buildInfo($sheet, int $row): int
    {
        $pb = $this->productionBatch;

        $hari = '-';
        $tanggal = '-';

        if ($pb->tanggal_produksi) {
            $tanggal = $pb->tanggal_produksi->format('d/m/Y');
            $hari = ucfirst($pb->tanggal_produksi->copy()->locale('id')->isoFormat('dddd'));
        }

        $grandTotal = 0;

        foreach ($pb->produksiBahanBakus as $produksiBahanBaku) {
            $grandTotal += (float) ($produksiBahanBaku->total ?? 0);
        }

        $pairs = [
            ['Hari', $hari, 'Tanggal', $tanggal],
            ['Produk', $this->val($pb->product->nama ?? null), 'No. Batch', $this->val($pb->no_batch)],
            ['Line', $this->val($pb->line), 'Waktu Kerja', $this->val($pb->waktu_kerja)],
            ['Yield', $this->number($pb->yield), '% Rijek', $this->number($pb->persen_rijek)],
            ['Produktifitas', $this->number($pb->produktifitas), 'Total Bahan Baku', $this->number($grandTotal) . ' Kg'],
        ];

        foreach ($pairs as $i => $pair) {
            $r = $row + $i;

            $cells = [
                ['A', 'C', $pair[0] . ' :'],
                ['D', 'G', $pair[1]],
                ['H', 'J', $pair[2] . ' :'],
                ['K', $this->lastCol, $pair[3]],
            ];

            foreach ($cells as $cell) {
                $start = $cell[0];
                $end = $cell[1];

                $sheet->mergeCells("{$start}{$r}:{$end}{$r}");
                $this->setText($sheet, "{$start}{$r}", $cell[2]);

                $sheet->getStyle("{$start}{$r}:{$end}{$r}")
                    ->getFont()
                    ->setBold(true)
                    ->setSize(12);

                $sheet->getStyle("{$start}{$r}:{$end}{$r}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
            }

            $sheet->getRowDimension($r)->setRowHeight(28);
        }

        return $row + count($pairs) + 1;
    }

    // ------------------------------------------------------------------
    // Approval: dua kotak berdampingan (Dibuat Oleh | Diperiksa Oleh)
    // ------------------------------------------------------------------

    protected function buildApproval($sheet, int $row): void
    {
        $row++;

        $this->approvalBox($sheet, $row, 'A', 'F', 'Dibuat Oleh');
        $this->approvalBox($sheet, $row, 'I', 'N', 'Diperiksa Oleh');
    }

    protected function approvalBox(
        $sheet,
        int $row,
        string $start,
        string $end,
        string $title
    ): void {
        $sheet->mergeCells("{$start}{$row}:{$end}{$row}");
        $sheet->setCellValue("{$start}{$row}", $title);

        $sheet->getStyle("{$start}{$row}:{$end}{$row}")
            ->getFont()
            ->setBold(true)
            ->setSize(13);

        $sheet->getStyle("{$start}{$row}:{$end}{$row}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle("{$start}{$row}:{$end}{$row}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)->setRowHeight(28);

        $row++;

        $endTtdRow = $row + 3;

        $sheet->mergeCells("{$start}{$row}:{$end}{$endTtdRow}");

        $sheet->getStyle("{$start}{$row}:{$end}{$endTtdRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        for ($i = $row; $i <= $endTtdRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }

        $row = $endTtdRow + 1;

        $sheet->mergeCells("{$start}{$row}:{$end}{$row}");
        $sheet->setCellValue("{$start}{$row}", '(................................)');

        $sheet->getStyle("{$start}{$row}:{$end}{$row}")
            ->getFont()
            ->setBold(true)
            ->setSize(12);

        $sheet->getStyle("{$start}{$row}:{$end}{$row}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getRowDimension($row)->setRowHeight(28);
    }

    // ------------------------------------------------------------------
    // Tabel & style umum
    // ------------------------------------------------------------------

    protected function table(
        $sheet,
        int $row,
        ?string $title,
        array $columns,
        array $rows
    ): int {
        if ($title !== null) {
            $this->sectionTitle($sheet, $row, $title, 'A', $this->lastCol);

            $row++;
        }

        $spans = $this->distributeColumns(count($columns));

        foreach ($columns as $i => $label) {
            $start = $spans[$i][0];
            $end = $spans[$i][1];

            if ($start !== $end) {
                $sheet->mergeCells("{$start}{$row}:{$end}{$row}");
            }

            $this->setText($sheet, "{$start}{$row}", $label);
        }

        $this->styleRow($sheet, $row, 12, true);

        $sheet->getRowDimension($row)->setRowHeight(40);

        $row++;

        if (count($rows) == 0) {
            $this->emptyBlockRow($sheet, $row, 'A', $this->lastCol);

            return $row + 2;
        }

        foreach ($rows as $record) {
            foreach ($record as $i => $value) {
                $start = $spans[$i][0];
                $end = $spans[$i][1];

                if ($start !== $end) {
                    $sheet->mergeCells("{$start}{$row}:{$end}{$row}");
                }

                $this->setText($sheet, "{$start}{$row}", $value);
            }

            $this->styleRow($sheet, $row, 11, false);

            $sheet->getRowDimension($row)->setRowHeight(30);

            $row++;
        }

        return $row + 1;
    }

    // Tampilan label : nilai, dua pasang per baris
    protected function keyValue($sheet, int $row, array $data): int
    {
        $labels = array_keys($data);
        $values = array_values($data);
        $count = count($labels);

        for ($i = 0; $i < $count; $i += 2) {
            $cells = [
                ['A', 'C', $labels[$i], true],
                ['D', 'G', $values[$i], false],
            ];

            if (isset($labels[$i + 1])) {
                $cells[] = ['H', 'J', $labels[$i + 1], true];
                $cells[] = ['K', 'N', $values[$i + 1], false];
            } else {
                $cells[] = ['H', 'N', '', false];
            }

            foreach ($cells as $cell) {
                $start = $cell[0];
                $end = $cell[1];
                $text = $cell[2];
                $isLabel = $cell[3];

                $sheet->mergeCells("{$start}{$row}:{$end}{$row}");
                $this->setText($sheet, "{$start}{$row}", $text);

                $sheet->getStyle("{$start}{$row}:{$end}{$row}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle("{$start}{$row}:{$end}{$row}")
                    ->getFont()
                    ->setBold(true)
                    ->setSize($isLabel ? 11 : 12);

                $sheet->getStyle("{$start}{$row}:{$end}{$row}")
                    ->getAlignment()
                    ->setHorizontal(
                        $isLabel
                            ? Alignment::HORIZONTAL_LEFT
                            : Alignment::HORIZONTAL_CENTER
                    )
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);

                if ($isLabel) {
                    $sheet->getStyle("{$start}{$row}:{$end}{$row}")
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setRGB('F2F2F2');
                }
            }

            $sheet->getRowDimension($row)->setRowHeight(26);

            $row++;
        }

        return $row + 1;
    }

    protected function emptySection($sheet, int $row, string $title): int
    {
        $this->sectionTitle($sheet, $row, $title, 'A', $this->lastCol);

        $row++;

        $this->emptyBlockRow($sheet, $row, 'A', $this->lastCol);

        return $row + 2;
    }

    protected function sectionTitle(
        $sheet,
        int $row,
        string $title,
        string $startCol,
        string $endCol
    ): void {
        $range = "{$startCol}{$row}:{$endCol}{$row}";

        $sheet->mergeCells($range);
        $sheet->setCellValue("{$startCol}{$row}", $title);

        $sheet->getStyle($range)
            ->getFont()
            ->setBold(true)
            ->setSize(14);

        $sheet->getStyle($range)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle($range)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)->setRowHeight(34);
    }

    protected function styleRow($sheet, int $row, int $size, bool $header): void
    {
        $range = "A{$row}:{$this->lastCol}{$row}";

        $sheet->getStyle($range)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle($range)
            ->getFont()
            ->setBold($header)
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
        $range = "{$startCol}{$row}:{$endCol}{$row}";

        $sheet->mergeCells($range);
        $sheet->setCellValue("{$startCol}{$row}", 'Tidak ada data');

        $sheet->getStyle($range)
            ->getFont()
            ->setItalic(true)
            ->setBold(true)
            ->setSize(13);

        $sheet->getStyle($range)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle($range)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension($row)->setRowHeight(30);
    }

    protected function distributeColumns(int $n): array
    {
        $letters = [];

        for ($i = 1; $i <= $this->totalCols; $i++) {
            $letters[] = Coordinate::stringFromColumnIndex($i);
        }

        $n = max(1, min($n, $this->totalCols));

        $base = intdiv($this->totalCols, $n);
        $extra = $this->totalCols % $n;
        $cursor = 0;
        $spans = [];

        for ($i = 0; $i < $n; $i++) {
            $width = $base + ($i < $extra ? 1 : 0);

            $spans[] = [$letters[$cursor], $letters[$cursor + $width - 1]];

            $cursor += $width;
        }

        return $spans;
    }

    // Paksa jadi teks supaya "1.300" tidak dibaca Excel sebagai angka 1,3
    protected function setText($sheet, string $cell, $value): void
    {
        $sheet->setCellValueExplicit(
            $cell,
            (string) $value,
            DataType::TYPE_STRING
        );
    }

    // ------------------------------------------------------------------
    // Stiker
    // ------------------------------------------------------------------

    protected function hasSticker(string $field): bool
    {
        $path = $this->productionBatch->{$field};

        if (!$path) {
            return false;
        }

        return Storage::disk('public')->exists($path);
    }

    // Satu kotak stiker dengan judul. Dipakai untuk Kartu Rute (Sheet 1).
    protected function stickerBox(
        $sheet,
        int $row,
        string $title,
        string $start,
        string $end,
        int $boxRows,
        string $field
    ): int {
        $this->sectionTitle($sheet, $row, $title, $start, $end);

        $row++;

        $rowStart = $row;
        $rowEnd = $row + $boxRows - 1;

        if ($this->hasSticker($field)) {
            $this->placeStickerImage(
                $sheet,
                $rowStart,
                $rowEnd,
                $start,
                $end,
                $this->productionBatch->{$field}
            );
        } else {
            $sheet->mergeCells("{$start}{$rowStart}:{$end}{$rowEnd}");
            $sheet->setCellValue("{$start}{$rowStart}", 'Tidak ada stiker');

            $sheet->getStyle("{$start}{$rowStart}:{$end}{$rowEnd}")
                ->getFont()
                ->setItalic(true)
                ->setBold(true)
                ->setSize(13);

            $sheet->getStyle("{$start}{$rowStart}:{$end}{$rowEnd}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("{$start}{$rowStart}:{$end}{$rowEnd}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            for ($i = $rowStart; $i <= $rowEnd; $i++) {
                $sheet->getRowDimension($i)->setRowHeight(26);
            }
        }

        return $rowEnd + 2;
    }

    // Beberapa stiker sejajar dalam satu baris, lebar dibagi sesuai bobot.
    protected function stickerGroup(
        $sheet,
        int $rowStart,
        int $rowEnd,
        string $colStart,
        string $colEnd,
        array $items
    ): void {
        if (count($items) == 0) {
            return;
        }

        $totalWeight = 0;

        foreach ($items as $item) {
            $totalWeight += $item['weight'];
        }

        $totalColumns = ord($colEnd) - ord($colStart) + 1;
        $allocated = 0;
        $colIndex = 0;
        $lastIndex = count($items) - 1;

        foreach ($items as $i => $item) {
            if ($i === $lastIndex) {
                $width = $totalColumns - $allocated;
            } else {
                $width = (int) round(($item['weight'] / $totalWeight) * $totalColumns);
            }

            if ($width < 1) {
                $width = 1;
            }

            $start = chr(ord($colStart) + $colIndex);
            $end = chr(ord($colStart) + $colIndex + $width - 1);

            $this->placeStickerImage(
                $sheet,
                $rowStart,
                $rowEnd,
                $start,
                $end,
                $item['path']
            );

            $colIndex += $width;
            $allocated += $width;
        }
    }

    protected function placeStickerImage(
        $sheet,
        int $rowStart,
        int $rowEnd,
        string $start,
        string $end,
        string $imagePath
    ): void {
        $rowHeightPt = 26;

        $sheet->mergeCells("{$start}{$rowStart}:{$end}{$rowEnd}");

        $sheet->getStyle("{$start}{$rowStart}:{$end}{$rowEnd}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        for ($i = $rowStart; $i <= $rowEnd; $i++) {
            $sheet->getRowDimension($i)->setRowHeight($rowHeightPt);
        }

        $fullPath = Storage::disk('public')->path($imagePath);
        $imageInfo = @getimagesize($fullPath);

        if ($imageInfo === false) {
            return;
        }

        $origWidth = $imageInfo[0];
        $origHeight = $imageInfo[1];

        $padding = 10;

        // 1 pt = 4/3 px
        $boxHeightPx = (int) round((($rowEnd - $rowStart + 1) * $rowHeightPt) * 4 / 3);

        $availableWidth = $this->columnRangeWidthPx($start, $end) - $padding;
        $availableHeight = $boxHeightPx - $padding;

        $scale = min(
            $availableWidth / $origWidth,
            $availableHeight / $origHeight
        );

        $drawWidth = (int) round($origWidth * $scale);
        $drawHeight = (int) round($origHeight * $scale);

        $offsetX = (int) max(4, ($availableWidth - $drawWidth) / 2);
        $offsetY = (int) max(4, ($availableHeight - $drawHeight) / 2);

        $drawing = new Drawing();
        $drawing->setName('Stiker');
        $drawing->setPath($fullPath);
        $drawing->setResizeProportional(false);
        $drawing->setCoordinates("{$start}{$rowStart}");
        $drawing->setOffsetX($offsetX);
        $drawing->setOffsetY($offsetY);
        $drawing->setWidth($drawWidth);
        $drawing->setHeight($drawHeight);
        $drawing->setWorksheet($sheet);
    }

    protected function columnRangeWidthPx(string $start, string $end): int
    {
        $widths = $this->columnWidths();
        $total = 0;

        for ($col = ord($start); $col <= ord($end); $col++) {
            $letter = chr($col);

            $width = 10;

            if (isset($widths[$letter])) {
                $width = $widths[$letter];
            }

            $total += (int) round(($width * 7) + 5);
        }

        return $total;
    }

    // ------------------------------------------------------------------
    // Format nilai
    // ------------------------------------------------------------------

    // Angka tidak dibulatkan: 239,299 tetap 239,299; 88,5 tetap 88,5
    protected function number($value): string
    {
        if ($value === null || $value === '') {
            return '-';
        }

        if (!is_numeric($value)) {
            return (string) $value;
        }

        $formatted = number_format((float) $value, 3, ',', '.');

        return rtrim(rtrim($formatted, '0'), ',');
    }

    protected function val($value): string
    {
        if ($value === null || $value === '') {
            return '-';
        }

        return (string) $value;
    }

    protected function time($value): string
    {
        if (!$value) {
            return '-';
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('H:i');
        }

        return substr((string) $value, 0, 5);
    }

    protected function date($value): string
    {
        if (!$value) {
            return '-';
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('d/m/Y');
        }

        return (string) $value;
    }

    protected function bahanBakuLabel($bahanBaku): string
    {
        if (!$bahanBaku) {
            return '-';
        }

        $kode = $bahanBaku->kode ?? null;
        $name = $bahanBaku->name ?? null;

        if ($kode && $name) {
            return "{$kode} - {$name}";
        }

        if ($kode) {
            return $kode;
        }

        if ($name) {
            return $name;
        }

        return '-';
    }
}