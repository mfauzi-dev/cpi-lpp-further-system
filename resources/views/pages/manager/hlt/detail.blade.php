@extends('layouts.master')

@section('title', 'Detail HLT')

@push('addon-style')
    <style>
        :root {
            --hlt-primary: #1B4B43;
            --hlt-primary-light: #E8F0EE;
            --hlt-accent: #D98C3D;
            --hlt-border: #E3E7E1;
            --hlt-text: #1F2A24;
            --hlt-muted: #5B6A62;
            --hlt-soft: #F7F9F7;
        }

        .hlt-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--hlt-text);
        }

        .hlt-page .section-lead {
            color: var(--hlt-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .hlt-page .card {
            border: none;
            border-left: 4px solid var(--hlt-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .hlt-page .card.card-final {
            border-left-color: var(--hlt-accent);
        }

        .hlt-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--hlt-border);
            padding: 1rem 1.5rem;
        }

        .hlt-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--hlt-text);
            display: flex;
            align-items: center;
        }

        .hlt-page .card-header h4 i {
            color: var(--hlt-primary);
        }

        .hlt-page .card-body {
            padding: 1.5rem;
        }

        .hlt-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--hlt-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .hlt-page .info-box {
            height: 100%;
            background: var(--hlt-soft);
            border: 1px solid var(--hlt-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .hlt-page .info-label {
            color: var(--hlt-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .hlt-page .info-value {
            color: var(--hlt-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .hlt-page .batch-highlight {
            background: linear-gradient(135deg, var(--hlt-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .hlt-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .hlt-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .hlt-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .hlt-page .total-card {
            background: var(--hlt-primary-light);
            border: 1px solid var(--hlt-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .hlt-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--hlt-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .hlt-page .stat-label {
            color: var(--hlt-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .hlt-page .stat-value {
            color: var(--hlt-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .hlt-page .badge-soft {
            display: inline-block;
            background: var(--hlt-primary-light);
            color: var(--hlt-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .hlt-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .hlt-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .hlt-page .btn-ghost {
            color: var(--hlt-muted);
            background: transparent;
            border: 1px solid var(--hlt-border);
        }

        .hlt-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--hlt-text);
        }

        @media (max-width: 767.98px) {
            .hlt-page .card-body {
                padding: 1rem;
            }

            .hlt-page .card-header {
                padding: 0.9rem 1rem;
            }

            .hlt-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="hlt-page">

        <div class="section-header">

            <h1>HLT</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('manager.hlt.index') }}">
                        HLT
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <p class="section-lead">
            Detail data proses HLT berdasarkan production batch.
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
                                    {{ $hlt->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $hlt->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ optional($hlt->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($hlt->productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ optional($hlt->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($hlt->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $hlt->productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $hlt->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $hlt->productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $hlt->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">

                                    @if ($hlt->productionBatch && $hlt->productionBatch->waktu_kerja !== null)
                                        {{ $hlt->productionBatch->waktu_kerja }} Menit
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
                                    HLT
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

                        Detail Proses HLT

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Suhu Awal Daging
                                </div>

                                <div class="info-value">

                                    @if ($hlt->suhu_awal_daging !== null)
                                        <span class="badge-value">
                                            {{ $hlt->suhu_awal_daging }}
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
                                    Suhu Infeed
                                </div>

                                <div class="info-value">

                                    @if ($hlt->suhu_infeed !== null)
                                        <span class="badge-value">
                                            {{ $hlt->suhu_infeed }}
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
                                    Suhu Outfeed
                                </div>

                                <div class="info-value">

                                    @if ($hlt->suhu_outfeed !== null)
                                        <span class="badge-value">
                                            {{ $hlt->suhu_outfeed }}
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
                                    Steam Valve
                                </div>

                                <div class="info-value">

                                    @if ($hlt->steam_valve !== null)
                                        <span class="badge-value">
                                            {{ $hlt->steam_valve }}
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
                                    Speed Ventilator
                                </div>

                                <div class="info-value">

                                    @if ($hlt->speed_ventilator !== null)
                                        <span class="badge-value">
                                            {{ $hlt->speed_ventilator }}
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
                                    Lama Pemasakan
                                </div>

                                <div class="info-value">

                                    @if ($hlt->lama_pemasakan !== null)
                                        <span class="badge-value">
                                            {{ $hlt->lama_pemasakan }}
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
                                    Suhu Pusat CT
                                </div>

                                <div class="info-value">

                                    @if ($hlt->suhu_pusat_ct !== null)
                                        <span class="badge-value">
                                            {{ $hlt->suhu_pusat_ct }}
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
                                    Organoleptik
                                </div>

                                <div class="info-value">

                                    @if ($hlt->organoleptik)
                                        <span class="badge-soft">
                                            {{ $hlt->organoleptik }}
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

                                    @if ($hlt->downtime)
                                        <span class="badge-value">
                                            {{ $hlt->downtime }}
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
                                    {{ $hlt->waktu_mulai ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    {{ $hlt->waktu_selesai ?? '-' }}
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
                                    {{ $hlt->petugas ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $hlt->pic_produksi ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="info-box">

                                <div class="info-label">
                                    Keterangan
                                </div>

                                <div class="info-value">
                                    {{ $hlt->keterangan ?? '-' }}
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

                                    <i class="fas fa-fire"></i>

                                </div>

                                <div>

                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        HLT
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.hlt.index') }}" class="btn btn-ghost">

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
