@extends('layouts.master')

@section('title', 'Preparasi Fla')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Preparasi Fla</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.preparasi-fla.index') }}">
                        Preparasi Fla
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses produksi Preparasi Fla berdasarkan production batch.
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

            {{-- ACTION --}}
            <div class="mb-4">
                <a href="{{ route('operator.preparasi-fla.create') }}" class="btn btn-add">
                    <i class="fas fa-plus mr-1"></i>
                    Tambah Preparasi Fla
                </a>
            </div>

            {{-- FILTER --}}
            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <i class="fas fa-filter mr-2"></i>
                        Filter Data
                    </h4>
                </div>

                <div class="card-body">

                    <form method="GET" action="{{ route('operator.preparasi-fla.index') }}">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>No. Batch</label>

                                <input type="text" name="no_batch" class="form-control" placeholder="Cth: PB-001"
                                    value="{{ request('no_batch') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Line</label>

                                <input type="text" name="line" class="form-control" placeholder="Cth: Line 1"
                                    value="{{ request('line') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tanggal Dari</label>

                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tanggal Sampai</label>

                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>

                        </div>

                        <div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search mr-1"></i>
                                Filter
                            </button>

                            <a href="{{ route('operator.preparasi-fla.index') }}" class="btn btn-ghost">
                                <i class="fas fa-sync-alt mr-1"></i>
                                Reset
                            </a>

                        </div>

                    </form>

                </div>

            </div>

            {{-- DATA --}}
            <div class="card card-accent">

                <div class="card-header">
                    <h4>
                        <i class="fas fa-flask mr-2"></i>
                        Daftar Preparasi Fla
                    </h4>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered table-wide">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Production Batch</th>
                                    <th>Product</th>
                                    <th>Waktu Kerja</th>
                                    <th>Homogenisasi / Orlap</th>
                                    <th>Suhu Fla After Cooling Down</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Downtime</th>
                                    <th>Keterangan</th>
                                    <th>Petugas</th>
                                    <th>Line</th>
                                    <th>PIC Produksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($preparasiFlas as $preparasiFla)
                                    <tr>

                                        <td class="number-cell">
                                            {{ $preparasiFlas->firstItem() + $loop->index }}
                                        </td>

                                        <td>
                                            @if ($preparasiFla->productionBatch?->tanggal_produksi)
                                                <span class="badge-soft">
                                                    {{ \Carbon\Carbon::parse($preparasiFla->productionBatch->tanggal_produksi)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($preparasiFla->productionBatch?->no_batch)
                                                <span class="badge-soft">
                                                    {{ $preparasiFla->productionBatch->no_batch }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $preparasiFla->productionBatch->product->nama ?? '-' }}
                                        </td>

                                        <td>
                                            @if ($preparasiFla->productionBatch?->waktu_kerja !== null)
                                                <span class="badge-value">
                                                    {{ $preparasiFla->productionBatch->waktu_kerja }} Menit
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($preparasiFla->homeganisasi_orlap)
                                                <span class="badge-value">
                                                    {{ $preparasiFla->homeganisasi_orlap }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($preparasiFla->suhu_fla_after_cooling_down !== null)
                                                <span class="badge-value">
                                                    {{ $preparasiFla->suhu_fla_after_cooling_down }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($preparasiFla->waktu_mulai)
                                                {{ \Carbon\Carbon::parse($preparasiFla->waktu_mulai)->format('H:i') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($preparasiFla->waktu_selesai)
                                                {{ \Carbon\Carbon::parse($preparasiFla->waktu_selesai)->format('H:i') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($preparasiFla->downtime)
                                                <span class="badge-value">
                                                    {{ $preparasiFla->downtime }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($preparasiFla->keterangan)
                                                {{ $preparasiFla->keterangan }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $preparasiFla->petugas ?? '-' }}
                                        </td>

                                        <td>
                                            @if ($preparasiFla->productionBatch?->line)
                                                <span class="badge-soft">
                                                    {{ $preparasiFla->productionBatch->line }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $preparasiFla->pic_produksi ?? '-' }}
                                        </td>

                                        <td>
                                            <div class="action-buttons">

                                                <a href="{{ route('operator.preparasi-fla.detail', $preparasiFla->id) }}"
                                                    class="btn btn-outline-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('operator.preparasi-fla.edit', $preparasiFla->id) }}"
                                                    class="btn btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form
                                                    action="{{ route('operator.preparasi-fla.destroy', $preparasiFla->id) }}"
                                                    method="POST" style="display: inline;">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                        onclick="return confirm('Yakin hapus data Preparasi Fla ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="15">
                                            <div class="empty-state">
                                                <i class="fas fa-flask d-block"></i>
                                                <div>
                                                    Belum ada data Preparasi Fla.
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
                    {{ $preparasiFlas->withQueryString()->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection
