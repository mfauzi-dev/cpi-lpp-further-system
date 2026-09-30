<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengendalian Produk</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 7mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 100%;
        }

        .page-break {
            page-break-before: always;
        }

        .header {
            text-align: center;
            margin-bottom: 14px;
        }

        .company {
            font-size: 18px;
            font-weight: bold;
            line-height: 21px;
        }

        .division {
            font-size: 14px;
            font-weight: bold;
            line-height: 17px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            line-height: 20px;
        }

        .batch {
            font-size: 13px;
            font-weight: bold;
            line-height: 17px;
            margin-top: 2px;
        }

        .section {
            page-break-inside: avoid;
            margin-top: 20px;
        }

        .section:first-of-type {
            margin-top: 0;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            line-height: 18px;
            margin: 0 0 9px 0;
            padding: 0;
            page-break-after: avoid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            page-break-inside: avoid;
            margin: 0 0 18px 0;
        }

        tr {
            page-break-inside: avoid;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 5px 7px;
            vertical-align: middle;
            word-wrap: break-word;
            font-size: 11px;
            line-height: 14px;
        }

        .label {
            width: 34%;
            font-weight: bold;
        }

        .value {
            width: 66%;
            font-weight: bold;
        }

        .record-title {
            font-size: 11px;
            font-weight: bold;
            padding: 5px 7px;
            background: #f2f2f2;
        }

        .record-label {
            width: 34%;
            font-weight: bold;
        }

        .record-value {
            width: 66%;
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            font-weight: bold;
            height: 28px;
        }

        .rijek-table th,
        .rijek-table td {
            text-align: center;
        }

        .rijek-table th:first-child,
        .rijek-table td:first-child {
            text-align: left;
            width: 34%;
        }

        .approval {
            margin-top: 28px;
            page-break-inside: avoid;
        }

        .approval td {
            text-align: center;
            font-weight: bold;
            vertical-align: top;
            font-size: 11px;
        }

        .approval-space {
            height: 50px;
        }

        .stamp {
            height: 250px;
            vertical-align: middle !important;
        }
    </style>
</head>

<body>

    @php
        $number = function ($value) {
            if ($value === null || $value === '') {
                return '-';
            }

            return number_format((float) $value, 2, ',', '.');
        };

        $time = function ($value) {
            if (!$value) {
                return '-';
            }

            return substr((string) $value, 0, 5);
        };

        $productionDetails = [];

        foreach ($productionBatch->productions ?? [] as $production) {
            foreach ($production->details ?? [] as $detail) {
                $productionDetails[] = [
                    'Product' => $detail->product->nama ?? '-',
                    'Kode Batch' => $detail->kode_batch ?? '-',
                    'Suhu' => $number($detail->suhu),
                    'Berat' => $number($detail->berat_kg) . ' Kg',
                ];
            }
        }

        $bowlCutters = $productionBatch->bowlCutters ?? collect();
        $grinders = $productionBatch->grinders ?? collect();
        $mixings = $productionBatch->mixings ?? collect();
        $tumblers = $productionBatch->tumblers ?? collect();
        $formings = $productionBatch->formings ?? collect();
        $batters = $productionBatch->batters ?? collect();
        $predustBreaders = $productionBatch->predustBreaders ?? collect();
        $fryers = $productionBatch->fryers ?? collect();
        $hlts = $productionBatch->hlts ?? collect();

        $rijek = ($productionBatch->kemasanRijeks ?? collect())->first();
        $pembekuan = ($productionBatch->pembekuans ?? collect())->first();
        $packingDalam = ($productionBatch->packingDalams ?? collect())->first();
        $packingLuar = ($productionBatch->packingLuars ?? collect())->first();
    @endphp

    <div class="page">

        <div class="header">
            <div class="company">PT CHAROEN POKPHAND INDONESIA</div>
            <div class="division">FOOD DIVISION</div>
            <div class="title">LAPORAN PENGENDALIAN PRODUK</div>
            <div class="batch">
                PRODUCTION BATCH : {{ $productionBatch->no_batch ?? '-' }}
            </div>
        </div>

        <div class="section">
            <div class="section-title">PRODUCTION</div>

            <table>
                <tr>
                    <td class="label">Tanggal Produksi</td>
                    <td class="value">
                        {{ $productionBatch->tanggal_produksi ? \Carbon\Carbon::parse($productionBatch->tanggal_produksi)->format('d/m/Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="label">No. Batch</td>
                    <td class="value">{{ $productionBatch->no_batch ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Product</td>
                    <td class="value">{{ $productionBatch->product->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Line</td>
                    <td class="value">{{ $productionBatch->line ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Waktu Kerja</td>
                    <td class="value">{{ $productionBatch->waktu_kerja ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Yield</td>
                    <td class="value">{{ $number($productionBatch->yield) }}</td>
                </tr>
                <tr>
                    <td class="label">% Rijek</td>
                    <td class="value">{{ $number($productionBatch->persen_rijek) }}</td>
                </tr>
                <tr>
                    <td class="label">Produktifitas</td>
                    <td class="value">{{ $number($productionBatch->produktifitas) }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">PRODUCTION DETAIL</div>

            @if (count($productionDetails) === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($productionDetails as $index => $item)
                    @if (count($productionDetails) > 1)
                        <table>
                            <tr>
                                <td class="record-title">
                                    DATA KE-{{ $index + 1 }}
                                </td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        @foreach ($item as $label => $value)
                            <tr>
                                <td class="record-label">{{ $label }}</td>
                                <td class="record-value">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">BOWL CUTTER</div>

            @if ($bowlCutters->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($bowlCutters as $index => $item)
                    @if ($bowlCutters->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Speed</td>
                            <td class="record-value">{{ $number($item->speed) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Suhu Emulasi</td>
                            <td class="record-value">{{ $number($item->suhu_emulasi) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Homeganisasi / Orlap</td>
                            <td class="record-value">{{ $item->homeganisasi_orlap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">GRINDER</div>

            @if ($grinders->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($grinders as $index => $item)
                    @if ($grinders->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Ukuran Saringan</td>
                            <td class="record-value">{{ $item->ukuran_saringan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Hasil</td>
                            <td class="record-value">{{ $item->hasil ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">MIXING</div>

            @if ($mixings->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($mixings as $index => $item)
                    @if ($mixings->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Mixer Preparation</td>
                            <td class="record-value">{{ $item->mixer_preparation ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Suhu Air</td>
                            <td class="record-value">{{ $number($item->suhu_air) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Lama Pengadukan</td>
                            <td class="record-value">{{ $number($item->lama_pengadukan) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Filter</td>
                            <td class="record-value">{{ $item->filter ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Salinity</td>
                            <td class="record-value">{{ $number($item->salinity) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Brix</td>
                            <td class="record-value">{{ $number($item->brix) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Mixer</td>
                            <td class="record-value">{{ $item->mixer ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Suhu Adonan</td>
                            <td class="record-value">{{ $number($item->suhu_adonan) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">TUMBLER</div>

            @if ($tumblers->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($tumblers as $index => $item)
                    @if ($tumblers->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Tumbler</td>
                            <td class="record-value">{{ $item->tumbler ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Drum On</td>
                            <td class="record-value">{{ $number($item->drum_on) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Drum Off</td>
                            <td class="record-value">{{ $number($item->drum_off) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Vacuum</td>
                            <td class="record-value">{{ $number($item->vacuum) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">FORMING</div>

            @if ($formings->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($formings as $index => $item)
                    @if ($formings->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">BATTER</div>

            @if ($batters->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($batters as $index => $item)
                    @if ($batters->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Suhu Batter</td>
                            <td class="record-value">{{ $number($item->suhu_batter) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Viskositas</td>
                            <td class="record-value">{{ $number($item->viskositas) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Salinity</td>
                            <td class="record-value">{{ $number($item->salinity) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">PREDUST BREADER</div>

            @if ($predustBreaders->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($predustBreaders as $index => $item)
                    @if ($predustBreaders->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Predust Breader</td>
                            <td class="record-value">{{ $item->predust_breader ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Superflex</td>
                            <td class="record-value">{{ $number($item->superflex) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">FRYER</div>

            @if ($fryers->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($fryers as $index => $item)
                    @if ($fryers->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Suhu Setting</td>
                            <td class="record-value">{{ $number($item->suhu_setting) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Suhu Aktual</td>
                            <td class="record-value">{{ $number($item->suhu_aktual) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Lama Pemasakan</td>
                            <td class="record-value">{{ $number($item->lama_pemasakan) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">TPM Minyak</td>
                            <td class="record-value">{{ $number($item->tpm_minyak) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">HLT</div>

            @if ($hlts->count() === 0)
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @else
                @foreach ($hlts as $index => $item)
                    @if ($hlts->count() > 1)
                        <table>
                            <tr>
                                <td class="record-title">DATA KE-{{ $index + 1 }}</td>
                            </tr>
                        </table>
                    @endif

                    <table>
                        <tr>
                            <td class="record-label">Suhu Awal Daging</td>
                            <td class="record-value">{{ $number($item->suhu_awal_daging) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Suhu Infeed</td>
                            <td class="record-value">{{ $number($item->suhu_infeed) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Suhu Outfeed</td>
                            <td class="record-value">{{ $number($item->suhu_outfeed) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Steam Valve</td>
                            <td class="record-value">{{ $number($item->steam_valve) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Speed Ventilator</td>
                            <td class="record-value">{{ $number($item->speed_ventilator) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Lama Pemasakan</td>
                            <td class="record-value">{{ $number($item->lama_pemasakan) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Suhu Pusat CT</td>
                            <td class="record-value">{{ $number($item->suhu_pusat_ct) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Organoleptik</td>
                            <td class="record-value">{{ $item->organoleptik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Mulai</td>
                            <td class="record-value">{{ $time($item->waktu_mulai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Waktu Selesai</td>
                            <td class="record-value">{{ $time($item->waktu_selesai) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Downtime</td>
                            <td class="record-value">{{ $number($item->downtime) }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Keterangan</td>
                            <td class="record-value">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Petugas</td>
                            <td class="record-value">{{ $item->petugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">Line</td>
                            <td class="record-value">{{ $item->line ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="record-label">PIC Produksi</td>
                            <td class="record-value">{{ $item->pic_produksi ?? '-' }}</td>
                        </tr>
                    </table>
                @endforeach
            @endif
        </div>

        <div class="section">
            <div class="section-title">KEMASAN RIJEK</div>

            @if ($rijek)
                <table class="rijek-table">
                    <tr>
                        <th>KATEGORI</th>
                        <th>COOKING (Kg)</th>
                        <th>PACKING (Kg)</th>
                    </tr>
                    <tr>
                        <td>Rusak</td>
                        <td>{{ $number($rijek->rusak_cooking ?? 0) }}</td>
                        <td>{{ $number($rijek->rusak_packing ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>Jatuh Lantai</td>
                        <td>{{ $number($rijek->jatuh_lantai_cooking ?? 0) }}</td>
                        <td>{{ $number($rijek->jatuh_lantai_packing ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>Kulit</td>
                        <td>{{ $number($rijek->kulit_cooking ?? 0) }}</td>
                        <td>{{ $number($rijek->kulit_packing ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>Serpihan</td>
                        <td>{{ $number($rijek->serpihan_cooking ?? 0) }}</td>
                        <td>{{ $number($rijek->serpihan_packing ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>Serbuk</td>
                        <td>{{ $number($rijek->serbuk_cooking ?? 0) }}</td>
                        <td>{{ $number($rijek->serbuk_packing ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>Gosong</td>
                        <td>{{ $number($rijek->gosong_cooking ?? 0) }}</td>
                        <td>{{ $number($rijek->gosong_packing ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>Sampel QC</td>
                        <td>{{ $number($rijek->sampel_qc_cooking ?? 0) }}</td>
                        <td>{{ $number($rijek->sampel_qc_packing ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>Lain-lain</td>
                        <td>{{ $number($rijek->lain_lain_cooking_kg ?? 0) }}</td>
                        <td>{{ $number($rijek->lain_lain_packing_kg ?? 0) }}</td>
                    </tr>
                    <tr>
                        <td>TOTAL RIJEK</td>
                        <td>{{ $number($rijek->total_rijek_cooking_kg ?? 0) }}</td>
                        <td>{{ $number($rijek->total_rijek_packing_kg ?? 0) }}</td>
                    </tr>
                </table>
            @else
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @endif
        </div>

        <table class="approval">
            <tr>
                <td width="50%">
                    DIBUAT OLEH
                    <div class="approval-space"></div>
                    (........................................)
                </td>
                <td width="50%">
                    DIPERIKSA OLEH
                    <div class="approval-space"></div>
                    (........................................)
                </td>
            </tr>
        </table>

    </div>

    <div class="page-break"></div>

    <div class="page">

        <div class="header">
            <div class="company">PT CHAROEN POKPHAND INDONESIA</div>
            <div class="division">FOOD DIVISION</div>
            <div class="title">LAPORAN PENGENDALIAN PRODUK</div>
            <div class="batch">
                PRODUCTION BATCH : {{ $productionBatch->no_batch ?? '-' }}
            </div>
        </div>

        <div class="section">
            <div class="section-title">PEMBEKUAN</div>

            @if ($pembekuan)
                <table>
                    <tr>
                        <td class="record-label">Suhu Ruang Packing</td>
                        <td class="record-value">{{ $pembekuan->suhu_ruang_packing ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Suhu Ruang IQF</td>
                        <td class="record-value">{{ $pembekuan->suhu_ruang_iqf ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Speed Conveyor</td>
                        <td class="record-value">{{ $pembekuan->speed_conveyor ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Suhu Pusat</td>
                        <td class="record-value">{{ $pembekuan->suhu_pusat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Waktu Mulai</td>
                        <td class="record-value">{{ $time($pembekuan->waktu_mulai) }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Waktu Selesai</td>
                        <td class="record-value">{{ $time($pembekuan->waktu_selesai) }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Lama Waktu Kerusakan</td>
                        <td class="record-value">{{ $pembekuan->lama_waktu_kerusakan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Lama Waktu Istirahat</td>
                        <td class="record-value">{{ $pembekuan->lama_waktu_istirahat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Operator</td>
                        <td class="record-value">{{ $pembekuan->operator ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Line</td>
                        <td class="record-value">{{ $pembekuan->line ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">PIC Produksi</td>
                        <td class="record-value">{{ $pembekuan->pic_produksi ?? '-' }}</td>
                    </tr>
                </table>
            @else
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @endif
        </div>

        <div class="section">
            <div class="section-title">PACKING DALAM</div>

            @if ($packingDalam)
                <table>
                    <tr>
                        <td class="record-label">MHW Korin</td>
                        <td class="record-value">{{ $packingDalam->mhw_korin ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Heating Level</td>
                        <td class="record-value">{{ $packingDalam->heating_level ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Speed</td>
                        <td class="record-value">{{ $packingDalam->speed ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Pressure</td>
                        <td class="record-value">{{ $packingDalam->pressure ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Packing Manual</td>
                        <td class="record-value">{{ $packingDalam->packing_manual ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Timbangan</td>
                        <td class="record-value">{{ $packingDalam->timbangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Heating Level Packing Manual</td>
                        <td class="record-value">{{ $packingDalam->heating_level_packing_manual ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Metal Detector</td>
                        <td class="record-value">{{ $packingDalam->metal_detector ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Fe / Sus / Non Fe</td>
                        <td class="record-value">{{ $packingDalam->fe_sus_non_fe ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Checkweigher PAC</td>
                        <td class="record-value">{{ $packingDalam->checkweigher_pac ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Petugas Sortasi After IQF</td>
                        <td class="record-value">{{ $packingDalam->petugas_sortasi_after_iqf ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Operator MD</td>
                        <td class="record-value">{{ $packingDalam->operator_md ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Leader Produksi</td>
                        <td class="record-value">{{ $packingDalam->leader_produksi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Waktu Awal</td>
                        <td class="record-value">{{ $time($packingDalam->waktu_awal) }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Waktu Akhir</td>
                        <td class="record-value">{{ $time($packingDalam->waktu_akhir) }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Line</td>
                        <td class="record-value">{{ $packingDalam->line ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">PIC Produksi</td>
                        <td class="record-value">{{ $packingDalam->pic_produksi ?? '-' }}</td>
                    </tr>
                </table>
            @else
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @endif
        </div>

        <div class="section">
            <div class="section-title">SAMPLING PACKING DALAM</div>

            <table>
                <tr>
                    <th>Sampling Ke</th>
                    <th>Berat Kemasan</th>
                    <th>Berat Per Bag</th>
                    <th>Range Berat</th>
                </tr>

                @forelse(($productionBatch->packingDalams ?? collect())->flatMap->samplings as $sampling)
                    <tr>
                        <td align="center">{{ $sampling->sampling_ke ?? '-' }}</td>
                        <td align="center">{{ $sampling->berat_kemasan ?? '-' }}</td>
                        <td align="center">{{ $sampling->berat_per_bag ?? '-' }}</td>
                        <td align="center">{{ $sampling->range_berat ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="no-data">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div class="section">
            <div class="section-title">PENGGUNAAN PLASTIK</div>

            <table>
                <tr>
                    <th width="35%">Product</th>
                    <th width="13%">Jumlah</th>
                    <th width="18%">Pemakaian</th>
                    <th width="17%">Sisa</th>
                    <th width="17%">Rijek</th>
                </tr>

                @forelse(($productionBatch->packingDalams ?? collect())->flatMap->plastiks as $plastik)
                    <tr>
                        <td>{{ $plastik->product->nama ?? '-' }}</td>
                        <td align="center">{{ $plastik->jumlah ?? '-' }}</td>
                        <td align="center">{{ $plastik->pemakaian ?? '-' }}</td>
                        <td align="center">{{ $plastik->sisa ?? '-' }}</td>
                        <td align="center">{{ $plastik->rijek ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="no-data">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div class="section">
            <div class="section-title">PACKING LUAR</div>

            @if ($packingLuar)
                <table>
                    <tr>
                        <td class="record-label">Pengisian ke Dalam Box</td>
                        <td class="record-value">{{ $packingLuar->pengisian_ke_dalam_box ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Sealer Box</td>
                        <td class="record-value">{{ $packingLuar->sealer_box ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Check Weigher Box</td>
                        <td class="record-value">{{ $packingLuar->check_weigher_box ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Petugas</td>
                        <td class="record-value">{{ $packingLuar->petugas ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">PIC Produksi</td>
                        <td class="record-value">{{ $packingLuar->pic_produksi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Waktu Awal</td>
                        <td class="record-value">{{ $time($packingLuar->waktu_awal) }}</td>
                    </tr>
                    <tr>
                        <td class="record-label">Waktu Akhir</td>
                        <td class="record-value">{{ $time($packingLuar->waktu_akhir) }}</td>
                    </tr>
                </table>
            @else
                <table>
                    <tr>
                        <td class="no-data">Tidak ada data</td>
                    </tr>
                </table>
            @endif
        </div>

        <div class="section">
            <div class="section-title">SAMPLING PACKING LUAR</div>

            <table>
                <tr>
                    <th width="20%">Sampling Ke</th>
                    <th width="40%">Berat Per Box</th>
                    <th width="40%">Range Berat</th>
                </tr>

                @forelse(($productionBatch->packingLuars ?? collect())->flatMap->samplings as $sampling)
                    <tr>
                        <td align="center">{{ $sampling->sampling_ke ?? '-' }}</td>
                        <td align="center">{{ $sampling->berat_per_box ?? '-' }}</td>
                        <td align="center">{{ $sampling->range_berat ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="no-data">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div class="section">
            <div class="section-title">PENGEMASAN BOX</div>

            <table>
                <tr>
                    <th width="32%">Product</th>
                    <th width="13%">Jumlah</th>
                    <th width="16%">Pemakaian</th>
                    <th width="13%">Sisa</th>
                    <th width="13%">Rijek</th>
                    <th width="13%">Petugas</th>
                </tr>

                @forelse(($productionBatch->packingLuars ?? collect())->flatMap->kemasans as $kemasan)
                    <tr>
                        <td>{{ $kemasan->product->nama ?? '-' }}</td>
                        <td align="center">{{ $kemasan->jumlah ?? '-' }}</td>
                        <td align="center">{{ $kemasan->pemakaian ?? '-' }}</td>
                        <td align="center">{{ $kemasan->sisa ?? '-' }}</td>
                        <td align="center">{{ $kemasan->rijek ?? '-' }}</td>
                        <td align="center">{{ $kemasan->petugas ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-data">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div class="section">
            <div class="section-title">PALET</div>

            <table>
                <tr>
                    <th width="15%">No. Palet</th>
                    <th width="27%">Product</th>
                    <th width="14%">Jumlah Pack</th>
                    <th width="14%">Jumlah Box</th>
                    <th width="15%">Jumlah Kg</th>
                    <th width="15%">No. BSTB</th>
                </tr>

                @forelse(($productionBatch->packingLuars ?? collect())->flatMap->palets as $palet)
                    <tr>
                        <td align="center">{{ $palet->no_palet ?? '-' }}</td>
                        <td>{{ $palet->product->nama ?? '-' }}</td>
                        <td align="center">{{ $palet->jumlah_pack ?? '-' }}</td>
                        <td align="center">{{ $palet->jumlah_box ?? '-' }}</td>
                        <td align="center">{{ $palet->jumlah_kg ?? '-' }}</td>
                        <td align="center">{{ $palet->no_bstb ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-data">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <table class="approval">
            <tr>
                <td width="50%">
                    DIBUAT OLEH
                    <div class="approval-space"></div>
                    (........................................)
                </td>

                <td width="50%">
                    DIPERIKSA OLEH
                    <div class="approval-space"></div>
                    (........................................)
                </td>
            </tr>
        </table>

    </div>

</body>

</html>
