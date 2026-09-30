<?php

namespace App\Exports;

use App\Models\Batter;
use App\Models\BowlCutter;
use App\Models\Forming;
use App\Models\Fryer;
use App\Models\Grinder;
use App\Models\Hlt;
use App\Models\KemasanRijek;
use App\Models\Mixing;
use App\Models\PackingDalam;
use App\Models\PackingDalamPlastik;
use App\Models\PackingDalamSampling;
use App\Models\PackingLuar;
use App\Models\PackingLuarKemasan;
use App\Models\PackingLuarPalet;
use App\Models\PackingLuarSampling;
use App\Models\Pembekuan;
use App\Models\PredustBreader;
use App\Models\PreparasiFla;
use App\Models\Production;
use App\Models\ProductionDetail;
use App\Models\Tumbler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardTableSheet implements FromCollection, WithEvents, WithStyles, WithColumnWidths
{
    protected Request $request;

    protected array $tables = [];

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->tables = [

            [
                'title' => 'PRODUKSI',
                'model' => Production::class,
                'type' => 'main',
            ],

            [
                'title' => 'DETAIL PRODUKSI',
                'model' => ProductionDetail::class,
                'type' => 'production_detail',
            ],

            [
                'title' => 'BATTER',
                'model' => Batter::class,
                'type' => 'main',
            ],

            [
                'title' => 'MIXING',
                'model' => Mixing::class,
                'type' => 'main',
            ],

            [
                'title' => 'BOWL CUTTER',
                'model' => BowlCutter::class,
                'type' => 'main',
            ],

            [
                'title' => 'FORMING',
                'model' => Forming::class,
                'type' => 'main',
            ],

            [
                'title' => 'FRYER',
                'model' => Fryer::class,
                'type' => 'main',
            ],

            [
                'title' => 'GRINDER',
                'model' => Grinder::class,
                'type' => 'main',
            ],

            [
                'title' => 'HLT',
                'model' => Hlt::class,
                'type' => 'main',
            ],

            [
                'title' => 'TUMBLER',
                'model' => Tumbler::class,
                'type' => 'main',
            ],

            [
                'title' => 'PREPARASI FLA',
                'model' => PreparasiFla::class,
                'type' => 'main',
            ],

            [
                'title' => 'PREDUST BREDER',
                'model' => PredustBreader::class,
                'type' => 'main',
            ],

            [
                'title' => 'PEMBEKUAN',
                'model' => Pembekuan::class,
                'type' => 'main',
            ],

            [
                'title' => 'PACKING DALAM',
                'model' => PackingDalam::class,
                'type' => 'main',
            ],

            [
                'title' => 'PACKING DALAM PLASTIK',
                'model' => PackingDalamPlastik::class,
                'type' => 'packing_dalam_detail',
            ],

            [
                'title' => 'PACKING DALAM SAMPLING',
                'model' => PackingDalamSampling::class,
                'type' => 'packing_dalam_detail',
            ],

            [
                'title' => 'PACKING LUAR',
                'model' => PackingLuar::class,
                'type' => 'main',
            ],

            [
                'title' => 'PACKING LUAR KEMASAN',
                'model' => PackingLuarKemasan::class,
                'type' => 'packing_luar_detail',
            ],

            [
                'title' => 'PACKING LUAR PALET',
                'model' => PackingLuarPalet::class,
                'type' => 'packing_luar_detail',
            ],

            [
                'title' => 'PACKING LUAR SAMPLING',
                'model' => PackingLuarSampling::class,
                'type' => 'packing_luar_detail',
            ],

            [
                'title' => 'KEMASAN RIJEK',
                'model' => KemasanRijek::class,
                'type' => 'main',
            ],

        ];
    }

    public function collection()
    {
        return collect();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $sheet->setTitle('Dashboard Manager');

                $this->writeHeader($sheet);

                $currentRow = 7;

                foreach ($this->tables as $table) {
                    $currentRow = $this->writeTable(
                        $sheet,
                        $table,
                        $currentRow
                    );
                }

                $lastColumn = $sheet->getHighestColumn();
                $lastRow = $sheet->getHighestRow();

                $sheet->getStyle(
                    "A1:{$lastColumn}{$lastRow}"
                )->getAlignment()->setVertical(
                    Alignment::VERTICAL_CENTER
                );

                $sheet->getStyle(
                    "A1:{$lastColumn}{$lastRow}"
                )->getAlignment()->setWrapText(true);

                $sheet->freezePane('A7');
            },
        ];
    }

    protected function writeHeader(Worksheet $sheet): void
    {
        $dateFrom = $this->request->date_from
            ? Carbon::parse($this->request->date_from)
            : null;

        $dateTo = $this->request->date_to
            ? Carbon::parse($this->request->date_to)
            : null;

        if ($dateFrom && $dateTo) {

            $period = $dateFrom->translatedFormat('d F Y')
                . ' S.D '
                . $dateTo->translatedFormat('d F Y');

        } else {

            $period = '-';
        }

        $line = $this->request->line ?: 'SEMUA LINE';

        $sheet->mergeCells('A1:T1');
        $sheet->mergeCells('A2:T2');
        $sheet->mergeCells('A3:T3');
        $sheet->mergeCells('A4:T4');

        $sheet->setCellValue(
            'A1',
            'PT. CHAROEN POKPHAND INDONESIA - FOOD DIVISION'
        );

        $sheet->setCellValue(
            'A2',
            'DASHBOARD MONITORING PRODUKSI'
        );

        $sheet->setCellValue(
            'A3',
            'PERIODE : ' . $period
        );

        $sheet->setCellValue(
            'A4',
            'LINE : ' . $line
        );

        $sheet->getStyle('A1:T4')
            ->getFont()
            ->setBold(true);

        $sheet->getStyle('A1:T4')
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_LEFT
            );

        $sheet->getStyle('A1')
            ->getFont()
            ->setSize(14);

        $sheet->getStyle('A2')
            ->getFont()
            ->setSize(12);

        $sheet->getRowDimension(1)
            ->setRowHeight(25);

        $sheet->getRowDimension(2)
            ->setRowHeight(22);

        $sheet->getRowDimension(3)
            ->setRowHeight(20);

        $sheet->getRowDimension(4)
            ->setRowHeight(20);
    }

    protected function writeTable(
        Worksheet $sheet,
        array $table,
        int $startRow
    ): int {

        $model = $table['model'];
        $type = $table['type'];

        $instance = new $model;

        $columns = Schema::getColumnListing(
            $instance->getTable()
        );

        $data = $this->getData(
            $model,
            $columns,
            $type
        );

        $displayColumns = [];

        foreach ($columns as $column) {

            if ($column !== 'id') {
                $displayColumns[] = $column;
            }
        }

        $hasId = in_array('id', $columns);

        $totalColumns = count($displayColumns);

        if ($hasId) {
            $totalColumns++;
        }

        $lastColumn = $this->getColumnLetter(
            $totalColumns
        );

        $sheet->mergeCells(
            "A{$startRow}:{$lastColumn}{$startRow}"
        );

        $sheet->setCellValue(
            "A{$startRow}",
            $table['title']
        );

        $sheet->getStyle(
            "A{$startRow}:{$lastColumn}{$startRow}"
        )->getFont()->setBold(true);

        $sheet->getStyle(
            "A{$startRow}:{$lastColumn}{$startRow}"
        )->getFill()
            ->setFillType(
                Fill::FILL_SOLID
            );

        $sheet->getStyle(
            "A{$startRow}:{$lastColumn}{$startRow}"
        )->getAlignment()->setHorizontal(
            Alignment::HORIZONTAL_LEFT
        );

        $headerRow = $startRow + 1;

        $columnIndex = 1;

        if ($hasId) {

            $sheet->setCellValue(
                $this->getColumnLetter($columnIndex) . $headerRow,
                'No'
            );

            $columnIndex++;
        }

        foreach ($displayColumns as $column) {

            $sheet->setCellValue(
                $this->getColumnLetter($columnIndex) . $headerRow,
                $this->formatHeader($column)
            );

            $columnIndex++;
        }

        $sheet->getStyle(
            "A{$headerRow}:{$lastColumn}{$headerRow}"
        )->getFont()->setBold(true);

        $sheet->getStyle(
            "A{$headerRow}:{$lastColumn}{$headerRow}"
        )->getAlignment()->setHorizontal(
            Alignment::HORIZONTAL_CENTER
        );

        $sheet->getStyle(
            "A{$headerRow}:{$lastColumn}{$headerRow}"
        )->getAlignment()->setVertical(
            Alignment::VERTICAL_CENTER
        );

        $sheet->getStyle(
            "A{$headerRow}:{$lastColumn}{$headerRow}"
        )->getAlignment()->setWrapText(true);

        $sheet->getRowDimension($headerRow)
            ->setRowHeight(35);

        $dataRow = $headerRow + 1;

        $number = 1;

        foreach ($data as $item) {

            $columnIndex = 1;

            if ($hasId) {

                $sheet->setCellValue(
                    $this->getColumnLetter($columnIndex) . $dataRow,
                    $number
                );

                $columnIndex++;
            }

            foreach ($displayColumns as $column) {

                $cell = $this->getColumnLetter($columnIndex)
                    . $dataRow;

                $value = $item->{$column};

                if ($value instanceof Carbon) {
                    $value = $value->format('Y-m-d');
                }

                if ($value === null) {
                    $value = '';
                }

                $sheet->setCellValue(
                    $cell,
                    $value
                );

                $columnIndex++;
            }

            $number++;
            $dataRow++;
        }

        $lastDataRow = $dataRow - 1;

        if ($lastDataRow >= $headerRow) {

            $sheet->getStyle(
                "A{$headerRow}:{$lastColumn}{$lastDataRow}"
            )->getBorders()
                ->getAllBorders()
                ->setBorderStyle(
                    Border::BORDER_THIN
                );
        }

        return $dataRow + 2;
    }

    protected function getData(
        string $model,
        array $columns,
        string $type
    ): Collection {

        $query = $model::query();

        $dateFrom = $this->request->date_from;
        $dateTo = $this->request->date_to;
        $line = $this->request->line;

        if ($type === 'main') {

            if (in_array('tanggal_produksi', $columns)) {

                if ($dateFrom) {

                    $query->whereDate(
                        'tanggal_produksi',
                        '>=',
                        Carbon::parse($dateFrom)->toDateString()
                    );
                }

                if ($dateTo) {

                    $query->whereDate(
                        'tanggal_produksi',
                        '<=',
                        Carbon::parse($dateTo)->toDateString()
                    );
                }
            }

            if (
                $line &&
                in_array('line', $columns)
            ) {

                $query->where(
                    'line',
                    $line
                );
            }
        }

        if ($type === 'production_detail') {

            $query->whereHas(
                'production',
                function ($q) use (
                    $dateFrom,
                    $dateTo
                ) {

                    if ($dateFrom) {

                        $q->whereDate(
                            'tanggal_produksi',
                            '>=',
                            Carbon::parse($dateFrom)->toDateString()
                        );
                    }

                    if ($dateTo) {

                        $q->whereDate(
                            'tanggal_produksi',
                            '<=',
                            Carbon::parse($dateTo)->toDateString()
                        );
                    }
                }
            );
        }

        if ($type === 'packing_dalam_detail') {

            $query->whereHas(
                'packingDalam',
                function ($q) use (
                    $dateFrom,
                    $dateTo,
                    $line
                ) {

                    if ($dateFrom) {

                        $q->whereDate(
                            'tanggal_produksi',
                            '>=',
                            Carbon::parse($dateFrom)->toDateString()
                        );
                    }

                    if ($dateTo) {

                        $q->whereDate(
                            'tanggal_produksi',
                            '<=',
                            Carbon::parse($dateTo)->toDateString()
                        );
                    }

                    if ($line) {

                        $q->where(
                            'line',
                            $line
                        );
                    }
                }
            );
        }

        if ($type === 'packing_luar_detail') {

            $query->whereHas(
                'packingLuar',
                function ($q) use (
                    $dateFrom,
                    $dateTo
                ) {

                    if ($dateFrom) {

                        $q->whereDate(
                            'tanggal_produksi',
                            '>=',
                            Carbon::parse($dateFrom)->toDateString()
                        );
                    }

                    if ($dateTo) {

                        $q->whereDate(
                            'tanggal_produksi',
                            '<=',
                            Carbon::parse($dateTo)->toDateString()
                        );
                    }
                }
            );
        }

        if (in_array('tanggal_produksi', $columns)) {

            $query->orderBy(
                'tanggal_produksi'
            );

        } else {

            if (in_array('id', $columns)) {

                $query->orderBy('id');
            }
        }

        return $query->get();
    }

    protected function formatHeader(string $column): string
    {
        $headers = [

            'tanggal_produksi' => 'Tanggal Produksi',
            'waktu_kerja' => 'Waktu Kerja',

            'process_type_id' => 'No Process Type',
            'production_id' => 'No Produksi',

            'product_id' => 'Product',
            'kode_batch' => 'Kode Batch',
            'berat_kg' => 'Berat (Kg)',

            'suhu_batter' => 'Suhu Batter',
            'viskositas' => 'Viskositas',
            'salinitas' => 'Salinitas',

            'speed' => 'Speed',
            'suhu_emulasi' => 'Suhu Emulasi',
            'homeganisasi_overlap' => 'Homogenisasi Overlap',

            'alat' => 'Alat',
            'suhu_adonan' => 'Suhu Adonan',
            'pressure' => 'Pressure',

            'suhu_setting' => 'Suhu Setting',
            'suhu_aktual' => 'Suhu Aktual',
            'lama_pemasakan' => 'Lama Pemasakan',
            'tpm_minyak' => 'TPM Minyak',

            'ukuran_saringan' => 'Ukuran Saringan',
            'hasil' => 'Hasil',

            'mixer_preparation' => 'Mixer Preparation',
            'suhu_air' => 'Suhu Air',
            'lama_pengadukan' => 'Lama Pengadukan',
            'filter' => 'Filter',
            'brix' => 'Brix',
            'mixer' => 'Mixer',

            'suhu_awal_daging' => 'Suhu Awal Daging',
            'suhu_infeed' => 'Suhu Infeed',
            'suhu_outfeed' => 'Suhu Outfeed',
            'steam_valve' => 'Steam Valve',
            'speed_ventilator' => 'Speed Ventilator',
            'suhu_pusat_ct' => 'Suhu Pusat CT',
            'organoleptik' => 'Organoleptik',

            'superflex' => 'Superflex',

            'suhu_fla_after_cooling_down' =>
                'Suhu FLA After Cooling Down',

            'suhu_ruang_packing' => 'Suhu Ruang Packing',
            'suhu_ruang_iqf' => 'Suhu Ruang IQF',
            'speed_conveyor' => 'Speed Conveyor',
            'suhu_pusat' => 'Suhu Pusat',
            'lama_waktu_kerusakan' => 'Lama Waktu Kerusakan',
            'lama_waktu_istirahat' => 'Lama Waktu Istirahat',

            'operator' => 'Operator',

            'waktu_mulai' => 'Waktu Mulai',
            'waktu_selesai' => 'Waktu Selesai',

            'downtime' => 'Downtime',
            'keterangan' => 'Keterangan',
            'petugas' => 'Petugas',
            'line' => 'Line',
            'pic_produksi' => 'PIC Produksi',

            'rusak_cooking' => 'Rusak Cooking',
            'rusak_packing' => 'Rusak Packing',

            'jatuh_lantai_cooking' =>
                'Jatuh Lantai Cooking',

            'jatuh_lantai_packing' =>
                'Jatuh Lantai Packing',

            'kulit_cooking' => 'Kulit Cooking',
            'kulit_packing' => 'Kulit Packing',

            'serpihan_cooking' =>
                'Serpihan Cooking',

            'serpihan_packing' =>
                'Serpihan Packing',

            'serbuk_cooking' =>
                'Serbuk Cooking',

            'serbuk_packing' =>
                'Serbuk Packing',

            'gosong_cooking' =>
                'Gosong Cooking',

            'gosong_packing' =>
                'Gosong Packing',

            'sampel_qc_cooking' =>
                'Sampel QC Cooking',

            'sampel_qc_packing' =>
                'Sampel QC Packing',

            'mhw_korin' => 'MHW Korin',
            'heating_level' => 'Heating Level',
            'packing_manual' => 'Packing Manual',
            'timbangan' => 'Timbangan',

            'heating_level_packing_manual' =>
                'Heating Level Packing Manual',

            'metal_detector' => 'Metal Detector',
            'fe_sus_non_fe' => 'Fe / SUS / Non Fe',

            'checkweigher_pac' =>
                'Checkweigher PAC',

            'petugas_sortasi_after_iqf' =>
                'Petugas Sortasi After IQF',

            'operator_md' => 'Operator MD',
            'leader_produksi' => 'Leader Produksi',

            'waktu_awal' => 'Waktu Awal',
            'waktu_akhir' => 'Waktu Akhir',

            'packing_dalam_id' =>
                'No Packing Dalam',

            'packing_luar_id' =>
                'No Packing Luar',

            'jumlah' => 'Jumlah',
            'pemakaian' => 'Pemakaian',
            'sisa' => 'Sisa',
            'rijek' => 'Rijek',

            'operator_mhw' => 'Operator MHW',
            'checker_ds' => 'Checker DS',
            'leader' => 'Leader',

            'sampling_ke' => 'Sampling Ke',
            'berat_kemasan' => 'Berat Kemasan',
            'berat_per_bag' => 'Berat Per Bag',
            'range_berat' => 'Range Berat',

            'pengisian_ke_dalam_box' =>
                'Pengisian Ke Dalam Box',

            'sealer_box' =>
                'Sealer Box',

            'check_weigher_box' =>
                'Check Weigher Box',

            'berat_per_box' =>
                'Berat Per Box',

            'no_palet' =>
                'No Palet',

            'jumlah_box' =>
                'Jumlah Box',

            'jumlah_kg' =>
                'Jumlah Kg',

            'jumlah_wip_keluar_bag' =>
                'Jumlah WIP Keluar Bag',

            'jumlah_wip_keluar_kg' =>
                'Jumlah WIP Keluar Kg',

            'jumlah_wip_keluar_lot' =>
                'Jumlah WIP Keluar Lot',

            'jumlah_wip_masuk' =>
                'Jumlah WIP Masuk',

            'checker_fg' =>
                'Checker FG',

            'drum_on' => 'Drum On',
            'drum_off' => 'Drum Off',
            'vacuum' => 'Vacuum',
            'tumbler' => 'Tumbler',
        ];

        if (isset($headers[$column])) {
            return $headers[$column];
        }

        return ucwords(
            str_replace(
                '_',
                ' ',
                $column
            )
        );
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 22,
            'C' => 22,
            'D' => 22,
            'E' => 22,
            'F' => 22,
            'G' => 22,
            'H' => 22,
            'I' => 22,
            'J' => 22,
            'K' => 22,
            'L' => 22,
            'M' => 22,
            'N' => 22,
            'O' => 22,
            'P' => 22,
            'Q' => 22,
            'R' => 22,
            'S' => 22,
            'T' => 22,
            'U' => 22,
            'V' => 22,
            'W' => 22,
            'X' => 22,
            'Y' => 22,
            'Z' => 22,
        ];
    }

    protected function getColumnLetter(int $column): string
    {
        $letter = '';

        while ($column > 0) {

            $modulo = ($column - 1) % 26;

            $letter = chr(65 + $modulo) . $letter;

            $column = (int) (($column - $modulo) / 26);
        }

        return $letter;
    }
}