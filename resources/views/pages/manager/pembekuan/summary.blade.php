@extends('layouts.master')

@section('title', 'Summary Pembekuan')

@push('addon-style')
    <style>
        :root {
            --freeze-primary: #1B4B43;
            --freeze-primary-light: #E8F0EE;
            --freeze-accent: #D98C3D;
            --freeze-border: #E3E7E1;
            --freeze-text: #1F2A24;
            --freeze-muted: #5B6A62;
            --freeze-soft: #F7F9F7;
        }

        .pembekuan-summary .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--freeze-text);
        }

        .pembekuan-summary .section-lead {
            color: var(--freeze-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pembekuan-summary .card {
            border: none;
            border-left: 4px solid var(--freeze-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pembekuan-summary .card.card-final {
            border-left-color: var(--freeze-accent);
        }

        .pembekuan-summary .card-header {
            background: #fff;
            border-bottom: 1px solid var(--freeze-border);
            padding: 1rem 1.5rem;
        }

        .pembekuan-summary .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--freeze-text);
        }

        .pembekuan-summary .card-body {
            padding: 1.5rem;
        }

        .pembekuan-summary .filter-label {
            color: var(--freeze-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .pembekuan-summary .form-control {
            border-color: var(--freeze-border);
            color: var(--freeze-text);
            border-radius: 7px;
        }

        .pembekuan-summary .form-control:focus {
            border-color: var(--freeze-primary);
            box-shadow: 0 0 0 0.2rem rgba(27, 75, 67, 0.12);
        }

        .pembekuan-summary .btn-primary {
            background: var(--freeze-primary);
            border-color: var(--freeze-primary);
        }

        .pembekuan-summary .btn-primary:hover,
        .pembekuan-summary .btn-primary:focus {
            background: #28665A;
            border-color: #28665A;
        }

        .pembekuan-summary .btn-ghost {
            color: var(--freeze-muted);
            background: transparent;
            border: 1px solid var(--freeze-border);
        }

        .pembekuan-summary .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--freeze-text);
        }

        .pembekuan-summary .summary-card {
            height: 100%;
            background: var(--freeze-soft);
            border: 1px solid var(--freeze-border);
            border-left: 4px solid var(--freeze-primary);
            border-radius: 9px;
        }

        .pembekuan-summary .summary-card .card-body {
            padding: 1.15rem 1.2rem;
        }

        .pembekuan-summary .summary-label {
            color: var(--freeze-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 0.3rem;
        }

        .pembekuan-summary .summary-value {
            color: var(--freeze-text);
            font-size: 1.35rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .pembekuan-summary .summary-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--freeze-primary);
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .pembekuan-summary .summary-card.warning {
            border-left-color: var(--freeze-accent);
        }

        .pembekuan-summary .summary-card.warning .summary-icon {
            color: var(--freeze-accent);
        }

        .pembekuan-summary .summary-card.success .summary-icon {
            color: var(--freeze-primary);
        }

        .pembekuan-summary .chart-item {
            margin-bottom: 35px;
        }

        .pembekuan-summary .chart-item:last-child {
            margin-bottom: 0;
        }

        .pembekuan-summary .chart-title {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 12px;
            color: var(--freeze-text);
        }

        .pembekuan-summary .chart-title i {
            color: var(--freeze-primary);
        }

        .pembekuan-summary .chart-subtitle {
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--freeze-muted);
            margin: 28px 0 10px;
        }

        .pembekuan-summary .chart-wrapper {
            position: relative;
            width: 100%;
            height: 350px;
        }

        .pembekuan-summary .zone-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            font-size: 12px;
            color: var(--freeze-muted);
            margin-bottom: 18px;
        }

        .pembekuan-summary .zone-legend span {
            display: inline-flex;
            align-items: center;
        }

        .pembekuan-summary .zone-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 6px;
            display: inline-block;
        }

        .pembekuan-summary .pie-wrapper {
            position: relative;
            width: 100%;
            height: 320px;
        }

        .pembekuan-summary .pie-stat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid var(--freeze-border);
            background: var(--freeze-soft);
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 10px;
        }

        .pembekuan-summary .pie-stat:last-child {
            margin-bottom: 0;
        }

        .pembekuan-summary .pie-stat-name {
            display: flex;
            align-items: center;
            color: var(--freeze-text);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .pembekuan-summary .pie-stat-range {
            display: block;
            color: var(--freeze-muted);
            font-size: 0.75rem;
            font-weight: 400;
        }

        .pembekuan-summary .pie-stat-value {
            color: var(--freeze-text);
            font-size: 1.15rem;
            font-weight: 700;
            text-align: right;
        }

        .pembekuan-summary .pie-stat-value small {
            display: block;
            color: var(--freeze-muted);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .pembekuan-summary .empty-chart {
            text-align: center;
            padding: 50px 20px;
            color: var(--freeze-muted);
        }

        .pembekuan-summary .empty-chart i {
            color: var(--freeze-primary);
        }

        .pembekuan-summary .monitor-box {
            border: 1px solid var(--freeze-border);
            background: var(--freeze-soft);
            border-radius: 8px;
            padding: 20px;
            height: 100%;
        }

        .pembekuan-summary .monitor-label {
            color: var(--freeze-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 5px;
        }

        .pembekuan-summary .monitor-value {
            color: var(--freeze-text);
            font-size: 24px;
            font-weight: 700;
        }

        .pembekuan-summary .status-badge {
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .pembekuan-summary .badge-success {
            background: var(--freeze-primary-light);
            color: var(--freeze-primary);
        }

        .pembekuan-summary .badge-warning {
            background: #FDF0E3;
            color: var(--freeze-accent);
        }

        .pembekuan-summary .badge-danger {
            background: #FDF0E3;
            color: var(--freeze-accent);
        }

        .pembekuan-summary .badge-secondary {
            background: #EEF1EF;
            color: var(--freeze-muted);
        }

        .pembekuan-summary .badge-suhu {
            display: inline-block;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .pembekuan-summary .badge-suhu-success {
            background: #d4edda;
            color: #155724;
        }

        .pembekuan-summary .badge-suhu-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .pembekuan-summary .progress {
            height: 8px;
            background: #E5EBE7;
            border-radius: 10px;
        }

        .pembekuan-summary .progress-bar {
            background: var(--freeze-primary) !important;
        }

        .pembekuan-summary .table thead th {
            color: var(--freeze-text);
            background: var(--freeze-soft);
            border-bottom: 1px solid var(--freeze-border);
            font-size: 0.8rem;
            font-weight: 600;
        }

        .pembekuan-summary .table tbody td {
            color: var(--freeze-text);
            vertical-align: middle;
            border-color: var(--freeze-border);
        }

        .pembekuan-summary .table-hover tbody tr:hover {
            background: var(--freeze-primary-light);
        }

        .pembekuan-summary .btn-light {
            color: var(--freeze-muted);
            background: #fff;
            border-color: var(--freeze-border);
        }

        .pembekuan-summary .btn-light:hover {
            background: #F3F5F3;
            color: var(--freeze-text);
        }

        @media (max-width: 767.98px) {
            .pembekuan-summary .card-body {
                padding: 1rem;
            }

            .pembekuan-summary .card-header {
                padding: 0.9rem 1rem;
            }

            .pembekuan-summary .chart-wrapper {
                height: 300px;
            }
        }
    </style>
@endpush

@section('content')

    @php
        $isManager = request()->routeIs('manager.pembekuan.summary');

        $summaryRoute = $isManager ? route('manager.pembekuan.summary') : route('operator.pembekuan.summary');

        $backRoute = $isManager ? route('manager.pembekuan.index') : route('operator.pembekuan.index');

        // ===== Batas suhu pusat pembekuan =====
        // Hijau : suhu pusat <= -19 °C
        // Merah : suhu pusat >  -19 °C
        $batasSuhu = -18;

        $persentaseSesuai = (float) ($persentaseSesuai ?? 0);

        $suhuPusatRataRata =
            isset($suhuPusatRataRata) && $suhuPusatRataRata !== null ? (float) $suhuPusatRataRata : null;

        $chartData = collect($chartData ?? [])->map(function ($item) {
            return (object) $item;
        });

        $lines = collect($lines ?? []);

        $totalRecord = $chartData->count();

        $sesuaiMinimum = 0;
        $diBawahMinimum = 0;

        foreach ($chartData as $item) {
            if ($item->suhu_pusat !== null && $item->suhu_minimum !== null) {
                if ((float) $item->suhu_pusat <= (float) $item->suhu_minimum) {
                    $sesuaiMinimum++;
                } else {
                    $diBawahMinimum++;
                }
            }
        }

        if ($totalRecord > 0) {
            $persentaseSesuai = ($sesuaiMinimum / $totalRecord) * 100;
        } else {
            $persentaseSesuai = 0;
        }

        $chartByDate = $chartData->groupBy(function ($item) {
            return substr((string) $item->tanggal, 0, 10);
        });

        // Distribusi status Suhu Pusat untuk pie chart
        $pieCount = ['success' => 0, 'danger' => 0];

        foreach ($chartData as $item) {
            if ($item->suhu_pusat === null) {
                continue;
            }

            if ((float) $item->suhu_pusat <= $batasSuhu) {
                $pieCount['success']++;
            } else {
                $pieCount['danger']++;
            }
        }

        $pieTotal = array_sum($pieCount);

        $pieMeta = [
            'success' => ['Sesuai', '≤ ' . $batasSuhu . ' °C', '#28a745'],
            'danger' => ['Tidak Sesuai', '> ' . $batasSuhu . ' °C', '#dc3545'],
        ];
    @endphp

    <div class="section pembekuan-summary">

        <div class="section-header">
            <h1>Summary Pembekuan</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ $backRoute }}">Pembekuan</a>
                </div>

                <div class="breadcrumb-item active">Summary</div>
            </div>
        </div>

        <div class="section-lead">
            Ringkasan monitoring suhu proses pembekuan berdasarkan production batch yang telah dicatat.
        </div>

        <div class="section-body">

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <i class="bi bi-funnel mr-2" style="color: var(--freeze-primary);"></i>
                        Filter Data
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ $summaryRoute }}" method="GET">

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="line" class="filter-label">Line</label>

                                <select name="line" id="line" class="form-control">
                                    <option value="">Semua Line</option>

                                    @foreach ($lines as $line)
                                        <option value="{{ $line }}"
                                            {{ request('line') == $line ? 'selected' : '' }}>
                                            {{ $line }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="date_from" class="filter-label">Tanggal Mulai</label>

                                <input type="date" name="date_from" id="date_from" class="form-control"
                                    value="{{ request('date_from') }}">
                            </div>

                            <div class="form-group col-md-4">
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

                                <div class="summary-icon"><i class="bi bi-database"></i></div>
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

                                <div class="summary-icon"><i class="bi bi-thermometer-half"></i></div>
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

                                <div class="summary-icon"><i class="bi bi-check-circle"></i></div>
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

                                <div class="summary-icon"><i class="bi bi-exclamation-triangle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <i class="bi bi-graph-up mr-2" style="color: var(--freeze-primary);"></i>
                        Perbandingan Suhu Antar Batch
                    </h4>
                </div>

                <div class="card-body">

                    @if ($chartByDate->count() > 0)

                        <div class="zone-legend">
                            <span><i class="zone-dot" style="background:#28a745;"></i>Hijau: ≤ {{ $batasSuhu }}
                                °C</span>
                            <span><i class="zone-dot" style="background:#dc3545;"></i>Merah: > {{ $batasSuhu }}
                                °C</span>
                        </div>

                        @foreach ($chartByDate as $tanggal => $items)
                            <div class="chart-item">

                                <div class="chart-title">
                                    <i class="bi bi-calendar3 mr-1"></i>

                                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                                </div>

                                <div class="chart-subtitle">Grafik Garis</div>

                                <div class="chart-wrapper">
                                    <canvas id="pembekuanChart{{ str_replace('-', '', $tanggal) }}"></canvas>
                                </div>

                                <div class="chart-subtitle">Grafik Batang</div>

                                <div class="chart-wrapper">
                                    <canvas id="pembekuanBar{{ str_replace('-', '', $tanggal) }}"></canvas>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="empty-chart">
                            <i class="bi bi-graph-up fa-3x mb-3"></i>

                            <h6>Belum ada data grafik</h6>

                            <p class="mb-0">Data suhu akan tampil setelah filter diterapkan.</p>
                        </div>
                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <i class="bi bi-pie-chart mr-2" style="color: var(--freeze-primary);"></i>
                        Distribusi Status Suhu Pusat
                    </h4>
                </div>

                <div class="card-body">
                    @if ($pieTotal > 0)
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="pie-wrapper">
                                    <canvas id="pembekuanPie"></canvas>
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
                            <i class="bi bi-pie-chart fa-3x mb-3"></i>

                            <h6>Belum ada data</h6>

                            <p class="mb-0">Pie chart akan tampil setelah ada data suhu pusat.</p>
                        </div>
                    @endif
                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <i class="bi bi-pie-chart mr-2" style="color: var(--freeze-primary);"></i>
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
                        <i class="bi bi-thermometer-half mr-2" style="color: var(--freeze-primary);"></i>
                        Monitoring Suhu Pembekuan
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
                                <div class="monitor-value" style="color: var(--freeze-primary);">
                                    {{ number_format($sesuaiMinimum, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="monitor-box">
                                <div class="monitor-label">Di Bawah Minimum</div>
                                <div class="monitor-value" style="color: var(--freeze-accent);">
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
                        <i class="bi bi-list mr-2" style="color: var(--freeze-primary);"></i>
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
                                    <th>Suhu Ruang Packing</th>
                                    <th>Suhu Ruang IQF</th>
                                    <th>Speed Conveyor</th>
                                    <th>Suhu Pusat</th>
                                    <th>Suhu Minimum</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($chartData as $index => $item)
                                    @php
                                        // Hijau: <= -19 °C | Merah: > -19 °C
                                        $suhuClass = '';
                                        $suhuStatusText = '';

                                        if ($item->suhu_pusat !== null) {
                                            if ((float) $item->suhu_pusat <= $batasSuhu) {
                                                $suhuClass = 'success';
                                                $suhuStatusText = 'Sesuai';
                                            } else {
                                                $suhuClass = 'danger';
                                                $suhuStatusText = 'Tidak Sesuai';
                                            }
                                        }
                                    @endphp

                                    <tr>

                                        <td>{{ $index + 1 }}</td>

                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>

                                        <td>{{ $item->no_batch ?? '-' }}</td>

                                        <td>{{ $item->kode_product ?? '-' }}</td>

                                        <td>{{ $item->nama_product ?? '-' }}</td>

                                        <td>{{ $item->line ?? '-' }}</td>

                                        <td>
                                            @if ($item->suhu_ruang_packing !== null)
                                                {{ number_format((float) $item->suhu_ruang_packing, 2, ',', '.') }} °C
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->suhu_ruang_iqf !== null)
                                                {{ number_format((float) $item->suhu_ruang_iqf, 2, ',', '.') }} °C
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->speed_conveyor !== null)
                                                {{ number_format((float) $item->speed_conveyor, 2, ',', '.') }}
                                            @else
                                                -
                                            @endif
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

                                        <td>
                                            @if ($suhuClass === '')
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
                    <i class="bi bi-arrow-left mr-1"></i>
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

            // ===== Batas & warna status Suhu Pusat =====
            // Hijau: <= BATAS | Merah: > BATAS
            const BATAS = {{ $batasSuhu }};

            const COLOR = {
                success: '#28a745',
                danger: '#dc3545'
            };

            const STATUS_TEXT = {
                success: 'Sesuai (≤ ' + BATAS + ' °C)',
                danger: 'Tidak Sesuai (> ' + BATAS + ' °C)'
            };

            function hasValue(v) {
                return v !== null && v !== undefined && v !== '' && !isNaN(Number(v));
            }

            function getStatus(v) {
                if (!hasValue(v)) return null;

                return Number(v) <= BATAS ? 'success' : 'danger';
            }

            // ===== Garis batas (horizontal) =====
            function thresholdDatasets(count) {
                return [{
                    type: 'line',
                    label: 'Batas Sesuai (≤ ' + BATAS + ' °C)',
                    data: Array(count).fill(BATAS),
                    borderColor: COLOR.success,
                    borderWidth: 1.5,
                    borderDash: [6, 4],
                    pointRadius: 0,
                    pointHoverRadius: 0,
                    tension: 0,
                    isThreshold: true
                }];
            }

            // ===== Background zona (hijau / merah tipis) =====
            const zoneBands = {
                id: 'zoneBands',
                beforeDatasetsDraw(chart) {
                    const {
                        ctx,
                        chartArea,
                        scales
                    } = chart;
                    const y = scales.y;
                    if (!chartArea || !y) return;

                    const bands = [
                        [-Infinity, BATAS, 'rgba(40, 167, 69, 0.09)'],
                        [BATAS, Infinity, 'rgba(220, 53, 69, 0.07)']
                    ];

                    ctx.save();

                    bands.forEach(function(b) {
                        const top = Math.min(b[1], y.max);
                        const bottom = Math.max(b[0], y.min);

                        if (top <= bottom) return;

                        const pxTop = y.getPixelForValue(top);
                        const pxBottom = y.getPixelForValue(bottom);

                        ctx.fillStyle = b[2];
                        ctx.fillRect(
                            chartArea.left,
                            pxTop,
                            chartArea.right - chartArea.left,
                            pxBottom - pxTop
                        );
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

            // ===== Opsi chart yang dipakai bersama (line & bar) =====
            function buildOptions(items, values, minimums) {
                const all = values.concat(minimums).filter(function(v) {
                    return v !== null && !isNaN(v);
                });

                const yMin = Math.floor(Math.min(BATAS - 1, ...all)) - 1;
                const yMax = Math.ceil(Math.max(BATAS + 1, ...all)) + 1;

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

                            // garis batas tidak ikut muncul di tooltip
                            filter: function(tooltipItem) {
                                return !tooltipItem.dataset.isThreshold;
                            },

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
                                        'Line: ' + String(item.line ?? '-')
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
                                    const status = getStatus(item.suhu_pusat);

                                    if (!status) return ['Status: Belum Lengkap'];

                                    return ['Status: ' + STATUS_TEXT[status]];
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

            // ===== Pie chart distribusi status =====
            const pieCanvas = document.getElementById('pembekuanPie');

            if (pieCanvas) {
                const pieCounts = {
                    success: 0,
                    danger: 0
                };

                chartData.forEach(function(item) {
                    const s = getStatus(item.suhu_pusat);

                    if (s) {
                        pieCounts[s]++;
                    }
                });

                const pieValues = [pieCounts.success, pieCounts.danger];
                const pieTotal = pieValues.reduce(function(a, b) {
                    return a + b;
                }, 0);

                new Chart(pieCanvas, {
                    type: 'pie',

                    data: {
                        labels: ['Sesuai', 'Tidak Sesuai'],

                        datasets: [{
                            data: pieValues,
                            backgroundColor: [COLOR.success, COLOR.danger],
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
                    return hasValue(item.suhu_pusat) ? Number(item.suhu_pusat) : null;
                });

                const suhuMinimum = items.map(function(item) {
                    return hasValue(item.suhu_minimum) ? Number(item.suhu_minimum) : null;
                });

                // warna titik / batang mengikuti status
                const pointColors = suhuPusat.map(function(v) {
                    const s = getStatus(v);

                    return s ? COLOR[s] : '#5B6A62';
                });

                const dateKey = tanggal.replace(/-/g, '');

                // ===== Line chart =====
                const lineCanvas = document.getElementById('pembekuanChart' + dateKey);

                if (lineCanvas) {
                    new Chart(lineCanvas, {
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
                            ].concat(thresholdDatasets(labels.length))
                        },

                        options: buildOptions(items, suhuPusat, suhuMinimum),
                        plugins: [zoneBands]
                    });
                }

                // ===== Bar chart =====
                const barCanvas = document.getElementById('pembekuanBar' + dateKey);

                if (barCanvas) {
                    new Chart(barCanvas, {
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
                            }].concat(thresholdDatasets(labels.length))
                        },

                        options: buildOptions(items, suhuPusat, []),
                        plugins: [zoneBands]
                    });
                }

            });

        });
    </script>
@endpush
