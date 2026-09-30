@extends('layouts.master')

@section('title', 'Detail Packing Luar')

@push('addon-style')
    <style>
        :root {
            --pld-primary: #1B4B43;
            --pld-primary-light: #E8F0EE;
            --pld-accent: #D98C3D;
            --pld-border: #E3E7E1;
            --pld-text: #1F2A24;
            --pld-muted: #5B6A62;
            --pld-soft: #F7F9F7;
        }

        .pld-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pld-text);
        }

        .pld-page .section-lead {
            color: var(--pld-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pld-page .card {
            border: none;
            border-left: 4px solid var(--pld-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pld-page .card.card-final {
            border-left-color: var(--pld-accent);
        }

        .pld-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pld-border);
            padding: 1rem 1.5rem;
        }

        .pld-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pld-text);
            display: flex;
            align-items: center;
        }

        .pld-page .card-header h4 i {
            color: var(--pld-primary);
        }

        .pld-page .card-body {
            padding: 1.5rem;
        }

        .pld-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pld-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pld-page .info-box {
            height: 100%;
            background: var(--pld-soft);
            border: 1px solid var(--pld-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pld-page .info-label {
            color: var(--pld-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pld-page .info-value {
            color: var(--pld-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pld-page .batch-highlight {
            background: linear-gradient(135deg, var(--pld-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pld-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pld-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pld-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pld-page .stat-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--pld-border);
            border-radius: 9px;
            padding: 1rem;
            display: flex;
            align-items: center;
        }

        .pld-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--pld-primary-light);
            color: var(--pld-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .pld-page .stat-label {
            color: var(--pld-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pld-page .stat-value {
            color: var(--pld-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pld-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pld-page .table {
            margin-bottom: 0;
        }

        .pld-page .table thead th {
            background: var(--pld-primary-light);
            color: var(--pld-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .pld-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--pld-text);
            padding: 0.8rem 0.9rem;
        }

        .pld-page .table-bordered td,
        .pld-page .table-bordered th {
            border-color: var(--pld-border);
        }

        .pld-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pld-page .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--pld-muted);
        }

        .pld-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: 0.6rem;
            opacity: 0.55;
        }

        .pld-page .badge-soft {
            display: inline-block;
            background: var(--pld-primary-light);
            color: var(--pld-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pld-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pld-page .table-wide-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pld-page .table-wide {
            min-width: 1500px;
        }

        .pld-page .table-wide th,
        .pld-page .table-wide td {
            padding: 0.85rem 1rem;
            white-space: nowrap;
        }

        .pld-page .btn-primary {
            background: var(--pld-primary);
            border-color: var(--pld-primary);
        }

        .pld-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pld-page .btn-ghost {
            color: var(--pld-muted);
            background: transparent;
            border: 1px solid var(--pld-border);
        }

        .pld-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pld-text);
        }

        .pld-page .section-divider {
            height: 1px;
            background: var(--pld-border);
            margin: 1.25rem 0;
        }

        @media (max-width: 767.98px) {
            .pld-page .card-body {
                padding: 1rem;
            }

            .pld-page .card-header {
                padding: 0.9rem 1rem;
            }

            .pld-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content') <div class="pld-page">


        <div class="section-header">
            <h1>Packing Luar</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.packing-luar.index') }}">
                        Packing Luar
                    </a>
                </div>
                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail proses packing luar berdasarkan production batch yang telah dicatat.
        </p>

        <div class="section-body">

            {{-- INFORMASI PRODUKSI --}}
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
                                    {{ $packingLuar->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $packingLuar->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($packingLuar->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($packingLuar->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ optional($packingLuar->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($packingLuar->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">No Batch</div>
                                <div class="info-value">
                                    {{ $packingLuar->productionBatch->no_batch ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Product</div>
                                <div class="info-value">
                                    {{ $packingLuar->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Line</div>
                                <div class="info-value">
                                    {{ $packingLuar->productionBatch->line ?? '-' }}
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
                                        {{ $packingLuar->productionBatch->waktu_kerja ?? '-' }}
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
                                        {{ $packingLuar->waktu_awal ? \Carbon\Carbon::parse($packingLuar->waktu_awal)->format('H:i') : '-' }}
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
                                        {{ $packingLuar->waktu_akhir ? \Carbon\Carbon::parse($packingLuar->waktu_akhir)->format('H:i') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- PARAMETER PACKING --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">2</span>
                        Parameter Packing Luar
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-box"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Pengisian ke Dalam Box</div>
                                    <div class="stat-value">
                                        {{ $packingLuar->pengisian_ke_dalam_box ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>

                                <div>
                                    <div class="stat-label">Sealer Box</div>
                                    <div class="stat-value">
                                        {{ $packingLuar->sealer_box ?: '-' }}
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
                                    <div class="stat-label">Check Weigher Box</div>
                                    <div class="stat-value">
                                        {{ $packingLuar->check_weigher_box ?: '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="section-divider"></div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="info-label">Petugas</div>
                                <div class="info-value">
                                    {{ $packingLuar->petugas ?: '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3 mt-md-0">
                            <div class="info-box">
                                <div class="info-label">PIC Produksi</div>
                                <div class="info-value">
                                    {{ $packingLuar->pic_produksi ?: '-' }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- SAMPLING --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">3</span>
                        Sampling
                    </h4>
                </div>

                <div class="card-body">

                    @if ($packingLuar->samplings->count() > 0)

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th width="70">No</th>
                                        <th>Sampling Ke</th>
                                        <th>Berat Per Box</th>
                                        <th>Range Berat</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($packingLuar->samplings as $index => $sampling)
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
                                                {{ $sampling->berat_per_box !== null ? number_format((float) $sampling->berat_per_box, 2, ',', '.') : '-' }}
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

            {{-- PENGEMASAN BOX --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">4</span>
                        Pengemasan Box
                    </h4>
                </div>

                <div class="card-body">

                    @if ($packingLuar->kemasans->count() > 0)

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
                                        <th>Petugas</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($packingLuar->kemasans as $index => $kemasan)
                                        <tr>
                                            <td class="text-center font-weight-bold">
                                                {{ $index + 1 }}
                                            </td>

                                            <td>
                                                @if ($kemasan->product)
                                                    <strong>{{ $kemasan->product->kode_product ?? '-' }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $kemasan->product->nama ?? '-' }}
                                                    </small>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="text-right">
                                                {{ $kemasan->jumlah !== null ? number_format((float) $kemasan->jumlah, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $kemasan->pemakaian !== null ? number_format((float) $kemasan->pemakaian, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $kemasan->sisa !== null ? number_format((float) $kemasan->sisa, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $kemasan->rijek !== null ? number_format((float) $kemasan->rijek, 2, ',', '.') : '-' }}
                                            </td>

                                            <td>
                                                {{ $kemasan->petugas ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-box-open d-block"></i>
                            <div>Tidak ada data pengemasan box.</div>
                        </div>

                    @endif

                </div>
            </div>

            {{-- PALET --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">5</span>
                        Palet
                    </h4>
                </div>

                <div class="card-body">

                    @if ($packingLuar->palets->count() > 0)

                        <div class="table-wide-wrap">
                            <table class="table table-bordered table-wide">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>No BSTB</th>
                                        <th>Jumlah Box</th>
                                        <th>Jumlah Pack</th>
                                        <th>Jumlah Kg</th>
                                        <th>WIP Keluar Bag</th>
                                        <th>WIP Keluar Kg</th>
                                        <th>WIP Keluar Lot</th>
                                        <th>WIP Masuk</th>
                                        <th>Checker FG</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($packingLuar->palets as $index => $palet)
                                        <tr>
                                            <td class="text-center font-weight-bold">
                                                {{ $palet->no_palet ?? $index + 1 }}
                                            </td>

                                            <td>
                                                @if ($palet->product)
                                                    <strong>{{ $palet->product->kode_product ?? '-' }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $palet->product->nama ?? '-' }}
                                                    </small>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>
                                                {{ $palet->no_bstb ?: '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $palet->jumlah_box !== null ? number_format((float) $palet->jumlah_box, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $palet->jumlah_pack !== null ? number_format((float) $palet->jumlah_pack, 0, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $palet->jumlah_kg !== null ? number_format((float) $palet->jumlah_kg, 2, ',', '.') : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $palet->jumlah_wip_keluar_bag !== null
                                                    ? number_format((float) $palet->jumlah_wip_keluar_bag, 2, ',', '.')
                                                    : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $palet->jumlah_wip_keluar_kg !== null
                                                    ? number_format((float) $palet->jumlah_wip_keluar_kg, 2, ',', '.')
                                                    : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $palet->jumlah_wip_keluar_lot !== null
                                                    ? number_format((float) $palet->jumlah_wip_keluar_lot, 2, ',', '.')
                                                    : '-' }}
                                            </td>

                                            <td class="text-right">
                                                {{ $palet->jumlah_wip_masuk !== null ? number_format((float) $palet->jumlah_wip_masuk, 2, ',', '.') : '-' }}
                                            </td>

                                            <td>
                                                {{ $palet->checker_fg ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-pallet d-block"></i>
                            <div>Tidak ada data palet.</div>
                        </div>

                    @endif

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="card card-final">
                <div class="card-body">
                    <div class="d-flex justify-content-end">

                        <a href="{{ route('operator.packing-luar.index') }}" class="btn btn-ghost">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
