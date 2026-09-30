@extends('layouts.master')

@section('title', 'Packing Luar')

@push('addon-style')
    <style>
        :root {
            --plr-primary: #1B4B43;
            --plr-primary-light: #E8F0EE;
            --plr-accent: #D98C3D;
            --plr-border: #E3E7E1;
            --plr-text: #1F2A24;
            --plr-muted: #5B6A62;
        }

        .pl-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--plr-text);
        }

        .pl-page .section-lead {
            color: var(--plr-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pl-page .card {
            border: none;
            border-left: 4px solid var(--plr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pl-page .card.card-final {
            border-left-color: var(--plr-accent);
        }

        .pl-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--plr-border);
            padding: 1rem 1.5rem;
        }

        .pl-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--plr-text);
            display: flex;
            align-items: center;
        }

        .pl-page .card-header h4 i {
            color: var(--plr-primary);
        }

        .pl-page .card-body {
            padding: 1.5rem;
        }

        .pl-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--plr-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pl-page label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--plr-muted);
            margin-bottom: 0.35rem;
        }

        .pl-page .form-control {
            border-radius: 6px;
            border-color: var(--plr-border);
            font-size: 0.9rem;
        }

        .pl-page .form-control:focus {
            border-color: var(--plr-primary);
            box-shadow: 0 0 0 3px rgba(27, 75, 67, 0.12);
        }

        .pl-page .form-control[readonly] {
            background: #F3F5F3;
            color: var(--plr-muted);
        }

        .pl-page .table thead th {
            background: var(--plr-primary-light);
            color: var(--plr-primary);
            font-weight: 600;
            font-size: 0.78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
        }

        .pl-page .table td {
            vertical-align: middle;
        }

        .pl-page .table-bordered td,
        .pl-page .table-bordered th {
            border-color: var(--plr-border);
        }

        .pl-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .pl-page .btn-primary {
            background: var(--plr-primary);
            border-color: var(--plr-primary);
        }

        .pl-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pl-page .btn-outline-accent {
            border: 1px solid var(--plr-accent);
            color: var(--plr-accent);
            background: transparent;
        }

        .pl-page .btn-outline-accent:hover {
            background: var(--plr-accent);
            color: #fff;
        }

        .pl-page .btn-ghost {
            color: var(--plr-muted);
            background: transparent;
            border: 1px solid var(--plr-border);
        }

        .pl-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--plr-text);
        }

        /* Wide data-entry table — used by Pengemasan Box and Palet —
               scrolls horizontally instead of squeezing columns. */
        .pl-page .table-wide-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pl-page .table-wide {
            min-width: 1400px;
        }

        .pl-page .table-wide th,
        .pl-page .table-wide td {
            padding: 0.85rem 1rem;
        }

        .pl-page .table-wide td input[type="number"].form-control {
            min-width: 130px;
            text-align: right;
        }

        .pl-page .table-wide td input[type="text"].form-control {
            min-width: 150px;
        }

        .pl-page .table-wide td select.form-control,
        .pl-page .table-wide td .select2-container {
            min-width: 220px;
        }

        /* Remove native spinner arrows on number inputs inside tables —
               with right-aligned text they overlap the last digit and hide it
               (e.g. "9600" reads as "960"). */
        .pl-page .table input[type="number"]::-webkit-outer-spin-button,
        .pl-page .table input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .pl-page .table input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>
@endpush

