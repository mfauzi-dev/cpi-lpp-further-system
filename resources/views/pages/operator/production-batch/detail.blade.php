@extends('layouts.master')

@section('title', 'Detail Production Batch')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Production Batch</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.production-batch.index') }}">
                        Production Batch
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail production batch dan proses produksi yang terhubung.
        </p>

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
                        Informasi Production Batch
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
                                    @if ($productionBatch->product)
                                        {{ $productionBatch->product->kode_product ? $productionBatch->product->kode_product . ' - ' : '' }}
                                        {{ $productionBatch->product->nama }}
                                    @else
                                        -
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ $productionBatch->tanggal_produksi ? $productionBatch->tanggal_produksi->translatedFormat('d F Y') : '-' }}
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
                                    {{ $productionBatch->tanggal_produksi ? $productionBatch->tanggal_produksi->translatedFormat('d F Y') : '-' }}
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
                                    @if ($productionBatch->product)
                                        {{ $productionBatch->product->kode_product ? $productionBatch->product->kode_product . ' - ' : '' }}
                                        {{ $productionBatch->product->nama }}
                                    @else
                                        -
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">

                                <div class="info-label">
                                    Product Group
                                </div>

                                <div class="info-value">
                                    {{ $productionBatch->product->productGroup->nama ?? '-' }}
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
                                    {{ $productionBatch->line ?? '-' }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">
                                    @if ($productionBatch->waktu_kerja !== null)
                                        <span class="badge-value">
                                            {{ $productionBatch->waktu_kerja }} Menit
                                        </span>
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
                                    Production Batch
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
                        Hasil Production Batch
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="info-box">

                                <div class="info-label">
                                    Waktu Kerja
                                </div>

                                <div class="info-value">
                                    @if ($productionBatch->waktu_kerja !== null)
                                        <span class="badge-value">
                                            {{ $productionBatch->waktu_kerja }} Menit
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">

                                <div class="info-label">
                                    Yield
                                </div>

                                <div class="info-value">
                                    @if ($productionBatch->yield !== null)
                                        <span class="badge-value">
                                            {{ $productionBatch->yield }}
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">

                                <div class="info-label">
                                    Persen Rijek
                                </div>

                                <div class="info-value">
                                    @if ($productionBatch->persen_rijek !== null)
                                        <span class="badge-value">
                                            {{ $productionBatch->persen_rijek }}%
                                        </span>
                                    @else
                                        <span class="value-empty">-</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">

                                <div class="info-label">
                                    Produktifitas
                                </div>

                                <div class="info-value">
                                    @if ($productionBatch->produktifitas !== null)
                                        <span class="badge-value">
                                            {{ $productionBatch->produktifitas }}
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
                        Informasi Proses Produksi
                    </h4>
                </div>

                <div class="card-body">

                    <div class="process-highlight">

                        <div class="process-label">
                            Production Batch
                        </div>

                        <div class="process-value">
                            {{ $productionBatch->no_batch ?? '-' }}
                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-wide">

                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th>Proses</th>
                                    <th>Data</th>
                                </tr>
                            </thead>

                            <tbody>

                                @php
                                    $no = 1;
                                @endphp

                                @if ($productionBatch->formings->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Forming
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->formings->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->bowlCutters->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Bowl Cutter
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->bowlCutters->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->grinders->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Grinder
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->grinders->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->preparasiFlas->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Preparasi FLA
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->preparasiFlas->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->tumblers->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Tumbler
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->tumblers->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->mixings->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Mixing
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->mixings->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->batters->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Batter
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->batters->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->hlts->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                HLT
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->hlts->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->predustBreaders->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Predust Breader
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->predustBreaders->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->fryers->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Fryer
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->fryers->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->pembekuans->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Pembekuan
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->pembekuans->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->packingDalams->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Packing Dalam
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->packingDalams->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->packingLuars->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Packing Luar
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->packingLuars->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->kemasanRijeks->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Kemasan Rijek
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->kemasanRijeks->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($productionBatch->productions->count())
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge-soft">
                                                Produksi Bahan Baku
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-value">
                                                {{ $productionBatch->productions->count() }} Data
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                @if ($no === 1)
                                    <tr>
                                        <td colspan="3">
                                            <div class="empty-state">
                                                <i class="fas fa-inbox d-block"></i>
                                                Belum ada proses produksi yang terhubung.
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            <div class="card card-final mb-4">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8 mb-3 mb-md-0">

                            <div class="total-card">

                                <div class="stat-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Production Batch
                                    </div>

                                    <div class="stat-value">
                                        {{ $productionBatch->no_batch ?? '-' }}
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end flex-wrap">

                                <a href="{{ route('operator.production-batch.edit', $productionBatch->id) }}"
                                    class="btn btn-warning mr-2 mb-2">

                                    <i class="fas fa-edit mr-1"></i>
                                    Edit

                                </a>

                                <form action="{{ route('operator.production-batch.destroy', $productionBatch->id) }}"
                                    method="POST" class="d-inline mr-2 mb-2"
                                    onsubmit="return confirm('Yakin ingin menghapus production batch ini?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">

                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus

                                    </button>

                                </form>

                                <a href="{{ route('operator.production-batch.index') }}" class="btn btn-ghost mb-2">

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
