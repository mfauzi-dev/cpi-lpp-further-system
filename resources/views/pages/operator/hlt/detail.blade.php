@extends('layouts.master')

@section('title', 'Detail HLT')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>HLT</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.hlt.index') }}">

                        HLT

                    </a>

                </div>

                <div class="breadcrumb-item active">

                    Detail

                </div>

            </div>

        </div>

        <div class="section-lead">

            Detail proses produksi HLT berdasarkan production batch yang telah dicatat.

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

                                    Line

                                </div>

                                <div class="info-value">

                                    {{ $hlt->productionBatch->line ?? '-' }}

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

                                        {{ $hlt->productionBatch->waktu_kerja !== null ? $hlt->productionBatch->waktu_kerja . ' Menit' : '-' }}

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

                                        {{ $hlt->productionBatch->line ?? '-' }}

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

                                        @if ($hlt->waktu_mulai || $hlt->waktu_selesai)
                                            {{ $hlt->waktu_mulai ? substr($hlt->waktu_mulai, 0, 5) : '-' }}

                                            &ndash;

                                            {{ $hlt->waktu_selesai ? substr($hlt->waktu_selesai, 0, 5) : '-' }}
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

                        Parameter HLT

                    </h4>

                </div>

                <div class="card-body">

                    <div class="row">

                        {{-- Suhu Awal Daging --}}
                        <div class="col-md-6 col-lg-4 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-drumstick-bite"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Suhu Awal Daging

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->suhu_awal_daging !== null ? $hlt->suhu_awal_daging . ' °C' : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Suhu Infeed --}}
                        <div class="col-md-6 col-lg-4 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-temperature-high"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Suhu Infeed

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->suhu_infeed !== null ? $hlt->suhu_infeed . ' °C' : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Suhu Outfeed --}}
                        <div class="col-md-6 col-lg-4 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-temperature-high"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Suhu Outfeed

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->suhu_outfeed !== null ? $hlt->suhu_outfeed . ' °C' : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        {{-- Steam Valve --}}
                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-sliders-h"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Steam Valve

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->steam_valve !== null ? $hlt->steam_valve : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Speed Ventilator --}}
                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-tachometer-alt"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Speed Ventilator

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->speed_ventilator !== null ? $hlt->speed_ventilator : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Lama Pemasakan --}}
                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-stopwatch"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Lama Pemasakan

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->lama_pemasakan !== null ? $hlt->lama_pemasakan . ' Menit' : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Suhu Pusat CT --}}
                        <div class="col-md-6 col-lg-3 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-thermometer-half"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Suhu Pusat CT

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->suhu_pusat_ct !== null ? $hlt->suhu_pusat_ct . ' °C' : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        {{-- Organoleptik --}}
                        <div class="col-md-6 mb-3 mb-md-0">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-clipboard-check"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Organoleptik

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->organoleptik ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Downtime --}}
                        <div class="col-md-6">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-exclamation-triangle"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Downtime

                                    </div>

                                    <div class="stat-value">

                                        {{ $hlt->downtime ?? '-' }}

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

                                    {{ $hlt->waktu_mulai ? substr($hlt->waktu_mulai, 0, 5) : '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <div class="info-box">

                                <div class="info-label">

                                    Waktu Selesai

                                </div>

                                <div class="info-value">

                                    {{ $hlt->waktu_selesai ? substr($hlt->waktu_selesai, 0, 5) : '-' }}

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

                                    {{ $hlt->petugas ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <div class="info-label">

                                    PIC Produksi

                                </div>

                                <div class="info-value">

                                    {{ $hlt->pic_produksi ?? '-' }}

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

                    @if ($hlt->keterangan)
                        <div class="section-info">

                            <i class="fas fa-info-circle"></i>

                            {{ $hlt->keterangan }}

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

                            Pastikan data HLT sudah sesuai.

                        </div>

                        <div class="action-buttons">

                            <a href="{{ route('operator.hlt.edit', $hlt->id) }}" class="btn btn-outline-warning"
                                title="Edit">

                                <i class="fas fa-edit mr-1"></i>

                                Edit

                            </a>

                            <form action="{{ route('operator.hlt.destroy', $hlt->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin ingin menghapus data HLT ini?');">

                                @csrf

                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger" title="Hapus">

                                    <i class="fas fa-trash mr-1"></i>

                                    Hapus

                                </button>

                            </form>

                            <a href="{{ route('operator.hlt.index') }}" class="btn btn-ghost">

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
