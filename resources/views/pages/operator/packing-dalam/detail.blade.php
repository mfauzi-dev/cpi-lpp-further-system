@extends('layouts.master')

@section('title', 'Detail Packing Dalam')

@push('addon-style')
    <style>
        :root {
            --pdk-primary: #1B4B43;
            --pdk-primary-light: #E8F0EE;
            --pdk-accent: #D98C3D;
            --pdk-border: #E3E7E1;
            --pdk-text: #1F2A24;
            --pdk-muted: #5B6A62;
            --pdk-soft: #F7F9F7;
        }

        .pdk-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pdk-text);
        }

        .pdk-page .section-lead {
            color: var(--pdk-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pdk-page .card {
            border: none;
            border-left: 4px solid var(--pdk-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pdk-page .card.card-final {
            border-left-color: var(--pdk-accent);
        }

        .pdk-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pdk-border);
            padding: 1rem 1.5rem;
        }

        .pdk-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pdk-text);
            display: flex;
            align-items: center;
        }

        .pdk-page .card-header h4 i {
            color: var(--pdk-primary);
        }

        .pdk-page .card-body {
            padding: 1.5rem;
        }

        .pdk-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pdk-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pdk-page .info-box {
            height: 100%;
            background: var(--pdk-soft);
            border: 1px solid var(--pdk-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pdk-page .info-label {
            color: var(--pdk-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pdk-page .info-value {
            color: var(--pdk-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pdk-page .batch-highlight {
            background: linear-gradient(135deg, var(--pdk-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pdk-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pdk-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pdk-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pdk-page .stat-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--pdk-border);
            border-radius: 9px;
            padding: 1rem;
            display: flex;
            align-items: center;
        }

        .pdk-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--pdk-primary-light);
            color: var(--pdk-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .pdk-page .stat-label {
            color: var(--pdk-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pdk-page .stat-value {
            color: var(--pdk-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pdk-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pdk-page .table {
            margin-bottom: 0;
        }

        .pdk-page .table thead th {
            background: var(--pdk-primary-light);
            color: var(--pdk-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .pdk-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--pdk-text);
            padding: 0.8rem 0.9rem;
        }

        .pdk-page .table-bordered td,
        .pdk-page .table-bordered th {
            border-color: var(--pdk-border);
        }

        .pdk-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pdk-page .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--pdk-muted);
        }

        .pdk-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: 0.6rem;
            opacity: 0.55;
        }

        .pdk-page .badge-soft {
            display: inline-block;
            background: var(--pdk-primary-light);
            color: var(--pdk-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pdk-page .table-wide-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pdk-page .table-wide {
            min-width: 1500px;
        }

        .pdk-page .table-wide th,
        .pdk-page .table-wide td {
            padding: 0.85rem 1rem;
            white-space: nowrap;
        }

        .pdk-page .btn-ghost {
            color: var(--pdk-muted);
            background: transparent;
            border: 1px solid var(--pdk-border);
        }

        .pdk-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pdk-text);
        }

        .pdk-page .section-divider {
            height: 1px;
            background: var(--pdk-border);
            margin: 1.25rem 0;
        }

        @media (max-width: 767.98px) {
            .pdk-page .card-body {
                padding: 1rem;
            }

            .pdk-page .card-header {
                padding: 0.9rem 1rem;
            }

            .pdk-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="pdk-page">
        <div class="section-header">
            <h1>Packing Dalam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.packing-dalam.index') }}">
                        Packing Dalam
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail proses packing dalam berdasarkan production batch yang telah dicatat.
        </p>

        <div class="section-body">

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">1</span>
                        Informasi Produksi
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
                                    {{ $packingDalam->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $packingDalam->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($packingDalam->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($packingDalam->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Tanggal Produksi</div>

                                <div class="info-value">
                                    {{ optional($packingDalam->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($packingDalam->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">No Batch</div>

                                <div class="info-value">
                                    {{ $packingDalam->productionBatch->no_batch ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Product</div>

                                <div class="info-value">
                                    {{ $packingDalam->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Line</div>

                                <div class="info-value">
                                    {{ $packingDalam->productionBatch->line ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-clock"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Waktu Kerja</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->productionBatch->waktu_kerja ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-play"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Waktu Awal</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->waktu_awal ? \Carbon\Carbon::parse($packingDalam->waktu_awal)->format('H:i') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-stop"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Waktu Akhir</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->waktu_akhir ? \Carbon\Carbon::parse($packingDalam->waktu_akhir)->format('H:i') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">2</span>
                        Parameter Packing Dalam
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-user-cog"></i>
                                </div>

                                <div>
                                    <div class="stat-label">MHW / Korin</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->mhw_korin ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-fire"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Heating Level</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->heating_level !== null
                                            ? number_format((float) $packingDalam->heating_level, 2, ',', '.')
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Speed</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->speed !== null ? number_format((float) $packingDalam->speed, 2, ',', '.') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Pressure</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->pressure ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-box"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Packing Manual</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->packing_manual ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-weight-hanging"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Timbangan</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->timbangan ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-temperature-high"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Heating Level Packing Manual</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->heating_level_packing_manual !== null
                                            ? number_format((float) $packingDalam->heating_level_packing_manual, 2, ',', '.')
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-search"></i>
                                </div>

                                <div>
                                    <div class="stat-label">FE / SUS / Non FE</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->fe_sus_non_fe ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-arrows-alt-h"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Setting X</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->setting_x !== null ? number_format((float) $packingDalam->setting_x, 2, ',', '.') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-arrows-alt-v"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Setting Y</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->setting_y !== null ? number_format((float) $packingDalam->setting_y, 2, ',', '.') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-balance-scale"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Checkweigher PAC</div>

                                    <div class="stat-value">
                                        {{ $packingDalam->checkweigher_pac ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">Petugas Sortasi After IQF</div>

                                <div class="info-value">
                                    {{ $packingDalam->petugas_sortasi_after_iqf ?: '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="info-label">Operator MD</div>

                                <div class="info-value">
                                    {{ $packingDalam->operator_md ?: '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">Leader Produksi</div>

                                <div class="info-value">
                                    {{ $packingDalam->leader_produksi ?: '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="info-label">PIC Produksi</div>

                                <div class="info-value">
                                    {{ $packingDalam->pic_produksi ?: '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">3</span>
                        Sampling
                    </h4>
                </div>

                <div class="card-body">
                    @if ($packingDalam->samplings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th width="70">No</th>
                                        <th>Sampling Ke</th>
                                        <th>Berat Kemasan</th>
                                        <th>Berat Per Bag</th>
                                        <th>Range Berat</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($packingDalam->samplings as $index => $sampling)
                                        <tr>
                                            <td class="text-center font-weight-bold">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="text-center">
                                                <span class="badge-soft">
                                                    Sampling {{ $sampling->sampling_ke }}
                                                </span>
                                            </td>

                                            <td class="text-right">
                                                {{ $sampling->berat_kemasan !== null ? number_format((float) $sampling->berat_kemasan, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $sampling->berat_per_bag !== null ? number_format((float) $sampling->berat_per_bag, 2, ',', '.') : '-' }}
                                            </td>

                                            <td>
                                                {{ $sampling->range_berat ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-clipboard-list d-block"></i>
                            <div>Tidak ada data sampling.</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">4</span>
                        Pemakaian Plastik
                    </h4>
                </div>

                <div class="card-body">
                    @if ($packingDalam->plastiks->count() > 0)
                        <div class="table-wide-wrap">
                            <table class="table table-bordered table-wide">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Jumlah</th>
                                        <th>Pemakaian</th>
                                        <th>Sisa</th>
                                        <th>Rijek</th>
                                        <th>Operator MHW</th>
                                        <th>Checker DS</th>
                                        <th>Leader</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($packingDalam->plastiks as $index => $plastik)
                                        <tr>
                                            <td class="text-center font-weight-bold">
                                                {{ $index + 1 }}
                                            </td>

                                            <td>
                                                @if ($plastik->product)
                                                    <strong>
                                                        {{ $plastik->product->kode_product ?? '-' }}
                                                    </strong>

                                                    <br>

                                                    <small class="text-muted">
                                                        {{ $plastik->product->nama ?? '-' }}
                                                    </small>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="text-right">
                                                {{ $plastik->jumlah !== null ? number_format((float) $plastik->jumlah, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $plastik->pemakaian !== null ? number_format((float) $plastik->pemakaian, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $plastik->sisa !== null ? number_format((float) $plastik->sisa, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $plastik->rijek !== null ? number_format((float) $plastik->rijek, 2, ',', '.') : '-' }}
                                            </td>

                                            <td>
                                                {{ $plastik->operator_mhw ?: '-' }}
                                            </td>

                                            <td>
                                                {{ $plastik->checker_ds ?: '-' }}
                                            </td>

                                            <td>
                                                {{ $plastik->leader ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-box-open d-block"></i>
                            <div>Tidak ada data pemakaian plastik.</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card card-final">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('operator.packing-dalam.index') }}" class="btn btn-ghost">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
