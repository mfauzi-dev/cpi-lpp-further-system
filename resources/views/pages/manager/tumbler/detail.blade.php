@extends('layouts.master')

@section('title', 'Detail Tumbler')

@push('addon-style')
    <style>
        :root {
            --tb-primary: #1B4B43;
            --tb-primary-light: #E8F0EE;
            --tb-accent: #D98C3D;
            --tb-border: #E3E7E1;
            --tb-text: #1F2A24;
            --tb-muted: #5B6A62;
            --tb-soft: #F7F9F7;
        }

        .tb-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--tb-text);
        }

        .tb-page .section-lead {
            color: var(--tb-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .tb-page .card {
            border: none;
            border-left: 4px solid var(--tb-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .tb-page .card.card-final {
            border-left-color: var(--tb-accent);
        }

        .tb-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--tb-border);
            padding: 1rem 1.5rem;
        }

        .tb-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--tb-text);
            display: flex;
            align-items: center;
        }

        .tb-page .card-header h4 i {
            color: var(--tb-primary);
        }

        .tb-page .card-body {
            padding: 1.5rem;
        }

        .tb-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--tb-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .tb-page .info-box {
            height: 100%;
            background: var(--tb-soft);
            border: 1px solid var(--tb-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .tb-page .info-label {
            color: var(--tb-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .tb-page .info-value {
            color: var(--tb-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .tb-page .batch-highlight {
            background: linear-gradient(135deg, var(--tb-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .tb-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .tb-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .tb-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .tb-page .total-card {
            background: var(--tb-primary-light);
            border: 1px solid var(--tb-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .tb-page .stat-card {
            height: 100%;
            background: var(--tb-primary-light);
            border: 1px solid var(--tb-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .tb-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--tb-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .tb-page .stat-label {
            color: var(--tb-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .tb-page .stat-value {
            color: var(--tb-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .tb-page .badge-soft {
            display: inline-block;
            background: var(--tb-primary-light);
            color: var(--tb-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .tb-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .tb-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .tb-page .btn-ghost {
            color: var(--tb-muted);
            background: transparent;
            border: 1px solid var(--tb-border);
        }

        .tb-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--tb-text);
        }

        @media (max-width: 767.98px) {
            .tb-page .card-body {
                padding: 1rem;
            }

            .tb-page .card-header {
                padding: 0.9rem 1rem;
            }

            .tb-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="tb-page">
        <div class="section-header">
            <h1>Tumbler</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('manager.tumbler.index') }}">
                        Tumbler
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail data proses tumbler berdasarkan production batch.
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
                                    {{ $tumbler->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $tumbler->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($tumbler->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($tumbler->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ optional($tumbler->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($tumbler->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $tumbler->productionBatch->no_batch ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $tumbler->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $tumbler->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $tumbler->productionBatch->line ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">
                                    @if ($tumbler->productionBatch && $tumbler->productionBatch->waktu_kerja !== null)
                                        {{ $tumbler->productionBatch->waktu_kerja }} Menit
                                    @else
                                        <span class="value-empty">-</span>
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
                                    Tumbler
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
                        Detail Proses Tumbler
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Tumbler
                                </div>

                                <div class="info-value">
                                    @if ($tumbler->tumbler)
                                        <span class="badge-soft">
                                            {{ $tumbler->tumbler }}
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
                                    Drum On
                                </div>

                                <div class="info-value">
                                    @if ($tumbler->drum_on !== null)
                                        <span class="badge-value">
                                            {{ rtrim(rtrim(number_format($tumbler->drum_on, 2, ',', '.'), '0'), ',') }}
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
                                    Drum Off
                                </div>

                                <div class="info-value">
                                    @if ($tumbler->drum_off !== null)
                                        <span class="badge-value">
                                            {{ rtrim(rtrim(number_format($tumbler->drum_off, 2, ',', '.'), '0'), ',') }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-wind"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Vacuum A
                                    </div>

                                    <div class="stat-value">
                                        @if ($tumbler->vacuum_a !== null)
                                            {{ rtrim(rtrim(number_format($tumbler->vacuum_a, 2, ',', '.'), '0'), ',') }} %
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-wind"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Vacuum B
                                    </div>

                                    <div class="stat-value">
                                        @if ($tumbler->vacuum_b !== null)
                                            {{ rtrim(rtrim(number_format($tumbler->vacuum_b, 2, ',', '.'), '0'), ',') }} %
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Waktu Mulai
                                </div>

                                <div class="info-value">
                                    @if ($tumbler->waktu_mulai)
                                        {{ \Carbon\Carbon::parse($tumbler->waktu_mulai)->format('H:i') }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    @if ($tumbler->waktu_selesai)
                                        {{ \Carbon\Carbon::parse($tumbler->waktu_selesai)->format('H:i') }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box">
                                <div class="info-label">
                                    Downtime
                                </div>

                                <div class="info-value">
                                    @if ($tumbler->downtime)
                                        <span class="badge-value">
                                            {{ $tumbler->downtime }}
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
                                    {{ $tumbler->petugas ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $tumbler->pic_produksi ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">
                                    {{ $tumbler->keterangan ?? '-' }}
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
                                    <i class="fas fa-sync-alt"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Tumbler
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex justify-content-md-end">
                                <a href="{{ route('manager.tumbler.index') }}" class="btn btn-ghost">
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