@section('content')

    <div class="pl-page">

        <div class="section-header">
            <h1>Packing Luar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('operator.packing-luar.index') }}">Packing Luar</a>
                </div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <p class="section-lead">Catat detail proses packing luar untuk batch produksi yang dipilih, mulai dari informasi
            produksi sampai data palet.</p>

        <div class="section-body">

            <form action="{{ route('operator.packing-luar.store') }}" method="POST">
                @csrf

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">1</span>
                            Informasi Produksi
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Produksi</label>
                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi', date('Y-m-d')) }}">

                                    @error('tanggal_produksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Production Batch</label>
                                    <select name="production_batch_id" id="production_batch_id"
                                        class="form-control @error('production_batch_id') is-invalid @enderror">
                                        <option value="">-- Pilih Production Batch --</option>

                                        @foreach ($productionBatches as $batch)
                                            <option value="{{ $batch->id }}"
                                                {{ old('production_batch_id') == $batch->id ? 'selected' : '' }}>
                                                {{ $batch->no_batch }}
                                                -
                                                {{ $batch->product->nama ?? '-' }}
                                                -
                                                {{ $batch->line ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('production_batch_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Batch</label>
                                    <input type="text" id="no_batch" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Product</label>
                                    <input type="text" id="product" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Line</label>
                                    <input type="text" id="line" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Waktu Kerja</label>
                                    <input type="text" id="waktu_kerja" class="form-control" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Awal</label>
                                    <input type="time" name="waktu_awal"
                                        class="form-control @error('waktu_awal') is-invalid @enderror"
                                        value="{{ old('waktu_awal') }}">

                                    @error('waktu_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Akhir</label>
                                    <input type="time" name="waktu_akhir"
                                        class="form-control @error('waktu_akhir') is-invalid @enderror"
                                        value="{{ old('waktu_akhir') }}">

                                    @error('waktu_akhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">2</span>
                            Parameter Packing Luar
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pengisian ke Dalam Box</label>
                                    <input type="text" name="pengisian_ke_dalam_box"
                                        class="form-control @error('pengisian_ke_dalam_box') is-invalid @enderror"
                                        value="{{ old('pengisian_ke_dalam_box') }}">

                                    @error('pengisian_ke_dalam_box')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sealer Box</label>
                                    <input type="text" name="sealer_box"
                                        class="form-control @error('sealer_box') is-invalid @enderror"
                                        value="{{ old('sealer_box') }}">

                                    @error('sealer_box')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Check Weigher Box</label>
                                    <input type="text" name="check_weigher_box"
                                        class="form-control @error('check_weigher_box') is-invalid @enderror"
                                        value="{{ old('check_weigher_box') }}">

                                    @error('check_weigher_box')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Petugas</label>
                                    <input type="text" name="petugas"
                                        class="form-control @error('petugas') is-invalid @enderror"
                                        value="{{ old('petugas') }}">

                                    @error('petugas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PIC Produksi</label>
                                    <input type="text" name="pic_produksi"
                                        class="form-control @error('pic_produksi') is-invalid @enderror"
                                        value="{{ old('pic_produksi') }}">

                                    @error('pic_produksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">3</span>
                            Sampling
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Sampling Ke</th>
                                        <th>Berat Per Box</th>
                                        <th>Range Berat</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @for ($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td class="text-center align-middle">
                                                {{ $i + 1 }}
                                            </td>

                                            <td>
                                                <input type="number" name="sampling[{{ $i }}][sampling_ke]"
                                                    class="form-control"
                                                    value="{{ old("sampling.$i.sampling_ke", $i + 1) }}" readonly>
                                            </td>

                                            <td>
                                                <input type="number" name="sampling[{{ $i }}][berat_per_box]"
                                                    class="form-control" step="0.01" min="0"
                                                    value="{{ old("sampling.$i.berat_per_box") }}">
                                            </td>

                                            <td>
                                                <input type="text" name="sampling[{{ $i }}][range_berat]"
                                                    class="form-control" value="{{ old("sampling.$i.range_berat") }}">
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>
                            <span class="step-badge">4</span>
                            Pengemasan Box
                        </h4>

                        <button type="button" class="btn btn-outline-accent btn-sm" id="btnTambahKemasan">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah
                        </button>
                    </div>

                    <div class="card-body">

                        <div class="table-wide-wrap">
                            <table class="table table-bordered table-wide" id="tableKemasan">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Jumlah</th>
                                        <th>Pemakaian</th>
                                        <th>Sisa</th>
                                        <th>Rijek</th>
                                        <th>Petugas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $oldKemasans = old('kemasan', []);
                                    @endphp

                                    @if (count($oldKemasans) > 0)

                                        @foreach ($oldKemasans as $index => $kemasan)
                                            <tr>
                                                <td class="text-center align-middle nomor-kemasan">
                                                    {{ $index + 1 }}
                                                </td>

                                                <td>
                                                    <select name="kemasan[{{ $index }}][product_id]"
                                                        class="form-control select2-kemasan">
                                                        <option value="">-- Pilih Product --</option>

                                                        @foreach ($productsKemasan as $product)
                                                            <option value="{{ $product->id }}"
                                                                {{ ($kemasan['product_id'] ?? '') == $product->id ? 'selected' : '' }}>
                                                                {{ $product->kode_product ?? '-' }}
                                                                -
                                                                {{ $product->nama ?? '-' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="number" name="kemasan[{{ $index }}][jumlah]"
                                                        class="form-control" step="0.01" min="0"
                                                        value="{{ $kemasan['jumlah'] ?? '' }}">
                                                </td>

                                                <td>
                                                    <input type="number" name="kemasan[{{ $index }}][pemakaian]"
                                                        class="form-control" step="0.01" min="0"
                                                        value="{{ $kemasan['pemakaian'] ?? '' }}">
                                                </td>

                                                <td>
                                                    <input type="number" name="kemasan[{{ $index }}][sisa]"
                                                        class="form-control" step="0.01" min="0"
                                                        value="{{ $kemasan['sisa'] ?? '' }}">
                                                </td>

                                                <td>
                                                    <input type="number" name="kemasan[{{ $index }}][rijek]"
                                                        class="form-control" step="0.01" min="0"
                                                        value="{{ $kemasan['rijek'] ?? '' }}">
                                                </td>

                                                <td>
                                                    <input type="text" name="kemasan[{{ $index }}][petugas]"
                                                        class="form-control" value="{{ $kemasan['petugas'] ?? '' }}">
                                                </td>

                                                <td class="text-center align-middle">
                                                    <button type="button" class="btn btn-danger btn-sm btnHapusKemasan">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center align-middle nomor-kemasan">
                                                1
                                            </td>

                                            <td>
                                                <select name="kemasan[0][product_id]"
                                                    class="form-control select2-kemasan">
                                                    <option value="">-- Pilih Product --</option>

                                                    @foreach ($productsKemasan as $product)
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->kode_product ?? '-' }}
                                                            -
                                                            {{ $product->nama ?? '-' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <input type="number" name="kemasan[0][jumlah]" class="form-control"
                                                    step="0.01" min="0">
                                            </td>

                                            <td>
                                                <input type="number" name="kemasan[0][pemakaian]" class="form-control"
                                                    step="0.01" min="0">
                                            </td>

                                            <td>
                                                <input type="number" name="kemasan[0][sisa]" class="form-control"
                                                    step="0.01" min="0">
                                            </td>

                                            <td>
                                                <input type="number" name="kemasan[0][rijek]" class="form-control"
                                                    step="0.01" min="0">
                                            </td>

                                            <td>
                                                <input type="text" name="kemasan[0][petugas]" class="form-control">
                                            </td>

                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-danger btn-sm btnHapusKemasan">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">5</span>
                            Palet
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label>Product</label>

                            <select name="palet[0][product_id]" id="palet_product_id"
                                class="form-control @error('palet.0.product_id') is-invalid @enderror">
                                <option value="">-- Pilih Product --</option>

                                @foreach ($productsPalet as $product)
                                    <option value="{{ $product->id }}"
                                        data-pack-per-box="{{ $product->pack_per_box ?? 0 }}"
                                        {{ old('palet.0.product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->kode_product ?? '-' }}
                                        -
                                        {{ $product->nama ?? '-' }}
                                    </option>
                                @endforeach
                            </select>

                            @error('palet.0.product_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="table-wide-wrap">
                            <table class="table table-bordered table-wide">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>No BSTB</th>
                                        <th>Jumlah Box</th>
                                        <th>Jumlah Pack</th>
                                        <th>Jumlah Kg</th>
                                        <th>WIP Keluar Bag</th>
                                        <th>WIP Keluar Kg</th>
                                        <th>WIP Keluar Lot</th>
                                        <th>WIP Masuk</th>
                                        <th>Checker FG</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>

                                        <td class="text-center align-middle">
                                            1
                                        </td>

                                        <td>
                                            <input type="text" name="palet[0][no_bstb]"
                                                class="form-control @error('palet.0.no_bstb') is-invalid @enderror"
                                                value="{{ old('palet.0.no_bstb') }}">

                                            @error('palet.0.no_bstb')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" name="palet[0][jumlah_box]" id="palet_jumlah_box"
                                                class="form-control @error('palet.0.jumlah_box') is-invalid @enderror"
                                                step="0.01" min="0" value="{{ old('palet.0.jumlah_box') }}">

                                            @error('palet.0.jumlah_box')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" name="palet[0][jumlah_pack]" id="palet_jumlah_pack"
                                                class="form-control @error('palet.0.jumlah_pack') is-invalid @enderror"
                                                step="1" min="0" value="{{ old('palet.0.jumlah_pack') }}"
                                                readonly>

                                            @error('palet.0.jumlah_pack')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" name="palet[0][jumlah_kg]"
                                                class="form-control @error('palet.0.jumlah_kg') is-invalid @enderror"
                                                step="0.01" min="0" value="{{ old('palet.0.jumlah_kg') }}">

                                            @error('palet.0.jumlah_kg')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" name="palet[0][jumlah_wip_keluar_bag]"
                                                class="form-control @error('palet.0.jumlah_wip_keluar_bag') is-invalid @enderror"
                                                step="0.01" min="0"
                                                value="{{ old('palet.0.jumlah_wip_keluar_bag') }}">

                                            @error('palet.0.jumlah_wip_keluar_bag')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" name="palet[0][jumlah_wip_keluar_kg]"
                                                class="form-control @error('palet.0.jumlah_wip_keluar_kg') is-invalid @enderror"
                                                step="0.01" min="0"
                                                value="{{ old('palet.0.jumlah_wip_keluar_kg') }}">

                                            @error('palet.0.jumlah_wip_keluar_kg')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" name="palet[0][jumlah_wip_keluar_lot]"
                                                class="form-control @error('palet.0.jumlah_wip_keluar_lot') is-invalid @enderror"
                                                step="0.01" min="0"
                                                value="{{ old('palet.0.jumlah_wip_keluar_lot') }}">

                                            @error('palet.0.jumlah_wip_keluar_lot')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="number" name="palet[0][jumlah_wip_masuk]"
                                                class="form-control @error('palet.0.jumlah_wip_masuk') is-invalid @enderror"
                                                step="0.01" min="0"
                                                value="{{ old('palet.0.jumlah_wip_masuk') }}">

                                            @error('palet.0.jumlah_wip_masuk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="palet[0][checker_fg]"
                                                class="form-control @error('palet.0.checker_fg') is-invalid @enderror"
                                                value="{{ old('palet.0.checker_fg') }}">

                                            @error('palet.0.checker_fg')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="card card-final">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('operator.packing-luar.index') }}" class="btn btn-ghost mr-2">
                                <i class="fas fa-times mr-1"></i>
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#production_batch_id').select2({
                width: '100%',
                placeholder: '-- Pilih Production Batch --',
                allowClear: true
            });

            $('#palet_product_id').select2({
                width: '100%',
                placeholder: '-- Pilih Product --',
                allowClear: true
            });

            function loadProductionBatches(date, selectedId = null) {

                $('#production_batch_id').empty();

                $('#production_batch_id').append(
                    '<option value="">-- Pilih Production Batch --</option>'
                );

                $('#no_batch').val('');
                $('#product').val('');
                $('#line').val('');
                $('#waktu_kerja').val('');

                if (!date) {
                    $('#production_batch_id').trigger('change');
                    return;
                }

                $.ajax({
                    url: "{{ url('production-batch/by-date') }}/" + date,
                    type: 'GET',
                    dataType: 'json',

                    success: function(data) {

                        if (data.length === 0) {

                            $('#production_batch_id').append(
                                '<option value="">Tidak ada Production Batch</option>'
                            );

                        } else {

                            $.each(data, function(index, batch) {

                                let selected = '';

                                if (
                                    selectedId !== null &&
                                    String(selectedId) === String(batch.id)
                                ) {
                                    selected = 'selected';
                                }

                                $('#production_batch_id').append(
                                    '<option value="' + batch.id + '" ' + selected + '>' +
                                    batch.no_batch + ' - ' +
                                    batch.product + ' - ' +
                                    batch.line +
                                    '</option>'
                                );

                            });

                        }

                        $('#production_batch_id').trigger('change');

                    },

                    error: function() {

                        $('#production_batch_id').append(
                            '<option value="">Gagal mengambil Production Batch</option>'
                        );

                        $('#production_batch_id').trigger('change');

                    }
                });
            }

            $('#tanggal_produksi').on('change', function() {

                loadProductionBatches(
                    $(this).val()
                );

            });

            $('#production_batch_id').on('change', function() {

                let selectedId = $(this).val();

                if (!selectedId) {

                    $('#no_batch').val('');
                    $('#product').val('');
                    $('#line').val('');
                    $('#waktu_kerja').val('');

                    return;
                }

                let selectedText = $(this)
                    .find('option:selected')
                    .text();

                let parts = selectedText.split(' - ');

                $('#no_batch').val(parts[0] ?? '');
                $('#product').val(parts[1] ?? '');
                $('#line').val(parts[2] ?? '');

                let date = $('#tanggal_produksi').val();

                if (!date) {
                    return;
                }

                $.ajax({
                    url: "{{ url('production-batch/by-date') }}/" + date,
                    type: 'GET',
                    dataType: 'json',

                    success: function(data) {

                        let batch = data.find(function(item) {

                            return String(item.id) === String(selectedId);

                        });

                        if (batch) {

                            $('#no_batch').val(
                                batch.no_batch ?? ''
                            );

                            $('#product').val(
                                batch.product ?? ''
                            );

                            $('#line').val(
                                batch.line ?? ''
                            );

                            $('#waktu_kerja').val(
                                batch.waktu_kerja !== null ?
                                batch.waktu_kerja :
                                ''
                            );

                        }

                    }
                });

            });

            let oldBatchId = "{{ old('production_batch_id') }}";

            let currentDate = $('#tanggal_produksi').val();

            if (currentDate) {

                loadProductionBatches(
                    currentDate,
                    oldBatchId ? oldBatchId : null
                );

            }

            let kemasanIndex = {{ count(old('kemasan', [])) > 0 ? count(old('kemasan', [])) : 1 }};

            function initKemasanSelect2() {

                $('.select2-kemasan').each(function() {

                    if ($(this).hasClass('select2-hidden-accessible')) {
                        return;
                    }

                    $(this).select2({
                        width: '100%',
                        placeholder: '-- Pilih Product --',
                        allowClear: true
                    });

                });

            }

            initKemasanSelect2();

            $('#btnTambahKemasan').on('click', function() {

                let row = `
                    <tr>
                        <td class="text-center align-middle nomor-kemasan">
                            ${kemasanIndex + 1}
                        </td>

                        <td>
                            <select
                                name="kemasan[${kemasanIndex}][product_id]"
                                class="form-control select2-kemasan"
                            >
                                <option value="">-- Pilih Product --</option>

                                @foreach ($productsKemasan as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->kode_product ?? '-' }}
                                        -
                                        {{ $product->nama ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input
                                type="number"
                                name="kemasan[${kemasanIndex}][jumlah]"
                                class="form-control"
                                step="0.01"
                                min="0"
                            >
                        </td>

                        <td>
                            <input
                                type="number"
                                name="kemasan[${kemasanIndex}][pemakaian]"
                                class="form-control"
                                step="0.01"
                                min="0"
                            >
                        </td>

                        <td>
                            <input
                                type="number"
                                name="kemasan[${kemasanIndex}][sisa]"
                                class="form-control"
                                step="0.01"
                                min="0"
                            >
                        </td>

                        <td>
                            <input
                                type="number"
                                name="kemasan[${kemasanIndex}][rijek]"
                                class="form-control"
                                step="0.01"
                                min="0"
                            >
                        </td>

                        <td>
                            <input
                                type="text"
                                name="kemasan[${kemasanIndex}][petugas]"
                                class="form-control"
                            >
                        </td>

                        <td class="text-center align-middle">
                            <button
                                type="button"
                                class="btn btn-danger btn-sm btnHapusKemasan"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;

                $('#tableKemasan tbody').append(row);

                initKemasanSelect2();

                kemasanIndex++;

            });

            $(document).on('click', '.btnHapusKemasan', function() {

                let totalRow = $('#tableKemasan tbody tr').length;

                if (totalRow <= 1) {
                    return;
                }

                $(this).closest('tr').remove();

                $('#tableKemasan tbody tr').each(function(index) {

                    $(this)
                        .find('.nomor-kemasan')
                        .text(index + 1);

                });

            });

            function hitungJumlahPack() {

                let packPerBox = parseInt(
                    $('#palet_product_id option:selected')
                    .attr('data-pack-per-box')
                ) || 0;

                let jumlahBox = parseFloat(
                    $('#palet_jumlah_box').val()
                ) || 0;

                let jumlahPack = jumlahBox * packPerBox;

                $('#palet_jumlah_pack').val(
                    jumlahPack
                );
            }

            $('#palet_product_id').on('change', function() {

                hitungJumlahPack();

            });

            $('#palet_jumlah_box').on('input', function() {

                hitungJumlahPack();

            });

            hitungJumlahPack();

        });
    </script>
@endpush
