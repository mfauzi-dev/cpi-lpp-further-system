@extends('layouts.master')

@section('title', 'Detail Fryer')

@push('addon-style')
    <style>
        :root {
            --fry-primary: #1B4B43;
            --fry-primary-light: #E8F0EE;
            --fry-accent: #D98C3D;
            --fry-border: #E3E7E1;
            --fry-text: #1F2A24;
            --fry-muted: #5B6A62;
            --fry-soft: #F7F9F7;
        }

        .fryer-detail .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--fry-text);
        }

        .fryer-detail .section-lead {
            color: var(--fry-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .fryer-detail .card {
            border: none;
            border-left: 4px solid var(--fry-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .fryer-detail .card.card-final {
            border-left-color: var(--fry-accent);
        }

        .fryer-detail .card-header {
            background: #fff;
            border-bottom: 1px solid var(--fry-border);
            padding: 1rem 1.5rem;
        }

        .fryer-detail .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--fry-text);
            display: flex;
            align-items: center;
        }

        .fryer-detail .card-body {
            padding: 1.5rem;
        }

        .fryer-detail .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--fry-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .fryer-detail .info-box {
            height: 100%;
            background: var(--fry-soft);
            border: 1px solid var(--fry-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .fryer-detail .info-label {
            color: var(--fry-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .fryer-detail .info-value {
            color: var(--fry-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .fryer-detail .batch-highlight {
            background: linear-gradient(135deg, var(--fry-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .fryer-detail .batch-highlight-warning {
            background: linear-gradient(135deg, var(--fry-accent), #C87527);
        }

        .fryer-detail .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .fryer-detail .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .fryer-detail .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .fryer-detail .stat-card {
            height: 100%;
            background: var(--fry-primary-light);
            border: 1px solid var(--fry-border);
            border-radius: 9px;
            padding: 1rem 1.1rem;
            display: flex;
            align-items: center;
        }

        .fryer-detail .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--fry-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .fryer-detail .stat-label {
            color: var(--fry-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .fryer-detail .stat-value {
            color: var(--fry-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        /* Status Suhu Pusat */
        .fryer-detail .stat-suhu-success {
            color: #28a745 !important;
        }

        .fryer-detail .stat-suhu-warning {
            color: #D98C3D !important;
        }

        .fryer-detail .stat-suhu-danger {
            color: #dc3545 !important;
        }

        /* Organoleptik */
        .fryer-detail .text-success-fryer {
            color: #28a745 !important;
        }

        .fryer-detail .text-warning-fryer {
            color: var(--fry-accent) !important;
        }

        .fryer-detail .section-info {
            background: var(--fry-primary-light);
            border: 1px solid var(--fry-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
            color: var(--fry-text);
        }

        .fryer-detail .section-info i {
            color: var(--fry-primary);
            margin-right: 0.5rem;
        }

        .fryer-detail .empty-state {
            text-align: center;
            color: var(--fry-muted);
            padding: 1rem;
        }

        .fryer-detail .empty-state i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .fryer-detail .btn-ghost {
            color: var(--fry-muted);
            background: transparent;
            border: 1px solid var(--fry-border);
        }

        .fryer-detail .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--fry-text);
        }

        @media (max-width: 767.98px) {
            .fryer-detail .card-body {
                padding: 1rem;
            }

            .fryer-detail .card-header {
                padding: 0.9rem 1rem;
            }

            .fryer-detail .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    @php
        // Status warna Suhu Pusat
        // Hijau : 76,5 - 79,5
        // Kuning: 76 - <76,5 dan >79,5 - 80
        // Merah : <76 atau >80
        $suhuClass = '';
        $isBelowMinimum = false;

        if ($fryer->suhu_pusat !== null) {
            $suhu = (float) $fryer->suhu_pusat;

            if ($suhu >= 76.5 && $suhu <= 79.5) {
                $suhuClass = 'stat-suhu-success';
            } elseif (($suhu >= 76 && $suhu < 76.5) || ($suhu > 79.5 && $suhu <= 80)) {
                $suhuClass = 'stat-suhu-warning';
            } else {
                $suhuClass = 'stat-suhu-danger';
                $isBelowMinimum = true; // kotak Production Batch jadi oranye
            }
        }
    @endphp

    <div class="fryer-detail">

        <div class="section-header">
            <h1>Fryer</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.fryer.index') }}">Fryer</a>
                </div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-lead">
            Detail proses produksi menggunakan Fryer berdasarkan production batch yang telah dicatat.
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

            {{-- 1. Informasi Produksi --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><span class="step-badge">1</span> Informasi Produksi</h4>
                </div>

                <div class="card-body">

                    <div class="batch-highlight {{ $isBelowMinimum ? 'batch-highlight-warning' : '' }}">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="batch-label">Production Batch</div>
                                <div class="batch-number">{{ $fryer->productionBatch->no_batch ?? '-' }}</div>
                                <div class="batch-product">{{ $fryer->productionBatch->product->nama ?? '-' }}</div>
                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                <div class="batch-label">Tanggal Produksi</div>
                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($fryer->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($fryer->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Tanggal Produksi</div>
                                <div class="info-value">
                                    {{ optional($fryer->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($fryer->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">No Batch</div>
                                <div class="info-value">{{ $fryer->productionBatch->no_batch ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Product</div>
                                <div class="info-value">{{ $fryer->productionBatch->product->nama ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Line</div>
                                <div class="info-value">
                                    {{ $fryer->line ?? ($fryer->productionBatch->line ?? '-') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                                <div>
                                    <div class="stat-label">Waktu Kerja</div>
                                    <div class="stat-value">
                                        {{ $fryer->productionBatch->waktu_kerja !== null ? $fryer->productionBatch->waktu_kerja . ' Menit' : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-fire"></i></div>
                                <div>
                                    <div class="stat-label">Fryer</div>
                                    <div class="stat-value">
                                        {{ $fryer->fryer !== null ? 'Fryer ' . $fryer->fryer : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-industry"></i></div>
                                <div>
                                    <div class="stat-label">Line</div>
                                    <div class="stat-value">
                                        {{ $fryer->line ?? ($fryer->productionBatch->line ?? '-') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-stopwatch"></i></div>
                                <div>
                                    <div class="stat-label">Waktu Proses</div>
                                    <div class="stat-value">
                                        @if ($fryer->waktu_mulai || $fryer->waktu_selesai)
                                            {{ $fryer->waktu_mulai ? substr($fryer->waktu_mulai, 0, 5) : '-' }}
                                            &ndash;
                                            {{ $fryer->waktu_selesai ? substr($fryer->waktu_selesai, 0, 5) : '-' }}
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

            {{-- 2. Parameter Fryer --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><span class="step-badge">2</span> Parameter Fryer</h4>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-thermometer-half"></i></div>
                                <div>
                                    <div class="stat-label">Suhu Setting</div>
                                    <div class="stat-value">
                                        {{ $fryer->suhu_setting !== null
                                            ? rtrim(rtrim(number_format($fryer->suhu_setting, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-temperature-high"></i></div>
                                <div>
                                    <div class="stat-label">Suhu Aktual</div>
                                    <div class="stat-value">
                                        {{ $fryer->suhu_aktual !== null
                                            ? rtrim(rtrim(number_format($fryer->suhu_aktual, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon {{ $suhuClass }}"><i class="fas fa-temperature-low"></i></div>
                                <div>
                                    <div class="stat-label {{ $suhuClass }}">Suhu Pusat</div>
                                    <div class="stat-value {{ $suhuClass }}">
                                        {{ $fryer->suhu_pusat !== null
                                            ? rtrim(rtrim(number_format($fryer->suhu_pusat, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-temperature-low"></i></div>
                                <div>
                                    <div class="stat-label">Suhu Minimum</div>
                                    <div class="stat-value">
                                        {{ $fryer->suhu_minimum !== null
                                            ? rtrim(rtrim(number_format($fryer->suhu_minimum, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                                <div>
                                    <div class="stat-label">Hasil Organoleptik</div>
                                    <div class="stat-value">
                                        @if ($fryer->organoleptik === 'Ok')
                                            <span class="text-success-fryer">Ok</span>
                                        @elseif ($fryer->organoleptik === 'Tidak')
                                            <span class="text-warning-fryer">Tidak</span>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                                <div>
                                    <div class="stat-label">Lama Pemasakan</div>
                                    <div class="stat-value">
                                        {{ $fryer->lama_pemasakan !== null
                                            ? rtrim(rtrim(number_format($fryer->lama_pemasakan, 2, ',', '.'), '0'), ',') . ' Menit'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-tint"></i></div>
                                <div>
                                    <div class="stat-label">TPM Minyak</div>
                                    <div class="stat-value">
                                        {{ $fryer->tpm_minyak !== null ? rtrim(rtrim(number_format($fryer->tpm_minyak, 2, ',', '.'), '0'), ',') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                <div>
                                    <div class="stat-label">Downtime</div>
                                    <div class="stat-value">{{ $fryer->downtime ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- 3. Waktu Proses & Petugas --}}
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
                                    {{ $fryer->waktu_mulai ? substr($fryer->waktu_mulai, 0, 5) : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-box">
                                <div class="info-label">Waktu Selesai</div>
                                <div class="info-value">
                                    {{ $fryer->waktu_selesai ? substr($fryer->waktu_selesai, 0, 5) : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">Petugas</div>
                                <div class="info-value">{{ $fryer->petugas ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="info-label">PIC Produksi</div>
                                <div class="info-value">{{ $fryer->pic_produksi ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Keterangan --}}
            <div class="card card-final mb-4">
                <div class="card-header">
                    <h4><span class="step-badge">4</span> Keterangan</h4>
                </div>

                <div class="card-body">
                    @if ($fryer->keterangan)
                        <div class="section-info">
                            <i class="fas fa-info-circle"></i>
                            {{ $fryer->keterangan }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-comment-slash d-block"></i>
                            <div>Tidak ada keterangan.</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Aksi --}}
            <div class="card card-final">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="section-info mb-2 mb-md-0">
                            <i class="fas fa-info-circle"></i>
                            Pastikan data Fryer sudah sesuai.
                        </div>

                        <div class="action-buttons">

                            <a href="{{ route('operator.fryer.edit', $fryer->id) }}" class="btn btn-outline-warning"
                                title="Edit">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>

                            <form action="{{ route('operator.fryer.destroy', $fryer->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus data Fryer ini?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>
                            </form>

                            <a href="{{ route('operator.fryer.index') }}" class="btn btn-ghost">
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
