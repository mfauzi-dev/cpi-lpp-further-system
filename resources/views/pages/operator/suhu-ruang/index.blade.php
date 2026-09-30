@extends('layouts.master')

@section('title', 'Suhu Ruang')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Suhu Ruang</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">
                    <a href="{{ route('operator.suhu-ruang.index') }}">
                        Suhu Ruang
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
                <a href="{{ route('operator.suhu-ruang.create') }}" class="btn btn-add">
                    <i class="fas fa-plus mr-1"></i>
                    Tambah Suhu Ruang
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

                    <form method="GET" action="{{ route('operator.suhu-ruang.index') }}">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Kode Batch</label>
                                <input type="text" name="no_batch" class="form-control" placeholder="Cth: BATCH001"
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

                            <a href="{{ route('operator.suhu-ruang.index') }}" class="btn btn-ghost">
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
                        <i class="fas fa-thermometer-half mr-2"></i>
                        Daftar Suhu Ruang
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
                                    <th>Suhu Ruang Meatprep</th>
                                    <th>Suhu Ruang Chillroom</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Downtime</th>
                                    <th>Keterangan</th>
                                    <th>Petugas</th>
                                    <th>PIC Produksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($suhuRuangs as $suhuRuang)
                                    <tr>

                                        <td class="number-cell">
                                            {{ $suhuRuangs->firstItem() + $loop->index }}
                                        </td>

                                        <td>
                                            @if ($suhuRuang->productionBatch?->tanggal_produksi)
                                                <span class="badge-soft">
                                                    {{ \Carbon\Carbon::parse($suhuRuang->productionBatch->tanggal_produksi)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->productionBatch?->no_batch)
                                                <span class="badge-soft">
                                                    {{ $suhuRuang->productionBatch->no_batch }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $suhuRuang->productionBatch->product->nama ?? '-' }}
                                        </td>

                                        <td>
                                            @if ($suhuRuang->line !== null)
                                                <span class="badge-value">{{ $suhuRuang->line }}</span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->suhu_ruang_meatprep !== null)
                                                <span class="badge-value">{{ $suhuRuang->suhu_ruang_meatprep }} °C</span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->suhu_ruang_chillroom !== null)
                                                <span class="badge-value">{{ $suhuRuang->suhu_ruang_chillroom }} °C</span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->waktu_mulai)
                                                {{ \Carbon\Carbon::parse($suhuRuang->waktu_mulai)->format('H\:i') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->waktu_selesai)
                                                {{ \Carbon\Carbon::parse($suhuRuang->waktu_selesai)->format('H\:i') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->downtime)
                                                {{ $suhuRuang->downtime }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->keterangan)
                                                {{ \Illuminate\Support\Str::limit($suhuRuang->keterangan, 30) }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->petugas)
                                                {{ $suhuRuang->petugas }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($suhuRuang->pic_produksi)
                                                {{ $suhuRuang->pic_produksi }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="action-buttons">

                                                <a href="{{ route('operator.suhu-ruang.detail', $suhuRuang->id) }}"
                                                    class="btn btn-outline-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('operator.suhu-ruang.edit', $suhuRuang->id) }}"
                                                    class="btn btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('operator.suhu-ruang.destroy', $suhuRuang->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                        onclick="return confirm('Yakin hapus data Suhu Ruang ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="14">
                                            <div class="empty-state">
                                                <i class="fas fa-thermometer-half d-block"></i>
                                                <div>Belum ada data Suhu Ruang.</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card-footer">
                    {{ $suhuRuangs->withQueryString()->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection
