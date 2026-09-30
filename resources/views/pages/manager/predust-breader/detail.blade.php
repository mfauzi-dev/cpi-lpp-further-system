@extends('layouts.master')

@section('title', 'Detail Predust Breader')

@push('addon-style')
    <style>
        :root {
            --pb-primary: #1B4B43;
            --pb-primary-light: #E8F0EE;
            --pb-accent: #D98C3D;
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

        .pb-page .card.card-final {
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

        .pb-page .batch-highlight {
            background: linear-gradient(135deg, var(--pb-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
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

        .pb-page .process-highlight {
            background: var(--pb-primary-light);
            border: 1px solid var(--pb-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            margin-bottom: 1.25rem;
        }

        .pb-page .process-label {
            color: var(--pb-muted);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .pb-page .process-value {
            color: var(--pb-primary);
            font-size: 1.15rem;
            font-weight: 700;
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

        .pb-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
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

        .pb-page .total-card {
            background: var(--pb-primary-light);
            border: 1px solid var(--pb-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
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
            background: #fff;
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

        .pb-page .btn-ghost {
            color: var(--pb-muted);
            background: transparent;
            border: 1px solid var(--pb-border);
        }

        .pb-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pb-text);
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
            <h1>Predust Breader</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('manager.predust-breader.index') }}">
                        Predust Breader
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail data proses predust breader berdasarkan product dan production batch.
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
                                    {{ $predustBreader->productionBatch->product->kode_product ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $predustBreader->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($predustBreader->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($predustBreader->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ optional($predustBreader->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($predustBreader->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Kode Product
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->productionBatch->product->kode_product ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->productionBatch->product->productGroup->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    No Batch
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Line
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Process
                                </div>

                                <div class="info-value">
                                    Predust Breader
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
                        Detail Proses Predust Breader
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Predust Breader
                                </div>

                                <div class="info-value">

                                    @if ($predustBreader->predust_breader)
                                        <span class="badge-soft">
                                            {{ $predustBreader->predust_breader }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Superflex
                                </div>

                                <div class="info-value">

                                    @if ($predustBreader->superflex !== null)
                                        <span class="badge-value">
                                            {{ $predustBreader->superflex }}
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
                                    {{ $predustBreader->waktu_mulai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->waktu_selesai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Downtime
                                </div>

                                <div class="info-value">

                                    @if ($predustBreader->downtime)
                                        <span class="badge-value">
                                            {{ $predustBreader->downtime }}
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
                                    {{ $predustBreader->petugas ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->pic_produksi ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">
                                    {{ $predustBreader->keterangan ?? '-' }}
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
                                    <i class="fas fa-layer-group"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Predust Breader
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.predust-breader.index') }}" class="btn btn-ghost">
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
