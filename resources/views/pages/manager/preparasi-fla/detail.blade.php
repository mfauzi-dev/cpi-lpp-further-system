@extends('layouts.master')

@section('title', 'Detail Preparasi FLA')

@push('addon-style')
    <style>
        :root {
            --pf-primary: #1B4B43;
            --pf-primary-light: #E8F0EE;
            --pf-accent: #D98C3D;
            --pf-border: #E3E7E1;
            --pf-text: #1F2A24;
            --pf-muted: #5B6A62;
            --pf-soft: #F7F9F7;
        }

        .pf-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pf-text);
        }

        .pf-page .section-lead {
            color: var(--pf-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pf-page .card {
            border: none;
            border-left: 4px solid var(--pf-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pf-page .card.card-final {
            border-left-color: var(--pf-accent);
        }

        .pf-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pf-border);
            padding: 1rem 1.5rem;
        }

        .pf-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pf-text);
            display: flex;
            align-items: center;
        }

        .pf-page .card-header h4 i {
            color: var(--pf-primary);
        }

        .pf-page .card-body {
            padding: 1.5rem;
        }

        .pf-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pf-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pf-page .info-box {
            height: 100%;
            background: var(--pf-soft);
            border: 1px solid var(--pf-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pf-page .info-label {
            color: var(--pf-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pf-page .info-value {
            color: var(--pf-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pf-page .batch-highlight {
            background: linear-gradient(135deg, var(--pf-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pf-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pf-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pf-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pf-page .total-card {
            background: var(--pf-primary-light);
            border: 1px solid var(--pf-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .pf-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--pf-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .pf-page .stat-label {
            color: var(--pf-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pf-page .stat-value {
            color: var(--pf-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pf-page .badge-soft {
            display: inline-block;
            background: var(--pf-primary-light);
            color: var(--pf-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pf-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pf-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pf-page .btn-ghost {
            color: var(--pf-muted);
            background: transparent;
            border: 1px solid var(--pf-border);
        }

        .pf-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pf-text);
        }

        @media (max-width: 767.98px) {
            .pf-page .card-body {
                padding: 1rem;
            }

            .pf-page .card-header {
                padding: 0.9rem 1rem;
            }

            .pf-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="pf-page">

        <div class="section-header">

            <h1>Preparasi FLA</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('manager.preparasi-fla.index') }}">
                        Preparasi FLA
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail data proses preparasi FLA berdasarkan production batch.
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
                                    {{ $preparasiFla->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $preparasiFla->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ optional($preparasiFla->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($preparasiFla->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ optional($preparasiFla->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($preparasiFla->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $preparasiFla->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $preparasiFla->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $preparasiFla->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $preparasiFla->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">

                                    @if ($preparasiFla->productionBatch && $preparasiFla->productionBatch->waktu_kerja !== null)
                                        {{ $preparasiFla->productionBatch->waktu_kerja }} Menit
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
                                    Preparasi FLA
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
                        Detail Proses Preparasi FLA
                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Homeganisasi / Orlap
                                </div>

                                <div class="info-value">

                                    @if ($preparasiFla->homeganisasi_orlap)
                                        <span class="badge-soft">
                                            {{ $preparasiFla->homeganisasi_orlap }}
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
                                    Suhu FLA After Cooling Down
                                </div>

                                <div class="info-value">

                                    @if ($preparasiFla->suhu_fla_after_cooling_down)
                                        <span class="badge-soft">
                                            {{ $preparasiFla->suhu_fla_after_cooling_down }}
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

                                    @if ($preparasiFla->downtime)
                                        <span class="badge-value">
                                            {{ $preparasiFla->downtime }}
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

                            <div class="info-box">

                                <div class="info-label">
                                    Setting Speed X
                                </div>

                                <div class="info-value">

                                    @if ($preparasiFla->setting_speed_x !== null)
                                        {{ $preparasiFla->setting_speed_x }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Setting Speed Y
                                </div>

                                <div class="info-value">

                                    @if ($preparasiFla->setting_speed_y !== null)
                                        {{ $preparasiFla->setting_speed_y }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Mulai
                                </div>

                                <div class="info-value">
                                    {{ $preparasiFla->waktu_mulai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    {{ $preparasiFla->waktu_selesai ?? '-' }}
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
                                    {{ $preparasiFla->petugas ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $preparasiFla->pic_produksi ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">
                                    {{ $preparasiFla->keterangan ?? '-' }}
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
                                        Preparasi FLA
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.preparasi-fla.index') }}" class="btn btn-ghost">

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
