@extends('layouts.master')

@section('title', 'Detail Packing Luar')

@push('addon-style')
    <style>
        :root {
            --pl-primary: #1B4B43;
            --pl-primary-light: #E8F0EE;
            --pl-accent: #D98C3D;
            --pl-border: #E3E7E1;
            --pl-text: #1F2A24;
            --pl-muted: #5B6A62;
            --pl-soft: #F7F9F7;
        }

        .pl-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pl-text);
        }

        .pl-page .section-lead {
            color: var(--pl-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pl-page .card {
            border: none;
            border-left: 4px solid var(--pl-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pl-page .card.card-final {
            border-left-color: var(--pl-accent);
        }

        .pl-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pl-border);
            padding: 1rem 1.5rem;
        }

        .pl-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pl-text);
            display: flex;
            align-items: center;
        }

        .pl-page .card-header h4 i {
            color: var(--pl-primary);
        }

        .pl-page .card-body {
            padding: 1.5rem;
        }

        .pl-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pl-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pl-page .info-box {
            height: 100%;
            background: var(--pl-soft);
            border: 1px solid var(--pl-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pl-page .info-label {
            color: var(--pl-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pl-page .info-value {
            color: var(--pl-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pl-page .batch-highlight {
            background: linear-gradient(135deg, var(--pl-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pl-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pl-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pl-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pl-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pl-page .table {
            margin-bottom: 0;
            min-width: 900px;
        }

        .pl-page .table-wide {
            min-width: 1500px;
        }

        .pl-page .table thead th {
            background: var(--pl-primary-light);
            color: var(--pl-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .pl-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--pl-text);
            padding: 0.8rem 0.9rem;
            white-space: nowrap;
        }

        .pl-page .table-bordered td,
        .pl-page .table-bordered th {
            border-color: var(--pl-border);
        }

        .pl-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pl-page .badge-soft {
            display: inline-block;
            background: var(--pl-primary-light);
            color: var(--pl-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pl-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pl-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pl-page .section-title {
            color: var(--pl-primary);
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 1rem;
        }

        .pl-page .total-card {
            background: var(--pl-primary-light);
            border: 1px solid var(--pl-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .pl-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--pl-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .pl-page .stat-label {
            color: var(--pl-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pl-page .stat-value {
            color: var(--pl-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pl-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pl-muted);
        }

        .pl-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: 0.6rem;
            opacity: 0.55;
        }

        .pl-page .btn-ghost {
            color: var(--pl-muted);
            background: transparent;
            border: 1px solid var(--pl-border);
        }

        .pl-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pl-text);
        }

        @media (max-width: 767.98px) {
            .pl-page .card-body {
                padding: 1rem;
            }

            .pl-page .card-header {
                padding: 0.9rem 1rem;
            }

            .pl-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="pl-page">

        <div class="section-header">

            <h1>Packing Luar</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('manager.packing-luar.index') }}">
                        Packing Luar
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail data proses packing luar berdasarkan production batch.
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
                                    Kode Product
                                </div>

                                <div class="batch-number">
                                    {{ $packingLuar->productionBatch->product->kode_product ?? '-' }}
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

                                <div class="info-label">
                                    Tanggal Produksi
                                </div>

                                <div class="info-value">

                                    {{ optional($packingLuar->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($packingLuar->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    No Batch
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->productionBatch->product->productGroup->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Line
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->productionBatch->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Awal
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->waktu_awal ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Akhir
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->waktu_akhir ?? '-' }}
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
                        Detail Proses Packing Luar
                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Pengisian ke Dalam Box
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->pengisian_ke_dalam_box ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Sealer Box
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->sealer_box ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Check Weigher Box
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->check_weigher_box ?? '-' }}
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
                        Detail Sampling
                    </h4>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th class="text-center">
                                        No
                                    </th>

                                    <th>
                                        Sampling Ke
                                    </th>

                                    <th>
                                        Berat Per Box
                                    </th>

                                    <th>
                                        Range Berat
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($packingLuar->samplings as $index => $sampling)
                                    <tr>

                                        <td class="text-center">
                                            {{ $index + 1 }}
                                        </td>

                                        <td>

                                            @if ($sampling->sampling_ke !== null)
                                                <span class="badge-soft">
                                                    {{ $sampling->sampling_ke }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($sampling->berat_per_box !== null)
                                                {{ number_format((float) $sampling->berat_per_box, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($sampling->range_berat)
                                                <span class="badge-value">
                                                    {{ $sampling->range_berat }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4">

                                            <div class="empty-state">

                                                <i class="fas fa-weight-hanging d-block"></i>

                                                <div>
                                                    Belum ada data sampling.
                                                </div>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">4</span>
                        Detail Kemasan
                    </h4>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th class="text-center">
                                        No
                                    </th>

                                    <th>
                                        Kode Product
                                    </th>

                                    <th>
                                        Product
                                    </th>

                                    <th class="text-right">
                                        Jumlah
                                    </th>

                                    <th class="text-right">
                                        Pemakaian
                                    </th>

                                    <th class="text-right">
                                        Sisa
                                    </th>

                                    <th class="text-right">
                                        Rijek
                                    </th>

                                    <th>
                                        Petugas
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($packingLuar->kemasans as $index => $kemasan)
                                    <tr>

                                        <td class="text-center">
                                            {{ $index + 1 }}
                                        </td>

                                        <td>

                                            @if ($kemasan->product)
                                                <span class="badge-soft">
                                                    {{ $kemasan->product->kode_product }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>
                                            {{ $kemasan->product->nama ?? '-' }}
                                        </td>

                                        <td class="text-right">

                                            @if ($kemasan->jumlah !== null)
                                                {{ number_format((float) $kemasan->jumlah, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($kemasan->pemakaian !== null)
                                                {{ number_format((float) $kemasan->pemakaian, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($kemasan->sisa !== null)
                                                {{ number_format((float) $kemasan->sisa, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($kemasan->rijek !== null)
                                                <span class="badge-value">
                                                    {{ number_format((float) $kemasan->rijek, 2, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>
                                            {{ $kemasan->petugas ?? '-' }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="8">

                                            <div class="empty-state">

                                                <i class="fas fa-box-open d-block"></i>

                                                <div>
                                                    Belum ada data kemasan.
                                                </div>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">5</span>
                        Detail Palet
                    </h4>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered table-wide">

                            <thead>

                                <tr>

                                    <th class="text-center">
                                        No
                                    </th>

                                    <th>
                                        No Palet
                                    </th>

                                    <th>
                                        Kode Product
                                    </th>

                                    <th>
                                        Product
                                    </th>

                                    <th class="text-right">
                                        Jumlah Pack
                                    </th>

                                    <th class="text-right">
                                        Jumlah Box
                                    </th>

                                    <th class="text-right">
                                        Jumlah Kg
                                    </th>

                                    <th>
                                        No BSTB
                                    </th>

                                    <th class="text-right">
                                        WIP Keluar Bag
                                    </th>

                                    <th class="text-right">
                                        WIP Keluar Kg
                                    </th>

                                    <th class="text-right">
                                        WIP Keluar Lot
                                    </th>

                                    <th class="text-right">
                                        WIP Masuk
                                    </th>

                                    <th>
                                        Checker FG
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($packingLuar->palets as $index => $palet)
                                    <tr>

                                        <td class="text-center">
                                            {{ $index + 1 }}
                                        </td>

                                        <td>

                                            @if ($palet->no_palet !== null)
                                                <span class="badge-soft">
                                                    {{ $palet->no_palet }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($palet->product)
                                                <span class="badge-soft">
                                                    {{ $palet->product->kode_product }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>
                                            {{ $palet->product->nama ?? '-' }}
                                        </td>

                                        <td class="text-right">

                                            @if ($palet->jumlah_pack !== null)
                                                {{ number_format((float) $palet->jumlah_pack, 0, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($palet->jumlah_box !== null)
                                                {{ number_format((float) $palet->jumlah_box, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($palet->jumlah_kg !== null)
                                                {{ number_format((float) $palet->jumlah_kg, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($palet->no_bstb)
                                                <span class="badge-value">
                                                    {{ $palet->no_bstb }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($palet->jumlah_wip_keluar_bag !== null)
                                                {{ number_format((float) $palet->jumlah_wip_keluar_bag, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($palet->jumlah_wip_keluar_kg !== null)
                                                {{ number_format((float) $palet->jumlah_wip_keluar_kg, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($palet->jumlah_wip_keluar_lot !== null)
                                                {{ number_format((float) $palet->jumlah_wip_keluar_lot, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($palet->jumlah_wip_masuk !== null)
                                                {{ number_format((float) $palet->jumlah_wip_masuk, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>
                                            {{ $palet->checker_fg ?? '-' }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="13">

                                            <div class="empty-state">

                                                <i class="fas fa-pallet d-block"></i>

                                                <div>
                                                    Belum ada data palet.
                                                </div>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>
                        <span class="step-badge">6</span>
                        Keterangan Produksi
                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Petugas
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->petugas ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $packingLuar->pic_produksi ?? '-' }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card card-final mb-4">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8 mb-3 mb-md-0">

                            <div class="total-card">

                                <div class="stat-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Packing Luar
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.packing-luar.index') }}" class="btn btn-ghost">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
