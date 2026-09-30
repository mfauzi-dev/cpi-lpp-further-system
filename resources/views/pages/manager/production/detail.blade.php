@extends('layouts.master')

@section('title', 'Detail Produksi Bahan Baku')

@push('addon-style')
    <style>
        :root {
            --pr-primary: #1B4B43;
            --pr-primary-light: #E8F0EE;
            --pr-accent: #D98C3D;
            --pr-border: #E3E7E1;
            --pr-text: #1F2A24;
            --pr-muted: #5B6A62;
            --pr-soft: #F7F9F7;
        }

        .pr-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pr-text);
        }

        .pr-page .section-lead {
            color: var(--pr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pr-page .card {
            border: none;
            border-left: 4px solid var(--pr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pr-page .card.card-final {
            border-left-color: var(--pr-accent);
        }

        .pr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pr-border);
            padding: 1rem 1.5rem;
        }

        .pr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pr-text);
            display: flex;
            align-items: center;
        }

        .pr-page .card-header h4 i {
            color: var(--pr-primary);
        }

        .pr-page .card-body {
            padding: 1.5rem;
        }

        .pr-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pr-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pr-page .info-box {
            height: 100%;
            background: var(--pr-soft);
            border: 1px solid var(--pr-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pr-page .info-label {
            color: var(--pr-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pr-page .info-value {
            color: var(--pr-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pr-page .batch-highlight {
            background: linear-gradient(135deg, var(--pr-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pr-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pr-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pr-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pr-page .process-highlight {
            background: var(--pr-primary-light);
            border: 1px solid var(--pr-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            margin-bottom: 1.25rem;
        }

        .pr-page .process-label {
            color: var(--pr-muted);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .pr-page .process-value {
            color: var(--pr-primary);
            font-size: 1.15rem;
            font-weight: 700;
        }

        .pr-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pr-page .table {
            margin-bottom: 0;
            min-width: 850px;
        }

        .pr-page .table thead th {
            background: var(--pr-primary-light);
            color: var(--pr-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .pr-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--pr-text);
            padding: 0.8rem 0.9rem;
        }

        .pr-page .table-bordered td,
        .pr-page .table-bordered th {
            border-color: var(--pr-border);
        }

        .pr-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pr-page .badge-soft {
            display: inline-block;
            background: var(--pr-primary-light);
            color: var(--pr-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pr-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pr-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pr-page .total-card {
            background: var(--pr-primary-light);
            border: 1px solid var(--pr-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .pr-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--pr-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .pr-page .stat-label {
            color: var(--pr-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pr-page .stat-value {
            color: var(--pr-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pr-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pr-muted);
        }

        .pr-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: 0.6rem;
            opacity: 0.55;
        }

        .pr-page .btn-ghost {
            color: var(--pr-muted);
            background: transparent;
            border: 1px solid var(--pr-border);
        }

        .pr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pr-text);
        }

        @media (max-width: 767.98px) {
            .pr-page .card-body {
                padding: 1rem;
            }

            .pr-page .card-header {
                padding: 0.9rem 1rem;
            }

            .pr-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="pr-page">

        <div class="section-header">
            <h1>Produksi Bahan Baku</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('manager.production.index') }}">
                        Produksi Bahan Baku
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail data produksi bahan baku berdasarkan production batch dan proses produksi.
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
                                    {{ $production->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $production->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ optional($production->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($production->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ optional($production->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($production->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $production->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $production->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $production->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $production->productionBatch->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">

                                    @if ($production->productionBatch && $production->productionBatch->waktu_kerja !== null)
                                        {{ $production->productionBatch->waktu_kerja }} Menit
                                    @else
                                        -
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Process Type
                                </div>

                                <div class="info-value">
                                    {{ $production->processType->name ?? '-' }}
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
                        Detail Bahan Baku
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
                                        Product
                                    </th>

                                    <th>
                                        Kode Batch
                                    </th>

                                    <th class="text-right">
                                        Suhu
                                    </th>

                                    <th class="text-right">
                                        Berat (Kg)
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($production->details as $index => $detail)
                                    <tr>

                                        <td class="text-center">
                                            {{ $index + 1 }}
                                        </td>

                                        <td>

                                            @if ($detail->product)
                                                {{ $detail->product->nama }}
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($detail->kode_batch)
                                                <span class="badge-soft">
                                                    {{ $detail->kode_batch }}
                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($detail->suhu !== null)
                                                <span class="badge-value">
                                                    {{ number_format((float) $detail->suhu, 2, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td class="text-right">

                                            @if ($detail->berat_kg !== null)
                                                {{ number_format((float) $detail->berat_kg, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5">

                                            <div class="empty-state">

                                                <i class="fas fa-box-open d-block"></i>

                                                <div>
                                                    Belum ada detail bahan baku.
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

            <div class="card card-final mb-4">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8 mb-3 mb-md-0">

                            <div class="total-card">

                                <div class="stat-icon">
                                    <i class="fas fa-weight-hanging"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Total Berat Bahan Baku
                                    </div>

                                    <div class="stat-value">

                                        {{ number_format((float) $production->details->sum('berat_kg'), 2, ',', '.') }}

                                        Kg

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.production.index') }}" class="btn btn-ghost">

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
