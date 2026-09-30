@extends('layouts.master')

@section('title', 'Pembekuan')

@section('content')


    <div class="page-section">

        <div class="section-header">

            <h1>Pembekuan</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.pembekuan.index') }}">

                        Pembekuan

                    </a>

                </div>

                <div class="breadcrumb-item active">

                    Table

                </div>

            </div>

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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    {{ session('error') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>
            @endif

            <div class="mb-4">

                <a href="{{ route('operator.pembekuan.create') }}" class="btn btn-add">

                    <i class="fas fa-plus mr-1"></i>

                    Tambah Pembekuan

                </a>

            </div>

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <i class="fas fa-filter mr-2"></i>

                        Filter Data

                    </h4>

                </div>

                <div class="card-body">

                    <form method="GET" action="{{ route('operator.pembekuan.index') }}">

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

                            <a href="{{ route('operator.pembekuan.index') }}" class="btn btn-ghost">

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

                        <i class="fas fa-snowflake mr-2"></i>

                        Daftar Pembekuan

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

                                    <th>Line</th>

                                    <th>Suhu Ruang Packing</th>

                                    <th>Suhu Ruang IQF</th>

                                    <th>Speed Conveyor</th>

                                    <th>Suhu Pusat</th>

                                    <th>Suhu Minimum</th>

                                    <th>Status Suhu</th>

                                    <th>Waktu Mulai</th>

                                    <th>Waktu Selesai</th>

                                    <th>Lama Kerusakan</th>

                                    <th>Lama Istirahat</th>

                                    <th>Operator</th>

                                    <th>PIC Produksi</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($pembekuans as $pembekuan)
                                    @php

                                        $isBelowMinimum =
                                            $pembekuan->suhu_pusat !== null &&
                                            $pembekuan->suhu_minimum !== null &&
                                            $pembekuan->suhu_pusat > $pembekuan->suhu_minimum;

                                    @endphp

                                    <tr>

                                        <td class="number-cell">

                                            {{ $pembekuans->firstItem() + $loop->index }}

                                        </td>

                                        <td>

                                            @if ($pembekuan->productionBatch?->tanggal_produksi)
                                                <span class="badge-soft">

                                                    {{ \Carbon\Carbon::parse($pembekuan->productionBatch->tanggal_produksi)->format('d M Y') }}

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->productionBatch?->no_batch)
                                                <span class="badge-soft">

                                                    {{ $pembekuan->productionBatch->no_batch }}

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            {{ $pembekuan->productionBatch->product->nama ?? '-' }}

                                        </td>

                                        <td>

                                            @if ($pembekuan->line !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->line }}

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->suhu_ruang_packing !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->suhu_ruang_packing }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->suhu_ruang_iqf !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->suhu_ruang_iqf }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->speed_conveyor !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->speed_conveyor }}

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->suhu_pusat !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->suhu_pusat }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->suhu_minimum !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->suhu_minimum }} °C

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->suhu_pusat === null || $pembekuan->suhu_minimum === null)
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @elseif ($isBelowMinimum)
                                                <span class="badge badge-danger">

                                                    Di Bawah Minimum

                                                </span>
                                            @else
                                                <span class="badge badge-success">

                                                    Sesuai Minimum

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->waktu_mulai)
                                                {{ \Carbon\Carbon::parse($pembekuan->waktu_mulai)->format('H\:i') }}
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->waktu_selesai)
                                                {{ \Carbon\Carbon::parse($pembekuan->waktu_selesai)->format('H\:i') }}
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->lama_waktu_kerusakan !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->lama_waktu_kerusakan }}

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->lama_waktu_istirahat !== null)
                                                <span class="badge-value">

                                                    {{ $pembekuan->lama_waktu_istirahat }}

                                                </span>
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->operator)
                                                {{ $pembekuan->operator }}
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($pembekuan->pic_produksi)
                                                {{ $pembekuan->pic_produksi }}
                                            @else
                                                <span class="value-empty">

                                                    -

                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            <div class="action-buttons">

                                                <a href="{{ route('operator.pembekuan.detail', $pembekuan->id) }}"
                                                    class="btn btn-outline-info" title="Lihat Detail">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('operator.pembekuan.edit', $pembekuan->id) }}"
                                                    class="btn btn-outline-warning" title="Edit">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form action="{{ route('operator.pembekuan.destroy', $pembekuan->id) }}"
                                                    method="POST" style="display: inline;">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                        onclick="return confirm('Yakin hapus data Pembekuan ini?')">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="18">

                                            <div class="empty-state">

                                                <i class="fas fa-snowflake d-block"></i>

                                                <div>

                                                    Belum ada data Pembekuan.

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

                    {{ $pembekuans->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection
