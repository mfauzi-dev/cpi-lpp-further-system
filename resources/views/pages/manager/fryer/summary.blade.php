@extends('layouts.master')

@section('title', 'Summary Fryer')

@push('addon-style')
    <style>
        :root {
            --fry-primary: #1B4B43;
            --fry-primary-light: #E8F0EE;
            --fry-accent: #D98C3D;
            --fry-border: #E3E7E1;
            --fry-text: #1F2A24;
            --fry-muted: #5B6A62;
            --fry-soft: #F7F9F7;
        }

        .fryer-summary .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--fry-text);
        }

        .fryer-summary .section-lead {
            color: var(--fry-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .fryer-summary .card {
            border: none;
            border-left: 4px solid var(--fry-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .fryer-summary .card.card-final {
            border-left-color: var(--fry-accent);
        }

        .fryer-summary .card-header {
            background: #fff;
            border-bottom: 1px solid var(--fry-border);
            padding: 1rem 1.5rem;
        }

        .fryer-summary .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--fry-text);
        }

        .fryer-summary .card-body {
            padding: 1.5rem;
        }

        .fryer-summary .filter-label {
            color: var(--fry-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .fryer-summary .form-control {
            border-color: var(--fry-border);
            color: var(--fry-text);
            border-radius: 7px;
        }

        .fryer-summary .form-control:focus {
            border-color: var(--fry-primary);
            box-shadow: 0 0 0 0.2rem rgba(27, 75, 67, 0.12);
        }

        .fryer-summary .btn-primary {
            background: var(--fry-primary);
            border-color: var(--fry-primary);
        }

        .fryer-summary .btn-primary:hover,
        .fryer-summary .btn-primary:focus {
            background: #28665A;
            border-color: #28665A;
        }

        .fryer-summary .btn-ghost {
            color: var(--fry-muted);
            background: transparent;
            border: 1px solid var(--fry-border);
        }

        .fryer-summary .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--fry-text);
        }

        .fryer-summary .summary-card {
            height: 100%;
            background: var(--fry-soft);
            border: 1px solid var(--fry-border);
            border-left: 4px solid var(--fry-primary);
            border-radius: 9px;
        }

        .fryer-summary .summary-card .card-body {
            padding: 1.15rem 1.2rem;
        }

        .fryer-summary .summary-label {
            color: var(--fry-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 0.3rem;
        }

        .fryer-summary .summary-value {
            color: var(--fry-text);
            font-size: 1.35rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .fryer-summary .summary-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--fry-primary);
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .fryer-summary .summary-card.warning {
            border-left-color: var(--fry-accent);
        }

        .fryer-summary .summary-card.warning .summary-icon {
            color: var(--fry-accent);
        }

        .fryer-summary .summary-card.success .summary-icon {
            color: var(--fry-primary);
        }

        .fryer-summary .chart-item {
            margin-bottom: 35px;
        }

        .fryer-summary .chart-item:last-child {
            margin-bottom: 0;
        }

        .fryer-summary .chart-title {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 12px;
            color: var(--fry-text);
        }

        .fryer-summary .chart-title i {
            color: var(--fry-primary);
        }

        .fryer-summary .chart-subtitle {
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--fry-muted);
            margin: 28px 0 10px;
        }

        .fryer-summary .chart-wrapper {
            position: relative;
            width: 100%;
            height: 350px;
        }

        .fryer-summary .zone-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            font-size: 12px;
            color: var(--fry-muted);
            margin-bottom: 18px;
        }

        .fryer-summary .zone-legend span {
            display: inline-flex;
            align-items: center;
        }

        .fryer-summary .zone-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
            display: inline-block;
        }

        .fryer-summary .pie-wrapper {
            position: relative;
            width: 100%;
            height: 320px;
        }

        .fryer-summary .pie-stat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid var(--fry-border);
            background: var(--fry-soft);
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 10px;
        }

        .fryer-summary .pie-stat:last-child {
            margin-bottom: 0;
        }

        .fryer-summary .pie-stat-name {
            display: flex;
            align-items: center;
            color: var(--fry-text);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .fryer-summary .pie-stat-range {
            display: block;
            color: var(--fry-muted);
            font-size: 0.75rem;
            font-weight: 400;
        }

        .fryer-summary .pie-stat-value {
            color: var(--fry-text);
            font-size: 1.15rem;
            font-weight: 700;
            text-align: right;
        }

        .fryer-summary .pie-stat-value small {
            display: block;
            color: var(--fry-muted);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .fryer-summary .empty-chart {
            text-align: center;
            padding: 50px 20px;
            color: var(--fry-muted);
        }

        .fryer-summary .empty-chart i {
            color: var(--fry-primary);
        }

        .fryer-summary .monitor-box {
            border: 1px solid var(--fry-border);
            background: var(--fry-soft);
            border-radius: 8px;
            padding: 20px;
            height: 100%;
        }

        .fryer-summary .monitor-label {
            color: var(--fry-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 5px;
        }

        .fryer-summary .monitor-value {
            color: var(--fry-text);
            font-size: 24px;
            font-weight: 700;
        }

        .fryer-summary .status-badge {
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .fryer-summary .badge-success {
            background: var(--fry-primary-light);
            color: var(--fry-primary);
        }

        .fryer-summary .badge-warning {
            background: #FDF0E3;
            color: var(--fry-accent);
        }

        .fryer-summary .badge-danger {
            background: #FDF0E3;
            color: var(--fry-accent);
        }

        .fryer-summary .badge-secondary {
            background: #EEF1EF;
            color: var(--fry-muted);
        }

        .fryer-summary .badge-suhu {
            display: inline-block;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .fryer-summary .badge-suhu-success {
            background: #d4edda;
            color: #155724;
        }

        .fryer-summary .badge-suhu-warning {
            background: #fff3cd;
            color: #856404;
        }

        .fryer-summary .badge-suhu-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .fryer-summary .badge-tipe {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
            background: #EEF1EF;
            color: var(--fry-muted);
            text-transform: capitalize;
        }

        .fryer-summary .progress {
            height: 8px;
            background: #E5EBE7;
            border-radius: 10px;
        }

        .fryer-summary .progress-bar {
            background: var(--fry-primary) !important;
        }

        .fryer-summary .table thead th {
            color: var(--fry-text);
            background: var(--fry-soft);
            border-bottom: 1px solid var(--fry-border);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .fryer-summary .table tbody td {
            color: var(--fry-text);
            vertical-align: middle;
            border-color: var(--fry-border);
        }

        .fryer-summary .table-hover tbody tr:hover {
            background: var(--fry-primary-light);
        }

        .fryer-summary .btn-light {
            color: var(--fry-muted);
            background: #fff;
            border-color: var(--fry-border);
        }

        .fryer-summary .btn-light:hover {
            background: #F3F5F3;
            color: var(--fry-text);
        }

        @media (max-width: 767.98px) {
            .fryer-summary .card-body {
                padding: 1rem;
            }

            .fryer-summary .card-header {
                padding: 0.9rem 1rem;
            }

            .fryer-summary .chart-wrapper {
                height: 300px;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $isManager = request()->routeIs('manager.fryer.summary');
        $summaryRoute = $isManager ? route('manager.fryer.summary') : route('operator.fryer.summary');
        $backRoute = $isManager ? route('manager.fryer.index') : route('operator.fryer.index');

        $persentaseSesuai = (float) ($persentaseSesuai ?? 0);

        $suhuPusatRataRata =
            isset($suhuPusatRataRata) && $suhuPusatRataRata !== null ? (float) $suhuPusatRataRata : null;

        $chartData = collect($chartData ?? [])->map(function ($item) {
            return (object) $item;
        });

        $lines = collect($lines ?? []);
        $fryersList = $fryersList ?? [];

        /**
         * ================== ATURAN AMBANG BATAS SUHU PUSAT ==================
         * forming (atau tipe_proses kosong/null):
         *   Merah   : < 76 atau > 80
         *   Kuning  : 76 - 76,5  dan  79,5 - 80
         *   Hijau   : 76,5 - 79,5
         *
         * non_forming / non_forming_roasted:
         *   Merah   : < 76 atau > 95
         *   Kuning  : 76 - 76,5  dan  94 - 95
         *   Hijau   : 76,5 - 94
         * ======================================================================
         */
        $getThreshold = function (?string $tipeProses) {
            if (in_array($tipeProses, ['non_forming', 'non_forming_roasted'], true)) {
                return ['low' => 76, 'greenLow' => 76.5, 'greenHigh' => 94, 'high' => 95];
            }

            // forming / null / default
            return ['low' => 76, 'greenLow' => 76.5, 'greenHigh' => 79.5, 'high' => 80];
        };

        $classifySuhu = function ($suhu, ?string $tipeProses) use ($getThreshold) {
            if ($suhu === null) {
                return null;
            }

            $t = $getThreshold($tipeProses);
            $v = (float) $suhu;

            if ($v >= $t['greenLow'] && $v <= $t['greenHigh']) {
                return 'success';
            }

            if (($v >= $t['low'] && $v < $t['greenLow']) || ($v > $t['greenHigh'] && $v <= $t['high'])) {
                return 'warning';
            }

            return 'danger';
        };

        $statusLabel = [
            'success' => 'Sesuai',
            'warning' => 'Waspada',
            'danger' => 'Di Luar Batas',
        ];

        $tipeProsesLabel = function (?string $tipeProses) {
            return $tipeProses ? ucwords(str_replace('_', ' ', $tipeProses)) : 'Forming';
        };

        // ---- Sesuai / Di Bawah Minimum (dibandingkan ke kolom suhu_minimum, TIDAK berubah oleh tipe_proses) ----
        $totalRecord = $chartData->count();
        $sesuaiMinimum = 0;
        $diBawahMinimum = 0;

        foreach ($chartData as $item) {
            if ($item->suhu_pusat !== null && $item->suhu_minimum !== null) {
                if ((float) $item->suhu_pusat >= (float) $item->suhu_minimum) {
                    $sesuaiMinimum++;
                } else {
                    $diBawahMinimum++;
                }
            }
        }

        $persentaseSesuai = $totalRecord > 0 ? ($sesuaiMinimum / $totalRecord) * 100 : 0;

        $chartByDate = $chartData->groupBy(function ($item) {
            return substr((string) $item->tanggal, 0, 10);
        });

        // ---- Distribusi status Suhu Pusat (pie chart) — pakai classifySuhu() sesuai tipe_proses ----
        $pieCount = ['success' => 0, 'warning' => 0, 'danger' => 0];

        foreach ($chartData as $item) {
            $status = $classifySuhu($item->suhu_pusat ?? null, $item->tipe_proses ?? null);

            if ($status !== null) {
                $pieCount[$status]++;
            }
        }

        $pieTotal = array_sum($pieCount);

        $pieMeta = [
            'success' => ['Sesuai', 'Forming 76,5-79,5 °C / Non-Forming 76,5-94 °C', '#28a745'],
            'warning' => ['Waspada', 'Forming 76-76,5 & 79,5-80 °C / Non-Forming 76-76,5 & 94-95 °C', '#F0AD00'],
            'danger' => ['Di Luar Batas', 'Forming <76 / >80 °C / Non-Forming <76 / >95 °C', '#dc3545'],
        ];
    @endphp

    <div class="section fryer-summary">
        <div class="section-header">
            <h1>Summary Fryer</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ $backRoute }}">Fryer</a>
                </div>

                <div class="breadcrumb-item active">Summary</div>
            </div>
        </div>

        <div class="section-lead">
            Ringkasan monitoring suhu proses produksi menggunakan Fryer berdasarkan production batch yang telah dicatat.
        </div>

        <div class="section-body">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-filter mr-2" style="color: var(--fry-primary);"></i>
                        Filter Data
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ $summaryRoute }}" method="GET">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="line" class="filter-label">Line</label>

                                <select name="line" id="line" class="form-control">
                                    <option value="">Semua Line</option>

                                    @foreach ($lines as $line)
                                        @php
                                            $lineValue = is_array($line)
                                                ? $line['line'] ?? ($line['name'] ?? $line)
                                                : $line;
                                        @endphp

                                        <option value="{{ $lineValue }}"
                                            {{ request('line') == $lineValue ? 'selected' : '' }}>
                                            {{ $lineValue }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="fryer" class="filter-label">Fryer</label>

                                <select name="fryer" id="fryer" class="form-control">
                                    <option value="">Semua Fryer</option>

                                    @foreach ($fryersList as $fryer)
                                        @php
                                            $fryerValue = is_array($fryer)
                                                ? $fryer['fryer'] ?? ($fryer['value'] ?? $fryer)
                                                : $fryer;
                                        @endphp

                                        <option value="{{ $fryerValue }}"
                                            {{ request('fryer') == $fryerValue ? 'selected' : '' }}>
                                            Fryer {{ $fryerValue }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="date_from" class="filter-label">Tanggal Mulai</label>

                                <input type="date" name="date_from" id="date_from" class="form-control"
                                    value="{{ request('date_from') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="date_to" class="filter-label">Tanggal Selesai</label>

                                <input type="date" name="date_to" id="date_to" class="form-control"
                                    value="{{ request('date_to') }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="bi bi-funnel mr-1"></i>
                                Terapkan Filter
                            </button>

                            <a href="{{ $summaryRoute }}" class="btn btn-light">
                                <i class="bi bi-arrow-clockwise mr-1"></i>
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card summary-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="summary-label">Total Record</div>
                                    <div class="summary-value">{{ number_format($totalRecord, 0, ',', '.') }}</div>
                                </div>

                                <div class="summary-icon"><i class="fas fa-database"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card summary-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="summary-label">Rata-rata Suhu Pusat</div>

                                    <div class="summary-value">
                                        @if ($suhuPusatRataRata !== null)
                                            {{ number_format($suhuPusatRataRata, 2, ',', '.') }} °C
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>

                                <div class="summary-icon"><i class="fas fa-temperature-high"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card summary-card success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="summary-label">Sesuai Minimum</div>
                                    <div class="summary-value">{{ number_format($sesuaiMinimum, 0, ',', '.') }}</div>
                                </div>

                                <div class="summary-icon"><i class="fas fa-check-circle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card summary-card warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="summary-label">Di Bawah Minimum</div>
                                    <div class="summary-value">{{ number_format($diBawahMinimum, 0, ',', '.') }}</div>
                                </div>

                                <div class="summary-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-chart-line mr-2" style="color: var(--fry-primary);"></i>
                        Perbandingan Suhu Antar Batch
                    </h4>
                </div>

                <div class="card-body">
                    @if ($chartByDate->count() > 0)
                        <div class="zone-legend">
                            <span><i class="zone-dot" style="background:#28a745;"></i>Hijau: Sesuai (Forming 76,5-79,5 °C /
                                Non-Forming 76,5-94 °C)</span>
                            <span><i class="zone-dot" style="background:#F0AD00;"></i>Kuning: Waspada (Forming 76-76,5 &amp;
                                79,5-80 °C / Non-Forming 76-76,5 &amp; 94-95 °C)</span>
                            <span><i class="zone-dot" style="background:#dc3545;"></i>Merah: Di Luar Batas (Forming &lt;76 /
                                &gt;80 °C / Non-Forming &lt;76 / &gt;95 °C)</span>
                        </div>

                        @foreach ($chartByDate as $tanggal => $items)
                            <div class="chart-item">
                                <div class="chart-title">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                                </div>

                                <div class="chart-subtitle">Grafik Garis</div>

                                <div class="chart-wrapper">
                                    <canvas id="fryerChart{{ str_replace('-', '', $tanggal) }}"></canvas>
                                </div>

                                <div class="chart-subtitle">Grafik Batang</div>

                                <div class="chart-wrapper">
                                    <canvas id="fryerBar{{ str_replace('-', '', $tanggal) }}"></canvas>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-chart">
                            <i class="fas fa-chart-line fa-3x mb-3"></i>

                            <h6>Belum ada data grafik</h6>

                            <p class="mb-0">Data suhu akan tampil setelah filter diterapkan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-chart-pie mr-2" style="color: var(--fry-primary);"></i>
                        Distribusi Status Suhu Pusat
                    </h4>
                </div>

                <div class="card-body">
                    @if ($pieTotal > 0)
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="pie-wrapper">
                                    <canvas id="fryerPie"></canvas>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @foreach ($pieMeta as $key => $meta)
                                    <div class="pie-stat">
                                        <div class="pie-stat-name">
                                            <i class="zone-dot"
                                                style="background: {{ $meta[2] }}; width: 12px; height: 12px; margin-right: 10px;"></i>
                                            <div>
                                                {{ $meta[0] }}
                                                <span class="pie-stat-range">{{ $meta[1] }}</span>
                                            </div>
                                        </div>

                                        <div class="pie-stat-value">
                                            {{ number_format($pieCount[$key], 0, ',', '.') }}
                                            <small>{{ number_format(($pieCount[$key] / $pieTotal) * 100, 1, ',', '.') }}%</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="empty-chart">
                            <i class="fas fa-chart-pie fa-3x mb-3"></i>

                            <h6>Belum ada data</h6>

                            <p class="mb-0">Pie chart akan tampil setelah ada data suhu pusat.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-chart-pie mr-2" style="color: var(--fry-primary);"></i>
                        Tingkat Kepatuhan Suhu
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="monitor-box">
                                <div class="monitor-label">Persentase Sesuai Minimum</div>

                                <div class="monitor-value">
                                    {{ number_format($persentaseSesuai, 2, ',', '.') }}%
                                </div>

                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ min(max($persentaseSesuai, 0), 100) }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="monitor-box">
                                <div class="monitor-label">Status Monitoring</div>

                                <div class="monitor-value">
                                    @if ($totalRecord === 0)
                                        -
                                    @elseif ($diBawahMinimum > 0)
                                        Perlu Monitoring
                                    @else
                                        Sesuai
                                    @endif
                                </div>

                                <div class="mt-2">
                                    @if ($totalRecord === 0)
                                        <span class="badge badge-secondary status-badge">Belum Ada Data</span>
                                    @elseif ($diBawahMinimum > 0)
                                        <span class="badge badge-warning status-badge">Ada Data Di Bawah Minimum</span>
                                    @else
                                        <span class="badge badge-success status-badge">Semua Sesuai Minimum</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-temperature-high mr-2" style="color: var(--fry-primary);"></i>
                        Monitoring Suhu Fryer
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="monitor-box">
                                <div class="monitor-label">Total Record</div>
                                <div class="monitor-value">{{ number_format($totalRecord, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="monitor-box">
                                <div class="monitor-label">Sesuai Minimum</div>
                                <div class="monitor-value" style="color: var(--fry-primary);">
                                    {{ number_format($sesuaiMinimum, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="monitor-box">
                                <div class="monitor-label">Di Bawah Minimum</div>
                                <div class="monitor-value" style="color: var(--fry-accent);">
                                    {{ number_format($diBawahMinimum, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-list mr-2" style="color: var(--fry-primary);"></i>
                        Detail Monitoring
                    </h4>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Production Batch</th>
                                    <th>Kode Product</th>
                                    <th>Nama Product</th>
                                    <th>Line</th>
                                    <th>Fryer</th>
                                    <th>Tipe Proses</th>
                                    <th>Suhu Pusat</th>
                                    <th>Suhu Minimum</th>
                                    <th>Organoleptik</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($chartData as $index => $item)
                                    @php
                                        $suhuClass = $classifySuhu(
                                            $item->suhu_pusat ?? null,
                                            $item->tipe_proses ?? null,
                                        );
                                        $suhuStatusText = $suhuClass ? $statusLabel[$suhuClass] : '';
                                    @endphp

                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                        <td>{{ $item->no_batch ?? '-' }}</td>
                                        <td>{{ $item->kode_product ?? '-' }}</td>
                                        <td>{{ $item->nama_product ?? '-' }}</td>
                                        <td>{{ $item->line ?? '-' }}</td>
                                        <td>Fryer {{ $item->fryer ?? '-' }}</td>
                                        <td><span
                                                class="badge-tipe">{{ $tipeProsesLabel($item->tipe_proses ?? null) }}</span>
                                        </td>

                                        <td>
                                            @if ($item->suhu_pusat !== null)
                                                <span class="badge-suhu badge-suhu-{{ $suhuClass }}">
                                                    {{ number_format((float) $item->suhu_pusat, 2, ',', '.') }} °C
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->suhu_minimum !== null)
                                                {{ number_format((float) $item->suhu_minimum, 2, ',', '.') }} °C
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>{{ $item->organoleptik ?? '-' }}</td>

                                        <td>
                                            @if ($suhuClass === null)
                                                <span class="badge badge-secondary status-badge">Belum Lengkap</span>
                                            @else
                                                <span class="badge-suhu badge-suhu-{{ $suhuClass }}"
                                                    style="font-size: 11px;">
                                                    {{ $suhuStatusText }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center py-4">
                                            Belum ada data monitoring.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <a href="{{ $backRoute }}" class="btn btn-ghost">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);

            const COLOR = {
                success: '#28a745',
                warning: '#F0AD00',
                danger: '#dc3545'
            };

            /**
             * Ambang batas suhu mengikuti tipe_proses per titik data.
             * forming/null            : low 76, greenLow 76.5, greenHigh 79.5, high 80
             * non_forming(_roasted)   : low 76, greenLow 76.5, greenHigh 94,   high 95
             */
            function getThreshold(tipeProses) {
                if (tipeProses === 'non_forming' || tipeProses === 'non_forming_roasted') {
                    return {
                        low: 76,
                        greenLow: 76.5,
                        greenHigh: 94,
                        high: 95
                    };
                }
                return {
                    low: 76,
                    greenLow: 76.5,
                    greenHigh: 79.5,
                    high: 80
                };
            }

            function getStatus(v, tipeProses) {
                if (v === null || v === undefined || isNaN(v)) return null;
                const t = getThreshold(tipeProses);
                if (v >= t.greenLow && v <= t.greenHigh) return 'success';
                if ((v >= t.low && v < t.greenLow) || (v > t.greenHigh && v <= t.high)) return 'warning';
                return 'danger';
            }

            function statusText(status, tipeProses) {
                const t = getThreshold(tipeProses);
                const map = {
                    success: 'Sesuai (' + t.greenLow + ' - ' + t.greenHigh + ')',
                    warning: 'Waspada (' + t.low + ' - ' + t.greenLow + ' / ' + t.greenHigh + ' - ' + t.high +
                        ')',
                    danger: 'Di luar batas (<' + t.low + ' / >' + t.high + ')'
                };
                return map[status] || '-';
            }

            // ===== Background zona: strip per-kolom, mengikuti tipe_proses tiap titik =====
            // (diganti dari garis batas horizontal flat, karena forming & non_forming bisa
            // tercampur dalam satu chart per tanggal sehingga batasnya tidak seragam)
            const zoneBands = {
                id: 'zoneBands',
                beforeDatasetsDraw(chart) {
                    const {
                        ctx,
                        chartArea,
                        scales
                    } = chart;
                    const x = scales.x;
                    const y = scales.y;
                    const items = chart.$fryerItems;
                    if (!chartArea || !x || !y || !items) return;

                    ctx.save();

                    items.forEach(function(item, idx) {
                        const t = getThreshold(item.tipe_proses);

                        const bands = [
                            [-Infinity, t.low, 'rgba(220, 53, 69, 0.07)'],
                            [t.low, t.greenLow, 'rgba(240, 173, 0, 0.13)'],
                            [t.greenLow, t.greenHigh, 'rgba(40, 167, 69, 0.09)'],
                            [t.greenHigh, t.high, 'rgba(240, 173, 0, 0.13)'],
                            [t.high, Infinity, 'rgba(220, 53, 69, 0.07)']
                        ];

                        const centerPx = x.getPixelForValue(idx);
                        const leftPx = idx === 0 ?
                            chartArea.left :
                            (x.getPixelForValue(idx - 1) + centerPx) / 2;
                        const rightPx = idx === items.length - 1 ?
                            chartArea.right :
                            (centerPx + x.getPixelForValue(idx + 1)) / 2;

                        bands.forEach(function(b) {
                            const top = Math.min(b[1], y.max);
                            const bottom = Math.max(b[0], y.min);
                            if (top <= bottom) return;

                            const pxTop = y.getPixelForValue(top);
                            const pxBottom = y.getPixelForValue(bottom);

                            ctx.fillStyle = b[2];
                            ctx.fillRect(leftPx, pxTop, rightPx - leftPx, pxBottom - pxTop);
                        });
                    });

                    ctx.restore();
                }
            };

            function fmt(value) {
                return Number(value).toLocaleString('id-ID', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function buildOptions(items, values, minimums) {
                const all = values.concat(minimums).filter(function(v) {
                    return v !== null && !isNaN(v);
                });

                // batas Y mengikuti nilai terbesar antara data & ambang batas non_forming (95)
                const thresholdsInPlay = items.map(function(item) {
                    return getThreshold(item.tipe_proses);
                });
                const allHigh = thresholdsInPlay.map(function(t) {
                    return t.high;
                });
                const allLow = thresholdsInPlay.map(function(t) {
                    return t.low;
                });

                const yMin = Math.floor(Math.min(...allLow, ...all)) - 1;
                const yMax = Math.ceil(Math.max(...allHigh, ...all)) + 1;

                return {
                    responsive: true,
                    maintainAspectRatio: false,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',

                            labels: {
                                color: '#1F2A24',
                                usePointStyle: true,
                                padding: 18
                            }
                        },

                        tooltip: {
                            backgroundColor: '#1F2A24',
                            titleColor: '#FFFFFF',
                            bodyColor: '#FFFFFF',
                            borderColor: '#E3E7E1',
                            borderWidth: 1,

                            callbacks: {
                                title: function(tooltipItems) {
                                    if (!tooltipItems.length) return '';
                                    const item = items[tooltipItems[0].dataIndex];
                                    return 'Batch ' + String(item.no_batch ?? '-');
                                },

                                beforeBody: function(tooltipItems) {
                                    if (!tooltipItems.length) return [];
                                    const item = items[tooltipItems[0].dataIndex];

                                    return [
                                        'Tanggal: ' + String(item.tanggal ?? '').substring(0, 10),
                                        'Product: ' + String(item.kode_product ?? '-') + ' - ' +
                                        String(item.nama_product ?? '-'),
                                        'Line: ' + String(item.line ?? '-'),
                                        'Fryer: ' + String(item.fryer ?? '-'),
                                        'Tipe Proses: ' + (item.tipe_proses ?
                                            String(item.tipe_proses).replace('_', ' ') :
                                            'forming')
                                    ];
                                },

                                label: function(context) {
                                    const value = context.parsed.y;

                                    if (value === null || value === undefined) {
                                        return context.dataset.label + ': -';
                                    }

                                    return context.dataset.label + ': ' + fmt(value) + ' °C';
                                },

                                afterBody: function(tooltipItems) {
                                    if (!tooltipItems.length) return [];
                                    const item = items[tooltipItems[0].dataIndex];
                                    const status = getStatus(Number(item.suhu_pusat), item.tipe_proses);

                                    if (!status) return ['Status: Belum Lengkap'];

                                    return ['Status: ' + statusText(status, item.tipe_proses)];
                                }
                            }
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: false,
                            min: yMin,
                            max: yMax,

                            title: {
                                display: true,
                                text: 'Suhu (°C)',
                                color: '#5B6A62'
                            },

                            grid: {
                                color: '#E3E7E1'
                            },

                            ticks: {
                                color: '#5B6A62',

                                callback: function(value) {
                                    return Number(value).toLocaleString('id-ID') + ' °C';
                                }
                            }
                        },

                        x: {
                            title: {
                                display: true,
                                text: 'Production Batch',
                                color: '#5B6A62'
                            },

                            grid: {
                                color: '#F0F3F0'
                            },

                            ticks: {
                                color: '#5B6A62'
                            }
                        }
                    }
                };
            }

            // ===== Pie chart distribusi status (pakai getStatus per tipe_proses) =====
            const pieCanvas = document.getElementById('fryerPie');

            if (pieCanvas) {
                const pieCounts = {
                    success: 0,
                    warning: 0,
                    danger: 0
                };

                chartData.forEach(function(item) {
                    const s = getStatus(Number(item.suhu_pusat), item.tipe_proses);

                    if (s && item.suhu_pusat !== null && item.suhu_pusat !== '') {
                        pieCounts[s]++;
                    }
                });

                const pieValues = [pieCounts.success, pieCounts.warning, pieCounts.danger];
                const pieTotal = pieValues.reduce(function(a, b) {
                    return a + b;
                }, 0);

                new Chart(pieCanvas, {
                    type: 'pie',

                    data: {
                        labels: ['Sesuai', 'Waspada', 'Di Luar Batas'],

                        datasets: [{
                            data: pieValues,
                            backgroundColor: [COLOR.success, COLOR.warning, COLOR.danger],
                            borderColor: '#FFFFFF',
                            borderWidth: 3,
                            hoverOffset: 6
                        }]
                    },

                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#1F2A24',
                                    usePointStyle: true,
                                    padding: 18
                                }
                            },

                            tooltip: {
                                backgroundColor: '#1F2A24',

                                callbacks: {
                                    label: function(context) {
                                        const value = context.parsed;
                                        const pct = pieTotal > 0 ? (value / pieTotal) * 100 : 0;

                                        return context.label + ': ' + value + ' data (' +
                                            pct.toLocaleString('id-ID', {
                                                minimumFractionDigits: 1,
                                                maximumFractionDigits: 1
                                            }) + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // ===== Kelompokkan per tanggal =====
            const groupedData = {};

            chartData.forEach(function(item) {
                const tanggal = String(item.tanggal).substring(0, 10);

                if (!groupedData[tanggal]) {
                    groupedData[tanggal] = [];
                }

                groupedData[tanggal].push(item);
            });

            Object.keys(groupedData).forEach(function(tanggal) {
                const items = groupedData[tanggal];

                items.sort(function(a, b) {
                    return String(a.no_batch ?? '').localeCompare(String(b.no_batch ?? ''),
                        undefined, {
                            numeric: true,
                            sensitivity: 'base'
                        });
                });

                const labels = items.map(function(item) {
                    return String(item.no_batch ?? '-');
                });

                const suhuPusat = items.map(function(item) {
                    if (item.suhu_pusat === null || item.suhu_pusat === undefined || item
                        .suhu_pusat === '') {
                        return null;
                    }
                    return Number(item.suhu_pusat);
                });

                const suhuMinimum = items.map(function(item) {
                    if (item.suhu_minimum === null || item.suhu_minimum === undefined || item
                        .suhu_minimum === '') {
                        return null;
                    }
                    return Number(item.suhu_minimum);
                });

                // warna titik/batang mengikuti status per tipe_proses masing-masing
                const pointColors = items.map(function(item) {
                    const v = item.suhu_pusat === null || item.suhu_pusat === undefined || item
                        .suhu_pusat === '' ?
                        null :
                        Number(item.suhu_pusat);
                    const s = getStatus(v, item.tipe_proses);
                    return s ? COLOR[s] : '#5B6A62';
                });

                const dateKey = tanggal.replace(/-/g, '');

                // ===== Line chart =====
                const lineCanvas = document.getElementById('fryerChart' + dateKey);

                if (lineCanvas) {
                    const lineChart = new Chart(lineCanvas, {
                        type: 'line',

                        data: {
                            labels: labels,

                            datasets: [{
                                    label: 'Suhu Pusat',
                                    data: suhuPusat,
                                    borderColor: '#1B4B43',
                                    backgroundColor: 'rgba(27, 75, 67, 0.10)',
                                    borderWidth: 2,
                                    tension: 0,
                                    pointRadius: 5,
                                    pointHoverRadius: 7,
                                    pointBackgroundColor: pointColors,
                                    pointBorderColor: '#FFFFFF',
                                    pointBorderWidth: 1.5,
                                    spanGaps: false
                                },
                                {
                                    label: 'Suhu Minimum',
                                    data: suhuMinimum,
                                    borderColor: '#5B6A62',
                                    borderWidth: 1.5,
                                    borderDash: [2, 4],
                                    tension: 0,
                                    pointRadius: 0,
                                    pointHoverRadius: 0,
                                    spanGaps: true
                                }
                            ]
                        },

                        options: buildOptions(items, suhuPusat, suhuMinimum),
                        plugins: [zoneBands]
                    });

                    lineChart.$fryerItems = items;
                }

                // ===== Bar chart =====
                const barCanvas = document.getElementById('fryerBar' + dateKey);

                if (barCanvas) {
                    const barChart = new Chart(barCanvas, {
                        type: 'bar',

                        data: {
                            labels: labels,

                            datasets: [{
                                type: 'bar',
                                label: 'Suhu Pusat',
                                data: suhuPusat,
                                backgroundColor: pointColors,
                                borderRadius: 4,
                                maxBarThickness: 46
                            }]
                        },

                        options: buildOptions(items, suhuPusat, []),
                        plugins: [zoneBands]
                    });

                    barChart.$fryerItems = items;
                }
            });
        });
    </script>
@endpush
