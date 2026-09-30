@extends('layouts.master')

@section('title', 'Detail Suhu Ruang')

@push('addon-style')
    <style>
        :root {
            --sr-primary: #1B4B43;
            --sr-primary-light: #E8F0EE;
            --sr-accent: #D98C3D;
            --sr-border: #E3E7E1;
            --sr-text: #1F2A24;
            --sr-muted: #5B6A62;
            --sr-soft: #F7F9F7;
        }

        .suhu-ruang-detail .card {
            border: none;
            border-left: 4px solid var(--sr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .suhu-ruang-detail .card.card-final {
            border-left-color: var(--sr-accent);
        }

        .suhu-ruang-detail .card-header {
            background: #fff;
            border-bottom: 1px solid var(--sr-border);
            padding: 1rem 1.5rem;
        }

        .suhu-ruang-detail .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--sr-text);
            display: flex;
            align-items: center;
        }

        .suhu-ruang-detail .card-body {
            padding: 1.5rem;
        }

        .suhu-ruang-detail .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--sr-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .suhu-ruang-detail .info-box {
            height: 100%;
            background: var(--sr-soft);
            border: 1px solid var(--sr-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .suhu-ruang-detail .info-label {
            color: var(--sr-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .suhu-ruang-detail .info-value {
            color: var(--sr-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .suhu-ruang-detail .batch-highlight {
            background: linear-gradient(135deg, var(--sr-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .suhu-ruang-detail .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .suhu-ruang-detail .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .suhu-ruang-detail .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .suhu-ruang-detail .stat-card {
            height: 100%;
            background: var(--sr-primary-light);
            border: 1px solid var(--sr-border);
            border-radius: 9px;
            padding: 1rem 1.1rem;
            display: flex;
            align-items: center;
        }

        .suhu-ruang-detail .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--sr-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .suhu-ruang-detail .stat-label {
            color: var(--sr-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .suhu-ruang-detail .stat-value {
            color: var(--sr-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .suhu-ruang-detail .section-info {
            background: var(--sr-primary-light);
            border: 1px solid var(--sr-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
            color: var(--sr-text);
        }

        .suhu-ruang-detail .section-info i {
            color: var(--sr-primary);
            margin-right: 0.5rem;
        }

        .suhu-ruang-detail .empty-state {
            text-align: center;
            color: var(--sr-muted);
            padding: 1rem;
        }

        .suhu-ruang-detail .empty-state i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .suhu-ruang-detail .btn-ghost {
            color: var(--sr-muted);
            background: transparent;
            border: 1px solid var(--sr-border);
        }

        @media (max-width: 767.98px) {
            .suhu-ruang-detail .card-body {
                padding: 1rem;
            }

            .suhu-ruang-detail .card-header {
                padding: 0.9rem 1rem;
            }

            .suhu-ruang-detail .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="suhu-ruang-detail">

        <div class="section-header">
            <h1>Suhu Ruang</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('manager.suhu-ruang.index') }}">Suhu Ruang</a>
                </div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-lead">
            Detail proses pencatatan Suhu Ruang berdasarkan production batch.
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
                    <h4><span class="step-badge">1</span> Informasi Produksi</h4>
                </div>

                <div class="card-body">

                    <div class="batch-highlight">
                        <div class="row align-items-center">

                            <div class="col-md-8">
                                <div class="batch-label">Production Batch</div>
                                <div class="batch-number">{{ $suhuRuang->productionBatch->no_batch ?? '-' }}</div>
                                <div class="batch-product">
                                    {{ $suhuRuang->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                <div class="batch-label">Tanggal Produksi</div>
                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($suhuRuang->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($suhuRuang->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Kode Product</div>
                                <div class="info-value">
                                    {{ $suhuRuang->productionBatch->product->kode_product ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Product</div>
                                <div class="info-value">{{ $suhuRuang->productionBatch->product->nama ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Line</div>
                                <div class="info-value">
                                    {{ $suhuRuang->line ?? ($suhuRuang->productionBatch->line ?? '-') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Waktu Kerja</div>
                                <div class="info-value">
                                    {{ $suhuRuang->productionBatch->waktu_kerja !== null ? $suhuRuang->productionBatch->waktu_kerja . ' Menit' : '-' }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">
                    <h4><span class="step-badge">2</span> Parameter Suhu Ruang</h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-thermometer-half"></i></div>
                                <div>
                                    <div class="stat-label">Suhu Ruang Meatprep</div>
                                    <div class="stat-value">
                                        {{ $suhuRuang->suhu_ruang_meatprep !== null
                                            ? rtrim(rtrim(number_format($suhuRuang->suhu_ruang_meatprep, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-temperature-low"></i></div>
                                <div>
                                    <div class="stat-label">Suhu Ruang Chillroom</div>
                                    <div class="stat-value">
                                        {{ $suhuRuang->suhu_ruang_chillroom !== null
                                            ? rtrim(rtrim(number_format($suhuRuang->suhu_ruang_chillroom, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                                <div>
                                    <div class="stat-label">Downtime</div>
                                    <div class="stat-value">{{ $suhuRuang->downtime ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-user"></i></div>
                                <div>
                                    <div class="stat-label">Petugas</div>
                                    <div class="stat-value">{{ $suhuRuang->petugas ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">
                    <h4><span class="step-badge">3</span> Waktu Proses & Petugas</h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="info-box">
                                <div class="info-label">Waktu Mulai</div>
                                <div class="info-value">
                                    {{ $suhuRuang->waktu_mulai ? substr($suhuRuang->waktu_mulai, 0, 5) : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-box">
                                <div class="info-label">Waktu Selesai</div>
                                <div class="info-value">
                                    {{ $suhuRuang->waktu_selesai ? substr($suhuRuang->waktu_selesai, 0, 5) : '-' }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">Petugas</div>
                                <div class="info-value">{{ $suhuRuang->petugas ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="info-label">PIC Produksi</div>
                                <div class="info-value">{{ $suhuRuang->pic_produksi ?? '-' }}</div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card card-final mb-4">

                <div class="card-header">
                    <h4><span class="step-badge">4</span> Keterangan</h4>
                </div>

                <div class="card-body">

                    @if ($suhuRuang->keterangan)
                        <div class="section-info">
                            <i class="fas fa-sticky-note"></i>
                            {{ $suhuRuang->keterangan }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-sticky-note d-block"></i>
                            <div>Belum ada keterangan.</div>
                        </div>
                    @endif

                </div>

            </div>

            <div class="card card-final">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="section-info mb-2 mb-md-0">
                            <i class="fas fa-info-circle"></i>
                            Data Suhu Ruang untuk keperluan monitoring.
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('manager.suhu-ruang.index') }}" class="btn btn-ghost">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Kembali
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
