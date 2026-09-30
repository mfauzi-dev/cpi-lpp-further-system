@extends('layouts.master')

@section('title', 'Detail Packing Dalam')

@push('addon-style')
    <style>
        :root {
            --pd-primary: #1B4B43;
            --pd-primary-light: #E8F0EE;
            --pd-accent: #D98C3D;
            --pd-border: #E3E7E1;
            --pd-text: #1F2A24;
            --pd-muted: #5B6A62;
            --pd-soft: #F7F9F7;
        }

        .pd-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pd-text);
        }

        .pd-page .section-lead {
            color: var(--pd-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pd-page .card {
            border: none;
            border-left: 4px solid var(--pd-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pd-page .card.card-final {
            border-left-color: var(--pd-accent);
        }

        .pd-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pd-border);
            padding: 1rem 1.5rem;
        }

        .pd-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pd-text);
            display: flex;
            align-items: center;
        }

        .pd-page .card-header h4 i {
            color: var(--pd-primary);
        }

        .pd-page .card-body {
            padding: 1.5rem;
        }

        .pd-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pd-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pd-page .info-box {
            height: 100%;
            background: var(--pd-soft);
            border: 1px solid var(--pd-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pd-page .info-label {
            color: var(--pd-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pd-page .info-value {
            color: var(--pd-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pd-page .batch-highlight {
            background: linear-gradient(135deg, var(--pd-primary), #28665A);
            color: #fff;
            border-radius: 9px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .pd-page .batch-highlight .batch-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.75;
            font-weight: 600;
        }

        .pd-page .batch-highlight .batch-number {
            font-size: 1.45rem;
            font-weight: 700;
            margin-top: 0.2rem;
        }

        .pd-page .batch-highlight .batch-product {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.15rem;
        }

        .pd-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pd-page .table {
            margin-bottom: 0;
            min-width: 1000px;
        }

        .pd-page .table thead th {
            background: var(--pd-primary-light);
            color: var(--pd-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 0.8rem 0.9rem;
        }

        .pd-page .table td {
            vertical-align: middle;
            font-size: 0.85rem;
            color: var(--pd-text);
            padding: 0.8rem 0.9rem;
        }

        .pd-page .table-bordered td,
        .pd-page .table-bordered th {
            border-color: var(--pd-border);
        }

        .pd-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pd-page .badge-soft {
            display: inline-block;
            background: var(--pd-primary-light);
            color: var(--pd-primary);
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pd-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: 0.3rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pd-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .pd-page .section-title {
            color: var(--pd-primary);
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 1rem;
        }

        .pd-page .total-card {
            background: var(--pd-primary-light);
            border: 1px solid var(--pd-border);
            border-radius: 9px;
            padding: 1.1rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .pd-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: var(--pd-primary);
            font-size: 1.05rem;
            margin-right: 0.85rem;
            flex-shrink: 0;
        }

        .pd-page .stat-label {
            color: var(--pd-muted);
            font-size: 0.73rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .pd-page .stat-value {
            color: var(--pd-text);
            font-size: 1rem;
            font-weight: 700;
            margin-top: 0.15rem;
        }

        .pd-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--pd-muted);
        }

        .pd-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: 0.6rem;
            opacity: 0.55;
        }

        .pd-page .btn-ghost {
            color: var(--pd-muted);
            background: transparent;
            border: 1px solid var(--pd-border);
        }

        .pd-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pd-text);
        }

        @media (max-width: 767.98px) {
            .pd-page .card-body {
                padding: 1rem;
            }

            .pd-page .card-header {
                padding: 0.9rem 1rem;
            }

            .pd-page .batch-highlight {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="pd-page">

        <div class="section-header">
            <h1>Packing Dalam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('manager.packing-dalam.index') }}">
                        Packing Dalam
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Detail
                </div>
            </div>
        </div>

        <p class="section-lead">
            Detail data proses packing dalam berdasarkan production batch.
        </p>

        <div class="section-body">

            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <span class="step-badge">1</span>
                        Informasi Produksi
                    </h4>
                </div>

                <div class="card-body">

                    <div class="batch-highlight">

                        <div class="row align-items-center">

                            <div class="col-md-8">

                                <div class="batch-label">
                                    Kode Product
                                </div>

                                <div class="batch-number">
                                    {{ $packingDalam->productionBatch->product->kode_product ?? '-' }}
                                </div>

                                <div class="batch-product">
                                    {{ $packingDalam->productionBatch->product->nama ?? '-' }}
                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">
                                    Tanggal Produksi
                                </div>

                                <div class="batch-number" style="font-size: 1.1rem;">
                                    {{ optional($packingDalam->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($packingDalam->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Tanggal Produksi</div>
                                <div class="info-value">
                                    {{ optional($packingDalam->productionBatch)->tanggal_produksi
                                        ? \Carbon\Carbon::parse($packingDalam->productionBatch->tanggal_produksi)->format('d M Y')
                                        : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">No Batch</div>
                                <div class="info-value">
                                    {{ $packingDalam->productionBatch->no_batch ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Product</div>
                                <div class="info-value">
                                    {{ $packingDalam->productionBatch->product->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="info-box">
                                <div class="info-label">Product Group</div>
                                <div class="info-value">
                                    {{ $packingDalam->productionBatch->product->productGroup->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">Line</div>
                                <div class="info-value">
                                    {{ $packingDalam->productionBatch->line ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">Waktu Awal</div>
                                <div class="info-value">
                                    {{ $packingDalam->waktu_awal ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-label">Waktu Akhir</div>
                                <div class="info-value">
                                    {{ $packingDalam->waktu_akhir ?? '-' }}
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
                        Detail Proses Packing Dalam
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">MHW Korin</div>
                                <div class="info-value">
                                    {{ $packingDalam->mhw_korin ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Heating Level</div>
                                <div class="info-value">
                                    {{ $packingDalam->heating_level !== null ? $packingDalam->heating_level : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Speed</div>
                                <div class="info-value">
                                    {{ $packingDalam->speed !== null ? $packingDalam->speed : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Pressure</div>
                                <div class="info-value">
                                    {{ $packingDalam->pressure !== null ? $packingDalam->pressure : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Packing Manual</div>
                                <div class="info-value">
                                    {{ $packingDalam->packing_manual ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Timbangan</div>
                                <div class="info-value">
                                    {{ $packingDalam->timbangan ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Heating Level Packing Manual</div>
                                <div class="info-value">
                                    {{ $packingDalam->heating_level_packing_manual !== null ? $packingDalam->heating_level_packing_manual : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Fe Sus Non Fe</div>
                                <div class="info-value">
                                    {{ $packingDalam->fe_sus_non_fe ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Setting X</div>
                                <div class="info-value">
                                    {{ $packingDalam->setting_x !== null ? $packingDalam->setting_x : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Setting Y</div>
                                <div class="info-value">
                                    {{ $packingDalam->setting_y !== null ? $packingDalam->setting_y : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Checkweigher PAC</div>
                                <div class="info-value">
                                    {{ $packingDalam->checkweigher_pac ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Petugas Sortasi After IQF</div>
                                <div class="info-value">
                                    {{ $packingDalam->petugas_sortasi_after_iqf ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-box">
                                <div class="info-label">Operator MD</div>
                                <div class="info-value">
                                    {{ $packingDalam->operator_md ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-label">Leader Produksi</div>
                                <div class="info-value">
                                    {{ $packingDalam->leader_produksi ?? '-' }}
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
                        Detail Sampling
                    </h4>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Berat Kemasan</th>
                                    <th>Berat Per Bag</th>
                                    <th>Range Berat</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($packingDalam->samplings as $sampling)
                                    <tr>

                                        <td class="text-center">
                                            {{ $sampling->sampling_ke }}
                                        </td>

                                        <td>
                                            @if ($sampling->berat_kemasan !== null)
                                                {{ number_format((float) $sampling->berat_kemasan, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($sampling->berat_per_bag !== null)
                                                {{ number_format((float) $sampling->berat_per_bag, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($sampling->range_berat)
                                                <span class="badge-value">
                                                    {{ $sampling->range_berat }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4">

                                            <div class="empty-state">

                                                <i class="fas fa-weight-hanging d-block"></i>

                                                <div>
                                                    Belum ada data sampling.
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <span class="step-badge">4</span>
                        Detail Plastik
                    </h4>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kode Product</th>
                                    <th>Product</th>
                                    <th class="text-right">Jumlah</th>
                                    <th class="text-right">Pemakaian</th>
                                    <th class="text-right">Sisa</th>
                                    <th class="text-right">Rijek (%)</th>
                                    <th>Operator MHW</th>
                                    <th>Checker DS</th>
                                    <th>Leader</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($packingDalam->plastiks as $index => $plastik)
                                    <tr>

                                        <td class="text-center">
                                            {{ $index + 1 }}
                                        </td>

                                        <td>
                                            @if ($plastik->product)
                                                <span class="badge-soft">
                                                    {{ $plastik->product->kode_product }}
                                                </span>
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $plastik->product->nama ?? '-' }}
                                        </td>

                                        <td class="text-right">
                                            @if ($plastik->jumlah !== null)
                                                {{ number_format((float) $plastik->jumlah, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td class="text-right">
                                            @if ($plastik->pemakaian !== null)
                                                {{ number_format((float) $plastik->pemakaian, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td class="text-right">
                                            @if ($plastik->sisa !== null)
                                                {{ number_format((float) $plastik->sisa, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td class="text-right">
                                            @if ($plastik->rijek !== null)
                                                {{ number_format((float) $plastik->rijek, 2, ',', '.') }}
                                            @else
                                                <span class="value-empty">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $plastik->operator_mhw ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $plastik->checker_ds ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $plastik->leader ?? '-' }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="10">

                                            <div class="empty-state">

                                                <i class="fas fa-box-open d-block"></i>

                                                <div>
                                                    Belum ada data plastik.
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card mb-4">

                <div class="card-header">
                    <h4>
                        <span class="step-badge">5</span>
                        Keterangan Produksi
                    </h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">PIC Produksi</div>
                                <div class="info-value">
                                    {{ $packingDalam->pic_produksi ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="info-box">
                                <div class="info-label">Waktu Awal</div>
                                <div class="info-value">
                                    {{ $packingDalam->waktu_awal ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="info-label">Waktu Akhir</div>
                                <div class="info-value">
                                    {{ $packingDalam->waktu_akhir ?? '-' }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card card-final mb-4">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8 mb-3 mb-md-0">

                            <div class="total-card">

                                <div class="stat-icon">
                                    <i class="fas fa-box"></i>
                                </div>

                                <div>

                                    <div class="stat-label">
                                        Proses Produksi
                                    </div>

                                    <div class="stat-value">
                                        Packing Dalam
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="d-flex justify-content-md-end">

                                <a href="{{ route('manager.packing-dalam.index') }}" class="btn btn-ghost">
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
