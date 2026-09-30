@extends('layouts.master')

@section('title', 'Batter')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Batter</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="{{ route('operator.batter.index') }}">
                        Batter
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

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

            <a href="{{ route('operator.batter.create') }}" class="btn btn-add">
                <i class="fas fa-plus mr-1"></i>
                Tambah Batter
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

                <form method="GET" action="{{ route('operator.batter.index') }}">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="filter-label">
                                Line
                            </label>

                            <input type="text" name="line" class="form-control" placeholder="Cth: Line 1"
                                value="{{ request('line') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="filter-label">
                                Tanggal Dari
                            </label>

                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="filter-label">
                                Tanggal Sampai
                            </label>

                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">

                        </div>

                    </div>

                    <div class="d-flex align-items-center" style="gap: .5rem;">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search mr-1"></i>
                            Tampilkan
                        </button>

                        <a href="{{ route('operator.batter.index') }}" class="btn btn-ghost">
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
                    <i class="fas fa-flask mr-2"></i>
                    Data Batter
                </h4>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Tanggal Produksi</th>
                                <th>No Batch</th>
                                <th>Product</th>
                                <th>Waktu Kerja</th>
                                <th>Suhu Batter</th>
                                <th>Viskositas</th>
                                <th>Salinitas</th>
                                <th>Batter</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Downtime</th>
                                <th>Keterangan</th>
                                <th>Petugas</th>
                                <th>Line</th>
                                <th>PIC Produksi</th>

                                <th width="150" class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($batters as $index => $batter)
                                <tr>

                                    <td>
                                        {{ $batters->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($batter->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">
                                                {{ \Carbon\Carbon::parse($batter->productionBatch->tanggal_produksi)->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batter->productionBatch?->no_batch)
                                            <span class="badge-soft">
                                                {{ $batter->productionBatch->no_batch }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $batter->productionBatch->product->nama ?? '-' }}
                                    </td>

                                    <td>

                                        @if ($batter->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">
                                                {{ $batter->productionBatch->waktu_kerja }} Menit
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batter->suhu_batter !== null)
                                            <span class="badge-value">
                                                {{ $batter->suhu_batter }} °C
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batter->viskositas !== null)
                                            <span class="badge-value">
                                                {{ $batter->viskositas }} Detik
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batter->salinity !== null)
                                            <span class="badge-value">
                                                {{ $batter->salinity }} Kadar
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batter->batter !== null && $batter->batter !== '')
                                            <span class="badge-value">
                                                {{ $batter->batter }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batter->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($batter->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batter->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($batter->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $batter->downtime ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $batter->keterangan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $batter->petugas ?? '-' }}
                                    </td>

                                    <td>

                                        @if ($batter->productionBatch?->line)
                                            <span class="badge-soft">
                                                {{ $batter->productionBatch->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $batter->pic_produksi ?? '-' }}
                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.batter.detail', $batter->id) }}"
                                                class="btn btn-outline-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('operator.batter.edit', $batter->id) }}"
                                                class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('operator.batter.destroy', $batter->id) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirm('Yakin ingin menghapus data Batter ini?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="17">

                                        <div class="empty-state">

                                            <i class="fas fa-flask d-block"></i>

                                            <div>
                                                Belum ada data Batter.
                                            </div>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="card-footer bg-white border-top">

                {{ $batters->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
