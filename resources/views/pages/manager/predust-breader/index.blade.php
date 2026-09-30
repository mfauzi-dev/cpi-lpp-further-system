@extends('layouts.master')

@section('title', 'Predust Breader')

@section('content')

    <style>
        :root {
            --pb-primary: #1B4B43;
            --pb-primary-light: #E8F0EE;
            --pb-accent: #D98C3D;
            --pb-border: #E3E7E1;
            --pb-text: #1F2A24;
            --pb-muted: #5B6A62;
            --pb-soft: #F7F9F7;
        }

        .pb-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pb-text);
        }

        .pb-page .section-lead {
            color: var(--pb-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pb-page .card {
            border: none;
            border-left: 4px solid var(--pb-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .pb-page .card.card-final {
            border-left-color: var(--pb-accent);
        }

        .pb-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pb-border);
            padding: 1rem 1.5rem;
        }

        .pb-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pb-text);
            display: flex;
            align-items: center;
        }

        .pb-page .card-header h4 i {
            color: var(--pb-primary);
        }

        .pb-page .card-body {
            padding: 1.5rem;
        }

        .pb-page .filter-label {
            color: var(--pb-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .pb-page .form-control {
            border-color: var(--pb-border);
            border-radius: 7px;
        }

        .pb-page .form-control:focus {
            border-color: var(--pb-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .pb-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pb-page .table {
            margin-bottom: 0;
        }

        .pb-page .table thead th {
            background: var(--pb-primary-light);
            color: var(--pb-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .pb-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--pb-text);
            padding: .8rem .9rem;
        }

        .pb-page .table-bordered td,
        .pb-page .table-bordered th {
            border-color: var(--pb-border);
        }

        .pb-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pb-page .table-wide {
            min-width: 1450px;
        }

        .pb-page .table-wide th,
        .pb-page .table-wide td {
            white-space: nowrap;
        }

        .pb-page .badge-soft {
            display: inline-block;
            background: var(--pb-primary-light);
            color: var(--pb-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pb-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .pb-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pb-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pb-muted);
        }

        .pb-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .pb-page .btn-primary {
            background: var(--pb-primary);
            border-color: var(--pb-primary);
        }

        .pb-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pb-page .btn-ghost {
            color: var(--pb-muted);
            background: transparent;
            border: 1px solid var(--pb-border);
        }

        .pb-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pb-text);
        }

        .pb-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .pb-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        @media (max-width: 767.98px) {
            .pb-page .card-body {
                padding: 1rem;
            }

            .pb-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="pb-page">

        <div class="section-header">

            <h1>Predust Breader</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active">
                    <a href="#">Predust Breader</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>

            </div>

        </div>

        <div class="section-lead">
            Pencatatan dan monitoring proses predust breader berdasarkan kode product.
        </div>

        <div class="card mb-4">

            <div class="card-header">

                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('manager.predust-breader.index') }}">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label class="filter-label">
                                    Kode Product
                                </label>

                                <input type="text" name="kode_product" class="form-control"
                                    placeholder="Cari kode product..." value="{{ request('kode_product') }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label class="filter-label">
                                    Line
                                </label>

                                <input type="text" name="line" class="form-control" placeholder="Cari line..."
                                    value="{{ request('line') }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label class="filter-label">
                                    Tanggal Mulai
                                </label>

                                <input type="date" name="date_from" class="form-control"
                                    value="{{ request('date_from') }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label class="filter-label">
                                    Tanggal Akhir
                                </label>

                                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">

                            </div>

                        </div>

                    </div>

                    <div class="d-flex align-items-center" style="gap: .5rem;">

                        <button type="submit" class="btn btn-primary">

                            <i class="fas fa-search mr-1"></i>
                            Tampilkan

                        </button>

                        <a href="{{ route('manager.predust-breader.index') }}" class="btn btn-ghost">

                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset

                        </a>

                    </div>

                </form>

            </div>

        </div>

        <div class="card card-final">

            <div class="card-header">

                <h4>

                    <i class="fas fa-bread-slice mr-2"></i>
                    Data Predust Breader

                </h4>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-wide">

                        <thead>

                            <tr>

                                <th class="text-center">
                                    No
                                </th>

                                <th>
                                    Kode Product
                                </th>

                                <th>
                                    Tanggal Produksi
                                </th>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Line
                                </th>

                                <th>
                                    Predust Breader
                                </th>

                                <th>
                                    Superflex
                                </th>

                                <th>
                                    Waktu Mulai
                                </th>

                                <th>
                                    Waktu Selesai
                                </th>

                                <th>
                                    Downtime
                                </th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($predustBreaders as $index => $predustBreader)
                                <tr>

                                    <td class="text-center">
                                        {{ $predustBreaders->firstItem() + $index }}
                                    </td>

                                    <td>

                                        @if ($predustBreader->productionBatch && $predustBreader->productionBatch->product)
                                            <span class="badge-soft">
                                                {{ $predustBreader->productionBatch->product->kode_product }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->productionBatch && $predustBreader->productionBatch->tanggal_produksi)
                                            {{ $predustBreader->productionBatch->tanggal_produksi->format('d/m/Y') }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->productionBatch && $predustBreader->productionBatch->product)
                                            {{ $predustBreader->productionBatch->product->nama }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->line)
                                            <span class="badge-value">
                                                {{ $predustBreader->line }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->predust_breader)
                                            <span class="badge-soft">
                                                {{ $predustBreader->predust_breader }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->superflex !== null)
                                            {{ $predustBreader->superflex }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->waktu_mulai)
                                            {{ $predustBreader->waktu_mulai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->waktu_selesai)
                                            {{ $predustBreader->waktu_selesai }}
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($predustBreader->downtime)
                                            <span class="badge-value">
                                                {{ $predustBreader->downtime }}
                                            </span>
                                        @else
                                            <span class="value-empty">-</span>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="action-buttons">

                                            <a href="{{ route('manager.predust-breader.detail', $predustBreader->id) }}"
                                                class="btn btn-outline-info">

                                                <i class="fas fa-info-circle mr-1"></i>
                                                Lihat Detail

                                            </a>

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

            <div class="card-footer bg-white border-top">

                {{ $predustBreaders->withQueryString()->links() }}

            </div>

        </div>

    </div>

@endsection
