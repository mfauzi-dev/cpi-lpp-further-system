@extends('layouts.master')

@section('title', 'Predust Breader')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Predust Breader</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('operator.predust-breader.index') }}">
                        Predust Breader
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

            {{-- ACTION --}}

            <div class="mb-4">

                <a href="{{ route('operator.predust-breader.create') }}" class="btn btn-add">

                    <i class="fas fa-plus mr-1"></i>
                    Tambah Predust Breader

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

                    <form method="GET" action="{{ route('operator.predust-breader.index') }}">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>
                                    No. Batch
                                </label>

                                <input type="text" name="kode_product" class="form-control" placeholder="Cth: PB-001"
                                    value="{{ request('kode_product') }}">

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

                            <a href="{{ route('operator.predust-breader.index') }}" class="btn btn-ghost">

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
                        <i class="fas fa-bread-slice mr-2"></i>
                        Daftar Predust Breader
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
                                    <th>Predust Breader</th>
                                    <th>Superflex</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Downtime</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($predustBreaders as $predustBreader)
                                    <tr>

                                        <td class="number-cell">
                                            {{ $predustBreaders->firstItem() + $loop->index }}
                                        </td>

                                        <td>

                                            @if ($predustBreader->productionBatch?->tanggal_produksi)
                                                <span class="badge-soft">
                                                    {{ \Carbon\Carbon::parse($predustBreader->productionBatch->tanggal_produksi)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($predustBreader->productionBatch?->no_batch)
                                                <span class="badge-soft">
                                                    {{ $predustBreader->productionBatch->no_batch }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>
                                            {{ $predustBreader->productionBatch->product->nama ?? '-' }}
                                        </td>

                                        <td>

                                            @if ($predustBreader->productionBatch?->waktu_kerja !== null)
                                                <span class="badge-value">
                                                    {{ $predustBreader->productionBatch->waktu_kerja }} Jam
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($predustBreader->predust_breader !== null)
                                                <span class="badge-value">
                                                    {{ $predustBreader->predust_breader }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($predustBreader->superflex !== null)
                                                <span class="badge-value">
                                                    {{ $predustBreader->superflex }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($predustBreader->waktu_mulai)
                                                {{ \Carbon\Carbon::parse($predustBreader->waktu_mulai)->format('H:i') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($predustBreader->waktu_selesai)
                                                {{ \Carbon\Carbon::parse($predustBreader->waktu_selesai)->format('H:i') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if ($predustBreader->downtime !== null)
                                                <span class="badge-value">
                                                    {{ $predustBreader->downtime }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif

                                        </td>

                                        <td>

                                            <div class="action-buttons">

                                                <a href="{{ route('operator.predust-breader.detail', $predustBreader->id) }}"
                                                    class="btn btn-outline-info" title="Lihat Detail">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('operator.predust-breader.edit', $predustBreader->id) }}"
                                                    class="btn btn-outline-warning" title="Edit">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form
                                                    action="{{ route('operator.predust-breader.destroy', $predustBreader->id) }}"
                                                    method="POST" style="display: inline;">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                        onclick="return confirm('Yakin hapus data Predust Breader ini?')">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="11">

                                            <div class="empty-state">

                                                <i class="fas fa-bread-slice d-block"></i>

                                                <div>
                                                    Belum ada data Predust Breader.
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

                    {{ $predustBreaders->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection
