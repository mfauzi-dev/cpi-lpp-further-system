@extends('layouts.master')

@section('title', 'Detail Pembekuan')

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

        .pembekuan-detail .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pb-text);
        }

        .pembekuan-detail .section-lead {
            color: var(--pb-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pembekuan-detail .card {
            border: none;
            border-left: 4px solid var(--pb-primary);
            border-radius: 10px;
            box-shadow:
                0 1px 3px rgba(15, 30, 25, 0.06),
                0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pembekuan-detail .card.card-final {
            border-left-color: var(--pb-accent);
        }

        .pembekuan-detail .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pb-border);
            padding: 1rem 1.5rem;
        }

        .pembekuan-detail .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pb-text);
            display: flex;
            align-items: center;
        }

        .pembekuan-detail .card-body {
            padding: 1.5rem;
        }

        .pembekuan-detail .step-badge {
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

        .pembekuan-detail .info-box {
            height: 100%;
            background: var(--pb-soft);
            border: 1px solid var(--pb-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pembekuan-detail .info-label {
            color: var(--pb-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pembekuan-detail .info-value {
            color: var(--pb-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pembekuan-detail .batch-highlight {
            background: linear-gradient(135deg, var(--pb-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pembekuan-detail .batch-highlight-warning {
            background: linear-gradient(135deg, var(--pb-accent), #C87527);
        }

        .pembekuan-detail .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pembekuan-detail .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pembekuan-detail .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pembekuan-detail .stat-card {
            height: 100%;
            background: var(--pb-primary-light);
            border: 1px solid var(--pb-border);
            border-radius: 9px;
            padding: 1rem 1.1rem;
            display: flex;
            align-items: center;
        }

        .pembekuan-detail .stat-icon {
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

        .pembekuan-detail .stat-icon-warning {
            color: var(--pb-accent);
        }

        .pembekuan-detail .stat-label {
            color: var(--pb-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pembekuan-detail .stat-value {
            color: var(--pb-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pembekuan-detail .text-warning-pembekuan {
            color: var(--pb-accent) !important;
        }

        .pembekuan-detail .section-info {
            background: var(--pb-primary-light);
            border: 1px solid var(--pb-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
            color: var(--pb-text);
        }

        .pembekuan-detail .section-info i {
            color: var(--pb-primary);
            margin-right: 0.5rem;
        }

        .pembekuan-detail .empty-state {
            text-align: center;
            color: var(--pb-muted);
            padding: 1rem;
        }

        .pembekuan-detail .empty-state i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .pembekuan-detail .btn-ghost {
            color: var(--pb-muted);
            background: transparent;
            border: 1px solid var(--pb-border);
        }

        .pembekuan-detail .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pb-text);
        }

        @media (max-width: 767.98px) {
            .pembekuan-detail .card-body {
                padding: 1rem;
            }

            .pembekuan-detail .card-header {
                padding: 0.9rem 1rem;
            }

            .pembekuan-detail .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    @php
        $isBelowMinimum =
            $pembekuan->suhu_pusat !== null &&
            $pembekuan->suhu_minimum !== null &&
            $pembekuan->suhu_pusat > $pembekuan->suhu_minimum;
    @endphp

    <div class="pembekuan-detail">

        <div class="section-header">
            <h1>Pembekuan</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.pembekuan.index') }}">
                        Pembekuan
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <div class="section-lead">
            Detail proses pembekuan berdasarkan production batch yang telah dicatat.
        </div>

        <div class="section-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <span class="step-badge">1</span>
                        Informasi Produksi
                    </h4>
                </div>

                <div class="card-body">

                    <div class="batch-highlight {{ $isBelowMinimum ? 'batch-highlight-warning' : '' }}">

                        <div class="row align-items-center">

                            <div class="col-md-8">

                                <div class="batch-label">
                                    Production Batch
                                </div>

                                <div class="batch-number">
                                    {{ $pembekuan->productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $pembekuan->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($pembekuan->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($pembekuan->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ optional($pembekuan->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($pembekuan->productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $pembekuan->productionBatch->no_batch ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $pembekuan->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">
                                    Line
                                </div>

                                <div class="info-value">
                                    {{ $pembekuan->line ?? ($pembekuan->productionBatch->line ?? '-') }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-clock"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Waktu Kerja
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->productionBatch->waktu_kerja !== null
                                            ? $pembekuan->productionBatch->waktu_kerja . ' Menit'
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-snowflake"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Proses
                                    </div>

                                    <div class="stat-value">
                                        Pembekuan
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-industry"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Line
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->line ?? ($pembekuan->productionBatch->line ?? '-') }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-stopwatch"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Waktu Proses
                                    </div>

                                    <div class="stat-value">
                                        @if ($pembekuan->waktu_mulai || $pembekuan->waktu_selesai)
                                            {{ $pembekuan->waktu_mulai ? substr($pembekuan->waktu_mulai, 0, 5) : '-' }}

                                            &ndash;

                                            {{ $pembekuan->waktu_selesai ? substr($pembekuan->waktu_selesai, 0, 5) : '-' }}
                                        @else
                                            -
                                        @endif
                                    </div>
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
                        Parameter Pembekuan
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-thermometer-half"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Suhu Ruang Packing
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->suhu_ruang_packing !== null
                                            ? rtrim(rtrim(number_format($pembekuan->suhu_ruang_packing, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-temperature-low"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Suhu Ruang IQF
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->suhu_ruang_iqf !== null
                                            ? rtrim(rtrim(number_format($pembekuan->suhu_ruang_iqf, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Speed Conveyor
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->speed_conveyor !== null
                                            ? rtrim(rtrim(number_format($pembekuan->speed_conveyor, 2, ',', '.'), '0'), ',')
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon {{ $isBelowMinimum ? 'stat-icon-warning' : '' }}">
                                    <i class="fas fa-temperature-low"></i>
                                </div>

                                <div>
                                    <div class="stat-label {{ $isBelowMinimum ? 'text-warning-pembekuan' : '' }}">
                                        Temperature Pendinginan
                                    </div>

                                    <div class="stat-value {{ $isBelowMinimum ? 'text-warning-pembekuan' : '' }}">
                                        {{ $pembekuan->suhu_pusat !== null
                                            ? rtrim(rtrim(number_format($pembekuan->suhu_pusat, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-temperature-low"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Suhu Minimum
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->suhu_minimum !== null
                                            ? rtrim(rtrim(number_format($pembekuan->suhu_minimum, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Lama Kerusakan
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->lama_waktu_kerusakan !== null
                                            ? rtrim(rtrim(number_format($pembekuan->lama_waktu_kerusakan, 2, ',', '.'), '0'), ',') . ' Menit'
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-coffee"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Lama Istirahat
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->lama_waktu_istirahat !== null
                                            ? rtrim(rtrim(number_format($pembekuan->lama_waktu_istirahat, 2, ',', '.'), '0'), ',') . ' Menit'
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-user"></i>
                                </div>

                                <div>
                                    <div class="stat-label">
                                        Operator
                                    </div>

                                    <div class="stat-value">
                                        {{ $pembekuan->operator ?? '-' }}
                                    </div>
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
                        Waktu Proses & Petugas
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Mulai
                                </div>

                                <div class="info-value">
                                    {{ $pembekuan->waktu_mulai ? substr($pembekuan->waktu_mulai, 0, 5) : '-' }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Selesai
                                </div>

                                <div class="info-value">
                                    {{ $pembekuan->waktu_selesai ? substr($pembekuan->waktu_selesai, 0, 5) : '-' }}
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-box">

                                <div class="info-label">
                                    Operator
                                </div>

                                <div class="info-value">
                                    {{ $pembekuan->operator ?? '-' }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">

                                <div class="info-label">
                                    PIC Produksi
                                </div>

                                <div class="info-value">
                                    {{ $pembekuan->pic_produksi ?? '-' }}
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card card-final mb-4">

                <div class="card-header">
                    <h4>
                        <span class="step-badge">4</span>
                        Status Suhu
                    </h4>
                </div>

                <div class="card-body">

                    @if ($pembekuan->suhu_pusat !== null && $pembekuan->suhu_minimum !== null)

                        <div class="section-info">

                            @if ($isBelowMinimum)
                                <i class="fas fa-exclamation-triangle" style="color: var(--pb-accent);"></i>

                                Temperature Pendinginan

                                <strong class="text-warning-pembekuan">
                                    {{ rtrim(rtrim(number_format($pembekuan->suhu_pusat, 2, ',', '.'), '0'), ',') }} °C
                                </strong>

                                berada di atas suhu minimum

                                <strong>
                                    {{ rtrim(rtrim(number_format($pembekuan->suhu_minimum, 2, ',', '.'), '0'), ',') }} °C.
                                </strong>
                            @else
                                <i class="fas fa-check-circle"></i>

                                Temperature Pendinginan

                                <strong>
                                    {{ rtrim(rtrim(number_format($pembekuan->suhu_pusat, 2, ',', '.'), '0'), ',') }} °C
                                </strong>

                                sudah sesuai dengan suhu minimum

                                <strong>
                                    {{ rtrim(rtrim(number_format($pembekuan->suhu_minimum, 2, ',', '.'), '0'), ',') }} °C.
                                </strong>
                            @endif

                        </div>
                    @else
                        <div class="empty-state">

                            <i class="fas fa-thermometer-half d-block"></i>

                            <div>
                                Data suhu belum lengkap.
                            </div>

                        </div>

                    @endif

                </div>

            </div>

            <div class="card card-final">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="section-info mb-2 mb-md-0">

                            <i class="fas fa-info-circle"></i>

                            Pastikan data Pembekuan sudah sesuai.

                        </div>

                        <div class="action-buttons">

                            <a href="{{ route('operator.pembekuan.index') }}" class="btn btn-ghost mr-1">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Kembali
                            </a>

                            <a href="{{ route('operator.pembekuan.edit', $pembekuan->id) }}"
                                class="btn btn-warning mr-1">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>

                            <form action="{{ route('operator.pembekuan.destroy', $pembekuan->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Pembekuan ini?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
