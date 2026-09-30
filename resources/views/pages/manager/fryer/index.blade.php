@extends('layouts.master')

@section('title', 'Fryer')

@push('addon-style')
    <style>
        .badge-suhu-success {
            background: #d4edda !important;
            color: #155724 !important;
        }

        .badge-suhu-warning {
            background: #fff3cd !important;
            color: #856404 !important;
        }

        .badge-suhu-danger {
            background: #f8d7da !important;
            color: #721c24 !important;
        }
    </style>
@endpush

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Fryer</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('manager.fryer.index') }}">
                        Fryer
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Table
                </div>

            </div>

        </div>

        <div class="section-body">

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <i class="fas fa-filter mr-2"></i>

                        Filter Data

                    </h4>

                </div>

                <div class="card-body">

                    <form method="GET" action="{{ route('manager.fryer.index') }}">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>
                                    Kode Batch
                                </label>

                                <input type="text" name="no_batch" class="form-control" placeholder="Cth: BATCH001"
                                    value="{{ request('no_batch') }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Line
                                </label>

                                <input type="text" name="line" class="form-control" placeholder="Cth: Line 1"
                                    value="{{ request('line') }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Tanggal Dari
                                </label>

                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Tanggal Sampai
                                </label>

                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">

                            </div>

                        </div>

                        <div>

                            <button type="submit" class="btn btn-primary">

                                <i class="fas fa-search mr-1"></i>

                                Filter

                            </button>

                            <a href="{{ route('manager.fryer.index') }}" class="btn btn-ghost">

                                <i class="fas fa-sync-alt mr-1"></i>

                                Reset

                            </a>

                        </div>

                    </form>

                </div>

            </div>

            <div class="card card-accent">

                <div class="card-header">

                    <h4>

                        <i class="fas fa-fire mr-2"></i>

                        Daftar Fryer

                    </h4>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered table-wide">

                            <thead>

                                <tr>

                                    <th>No</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Kode Batch</th>
                                    <th>Product</th>
                                    <th>Fryer</th>
                                    <th>Waktu Kerja</th>
                                    <th>Suhu Setting</th>
                                    <th>Suhu Aktual</th>
                                    <th>Suhu Pusat</th>
                                    <th>Suhu Minimum</th>
                                    <th>Lama Pemasakan</th>
                                    <th>TPM Minyak</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Downtime</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($fryers as $fryer)
                                    <tr>

                                        <td class="number-cell">

                                            {{ $fryers->firstItem() + $loop->index }}

                                        </td>

                                        <td>

                                            @if ($fryer->productionBatch?->tanggal_produksi)
                                                <span class="badge-soft">

                                                    {{ \Carbon\Carbon::parse($fryer->productionBatch->tanggal_produksi)->format('d M Y') }}

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->productionBatch?->no_batch)
                                                <span class="badge-soft">

                                                    {{ $fryer->productionBatch->no_batch }}

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            {{ $fryer->productionBatch->product->nama ?? '-' }}

                                        </td>

                                        <td>

                                            @if ($fryer->fryer !== null)
                                                <span class="badge-value">

                                                    Fryer {{ $fryer->fryer }}

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->productionBatch?->waktu_kerja !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->productionBatch->waktu_kerja }} Menit

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->suhu_setting !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->suhu_setting }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->suhu_aktual !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->suhu_aktual }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->suhu_pusat !== null)
                                                <span class="badge-value badge-suhu-{{ $fryer->suhu_pusat_status }}">

                                                    {{ $fryer->suhu_pusat }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->suhu_minimum !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->suhu_minimum }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->lama_pemasakan !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->lama_pemasakan }} Menit

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->tpm_minyak !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->tpm_minyak }}

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->waktu_mulai)
                                                {{ \Carbon\Carbon::parse($fryer->waktu_mulai)->format('H:i') }}
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->waktu_selesai)
                                                {{ \Carbon\Carbon::parse($fryer->waktu_selesai)->format('H:i') }}
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($fryer->downtime !== null)
                                                <span class="badge-value">

                                                    {{ $fryer->downtime }}

                                                </span>
                                            @else
                                                <span class="value-empty">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            <div class="action-buttons">

                                                <a href="{{ route('manager.fryer.detail', $fryer->id) }}"
                                                    class="btn btn-outline-info" title="Lihat Detail">

                                                    <i class="fas fa-info-circle mr-1"></i>
                                                    Lihat Detail

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="16">

                                            <div class="empty-state">

                                                <i class="fas fa-fire d-block"></i>

                                                <div>
                                                    Belum ada data Fryer.
                                                </div>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card-footer">

                    {{ $fryers->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection
