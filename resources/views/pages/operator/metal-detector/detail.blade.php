@extends('layouts.master')

@section('title', 'Detail Metal Detector')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Metal Detector</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.metal-detector.index') }}">
                        Metal Detector
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>

            </div>

        </div>

        <div class="section-lead">
            Detail pemeriksaan Metal Detector berdasarkan production batch yang telah dicatat.
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

            {{-- STEP 1 --}}

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
                                    {{ $productionBatch->no_batch ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">

                                    {{ $productionBatch->tanggal_produksi
                                        ? \Carbon\Carbon::parse($productionBatch->tanggal_produksi)->format('d M Y')
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

                                    {{ $productionBatch->tanggal_produksi
                                        ? \Carbon\Carbon::parse($productionBatch->tanggal_produksi)->format('d M Y')
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
                                    {{ $productionBatch->no_batch ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Product
                                </div>

                                <div class="info-value">
                                    {{ $productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">
                                    Line
                                </div>

                                <div class="info-value">
                                    {{ $productionBatch->line ?? '-' }}
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-clock"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Waktu Kerja
                                    </div>

                                    <div class="stat-value">

                                        {{ $productionBatch->waktu_kerja !== null ? $productionBatch->waktu_kerja . ' Menit' : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">

                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-industry"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Line
                                    </div>

                                    <div class="stat-value">
                                        {{ $productionBatch->line ?? '-' }}
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="stat-card">

                                <div class="stat-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Jumlah Metal Detector
                                    </div>

                                    <div class="stat-value">
                                        {{ $productionBatch->metalDetectors->count() }} Bagian
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- STEP 2 --}}

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">2</span>
                        Pemeriksaan Metal Detector

                    </h4>

                </div>

                <div class="card-body">

                    @forelse ($productionBatch->metalDetectors as $index => $metalDetector)
                        <div class="card mb-4 {{ $loop->last ? 'mb-0' : '' }}">

                            <div class="card-header">

                                <h4>

                                    <span class="step-badge">
                                        {{ $index + 1 }}
                                    </span>

                                    Metal Detector - Bagian {{ $index + 1 }}

                                </h4>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-4 mb-3">

                                        <div class="info-box">

                                            <div class="info-label">
                                                Tipe Batch
                                            </div>

                                            <div class="info-value">

                                                @if ($metalDetector->batch_type)
                                                    <span class="badge-soft">
                                                        {{ $metalDetector->batch_type }}
                                                    </span>
                                                @else
                                                    <span class="value-empty">
                                                        -
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <div class="info-box">

                                            <div class="info-label">
                                                Metal Detector
                                            </div>

                                            <div class="info-value">

                                                @if ($metalDetector->metal_detector)
                                                    <span class="badge-value">
                                                        {{ $metalDetector->metal_detector }}
                                                    </span>
                                                @else
                                                    <span class="value-empty">
                                                        -
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4 mb-3">

                                        <div class="info-box">

                                            <div class="info-label">
                                                Status
                                            </div>

                                            <div class="info-value">

                                                @if ($metalDetector->batch_type === 'FULL BATCH')
                                                    <span class="badge-soft">
                                                        Selesai
                                                    </span>
                                                @elseif ($metalDetector->batch_type === 'HALF BATCH')
                                                    <span class="badge-soft">
                                                        Lanjut ke Bagian Berikutnya
                                                    </span>
                                                @else
                                                    <span class="value-empty">
                                                        -
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3 mb-md-0">

                                        <div class="stat-card">

                                            <div class="stat-icon">
                                                <i class="fas fa-play"></i>
                                            </div>

                                            <div>

                                                <div class="stat-label">
                                                    Waktu Awal
                                                </div>

                                                <div class="stat-value">

                                                    {{ $metalDetector->waktu_awal ? substr($metalDetector->waktu_awal, 0, 5) : '-' }}

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="stat-card">

                                            <div class="stat-icon">
                                                <i class="fas fa-stop"></i>
                                            </div>

                                            <div>

                                                <div class="stat-label">
                                                    Waktu Akhir
                                                </div>

                                                <div class="stat-value">

                                                    {{ $metalDetector->waktu_akhir ? substr($metalDetector->waktu_akhir, 0, 5) : '-' }}

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="empty-state">

                            <i class="fas fa-magnet d-block"></i>

                            <div>
                                Belum ada data Metal Detector untuk production batch ini.
                            </div>

                        </div>
                    @endforelse

                </div>

            </div>

            {{-- ACTION --}}

            <div class="card card-final">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="section-info mb-2 mb-md-0">

                            <i class="fas fa-info-circle"></i>

                            Pastikan data Metal Detector sudah sesuai.

                        </div>

                        <div class="action-buttons">

                            <a href="{{ route('operator.metal-detector.edit', $productionBatch->id) }}"
                                class="btn btn-outline-warning" title="Edit">

                                <i class="fas fa-edit mr-1"></i>
                                Edit

                            </a>

                            <form action="{{ route('operator.metal-detector.destroy', $productionBatch->id) }}"
                                method="POST" style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus data Metal Detector untuk batch ini?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger" title="Hapus">

                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus

                                </button>

                            </form>

                            <a href="{{ route('operator.metal-detector.index') }}" class="btn btn-ghost">

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
