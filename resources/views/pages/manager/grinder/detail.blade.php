@extends('layouts.master')

@section('title', 'Detail Grinder')

@push('addon-style')
    <style>
        :root {
            --gr-primary: #1B4B43;
            --gr-primary-light: #E8F0EE;
            --gr-accent: #D98C3D;
            --gr-border: #E3E7E1;
            --gr-text: #1F2A24;
            --gr-muted: #5B6A62;
            --gr-soft: #F7F9F7;
        }

        .gr-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--gr-text);
        }

        .gr-page .section-lead {
            color: var(--gr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .gr-page .card {
            border: none;
            border-left: 4px solid var(--gr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .gr-page .card.card-final {
            border-left-color: var(--gr-accent);
        }

        .gr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--gr-border);
            padding: 1rem 1.5rem;
        }

        .gr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--gr-text);
            display: flex;
            align-items: center;
        }

        .gr-page .card-header h4 i {
            color: var(--gr-primary);
        }

        .gr-page .card-body {
            padding: 1.5rem;
        }

        .gr-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--gr-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .gr-page .info-box {
            height: 100%;
            background: var(--gr-soft);
            border: 1px solid var(--gr-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .gr-page .info-label {
            color: var(--gr-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .gr-page .info-value {
            color: var(--gr-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .gr-page .batch-highlight {
            background: linear-gradient(135deg, var(--gr-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .gr-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .gr-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .gr-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .gr-page .process-highlight {
            background: var(--gr-primary-light);
            border: 1px solid var(--gr-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            margin-bottom: 1.25rem;
        }

        .gr-page .process-label {
            color: var(--gr-muted);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .gr-page .process-value {
            color: var(--gr-primary);
            font-size: 1.15rem;
            font-weight: 700;
        }

        .gr-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .gr-page .table {
            margin-bottom: 0;
            min-width: 950px;
        }

        .gr-page .table thead th {
            background: var(--gr-primary-light);
            color: var(--gr-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .gr-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--gr-text);
            padding: 0.8rem 0.9rem;
        }

        .gr-page .table-bordered td,
        .gr-page .table-bordered th {
            border-color: var(--gr-border);
        }

        .gr-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .gr-page .badge-soft {
            display: inline-block;
            background: var(--gr-primary-light);
            color: var(--gr-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .gr-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .gr-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .gr-page .total-card {
            background: var(--gr-primary-light);
            border: 1px solid var(--gr-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .gr-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--gr-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .gr-page .stat-label {
            color: var(--gr-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .gr-page .stat-value {
            color: var(--gr-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .gr-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--gr-muted);
        }

        .gr-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: 0.6rem;
            opacity: 0.55;
        }

        .gr-page .btn-ghost {
            color: var(--gr-muted);
            background: transparent;
            border: 1px solid var(--gr-border);
        }

        .gr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--gr-text);
        }

        @media (max-width: 767.98px) {
            .gr-page .card-body {
                padding: 1rem;
            }

            .gr-page .card-header {
                padding: 0.9rem 1rem;
            }

            .gr-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="gr-page">

        <div class="section-header">

            <h1>Grinder</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('manager.grinder.index') }}">
                        Grinder
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail data proses grinder berdasarkan production batch.
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
                                    {{ $grinder->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $grinder->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ optional($grinder->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($grinder->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ optional($grinder->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($grinder->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $grinder->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $grinder->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $grinder->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $grinder->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">

                                    @if ($grinder->productionBatch && $grinder->productionBatch->waktu_kerja !== null)
                                        {{ $grinder->productionBatch->waktu_kerja }} Menit
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
                                    Grinder
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
                        Detail Proses Grinder
                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Ukuran Saringan
                                </div>

                                <div class="info-value">

                                    @if ($grinder->ukuran_saringan)
                                        <span class="badge-value">
                                            {{ $grinder->ukuran_saringan }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Hasil
                                </div>

                                <div class="info-value">

                                    @if ($grinder->hasil)
                                        <span class="badge-soft">
                                            {{ $grinder->hasil }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Downtime
                                </div>

                                <div class="info-value">

                                    @if ($grinder->downtime)
                                        <span class="badge-value">
                                            {{ $grinder->downtime }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Mulai
                                </div>

                                <div class="info-value">
                                    {{ $grinder->waktu_mulai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    {{ $grinder->waktu_selesai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">
                                    {{ $grinder->keterangan ?? '-' }}
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
                                    {{ $grinder->petugas ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $grinder->pic_produksi ?? '-' }}
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
                                    <i class="fas fa-cogs"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Grinder
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.grinder.index') }}" class="btn btn-ghost">

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
