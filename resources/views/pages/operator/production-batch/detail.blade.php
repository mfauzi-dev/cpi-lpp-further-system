@extends('layouts.master')
@section('title', 'Detail Production Batch')

@push('addon-style')
    <style>
        .pb-page {
            --pb-primary: #1B4B43;
            --pb-primary-light: #E8F0EE;
            --pb-accent: #D98C3D;
            --pb-accent-light: #FFF3E5;
            --pb-border: #E3E7E1;
            --pb-text: #1F2A24;
            --pb-muted: #5B6A62;
            --pb-soft: #F7F9F7;
        }

        .pb-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pb-text);
        }

        .pb-page .section-lead {
            color: var(--pb-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pb-page .card {
            border: none;
            border-left: 4px solid var(--pb-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pb-page .card-temperature-warning {
            border-left-color: var(--pb-accent);
        }

        .pb-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pb-border);
            padding: 1rem 1.5rem;
        }

        .pb-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pb-text);
            display: flex;
            align-items: center;
        }

        .pb-page .card-header h4 i {
            color: var(--pb-primary);
        }

        .pb-page .card-temperature-warning .card-header h4 i {
            color: var(--pb-accent);
        }

        .pb-page .card-body {
            padding: 1.5rem;
        }

        .pb-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pb-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pb-page .card-temperature-warning .step-badge {
            background: var(--pb-accent);
        }

        .pb-page .batch-highlight {
            background: linear-gradient(135deg, var(--pb-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pb-page .card-temperature-warning .batch-highlight {
            background: linear-gradient(135deg, var(--pb-accent), #C7772E);
        }

        .pb-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pb-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pb-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pb-page .info-box {
            height: 100%;
            background: var(--pb-soft);
            border: 1px solid var(--pb-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pb-page .info-label {
            color: var(--pb-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pb-page .info-value {
            color: var(--pb-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pb-page .stat-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--pb-border);
            border-radius: 9px;
            padding: 1rem;
            display: flex;
            align-items: center;
        }

        .pb-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--pb-primary-light);
            color: var(--pb-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .pb-page .stat-label {
            color: var(--pb-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pb-page .stat-value {
            color: var(--pb-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pb-page .process-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--pb-border);
            border-radius: 9px;
            padding: 1rem 1.1rem;
        }

        .pb-page .process-label {
            color: var(--pb-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 0.3rem;
        }

        .pb-page .process-value {
            color: var(--pb-text);
            font-size: 0.95rem;
            font-weight: 700;
            min-height: 20px;
        }

        .pb-page .process-value-muted {
            color: #9AA59F;
            font-size: 0.9rem;
            font-style: italic;
            font-weight: 400;
        }

        .pb-page .process-value.text-alert {
            color: var(--pb-accent);
        }

        .pb-page .process-empty {
            text-align: center;
            padding: 1.5rem 1rem;
            background: var(--pb-soft);
            border: 1px dashed var(--pb-border);
            border-radius: 8px;
            color: var(--pb-muted);
        }

        .pb-page .process-empty i {
            font-size: 1.4rem;
            opacity: .5;
            margin-bottom: .4rem;
        }

        .pb-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pb-page .table {
            margin-bottom: 0;
        }

        .pb-page .table thead th {
            background: var(--pb-primary-light);
            color: var(--pb-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .pb-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--pb-text);
            padding: 0.8rem 0.9rem;
            white-space: nowrap;
        }

        .pb-page .table-bordered td,
        .pb-page .table-bordered th {
            border-color: var(--pb-border);
        }

        .pb-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pb-page .badge-soft {
            display: inline-block;
            background: var(--pb-primary-light);
            color: var(--pb-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pb-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pb-page .btn-ghost {
            color: var(--pb-muted);
            background: transparent;
            border: 1px solid var(--pb-border);
        }

        .pb-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pb-text);
        }

        .pb-page .btn-excel {
            color: #1B4B43;
            background: var(--pb-primary-light);
            border: 1px solid #C9DCD7;
        }

        .pb-page .btn-excel:hover {
            background: #DCEAE6;
            color: #153B35;
        }

        .pb-page .btn-pdf {
            color: #A94442;
            background: #FCEEEE;
            border: 1px solid #F1D0D0;
        }

        .pb-page .btn-pdf:hover {
            background: #F8E1E1;
            color: #8C3735;
        }

        @media (max-width: 767.98px) {
            .pb-page .card-body {
                padding: 1rem;
            }

            .pb-page .card-header {
                padding: 0.9rem 1rem;
            }

            .pb-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush


@section('content')

    <div class="pb-page">

        <div class="section-header">

            <h1>Production Batch</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('operator.production-batch.index') }}">
                        Production Batch
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail dan monitoring seluruh proses produksi berdasarkan production batch.
        </p>

        <div class="section-body">
            @php
                // Fryer: pakai accessor $fryer->suhu_pusat_status dari model,
                // yang sudah otomatis menyesuaikan threshold berdasarkan tipe_proses
                // (forming vs non_forming / non_forming_roasted).
                // "Tidak memenuhi" = status apa pun selain 'success' (hijau).
                $fryerTidakMemenuhi = false;
                $pembekuanTidakMemenuhi = false;

                if ($productionBatch->fryers && $productionBatch->fryers->count()) {
                    foreach ($productionBatch->fryers as $fryer) {
                        if ($fryer->suhu_pusat_status !== null && $fryer->suhu_pusat_status !== 'success') {
                            $fryerTidakMemenuhi = true;
                            break;
                        }
                    }
                }

                if ($productionBatch->pembekuans && $productionBatch->pembekuans->count()) {
                    foreach ($productionBatch->pembekuans as $pembekuan) {
                        if ($pembekuan->suhu_pusat !== null && (float) $pembekuan->suhu_pusat >= -18) {
                            $pembekuanTidakMemenuhi = true;
                            break;
                        }
                    }
                }

                $temperatureTidakMemenuhi = $fryerTidakMemenuhi || $pembekuanTidakMemenuhi;
            @endphp

            <div class="pb-page">
                <div class="card mb-4 {{ $temperatureTidakMemenuhi ? 'card-temperature-warning' : '' }}">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">1</span>
                            Informasi Production Batch
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="batch-highlight">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="batch-label">
                                        Production Batch
                                    </div>

                                    <div class="batch-number">
                                        {{ $productionBatch->no_batch ?? '-' }}
                                    </div>

                                    <div class="batch-product">
                                        {{ $productionBatch->product->nama ?? '-' }}
                                    </div>
                                </div>

                                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                    <div class="batch-label">
                                        Tanggal Produksi
                                    </div>

                                    <div class="batch-number" style="font-size: 1.1rem;">
                                        {{ $productionBatch->tanggal_produksi ? $productionBatch->tanggal_produksi->format('d M Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="info-box">
                                    <div class="info-label">
                                        Tanggal Produksi
                                    </div>

                                    <div class="info-value">
                                        {{ $productionBatch->tanggal_produksi ? $productionBatch->tanggal_produksi->format('d M Y') : '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="info-box">
                                    <div class="info-label">
                                        No Batch
                                    </div>

                                    <div class="info-value">
                                        {{ $productionBatch->no_batch ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="info-box">
                                    <div class="info-label">
                                        Product
                                    </div>

                                    <div class="info-value">
                                        {{ $productionBatch->product->nama ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="info-box">
                                    <div class="info-label">
                                        Product Group
                                    </div>

                                    <div class="info-value">
                                        {{ $productionBatch->product->productGroup->nama ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>

                                    <div>
                                        <div class="stat-label">
                                            Produktifitas
                                        </div>

                                        <div class="stat-value">
                                            @if ($productionBatch->produktifitas !== null)
                                                {{ number_format((float) $productionBatch->produktifitas, 2, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-industry"></i>
                                    </div>

                                    <div>
                                        <div class="stat-label">
                                            Status Production Batch
                                        </div>

                                        <div class="stat-value">
                                            @if ($temperatureTidakMemenuhi)
                                                Parameter Temperature Tidak Memenuhi
                                            @else
                                                Data Produksi
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-stream"></i>
                                    </div>

                                    <div>
                                        <div class="stat-label">
                                            Tipe Proses
                                        </div>

                                        <div class="stat-value">
                                            @php
                                                $tipeProsesLabel = [
                                                    'forming' => 'Forming',
                                                    'non_forming' => 'Non Forming',
                                                    'non_forming_roasted' => 'Non Forming Roasted',
                                                ];
                                            @endphp

                                            @if ($productionBatch->tipe_proses)
                                                {{ $tipeProsesLabel[$productionBatch->tipe_proses] ?? ucfirst(str_replace('_', ' ', $productionBatch->tipe_proses)) }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($productionBatch->productions->count())

                <div class="card mb-4">

                    <div class="card-header">

                        <h4>
                            <span class="step-badge">2</span>
                            Production Detail
                        </h4>

                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-bordered">

                                <thead>

                                    <tr>
                                        <th>Product</th>
                                        <th>Kode Batch</th>
                                        <th class="text-right">Suhu</th>
                                        <th class="text-right">Berat</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($productionBatch->productions as $production)
                                        @foreach ($production->details as $detail)
                                            <tr>

                                                <td>
                                                    {{ $detail->product->nama ?? '-' }}
                                                </td>

                                                <td>
                                                    {{ $production->kode_batch ?? '-' }}
                                                </td>

                                                <td class="text-right">
                                                    {{ $detail->suhu ?? '-' }}
                                                </td>

                                                <td class="text-right">
                                                    {{ $detail->berat_kg !== null ? number_format((float) $detail->berat_kg, 2, ',', '.') . ' Kg' : '-' }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            @endif

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">3</span>
                        Bowl Cutter
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->bowlCutters->count())

                        @foreach ($productionBatch->bowlCutters as $bowlCutter)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Speed</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->speed ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Emulasi</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->suhu_emulasi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Homeganisasi / Orlap</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->homeganisasi_overlap ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->waktu_mulai ? substr($bowlCutter->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->waktu_selesai ? substr($bowlCutter->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $bowlCutter->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-utensils d-block"></i>
                            Belum ada data Bowl Cutter untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">4</span>
                        Grinder
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->grinders->count())

                        @foreach ($productionBatch->grinders as $grinder)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Ukuran Saringan</div>
                                        <div class="process-value">
                                            {{ $grinder->ukuran_saringan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Hasil</div>
                                        <div class="process-value">
                                            {{ $grinder->hasil ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $grinder->waktu_mulai ? substr($grinder->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $grinder->waktu_selesai ? substr($grinder->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $grinder->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $grinder->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $grinder->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $grinder->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $grinder->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-cogs d-block"></i>
                            Belum ada data Grinder untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">5</span>
                        Preparasi FLA
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->preparasiFlas->count())

                        @foreach ($productionBatch->preparasiFlas as $preparasiFla)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Homeganisasi / Orlap</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->homeganisasi_orlap ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu FLA After Cooling Down</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->suhu_fla_after_cooling_down ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->waktu_mulai ? substr($preparasiFla->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->waktu_selesai ? substr($preparasiFla->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $preparasiFla->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-temperature-low d-block"></i>
                            Belum ada data Preparasi FLA untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">6</span>
                        Tumbler
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->tumblers->count())

                        @foreach ($productionBatch->tumblers as $tumbler)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Tumbler</div>
                                        <div class="process-value">
                                            {{ $tumbler->tumbler ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Drum On</div>
                                        <div class="process-value">
                                            {{ $tumbler->drum_on ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Drum Off</div>
                                        <div class="process-value">
                                            {{ $tumbler->drum_off ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Vacuum</div>
                                        <div class="process-value">
                                            {{ $tumbler->vacuum ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $tumbler->waktu_mulai ? substr($tumbler->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $tumbler->waktu_selesai ? substr($tumbler->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $tumbler->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $tumbler->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $tumbler->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $tumbler->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $tumbler->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-sync-alt d-block"></i>
                            Belum ada data Tumbler untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">7</span>
                        Mixing
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->mixings->count())

                        @foreach ($productionBatch->mixings as $mixing)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Mixer Preparation</div>
                                        <div class="process-value">
                                            {{ $mixing->mixer_preparation ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Air</div>
                                        <div class="process-value">
                                            {{ $mixing->suhu_air ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Lama Pengadukan</div>
                                        <div class="process-value">
                                            {{ $mixing->lama_pengadukan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Filter</div>
                                        <div class="process-value">
                                            {{ $mixing->filter ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Salinity</div>
                                        <div class="process-value">
                                            {{ $mixing->salinity ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Brix</div>
                                        <div class="process-value">
                                            {{ $mixing->brix ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Mixer</div>
                                        <div class="process-value">
                                            {{ $mixing->mixer ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Adonan</div>
                                        <div class="process-value">
                                            {{ $mixing->suhu_adonan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $mixing->waktu_mulai ? substr($mixing->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $mixing->waktu_selesai ? substr($mixing->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $mixing->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $mixing->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $mixing->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $mixing->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $mixing->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-blender d-block"></i>
                            Belum ada data Mixing untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">8</span>
                        Forming
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->formings->count())

                        @foreach ($productionBatch->formings as $forming)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $forming->waktu_mulai ? substr($forming->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $forming->waktu_selesai ? substr($forming->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $forming->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $forming->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $forming->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $forming->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $forming->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-shapes d-block"></i>
                            Belum ada data Forming untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">9</span>
                        Batter
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->batters->count())

                        @foreach ($productionBatch->batters as $batter)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Batter</div>
                                        <div class="process-value">
                                            {{ $batter->suhu_batter ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Viskositas</div>
                                        <div class="process-value">
                                            {{ $batter->viskositas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Salinity</div>
                                        <div class="process-value">
                                            {{ $batter->salinity ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $batter->waktu_mulai ? substr($batter->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $batter->waktu_selesai ? substr($batter->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $batter->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $batter->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $batter->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $batter->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $batter->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-fill-drip d-block"></i>
                            Belum ada data Batter untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">10</span>
                        Predust Breader
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->predustBreaders->count())

                        @foreach ($productionBatch->predustBreaders as $predustBreader)
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Predust Breader</div>
                                        <div class="process-value">
                                            {{ $predustBreader->predust_breader ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Superflex</div>
                                        <div class="process-value">
                                            {{ $predustBreader->superflex ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $predustBreader->waktu_mulai ? substr($predustBreader->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $predustBreader->waktu_selesai ? substr($predustBreader->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $predustBreader->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $predustBreader->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $predustBreader->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-0">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $predustBreader->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $predustBreader->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-bread-slice d-block"></i>
                            Belum ada data Predust Breader untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4 {{ $fryerTidakMemenuhi ? 'card-temperature-warning' : '' }}">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">11</span>
                        Fryer
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->fryers->count())

                        @foreach ($productionBatch->fryers as $fryer)
                            {{-- Status suhu pusat (success/warning/danger) sepenuhnya diambil
                                 dari accessor model Fryer::getSuhuPusatStatusAttribute(),
                                 yang otomatis menyesuaikan ambang batas sesuai tipe_proses
                                 pada ProductionBatch terkait. Tidak ada logika threshold
                                 di-duplikasi di view. --}}
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Setting</div>
                                        <div class="process-value">
                                            {{ $fryer->suhu_setting ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Aktual</div>
                                        <div class="process-value">
                                            {{ $fryer->suhu_aktual ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Pusat</div>
                                        <div
                                            class="process-value
                                                {{ $fryer->suhu_pusat_status === 'danger' ? 'text-alert' : '' }}
                                                {{ $fryer->suhu_pusat_status === 'warning' ? 'text-warning' : '' }}">
                                            {{ $fryer->suhu_pusat ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Minimum</div>
                                        <div class="process-value">
                                            {{ $fryer->suhu_minimum ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Lama Pemasakan</div>
                                        <div class="process-value">
                                            {{ $fryer->lama_pemasakan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">TPM Minyak</div>
                                        <div class="process-value">
                                            {{ $fryer->tpm_minyak ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $fryer->waktu_mulai ? substr($fryer->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $fryer->waktu_selesai ? substr($fryer->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $fryer->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $fryer->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $fryer->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $fryer->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $fryer->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-fire d-block"></i>
                            Belum ada data Fryer untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">12</span>
                        HLT
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->hlts->count())

                        @foreach ($productionBatch->hlts as $hlt)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Awal Daging</div>
                                        <div class="process-value">
                                            {{ $hlt->suhu_awal_daging ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Infeed</div>
                                        <div class="process-value">
                                            {{ $hlt->suhu_infeed ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Outfeed</div>
                                        <div class="process-value">
                                            {{ $hlt->suhu_outfeed ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Steam Valve</div>
                                        <div class="process-value">
                                            {{ $hlt->steam_valve ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Speed Ventilator</div>
                                        <div class="process-value">
                                            {{ $hlt->speed_ventilator ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Lama Pemasakan</div>
                                        <div class="process-value">
                                            {{ $hlt->lama_pemasakan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Pusat CT</div>
                                        <div class="process-value">
                                            {{ $hlt->suhu_pusat_ct ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Organoleptik</div>
                                        <div class="process-value">
                                            {{ $hlt->organoleptik ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $hlt->waktu_mulai ? substr($hlt->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $hlt->waktu_selesai ? substr($hlt->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Downtime</div>
                                        <div class="process-value">
                                            {{ $hlt->downtime ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $hlt->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $hlt->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $hlt->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="process-card">
                                        <div class="process-label">Keterangan</div>
                                        <div class="process-value">
                                            {{ $hlt->keterangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-hot-tub d-block"></i>
                            Belum ada data HLT untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4 {{ $pembekuanTidakMemenuhi ? 'card-temperature-warning' : '' }}">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">13</span>
                        Pembekuan
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->pembekuans->count())

                        @foreach ($productionBatch->pembekuans as $pembekuan)
                            @php
                                $pembekuanItemTidakMemenuhi =
                                    $pembekuan->suhu_pusat !== null && (float) $pembekuan->suhu_pusat >= -18;
                            @endphp

                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Ruang Packing</div>
                                        <div class="process-value">
                                            {{ $pembekuan->suhu_ruang_packing ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Ruang IQF</div>
                                        <div class="process-value">
                                            {{ $pembekuan->suhu_ruang_iqf ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Speed Conveyor</div>
                                        <div class="process-value">
                                            {{ $pembekuan->speed_conveyor ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Pusat</div>
                                        <div class="process-value {{ $pembekuanItemTidakMemenuhi ? 'text-alert' : '' }}">
                                            {{ $pembekuan->suhu_pusat ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Suhu Minimum</div>
                                        <div class="process-value">
                                            {{ $pembekuan->suhu_minimum ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Mulai</div>
                                        <div class="process-value">
                                            {{ $pembekuan->waktu_mulai ? substr($pembekuan->waktu_mulai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Selesai</div>
                                        <div class="process-value">
                                            {{ $pembekuan->waktu_selesai ? substr($pembekuan->waktu_selesai, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Lama Waktu Kerusakan</div>
                                        <div class="process-value">
                                            {{ $pembekuan->lama_waktu_kerusakan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Lama Waktu Istirahat</div>
                                        <div class="process-value">
                                            {{ $pembekuan->lama_waktu_istirahat ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Operator</div>
                                        <div class="process-value">
                                            {{ $pembekuan->operator ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $pembekuan->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $pembekuan->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-snowflake d-block"></i>
                            Belum ada data Pembekuan untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">14</span>
                        Metal Detector
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->metalDetectors->count())

                        @foreach ($productionBatch->metalDetectors as $metalDetector)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Batch Type</div>
                                        <div class="process-value">
                                            {{ $metalDetector->batch_type ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Metal Detector</div>
                                        <div class="process-value">
                                            {{ $metalDetector->metal_detector ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Awal</div>
                                        <div class="process-value">
                                            {{ $metalDetector->waktu_awal ? substr($metalDetector->waktu_awal, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Akhir</div>
                                        <div class="process-value">
                                            {{ $metalDetector->waktu_akhir ? substr($metalDetector->waktu_akhir, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-magnet d-block"></i>
                            Belum ada data Metal Detector untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">15</span>
                        Packing Dalam
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->packingDalams->count())

                        @foreach ($productionBatch->packingDalams as $packingDalam)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">MHW Korin</div>
                                        <div class="process-value">
                                            {{ $packingDalam->mhw_korin ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Heating Level</div>
                                        <div class="process-value">
                                            {{ $packingDalam->heating_level ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Speed</div>
                                        <div class="process-value">
                                            {{ $packingDalam->speed ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Pressure</div>
                                        <div class="process-value">
                                            {{ $packingDalam->pressure ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Packing Manual</div>
                                        <div class="process-value">
                                            {{ $packingDalam->packing_manual ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Timbangan</div>
                                        <div class="process-value">
                                            {{ $packingDalam->timbangan ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Heating Level Packing Manual</div>
                                        <div class="process-value">
                                            {{ $packingDalam->heating_level_packing_manual ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Metal Detector</div>
                                        <div class="process-value">
                                            {{ $packingDalam->metal_detector ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Fe / Sus / Non Fe</div>
                                        <div class="process-value">
                                            {{ $packingDalam->fe_sus_non_fe ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Checkweigher PAC</div>
                                        <div class="process-value">
                                            {{ $packingDalam->checkweigher_pac ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas Sortasi After IQF</div>
                                        <div class="process-value">
                                            {{ $packingDalam->petugas_sortasi_after_iqf ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Operator MD</div>
                                        <div class="process-value">
                                            {{ $packingDalam->operator_md ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Leader Produksi</div>
                                        <div class="process-value">
                                            {{ $packingDalam->leader_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Awal</div>
                                        <div class="process-value">
                                            {{ $packingDalam->waktu_awal ? substr($packingDalam->waktu_awal, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Akhir</div>
                                        <div class="process-value">
                                            {{ $packingDalam->waktu_akhir ? substr($packingDalam->waktu_akhir, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Line</div>
                                        <div class="process-value">
                                            {{ $packingDalam->line ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $packingDalam->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @if ($packingDalam->samplings->count())
                                <div class="mt-3">

                                    <div class="process-label mb-2">
                                        Sampling Packing Dalam
                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <thead>
                                                <tr>
                                                    <th>Sampling Ke</th>
                                                    <th>Berat Kemasan</th>
                                                    <th>Berat Per Bag</th>
                                                    <th>Range Berat</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($packingDalam->samplings as $sampling)
                                                    <tr>

                                                        <td>
                                                            {{ $sampling->sampling_ke ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $sampling->berat_kemasan ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $sampling->berat_per_bag ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $sampling->range_berat ?? '-' }}
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            @endif

                            @if ($packingDalam->plastiks->count())
                                <div class="mt-3">

                                    <div class="process-label mb-2">
                                        Penggunaan Plastik
                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Jumlah</th>
                                                    <th>Pemakaian</th>
                                                    <th>Sisa</th>
                                                    <th>Rijek</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($packingDalam->plastiks as $plastik)
                                                    <tr>

                                                        <td>
                                                            {{ $plastik->product->nama ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $plastik->jumlah ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $plastik->pemakaian ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $plastik->sisa ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $plastik->rijek ?? '-' }}
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-box d-block"></i>
                            Belum ada data Packing Dalam untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">16</span>
                        Packing Luar
                    </h4>

                </div>

                <div class="card-body">

                    @if ($productionBatch->packingLuars->count())

                        @foreach ($productionBatch->packingLuars as $packingLuar)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Pengisian ke Dalam Box</div>
                                        <div class="process-value">
                                            {{ $packingLuar->pengisian_ke_dalam_box ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Sealer Box</div>
                                        <div class="process-value">
                                            {{ $packingLuar->sealer_box ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Check Weigher Box</div>
                                        <div class="process-value">
                                            {{ $packingLuar->check_weigher_box ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Petugas</div>
                                        <div class="process-value">
                                            {{ $packingLuar->petugas ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">PIC Produksi</div>
                                        <div class="process-value">
                                            {{ $packingLuar->pic_produksi ?? '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Awal</div>
                                        <div class="process-value">
                                            {{ $packingLuar->waktu_awal ? substr($packingLuar->waktu_awal, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="process-card">
                                        <div class="process-label">Waktu Akhir</div>
                                        <div class="process-value">
                                            {{ $packingLuar->waktu_akhir ? substr($packingLuar->waktu_akhir, 0, 5) : '-' }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @if ($packingLuar->samplings->count())
                                <div class="mt-3">

                                    <div class="process-label mb-2">
                                        Sampling Packing Luar
                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <thead>
                                                <tr>
                                                    <th>Sampling Ke</th>
                                                    <th>Berat Per Box</th>
                                                    <th>Range Berat</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($packingLuar->samplings as $sampling)
                                                    <tr>

                                                        <td>
                                                            {{ $sampling->sampling_ke ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $sampling->berat_per_box ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $sampling->range_berat ?? '-' }}
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            @endif

                            @if ($packingLuar->kemasans->count())
                                <div class="mt-3">

                                    <div class="process-label mb-2">
                                        Pengemasan Box
                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Jumlah</th>
                                                    <th>Pemakaian</th>
                                                    <th>Sisa</th>
                                                    <th>Rijek</th>
                                                    <th>Petugas</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($packingLuar->kemasans as $kemasan)
                                                    <tr>

                                                        <td>
                                                            {{ $kemasan->product->nama ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $kemasan->jumlah ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $kemasan->pemakaian ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $kemasan->sisa ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $kemasan->rijek ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $kemasan->petugas ?? '-' }}
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            @endif

                            @if ($packingLuar->palets->count())
                                <div class="mt-3">

                                    <div class="process-label mb-2">
                                        Palet
                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-bordered">

                                            <thead>
                                                <tr>
                                                    <th>No. Palet</th>
                                                    <th>Product</th>
                                                    <th>Jumlah Pack</th>
                                                    <th>Jumlah Box</th>
                                                    <th>Jumlah Kg</th>
                                                    <th>No. BSTB</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($packingLuar->palets as $palet)
                                                    <tr>

                                                        <td>
                                                            {{ $palet->no_palet ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $palet->product->nama ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $palet->jumlah_pack ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $palet->jumlah_box ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $palet->jumlah_kg ?? '-' }}
                                                        </td>

                                                        <td>
                                                            {{ $palet->no_bstb ?? '-' }}
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="process-empty">
                            <i class="fas fa-boxes d-block"></i>
                            Belum ada data Packing Luar untuk production batch ini.
                        </div>

                    @endif

                </div>

            </div>

            @if ($productionBatch->kemasanRijeks->count())

                <div class="card mb-4">

                    <div class="card-header">

                        <h4>
                            <span class="step-badge">17</span>
                            Kemasan Rijek
                        </h4>

                    </div>

                    <div class="card-body">

                        @foreach ($productionBatch->kemasanRijeks as $kemasanRijek)
                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-fire"></i>
                                        </div>
                                        <div>
                                            <div class="stat-label">Total Cooking</div>
                                            <div class="stat-value">
                                                {{ number_format((float) ($kemasanRijek->total_cooking_kg ?? 0), 2, ',', '.') }}
                                                Kg
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div>
                                            <div class="stat-label">Rijek Cooking</div>
                                            <div class="stat-value">
                                                {{ number_format((float) ($kemasanRijek->total_rijek_cooking_kg ?? 0), 2, ',', '.') }}
                                                Kg
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                        <div>
                                            <div class="stat-label">Total Packing</div>
                                            <div class="stat-value">
                                                {{ number_format((float) ($kemasanRijek->total_packing_kg ?? 0), 2, ',', '.') }}
                                                Kg
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <div>
                                            <div class="stat-label">Rijek Packing</div>
                                            <div class="stat-value">
                                                {{ number_format((float) ($kemasanRijek->total_rijek_packing_kg ?? 0), 2, ',', '.') }}
                                                Kg
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            @endif

            <div class="card card-final">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: .5rem;">

                        <a href="{{ route('operator.production-batch.index') }}" class="btn btn-ghost">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali
                        </a>

                        <div class="d-flex align-items-center" style="gap: .5rem;">

                            <a href="{{ route('production-batch.export', $productionBatch->id) }}"
                                class="btn btn-excel">
                                <i class="fas fa-file-excel mr-1"></i>
                                Excel
                            </a>

                            <a href="{{ route('operator.production-batch.export-pdf', $productionBatch->id) }}"
                                class="btn btn-pdf" target="_blank">
                                <i class="fas fa-file-pdf mr-1"></i>
                                PDF
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
