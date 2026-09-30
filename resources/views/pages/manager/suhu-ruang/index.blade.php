@extends('layouts.master')

@section('title', 'Suhu Ruang')

@section('content')

    <style>
        :root {
            --sr-primary: #1B4B43;
            --sr-primary-light: #E8F0EE;
            --sr-accent: #D98C3D;
            --sr-border: #E3E7E1;
            --sr-text: #1F2A24;
            --sr-muted: #5B6A62;
            --sr-soft: #F7F9F7;
        }

        .sr-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--sr-text);
        }

        .sr-page .section-lead {
            color: var(--sr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .sr-page .card {
            border: none;
            border-left: 4px solid var(--sr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .sr-page .card.card-final {
            border-left-color: var(--sr-accent);
        }

        .sr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--sr-border);
            padding: 1rem 1.5rem;
        }

        .sr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--sr-text);
            display: flex;
            align-items: center;
        }

        .sr-page .card-header h4 i {
            color: var(--sr-primary);
        }

        .sr-page .card-body {
            padding: 1.5rem;
        }

        .sr-page .filter-label {
            color: var(--sr-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .sr-page .form-control {
            border-color: var(--sr-border);
            border-radius: 7px;
        }

        .sr-page .form-control:focus {
            border-color: var(--sr-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .sr-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .sr-page .table {
            margin-bottom: 0;
        }

        .sr-page .table thead th {
            background: var(--sr-primary-light);
            color: var(--sr-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .sr-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--sr-text);
            padding: .8rem .9rem;
        }

        .sr-page .table-bordered td,
        .sr-page .table-bordered th {
            border-color: var(--sr-border);
        }

        .sr-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .sr-page .table-wide {
            min-width: 1600px;
        }

        .sr-page .table-wide th,
        .sr-page .table-wide td {
            white-space: nowrap;
        }

        .sr-page .badge-soft {
            display: inline-block;
            background: var(--sr-primary-light);
            color: var(--sr-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .sr-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .sr-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .sr-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--sr-muted);
        }

        .sr-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .sr-page .btn-primary {
            background: var(--sr-primary);
            border-color: var(--sr-primary);
        }

        .sr-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .sr-page .btn-ghost {
            color: var(--sr-muted);
            background: transparent;
            border: 1px solid var(--sr-border);
        }

        .sr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--sr-text);
        }

        .sr-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .sr-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .sr-page .card-body {
                padding: 1rem;
            }

            .sr-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="sr-page">

        <div class="section-header">
            <h1>Suhu Ruang</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">Suhu Ruang</a>
                </div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-lead">
            Monitoring pencatatan Suhu Ruang (Meatprep & Chillroom) berdasarkan production batch.
        </div>

        <div class="card mb-4">

            <div class="card-header">
                <h4><i class="fas fa-filter mr-2"></i> Filter Data</h4>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.suhu-ruang.index') }}">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">Kode Batch</label>
                                <input type="text" name="no_batch" class="form-control" placeholder="Cari kode batch..."
                                    value="{{ request('no_batch') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">Kode Product</label>
                                <input type="text" name="kode_product" class="form-control"
                                    placeholder="Cari kode product..." value="{{ request('kode_product') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">Line</label>
                                <input type="text" name="line" class="form-control" placeholder="Cari line..."
                                    value="{{ request('line') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">Tanggal Mulai</label>
                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">Tanggal Akhir</label>
                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>
                        </div>

                    </div>

                    <div class="d-flex align-items-center" style="gap: .5rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search mr-1"></i>
                            Tampilkan
                        </button>

                        <a href="{{ route('manager.suhu-ruang.index') }}" class="btn btn-ghost">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset
                        </a>
                    </div>

                </form>

            </div>
        </div>

        <div class="card card-final">

            <div class="card-header">
                <h4><i class="fas fa-thermometer-half mr-2"></i> Data Suhu Ruang</h4>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Kode Product</th>
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
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($suhuRuangs as $index => $suhuRuang)
                                <tr>

                                    <td class="text-center">{{ $suhuRuangs->firstItem() + $index }}</td>

                                    <td>
                                        @if ($suhuRuang->productionBatch && $suhuRuang->productionBatch->product)
                                            <span class="badge-soft">
                                                {{ $suhuRuang->productionBatch->product->kode_product }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->productionBatch && $suhuRuang->productionBatch->tanggal_produksi)
                                            {{ \Carbon\Carbon::parse($suhuRuang->productionBatch->tanggal_produksi)->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->productionBatch?->no_batch)
                                            <span class="badge-soft">{{ $suhuRuang->productionBatch->no_batch }}</span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->productionBatch && $suhuRuang->productionBatch->product)
                                            {{ $suhuRuang->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->line)
                                            <span class="badge-value">{{ $suhuRuang->line }}</span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->suhu_ruang_meatprep !== null)
                                            {{ rtrim(rtrim(number_format($suhuRuang->suhu_ruang_meatprep, 2, ',', '.'), '0'), ',') }}
                                            °C
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->suhu_ruang_chillroom !== null)
                                            {{ rtrim(rtrim(number_format($suhuRuang->suhu_ruang_chillroom, 2, ',', '.'), '0'), ',') }}
                                            °C
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->waktu_mulai)
                                            {{ \Carbon\Carbon::parse($suhuRuang->waktu_mulai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($suhuRuang->waktu_selesai)->format('H:i') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($suhuRuang->downtime)
                                            <span class="badge-value">{{ $suhuRuang->downtime }}</span>
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

                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <a href="{{ route('manager.suhu-ruang.detail', $suhuRuang->id) }}"
                                                class="btn btn-outline-info">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15">
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

            <div class="card-footer bg-white border-top">
                {{ $suhuRuangs->withQueryString()->links() }}
            </div>

        </div>

    </div>

@endsection
