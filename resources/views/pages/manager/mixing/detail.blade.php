@extends('layouts.master')

@section('title', 'Detail Mixing')

@push('addon-style')
    <style>
        :root {
            --mix-primary: #1B4B43;
            --mix-primary-light: #E8F0EE;
            --mix-accent: #D98C3D;
            --mix-border: #E3E7E1;
            --mix-text: #1F2A24;
            --mix-muted: #5B6A62;
            --mix-soft: #F7F9F7;
        }

        .mix-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--mix-text);
        }

        .mix-page .section-lead {
            color: var(--mix-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .mix-page .card {
            border: none;
            border-left: 4px solid var(--mix-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .mix-page .card.card-final {
            border-left-color: var(--mix-accent);
        }

        .mix-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--mix-border);
            padding: 1rem 1.5rem;
        }

        .mix-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--mix-text);
            display: flex;
            align-items: center;
        }

        .mix-page .card-header h4 i {
            color: var(--mix-primary);
        }

        .mix-page .card-body {
            padding: 1.5rem;
        }

        .mix-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--mix-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .mix-page .info-box {
            height: 100%;
            background: var(--mix-soft);
            border: 1px solid var(--mix-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .mix-page .info-label {
            color: var(--mix-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .mix-page .info-value {
            color: var(--mix-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .mix-page .batch-highlight {
            background: linear-gradient(135deg, var(--mix-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .mix-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .mix-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .mix-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .mix-page .total-card {
            background: var(--mix-primary-light);
            border: 1px solid var(--mix-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .mix-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--mix-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .mix-page .stat-label {
            color: var(--mix-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .mix-page .stat-value {
            color: var(--mix-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .mix-page .badge-soft {
            display: inline-block;
            background: var(--mix-primary-light);
            color: var(--mix-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .mix-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .mix-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .mix-page .btn-ghost {
            color: var(--mix-muted);
            background: transparent;
            border: 1px solid var(--mix-border);
        }

        .mix-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--mix-text);
        }

        @media (max-width: 767.98px) {
            .mix-page .card-body {
                padding: 1rem;
            }

            .mix-page .card-header {
                padding: 0.9rem 1rem;
            }

            .mix-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="mix-page">

        <div class="section-header">

            <h1>Mixing</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('manager.mixing.index') }}">
                        Mixing
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail data proses mixing berdasarkan production batch.
        </p>

        <div class="section-body">

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">
                            1
                        </span>

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

                                    {{ $mixing->productionBatch->no_batch ?? '-' }}

                                </div>

                                <div class="batch-product">

                                    {{ $mixing->productionBatch->product->nama ?? '-' }}

                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ optional($mixing->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($mixing->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ optional($mixing->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($mixing->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ $mixing->productionBatch->no_batch ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">

                                    {{ $mixing->productionBatch->product->nama ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">

                                    {{ $mixing->productionBatch->product->productGroup->nama ?? '-' }}

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

                                    {{ $mixing->line ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">

                                    @if ($mixing->productionBatch && $mixing->productionBatch->waktu_kerja !== null)
                                        {{ $mixing->productionBatch->waktu_kerja }} Menit
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
                                    Mixing
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">
                            2
                        </span>

                        Detail Proses Mixing

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Mixer Preparation
                                </div>

                                <div class="info-value">

                                    @if ($mixing->mixer_preparation)
                                        <span class="badge-soft">
                                            {{ $mixing->mixer_preparation }}
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
                                    Suhu Air
                                </div>

                                <div class="info-value">

                                    @if ($mixing->suhu_air !== null)
                                        {{ $mixing->suhu_air }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Lama Pengadukan
                                </div>

                                <div class="info-value">

                                    @if ($mixing->lama_pengadukan !== null)
                                        {{ $mixing->lama_pengadukan }}
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
                                    Filter
                                </div>

                                <div class="info-value">

                                    @if ($mixing->filter)
                                        <span class="badge-soft">
                                            {{ $mixing->filter }}
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
                                    Salinity
                                </div>

                                <div class="info-value">

                                    @if ($mixing->salinity !== null)
                                        {{ $mixing->salinity }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Brix
                                </div>

                                <div class="info-value">

                                    @if ($mixing->brix)
                                        <span class="badge-soft">
                                            {{ $mixing->brix }}
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
                                    Mixer
                                </div>

                                <div class="info-value">

                                    @if ($mixing->mixer)
                                        <span class="badge-soft">
                                            {{ $mixing->mixer }}
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
                                    Suhu Adonan
                                </div>

                                <div class="info-value">

                                    @if ($mixing->suhu_adonan !== null)
                                        {{ $mixing->suhu_adonan }}
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

                                    @if ($mixing->downtime)
                                        <span class="badge-value">
                                            {{ $mixing->downtime }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Mulai
                                </div>

                                <div class="info-value">

                                    {{ $mixing->waktu_mulai ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">

                                    {{ $mixing->waktu_selesai ?? '-' }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">
                            3
                        </span>

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

                                    {{ $mixing->petugas ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">

                                    {{ $mixing->pic_produksi ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">

                                    {{ $mixing->keterangan ?? '-' }}

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
                                        Mixing
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.mixing.index') }}" class="btn btn-ghost">

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
