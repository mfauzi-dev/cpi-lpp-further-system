@extends('layouts.master')

@section('title', 'Detail Forming')

@push('addon-style')
    <style>
        :root {
            --frm-primary: #1B4B43;
            --frm-primary-light: #E8F0EE;
            --frm-accent: #D98C3D;
            --frm-border: #E3E7E1;
            --frm-text: #1F2A24;
            --frm-muted: #5B6A62;
            --frm-soft: #F7F9F7;
        }

        .frm-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--frm-text);
        }

        .frm-page .section-lead {
            color: var(--frm-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .frm-page .card {
            border: none;
            border-left: 4px solid var(--frm-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .frm-page .card.card-final {
            border-left-color: var(--frm-accent);
        }

        .frm-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--frm-border);
            padding: 1rem 1.5rem;
        }

        .frm-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--frm-text);
            display: flex;
            align-items: center;
        }

        .frm-page .card-header h4 i {
            color: var(--frm-primary);
        }

        .frm-page .card-body {
            padding: 1.5rem;
        }

        .frm-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--frm-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .frm-page .info-box {
            height: 100%;
            background: var(--frm-soft);
            border: 1px solid var(--frm-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .frm-page .info-label {
            color: var(--frm-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .frm-page .info-value {
            color: var(--frm-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .frm-page .batch-highlight {
            background: linear-gradient(135deg, var(--frm-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .frm-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .frm-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .frm-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .frm-page .total-card {
            background: var(--frm-primary-light);
            border: 1px solid var(--frm-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .frm-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--frm-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .frm-page .stat-label {
            color: var(--frm-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .frm-page .stat-value {
            color: var(--frm-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .frm-page .badge-soft {
            display: inline-block;
            background: var(--frm-primary-light);
            color: var(--frm-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .frm-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .frm-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .frm-page .btn-ghost {
            color: var(--frm-muted);
            background: transparent;
            border: 1px solid var(--frm-border);
        }

        .frm-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--frm-text);
        }

        @media (max-width: 767.98px) {
            .frm-page .card-body {
                padding: 1rem;
            }

            .frm-page .card-header {
                padding: 0.9rem 1rem;
            }

            .frm-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="frm-page">

        <div class="section-header">

            <h1>Forming</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('manager.forming.index') }}">
                        Forming
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail data proses forming berdasarkan production batch.
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
                                    {{ $forming->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $forming->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ optional($forming->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($forming->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ optional($forming->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($forming->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $forming->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $forming->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $forming->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $forming->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">

                                    @if ($forming->productionBatch && $forming->productionBatch->waktu_kerja !== null)
                                        {{ $forming->productionBatch->waktu_kerja }} Menit
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
                                    Forming
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

                        Detail Proses Forming

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Alat
                                </div>

                                <div class="info-value">

                                    @if ($forming->alat)
                                        <span class="badge-soft">
                                            {{ $forming->alat }}
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

                                    @if ($forming->suhu_adonan !== null)
                                        {{ $forming->suhu_adonan }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Pressure
                                </div>

                                <div class="info-value">

                                    @if ($forming->pressure !== null)
                                        {{ $forming->pressure }}
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
                                    Speed
                                </div>

                                <div class="info-value">

                                    @if ($forming->speed !== null)
                                        {{ $forming->speed }}
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Mulai
                                </div>

                                <div class="info-value">
                                    {{ $forming->waktu_mulai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    {{ $forming->waktu_selesai ?? '-' }}
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

                                    @if ($forming->downtime)
                                        <span class="badge-value">
                                            {{ $forming->downtime }}
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
                                    {{ $forming->petugas ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $forming->pic_produksi ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">
                                    {{ $forming->keterangan ?? '-' }}
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

                                    <i class="fas fa-shapes"></i>

                                </div>

                                <div>

                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Forming
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.forming.index') }}" class="btn btn-ghost">

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
