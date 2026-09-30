@extends('layouts.master')

@section('title', 'HLT')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>HLT</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">

                    HLT

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

        {{-- TAMBAH --}}

        <div class="mb-4">

            <a href="{{ route('operator.hlt.create') }}" class="btn btn-add">

                <i class="fas fa-plus mr-1"></i>

                Tambah HLT

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

                <form method="GET" action="{{ route('operator.hlt.index') }}">

                    <div class="row">

                        <div class="col-md-3 mb-3">

                            <label class="filter-label">

                                Kode Product

                            </label>

                            <input type="text" name="kode_product" class="form-control" placeholder="Cth: PRD001"
                                value="{{ request('kode_product') }}">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="filter-label">

                                Line

                            </label>

                            <input type="text" name="line" class="form-control" placeholder="Cth: Line 1"
                                value="{{ request('line') }}">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="filter-label">

                                Tanggal Dari

                            </label>

                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">

                        </div>

                        <div class="col-md-3 mb-3">

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

                        <a href="{{ route('operator.hlt.index') }}" class="btn btn-ghost">

                            <i class="fas fa-sync-alt mr-1"></i>

                            Reset

                        </a>

                    </div>

                </form>

            </div>

        </div>

        {{-- DATA HLT --}}

        <div class="card card-accent">

            <div class="card-header">

                <h4>

                    <i class="fas fa-temperature-high mr-2"></i>

                    Data HLT

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

                                <th>Suhu Awal Daging</th>

                                <th>Suhu Infeed</th>

                                <th>Suhu Outfeed</th>

                                <th>Steam Valve</th>

                                <th>Speed Ventilator</th>

                                <th>Lama Pemasakan</th>

                                <th>Suhu Pusat CT</th>

                                <th>Organoleptik</th>

                                <th>Waktu Mulai</th>

                                <th>Waktu Selesai</th>

                                <th>Downtime</th>

                                <th>Keterangan</th>

                                <th>Petugas</th>

                                <th>Line</th>

                                <th>PIC Produksi</th>

                                <th width="150" class="text-center">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($hlts as $index => $hlt)
                                <tr>

                                    <td>

                                        {{ $hlts->firstItem() + $index }}

                                    </td>

                                    <td>

                                        @if ($hlt->productionBatch?->tanggal_produksi)
                                            <span class="badge-soft">

                                                {{ $hlt->productionBatch->tanggal_produksi->format('d/m/Y') }}

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->productionBatch?->no_batch)
                                            <span class="badge-soft">

                                                {{ $hlt->productionBatch->no_batch }}

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $hlt->productionBatch?->product?->nama ?? '-' }}

                                    </td>

                                    <td>

                                        @if ($hlt->productionBatch?->waktu_kerja !== null)
                                            <span class="badge-value">

                                                {{ $hlt->productionBatch->waktu_kerja }} Menit

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->suhu_awal_daging !== null)
                                            <span class="badge-value">

                                                {{ $hlt->suhu_awal_daging }} °C

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->suhu_infeed !== null)
                                            <span class="badge-value">

                                                {{ $hlt->suhu_infeed }} °C

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->suhu_outfeed !== null)
                                            <span class="badge-value">

                                                {{ $hlt->suhu_outfeed }} °C

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->steam_valve !== null)
                                            <span class="badge-value">

                                                {{ $hlt->steam_valve }}

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->speed_ventilator !== null)
                                            <span class="badge-value">

                                                {{ $hlt->speed_ventilator }}

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->lama_pemasakan !== null)
                                            <span class="badge-value">

                                                {{ $hlt->lama_pemasakan }} Menit

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->suhu_pusat_ct !== null)
                                            <span class="badge-value">

                                                {{ $hlt->suhu_pusat_ct }} °C

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $hlt->organoleptik ?? '-' }}

                                    </td>

                                    <td>

                                        @if ($hlt->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($hlt->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($hlt->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($hlt->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $hlt->downtime ?? '-' }}

                                    </td>

                                    <td>

                                        {{ $hlt->keterangan ?? '-' }}

                                    </td>

                                    <td>

                                        {{ $hlt->petugas ?? '-' }}

                                    </td>

                                    <td>

                                        @if ($hlt->productionBatch?->line)
                                            <span class="badge-soft">

                                                {{ $hlt->productionBatch->line }}

                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $hlt->pic_produksi ?? '-' }}

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('operator.hlt.detail', $hlt->id) }}"
                                                class="btn btn-outline-info" title="Detail">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="{{ route('operator.hlt.edit', $hlt->id) }}"
                                                class="btn btn-outline-warning" title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('operator.hlt.destroy', $hlt->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Yakin ingin menghapus data HLT ini?');">

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

                                    <td colspan="21">

                                        <div class="empty-state">

                                            <i class="fas fa-temperature-high d-block"></i>

                                            <div>

                                                Belum ada data HLT.

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

                {{ $hlts->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
