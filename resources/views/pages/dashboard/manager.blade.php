@extends('layouts.master')

@section('title', 'Dashboard Manager')

@section('content')

    <div class="manager-dashboard">

        <div class="section-header">
            <h1>Dashboard</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    Dashboard
                </div>
            </div>
        </div>

        <div class="section-body">

            <div class="dashboard-header mb-4">
                <div>
                    <h2>Monitoring LPP Further</h2>
                    <p>Ringkasan aktivitas produksi berdasarkan Production Batch.</p>
                </div>

                <form method="GET" action="{{ route('dashboard') }}" class="dashboard-filter">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>

                        <input type="date" name="date" value="{{ $date }}" class="form-control"
                            onchange="this.form.submit()">
                    </div>
                </form>
            </div>

            {{-- ===== KPI UTAMA: Batch / Berhasil / Rijek (Compliance Suhu) ===== --}}
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card dashboard-card dashboard-card-primary">
                        <div class="card-body">
                            <div class="dashboard-card-top">
                                <div>
                                    <div class="dashboard-label">
                                        TOTAL BATCH
                                    </div>

                                    <div class="dashboard-value">
                                        {{ number_format($totalBatch, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="dashboard-icon dashboard-icon-emoji">📦</div>
                            </div>

                            <div class="dashboard-caption">
                                Batch pada tanggal terpilih
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card dashboard-card dashboard-card-success">
                        <div class="card-body">
                            <div class="dashboard-card-top">
                                <div>
                                    <div class="dashboard-label">
                                        TOTAL BERHASIL
                                    </div>

                                    <div class="dashboard-value">
                                        {{ number_format($totalBerhasil, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="dashboard-icon dashboard-icon-emoji dashboard-icon-success">✅</div>
                            </div>

                            <div class="dashboard-caption">
                                {{ number_format($persentaseBerhasil, 1, ',', '.') }}% dari total batch
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card dashboard-card dashboard-card-danger">
                        <div class="card-body">
                            <div class="dashboard-card-top">
                                <div>
                                    <div class="dashboard-label">
                                        TOTAL RIJEK
                                    </div>

                                    <div class="dashboard-value">
                                        {{ number_format($totalRijek, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="dashboard-icon dashboard-icon-emoji dashboard-icon-danger">❌</div>
                            </div>

                            <div class="dashboard-caption">
                                {{ number_format($persentaseRijek, 1, ',', '.') }}% — suhu di luar ambang batas
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===== KPI SEKUNDER: Output / Yield / Rijek Produk ===== --}}
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card dashboard-card dashboard-card-output">
                        <div class="card-body">
                            <div class="dashboard-card-top">
                                <div>
                                    <div class="dashboard-label">
                                        OUTPUT
                                    </div>

                                    <div class="dashboard-value">
                                        {{ number_format($totalOutput, 2, ',', '.') }}
                                    </div>
                                </div>

                                <div class="dashboard-icon dashboard-icon-emoji">⚖️</div>
                            </div>

                            <div class="dashboard-caption">
                                Total yield dari production batch
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card dashboard-card dashboard-card-yield">
                        <div class="card-body">
                            <div class="dashboard-card-top">
                                <div>
                                    <div class="dashboard-label">
                                        AVERAGE YIELD
                                    </div>

                                    <div class="dashboard-value">
                                        {{ $averageYield !== null ? number_format($averageYield, 2, ',', '.') . '%' : '-' }}
                                    </div>
                                </div>

                                <div class="dashboard-icon dashboard-icon-emoji">📈</div>
                            </div>

                            <div class="dashboard-caption">
                                Rata-rata yield production batch
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="card dashboard-card dashboard-card-warning">
                        <div class="card-body">
                            <div class="dashboard-card-top">
                                <div>
                                    <div class="dashboard-label">
                                        AVERAGE RIJEK PRODUK
                                    </div>

                                    <div class="dashboard-value">
                                        {{ $averageRijek !== null ? number_format($averageRijek, 2, ',', '.') . '%' : '-' }}
                                    </div>
                                </div>

                                <div class="dashboard-icon dashboard-icon-emoji dashboard-icon-warning">⚠️</div>
                            </div>

                            <div class="dashboard-caption">
                                Rata-rata persen rijek production batch
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-8">
                    <div class="card dashboard-panel">

                        <div class="card-header">
                            <div>
                                <h4>
                                    <span class="dashboard-panel-emoji">🥧</span>
                                    Compliance Suhu
                                </h4>

                                <span>
                                    Distribusi Berhasil/Rijek, tanggal {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($totalBatch > 0)
                                <div class="chart-wrapper">
                                    <canvas id="productionChart"></canvas>
                                </div>
                            @else
                                <div class="empty-state text-center">
                                    <div class="empty-state-emoji">🥧</div>
                                    <h6>Belum ada data batch</h6>
                                    <p>Belum ada production batch pada tanggal ini.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card dashboard-panel">

                        <div class="card-header">
                            <div>
                                <h4>
                                    <span class="dashboard-panel-emoji">🧭</span>
                                    Status Proses
                                </h4>

                                <span>
                                    Tanggal {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="status-summary">

                                <div class="status-summary-item">
                                    <div class="status-summary-icon success">✅</div>

                                    <div>
                                        <strong>{{ $completedProcess }}</strong>
                                        <span>Selesai / Sudah Input</span>
                                    </div>
                                </div>

                                <div class="status-summary-item">
                                    <div class="status-summary-icon warning">⏳</div>

                                    <div>
                                        <strong>{{ $pendingProcess }}</strong>
                                        <span>Belum Diinput</span>
                                    </div>
                                </div>

                            </div>

                            @php
                                $processPercentage = $totalProcess > 0 ? ($completedProcess / $totalProcess) * 100 : 0;
                            @endphp

                            <div class="progress dashboard-progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $processPercentage }}%;">
                                </div>
                            </div>

                            <div class="progress-caption">
                                <span>Progress proses</span>
                                <strong>{{ number_format($processPercentage, 0) }}%</strong>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-5">

                    <div class="card dashboard-panel">

                        <div class="card-header">
                            <div>
                                <h4>
                                    <span class="dashboard-panel-emoji">📦</span>
                                    Kemasan Rijek
                                </h4>

                                <span>
                                    Berdasarkan Production Batch terpilih
                                </span>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="rijek-box">

                                <div class="rijek-icon">📦</div>

                                <div>
                                    <div class="rijek-label">
                                        Total Record Kemasan Rijek
                                    </div>

                                    <div class="rijek-value">
                                        {{ number_format($kemasanRijekToday, 0, ',', '.') }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-7">

                    <div class="card dashboard-panel">

                        <div class="card-header">
                            <div>
                                <h4>
                                    <span class="dashboard-panel-emoji">🕒</span>
                                    Production Batch Terbaru
                                </h4>

                                <span>
                                    Batch pada tanggal terpilih
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table dashboard-table mb-0">

                                    <thead>
                                        <tr>
                                            <th>No Batch</th>
                                            <th>Product</th>
                                            <th>Line</th>
                                            <th>Yield</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($recentProduction as $batch)
                                            <tr>

                                                <td>
                                                    <strong>
                                                        {{ $batch->no_batch }}
                                                    </strong>
                                                </td>

                                                <td>
                                                    {{ $batch->product->nama_product ?? ($batch->product->nama ?? '-') }}
                                                </td>

                                                <td>
                                                    {{ $batch->line ?? '-' }}
                                                </td>

                                                <td>
                                                    @if ($batch->yield !== null)
                                                        {{ number_format($batch->yield, 2, ',', '.') }}%
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($batch->is_compliant)
                                                        <span class="status-badge status-success">✅ Berhasil</span>
                                                    @else
                                                        <span class="status-badge status-danger">❌ Rijek</span>
                                                    @endif
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">
                                                    Belum ada Production Batch.
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('addon-style')
    <style>
        .manager-dashboard {
            --dashboard-primary: #1B4B43;
            --dashboard-primary-light: #E8F0EE;
            --dashboard-accent: #D98C3D;
            --dashboard-accent-light: #FFF3E6;
            --dashboard-danger: #dc3545;
            --dashboard-danger-light: #FBE4E4;
            --dashboard-border: #E3E7E1;
            --dashboard-text: #1F2A24;
            --dashboard-muted: #5B6A62;
            --dashboard-soft: #F7F9F7;
        }

        .manager-dashboard .section-header h1 {
            font-weight: 700;
            color: var(--dashboard-text);
            letter-spacing: -0.01em;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .dashboard-header h2 {
            margin: 0 0 5px;
            font-size: 20px;
            font-weight: 700;
            color: var(--dashboard-text);
        }

        .dashboard-header p {
            margin: 0;
            color: var(--dashboard-muted);
            font-size: 13px;
        }

        .dashboard-filter {
            min-width: 190px;
        }

        .dashboard-filter .input-group-text {
            background: var(--dashboard-primary-light);
            border-color: var(--dashboard-border);
            color: var(--dashboard-primary);
        }

        .dashboard-filter .form-control {
            border-color: var(--dashboard-border);
        }

        .dashboard-filter .form-control:focus {
            border-color: var(--dashboard-primary);
            box-shadow: 0 0 0 0.2rem rgba(27, 75, 67, .08);
        }

        .dashboard-card {
            border: 1px solid var(--dashboard-border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(15, 30, 25, .05);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .dashboard-card-primary {
            border-left: 4px solid var(--dashboard-primary);
        }

        .dashboard-card-success {
            border-left: 4px solid #28a745;
        }

        .dashboard-card-success .dashboard-value {
            color: #1e7a34;
        }

        .dashboard-card-danger {
            border-left: 4px solid var(--dashboard-danger);
        }

        .dashboard-card-danger .dashboard-value {
            color: var(--dashboard-danger);
        }

        .dashboard-card-output {
            border-left: 4px solid #28665A;
        }

        .dashboard-card-yield {
            border-left: 4px solid #4D8076;
        }

        .dashboard-card-warning {
            border-left: 4px solid var(--dashboard-accent);
        }

        .dashboard-card .card-body {
            padding: 20px;
        }

        .dashboard-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .dashboard-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
            color: var(--dashboard-muted);
            margin-bottom: 6px;
        }

        .dashboard-value {
            font-size: 25px;
            font-weight: 700;
            line-height: 1.2;
            color: var(--dashboard-primary);
        }

        .dashboard-caption {
            margin-top: 10px;
            font-size: 12px;
            color: #7A8780;
        }

        .dashboard-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--dashboard-primary-light);
            color: var(--dashboard-primary);
            font-size: 19px;
            flex-shrink: 0;
        }

        /* ikon emoji — ukuran lebih besar biar kerasa "ilustrasi", bukan teks biasa */
        .dashboard-icon-emoji {
            font-size: 24px;
            background: var(--dashboard-soft);
        }

        .dashboard-icon-success {
            background: #E6F4EA;
        }

        .dashboard-icon-danger {
            background: var(--dashboard-danger-light);
        }

        .dashboard-card-output .dashboard-icon {
            background: #EDF4F1;
            color: #28665A;
        }

        .dashboard-card-yield .dashboard-icon {
            background: #EEF5F3;
            color: #4D8076;
        }

        .dashboard-icon-warning {
            background: var(--dashboard-accent-light);
            color: var(--dashboard-accent);
        }

        .dashboard-card-warning .dashboard-value {
            color: var(--dashboard-accent);
        }

        .dashboard-panel {
            border: 1px solid var(--dashboard-border);
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(15, 30, 25, .05);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .dashboard-panel .card-header {
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--dashboard-border);
            background: #fff;
            padding: 15px 20px;
        }

        .dashboard-panel .card-header h4 {
            margin: 0 0 4px;
            color: var(--dashboard-text);
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .dashboard-panel-emoji {
            margin-right: 8px;
            font-size: 16px;
        }

        .dashboard-panel .card-header span {
            color: #7A8780;
            font-size: 12px;
        }

        .chart-wrapper {
            height: 300px;
            position: relative;
        }

        .status-summary {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .status-summary-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .status-summary-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .status-summary-icon.success {
            background: var(--dashboard-primary-light);
        }

        .status-summary-icon.warning {
            background: var(--dashboard-accent-light);
        }

        .status-summary-item strong {
            display: block;
            color: var(--dashboard-text);
            font-size: 18px;
        }

        .status-summary-item span {
            display: block;
            color: #7A8780;
            font-size: 12px;
        }

        .dashboard-progress {
            height: 8px;
            margin-top: 25px;
            background: #EEF1EF;
            border-radius: 10px;
            overflow: hidden;
        }

        .dashboard-progress .progress-bar {
            background: var(--dashboard-primary);
            border-radius: 10px;
        }

        .progress-caption {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            font-size: 12px;
            color: #7A8780;
        }

        .progress-caption strong {
            color: var(--dashboard-primary);
        }

        .dashboard-table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .dashboard-table {
            min-width: 700px;
        }

        .dashboard-table thead th {
            background: var(--dashboard-soft);
            border-bottom: 1px solid var(--dashboard-border);
            color: var(--dashboard-muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .4px;
            font-weight: 700;
            padding: 13px 15px;
            white-space: nowrap;
        }

        .dashboard-table tbody td {
            padding: 13px 15px;
            vertical-align: middle;
            border-color: #EEF1EF;
            color: #39463F;
            font-size: 13px;
        }

        .dashboard-table tbody tr:hover {
            background: #FAFCFB;
        }

        .process-name {
            font-weight: 600;
            color: var(--dashboard-text);
            display: flex;
            align-items: center;
        }

        .process-emoji {
            margin-right: 8px;
            font-size: 16px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-success {
            background: var(--dashboard-primary-light);
            color: var(--dashboard-primary);
        }

        .status-warning {
            background: var(--dashboard-accent-light);
            color: #B86F20;
        }

        .status-danger {
            background: var(--dashboard-danger-light);
            color: #A4303F;
        }

        .rijek-box {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 15px;
            border: 1px solid var(--dashboard-border);
            border-radius: 10px;
            background: #FFFDF9;
        }

        .rijek-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--dashboard-accent-light);
            color: var(--dashboard-accent);
            font-size: 24px;
            flex-shrink: 0;
        }

        .rijek-label {
            color: #7A8780;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .rijek-value {
            color: var(--dashboard-text);
            font-size: 25px;
            font-weight: 700;
        }

        .empty-state {
            padding: 15px;
        }

        .empty-state-emoji {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .empty-state h6 {
            color: var(--dashboard-muted);
            margin-bottom: 5px;
        }

        .empty-state p {
            color: #8A968F;
            font-size: 12px;
            margin: 0;
        }

        @media (max-width: 767px) {

            .dashboard-header {
                flex-direction: column;
                align-items: stretch;
            }

            .dashboard-filter {
                width: 100%;
            }

            .dashboard-card {
                margin-bottom: 15px;
            }

            .dashboard-panel .card-header {
                padding: 13px 15px;
            }

            .chart-wrapper {
                height: 250px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Compliance suhu untuk tanggal yang dipilih saja (bukan tren 7 hari)
        const complianceValues = [{{ $totalBerhasil }}, {{ $totalRijek }}];
        const complianceLabels = ['Berhasil', 'Rijek'];

        const ctx = document.getElementById('productionChart');

        if (ctx) {
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: complianceLabels,
                    datasets: [{
                        data: complianceValues,
                        backgroundColor: ['#28a745', '#dc3545'],
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
                            display: true,
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 18
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed;
                                    const total = complianceValues.reduce((a, b) => a + b, 0);
                                    const pct = total > 0 ? (value / total) * 100 : 0;

                                    return context.label + ': ' + value + ' batch (' +
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
    </script>
@endpush
