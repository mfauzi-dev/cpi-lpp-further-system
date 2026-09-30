@extends('layouts.master')

@section('title', 'Detail Forming')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Forming</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.forming.index') }}">

                        Forming

                    </a>

                </div>

                <div class="breadcrumb-item active">

                    Detail

                </div>

            </div>

        </div>

        <div class="section-lead">

            Detail proses produksi menggunakan Forming berdasarkan production batch yang telah dicatat.

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

                                    Line

                                </div>

                                <div class="info-value">

                                    {{ $forming->productionBatch->line ?? '-' }}

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

                                        {{ $forming->productionBatch->waktu_kerja !== null ? $forming->productionBatch->waktu_kerja . ' Menit' : '-' }}

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

                                        {{ $forming->productionBatch->line ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-stopwatch"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Waktu Proses

                                    </div>

                                    <div class="stat-value">

                                        @if ($forming->waktu_mulai || $forming->waktu_selesai)
                                            {{ $forming->waktu_mulai ? substr($forming->waktu_mulai, 0, 5) : '-' }}

                                            &ndash;

                                            {{ $forming->waktu_selesai ? substr($forming->waktu_selesai, 0, 5) : '-' }}
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

            {{-- STEP 2 --}}

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">2</span>

                        Parameter Forming

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-cogs"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Alat

                                    </div>

                                    <div class="stat-value">

                                        {{ $forming->alat ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-thermometer-half"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Suhu Adonan

                                    </div>

                                    <div class="stat-value">

                                        {{ $forming->suhu_adonan !== null
                                            ? rtrim(rtrim(number_format($forming->suhu_adonan, 2, ',', '.'), '0'), ',') . ' °C'
                                            : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-sliders-h"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Pressure

                                    </div>

                                    <div class="stat-value">

                                        {{ $forming->pressure !== null ? rtrim(rtrim(number_format($forming->pressure, 2, ',', '.'), '0'), ',') : '-' }}

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

                                        Speed

                                    </div>

                                    <div class="stat-value">

                                        {{ $forming->speed !== null ? rtrim(rtrim(number_format($forming->speed, 2, ',', '.'), '0'), ',') : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-exclamation-triangle"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Downtime

                                    </div>

                                    <div class="stat-value">

                                        {{ $forming->downtime ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- STEP 3 --}}

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

                                    {{ $forming->waktu_mulai ? substr($forming->waktu_mulai, 0, 5) : '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <div class="info-box">

                                <div class="info-label">

                                    Waktu Selesai

                                </div>

                                <div class="info-value">

                                    {{ $forming->waktu_selesai ? substr($forming->waktu_selesai, 0, 5) : '-' }}

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3 mb-md-0">

                            <div class="info-box">

                                <div class="info-label">

                                    Petugas

                                </div>

                                <div class="info-value">

                                    {{ $forming->petugas ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <div class="info-label">

                                    PIC Produksi

                                </div>

                                <div class="info-value">

                                    {{ $forming->pic_produksi ?? '-' }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- STEP 4 --}}

            <div class="card card-final mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">4</span>

                        Keterangan

                    </h4>

                </div>

                <div class="card-body">

                    @if ($forming->keterangan)
                        <div class="section-info">

                            <i class="fas fa-info-circle"></i>

                            {{ $forming->keterangan }}

                        </div>
                    @else
                        <div class="empty-state">

                            <i class="fas fa-comment-slash d-block"></i>

                            <div>

                                Tidak ada keterangan.

                            </div>

                        </div>
                    @endif

                </div>

            </div>

            {{-- ACTION --}}

            <div class="card card-final">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div class="section-info mb-2 mb-md-0">

                            <i class="fas fa-info-circle"></i>

                            Pastikan data Forming sudah sesuai.

                        </div>

                        <div class="action-buttons">

                            <a href="{{ route('operator.forming.edit', $forming->id) }}" class="btn btn-outline-warning"
                                title="Edit">

                                <i class="fas fa-edit mr-1"></i>

                                Edit

                            </a>

                            <form action="{{ route('operator.forming.destroy', $forming->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus data Forming ini?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger" title="Hapus">

                                    <i class="fas fa-trash mr-1"></i>

                                    Hapus

                                </button>

                            </form>

                            <a href="{{ route('operator.forming.index') }}" class="btn btn-ghost">

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
