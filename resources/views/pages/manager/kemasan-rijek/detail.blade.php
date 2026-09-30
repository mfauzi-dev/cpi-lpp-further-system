@extends('layouts.master')

@section('title', 'Detail Kemasan Rijek')

@push('addon-style')
    <style>
        :root {
            --kr-primary: #1B4B43;
            --kr-primary-light: #E8F0EE;
            --kr-accent: #D98C3D;
            --kr-border: #E3E7E1;
            --kr-text: #1F2A24;
            --kr-muted: #5B6A62;
            --kr-soft: #F7F9F7;
        }

        .kr-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--kr-text);
        }

        .kr-page .section-lead {
            color: var(--kr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .kr-page .card {
            border: none;
            border-left: 4px solid var(--kr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .kr-page .card.card-final {
            border-left-color: var(--kr-accent);
        }

        .kr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--kr-border);
            padding: 1rem 1.5rem;
        }

        .kr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--kr-text);
            display: flex;
            align-items: center;
        }

        .kr-page .card-header h4 i {
            color: var(--kr-primary);
        }

        .kr-page .card-body {
            padding: 1.5rem;
        }

        .kr-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--kr-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .kr-page .info-box {
            height: 100%;
            background: var(--kr-soft);
            border: 1px solid var(--kr-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .kr-page .info-label {
            color: var(--kr-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .kr-page .info-value {
            color: var(--kr-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .kr-page .batch-highlight {
            background: linear-gradient(135deg, var(--kr-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .kr-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .kr-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .kr-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .kr-page .total-card {
            background: var(--kr-primary-light);
            border: 1px solid var(--kr-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .kr-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--kr-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .kr-page .stat-label {
            color: var(--kr-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .kr-page .stat-value {
            color: var(--kr-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .kr-page .badge-soft {
            display: inline-block;
            background: var(--kr-primary-light);
            color: var(--kr-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .kr-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .kr-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .kr-page .detail-table {
            margin-bottom: 0;
        }

        .kr-page .detail-table th {
            background: var(--kr-soft);
            color: var(--kr-muted);
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            white-space: nowrap;
            border-top: 1px solid var(--kr-border);
            border-bottom: 1px solid var(--kr-border);
            padding: 0.85rem 0.9rem;
        }

        .kr-page .detail-table td {
            color: var(--kr-text);
            font-size: 0.85rem;
            vertical-align: middle;
            padding: 0.85rem 0.9rem;
            border-bottom: 1px solid #EDF0ED;
        }

        .kr-page .detail-table tbody tr:last-child td {
            border-bottom: none;
        }

        .kr-page .detail-table .total-row td {
            background: var(--kr-primary-light);
            font-weight: 700;
            color: var(--kr-primary);
        }

        .kr-page .btn-ghost {
            color: var(--kr-muted);
            background: transparent;
            border: 1px solid var(--kr-border);
        }

        .kr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--kr-text);
        }

        @media (max-width: 767.98px) {
            .kr-page .card-body {
                padding: 1rem;
            }

            .kr-page .card-header {
                padding: 0.9rem 1rem;
            }

            .kr-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="kr-page">

        <div class="section-header">
            <h1>Kemasan Rijek</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('manager.kemasan-rijek.index') }}">
                        Kemasan Rijek
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail data kemasan rijek berdasarkan production batch.
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
                                    {{ $kemasanRijek->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $kemasanRijek->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($kemasanRijek->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($kemasanRijek->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ optional($kemasanRijek->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($kemasanRijek->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $kemasanRijek->productionBatch->no_batch ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $kemasanRijek->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $kemasanRijek->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $kemasanRijek->productionBatch->line ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">
                                    @if ($kemasanRijek->productionBatch && $kemasanRijek->productionBatch->waktu_kerja !== null)
                                        {{ $kemasanRijek->productionBatch->waktu_kerja }} Menit
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-label">
                                    Process
                                </div>

                                <div class="info-value">
                                    Kemasan Rijek
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
                        Rijek Cooking
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row mb-4">

                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="total-card">
                                <div class="stat-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Total Cooking
                                    </div>

                                    <div class="stat-value">
                                        @if ($kemasanRijek->total_cooking_kg !== null)
                                            {{ number_format((float) $kemasanRijek->total_cooking_kg, 2, ',', '.') }} Kg
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="total-card">
                                <div class="stat-icon">
                                    <i class="fas fa-recycle"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Total Rijek Cooking
                                    </div>

                                    <div class="stat-value">
                                        {{ number_format((float) ($kemasanRijek->total_rijek_cooking_kg ?? 0), 2, ',', '.') }}
                                        Kg
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table detail-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Rijek</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Rusak</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->rusak_cooking ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Jatuh Lantai</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->jatuh_lantai_cooking ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Kulit</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->kulit_cooking ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Serpihan</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->serpihan_cooking ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>Serbuk</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->serbuk_cooking ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td>Gosong</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->gosong_cooking ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>7</td>
                                    <td>Sampel QC</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->sampel_qc_cooking ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>8</td>
                                    <td>Lain-lain</td>
                                    <td>
                                        {{ $kemasanRijek->lain_lain_cooking ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>9</td>
                                    <td>Lain-lain KG</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->lain_lain_cooking_kg ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>

                                <tr class="total-row">
                                    <td colspan="2">
                                        Total Rijek Cooking
                                    </td>

                                    <td>
                                        {{ number_format((float) ($kemasanRijek->total_rijek_cooking_kg ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>
                        <span class="step-badge">3</span>
                        Rijek Packing
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row mb-4">

                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="total-card">
                                <div class="stat-icon">
                                    <i class="fas fa-box"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Total Packing
                                    </div>

                                    <div class="stat-value">
                                        @if ($kemasanRijek->total_packing_kg !== null)
                                            {{ number_format((float) $kemasanRijek->total_packing_kg, 2, ',', '.') }} Kg
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="total-card">
                                <div class="stat-icon">
                                    <i class="fas fa-recycle"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Total Rijek Packing
                                    </div>

                                    <div class="stat-value">
                                        {{ number_format((float) ($kemasanRijek->total_rijek_packing_kg ?? 0), 2, ',', '.') }}
                                        Kg
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table detail-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Rijek</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Rusak</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->rusak_packing ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Jatuh Lantai</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->jatuh_lantai_packing ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>Kulit</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->kulit_packing ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Serpihan</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->serpihan_packing ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>Serbuk</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->serbuk_packing ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td>Gosong</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->gosong_packing ?? 0), 2, ',', '.') }} Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>7</td>
                                    <td>Sampel QC</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->sampel_qc_packing ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>

                                <tr>
                                    <td>8</td>
                                    <td>Lain-lain</td>
                                    <td>
                                        {{ $kemasanRijek->lain_lain_packing ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>9</td>
                                    <td>Lain-lain KG</td>
                                    <td>
                                        {{ number_format((float) ($kemasanRijek->lain_lain_packing_kg ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>

                                <tr class="total-row">
                                    <td colspan="2">
                                        Total Rijek Packing
                                    </td>

                                    <td>
                                        {{ number_format((float) ($kemasanRijek->total_rijek_packing_kg ?? 0), 2, ',', '.') }}
                                        Kg
                                    </td>
                                </tr>
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
                                    <i class="fas fa-recycle"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Kemasan Rijek
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex justify-content-md-end">
                                <a href="{{ route('manager.kemasan-rijek.index') }}" class="btn btn-ghost">
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
