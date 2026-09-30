@extends('layouts.master')

@section('title', 'Detail Bowl Cutter')

@push('addon-style')
    <style>
        :root {
            --bc-primary: #1B4B43;
            --bc-primary-light: #E8F0EE;
            --bc-accent: #D98C3D;
            --bc-border: #E3E7E1;
            --bc-text: #1F2A24;
            --bc-muted: #5B6A62;
            --bc-soft: #F7F9F7;
        }

        .bc-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--bc-text);
        }

        .bc-page .section-lead {
            color: var(--bc-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .bc-page .card {
            border: none;
            border-left: 4px solid var(--bc-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .bc-page .card.card-final {
            border-left-color: var(--bc-accent);
        }

        .bc-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--bc-border);
            padding: 1rem 1.5rem;
        }

        .bc-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--bc-text);
            display: flex;
            align-items: center;
        }

        .bc-page .card-header h4 i {
            color: var(--bc-primary);
        }

        .bc-page .card-body {
            padding: 1.5rem;
        }

        .bc-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--bc-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .bc-page .info-box {
            height: 100%;
            background: var(--bc-soft);
            border: 1px solid var(--bc-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .bc-page .info-label {
            color: var(--bc-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .bc-page .info-value {
            color: var(--bc-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .bc-page .batch-highlight {
            background: linear-gradient(135deg, var(--bc-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .bc-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .bc-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .bc-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .bc-page .process-highlight {
            background: var(--bc-primary-light);
            border: 1px solid var(--bc-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            margin-bottom: 1.25rem;
        }

        .bc-page .process-label {
            color: var(--bc-muted);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .bc-page .process-value {
            color: var(--bc-primary);
            font-size: 1.15rem;
            font-weight: 700;
        }

        .bc-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .bc-page .table {
            margin-bottom: 0;
            min-width: 950px;
        }

        .bc-page .table thead th {
            background: var(--bc-primary-light);
            color: var(--bc-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .bc-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--bc-text);
            padding: 0.8rem 0.9rem;
        }

        .bc-page .table-bordered td,
        .bc-page .table-bordered th {
            border-color: var(--bc-border);
        }

        .bc-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .bc-page .badge-soft {
            display: inline-block;
            background: var(--bc-primary-light);
            color: var(--bc-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .bc-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .bc-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .bc-page .total-card {
            background: var(--bc-primary-light);
            border: 1px solid var(--bc-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .bc-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--bc-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .bc-page .stat-label {
            color: var(--bc-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .bc-page .stat-value {
            color: var(--bc-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .bc-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--bc-muted);
        }

        .bc-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: 0.6rem;
            opacity: 0.55;
        }

        .bc-page .btn-ghost {
            color: var(--bc-muted);
            background: transparent;
            border: 1px solid var(--bc-border);
        }

        .bc-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--bc-text);
        }

        @media (max-width: 767.98px) {
            .bc-page .card-body {
                padding: 1rem;
            }

            .bc-page .card-header {
                padding: 0.9rem 1rem;
            }

            .bc-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="bc-page">

        <div class="section-header">

            <h1>Bowl Cutter</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('manager.bowl-cutter.index') }}">
                        Bowl Cutter
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail data proses bowl cutter berdasarkan production batch.
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
                                    {{ $bowlCutter->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $bowlCutter->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ optional($bowlCutter->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($bowlCutter->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ optional($bowlCutter->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($bowlCutter->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $bowlCutter->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $bowlCutter->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $bowlCutter->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $bowlCutter->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">

                                    @if ($bowlCutter->productionBatch && $bowlCutter->productionBatch->waktu_kerja !== null)
                                        {{ $bowlCutter->productionBatch->waktu_kerja }} Menit
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
                                    Bowl Cutter
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
                        Detail Proses Bowl Cutter
                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Speed
                                </div>

                                <div class="info-value">

                                    @if ($bowlCutter->speed !== null)
                                        <span class="badge-value">
                                            {{ $bowlCutter->speed }}
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
                                    Suhu Emulasi
                                </div>

                                <div class="info-value">

                                    @if ($bowlCutter->suhu_emulasi !== null)
                                        <span class="badge-value">
                                            {{ $bowlCutter->suhu_emulasi }}
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
                                    Homeganisasi / Orlap
                                </div>

                                <div class="info-value">

                                    @if ($bowlCutter->homeganisasi_orlap)
                                        <span class="badge-soft">
                                            {{ $bowlCutter->homeganisasi_orlap }}
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
                                    {{ $bowlCutter->waktu_mulai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    {{ $bowlCutter->waktu_selesai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Downtime
                                </div>

                                <div class="info-value">

                                    @if ($bowlCutter->downtime)
                                        <span class="badge-value">
                                            {{ $bowlCutter->downtime }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
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
                        <span class="step-badge">3</span>
                        Keterangan Produksi
                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Petugas
                                </div>

                                <div class="info-value">
                                    {{ $bowlCutter->petugas ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $bowlCutter->pic_produksi ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">
                                    {{ $bowlCutter->keterangan ?? '-' }}
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
                                    <i class="fas fa-blender"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Bowl Cutter
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.bowl-cutter.index') }}" class="btn btn-ghost">

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
