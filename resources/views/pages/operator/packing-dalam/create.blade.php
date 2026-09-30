@extends('layouts.master')

@section('title', 'Tambah Packing Dalam')

@push('addon-style')
    <style>
        :root {
            --pdk-primary: #1B4B43;
            --pdk-primary-light: #E8F0EE;
            --pdk-accent: #D98C3D;
            --pdk-border: #E3E7E1;
            --pdk-text: #1F2A24;
            --pdk-muted: #5B6A62;
        }

        .pdk-page .section-header h1 {
            font-weight: 700;
            color: var(--pdk-text);
        }

        .pdk-page .section-lead {
            color: var(--pdk-muted);
            font-size: .925rem;
            margin: .25rem 0 1.5rem;
        }

        .pdk-page .card {
            border: none;
            border-left: 4px solid var(--pdk-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06);
            overflow: hidden;
        }

        .pdk-page .card-final {
            border-left-color: var(--pdk-accent);
        }

        .pdk-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pdk-border);
            padding: 1rem 1.5rem;
        }

        .pdk-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pdk-text);
            display: flex;
            align-items: center;
        }

        .pdk-page .card-body {
            padding: 1.5rem;
        }

        .pdk-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pdk-primary);
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            margin-right: .75rem;
        }

        .pdk-page label {
            font-size: .8rem;
            font-weight: 600;
            color: var(--pdk-muted);
            margin-bottom: .35rem;
        }

        .pdk-page .form-control {
            border-radius: 6px;
            border-color: var(--pdk-border);
            font-size: .9rem;
        }

        .pdk-page .form-control:focus {
            border-color: var(--pdk-primary);
            box-shadow: 0 0 0 3px rgba(27, 75, 67, .12);
        }

        .pdk-page .form-control[readonly] {
            background: #F3F5F3;
            color: var(--pdk-muted);
        }

        .pdk-page .select2-container {
            width: 100% !important;
        }

        .pdk-page .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid var(--pdk-border);
            border-radius: 6px;
        }

        .pdk-page .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            font-size: .9rem;
            color: #495057;
            padding-left: 12px;
        }

        .pdk-page .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .pdk-page .table thead th {
            background: var(--pdk-primary-light);
            color: var(--pdk-primary);
            font-weight: 600;
            font-size: .78rem;
            white-space: nowrap;
            vertical-align: middle;
        }

        .pdk-page .table td {
            vertical-align: middle;
        }

        .pdk-page .table-bordered td,
        .pdk-page .table-bordered th {
            border-color: var(--pdk-border);
        }

        .pdk-page .table-wide-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .pdk-page .table-wide {
            min-width: 1600px;
        }

        .pdk-page .table-wide th,
        .pdk-page .table-wide td {
            padding: .85rem 1rem;
        }

        .pdk-page .table-wide td input[type="number"] {
            min-width: 130px;
            text-align: right;
        }

        .pdk-page .table-wide td input[type="text"] {
            min-width: 160px;
        }

        .pdk-page .table-wide td .select2-container {
            min-width: 280px;
        }

        .pdk-page .sampling-table {
            min-width: 900px;
        }

        .pdk-page .sampling-table input {
            min-width: 180px;
        }

        .pdk-page .number-cell {
            width: 65px;
            min-width: 65px;
            text-align: center;
            font-weight: 600;
            color: var(--pdk-muted);
        }

        .pdk-page .sampling-no {
            width: 100px;
            min-width: 100px;
            text-align: center;
        }

        .pdk-page .remove-cell {
            width: 80px;
            min-width: 80px;
            text-align: center;
        }

        .pdk-page .batch-summary {
            padding: .75rem 1rem;
            border-radius: 7px;
            background: var(--pdk-primary-light);
            color: var(--pdk-primary);
            font-size: .8rem;
        }

        .pdk-page .batch-summary i {
            margin-right: .35rem;
        }

        .pdk-page .readonly-highlight {
            background: #F3F5F3;
            color: var(--pdk-primary);
            font-weight: 600;
        }

        .pdk-page .section-info {
            padding: .75rem 1rem;
            border-radius: 7px;
            background: var(--pdk-primary-light);
            color: var(--pdk-primary);
            font-size: .8rem;
        }

        .pdk-page .section-info i {
            margin-right: .35rem;
        }

        .pdk-page .btn-primary {
            background: var(--pdk-primary);
            border-color: var(--pdk-primary);
        }

        .pdk-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .pdk-page .btn-outline-accent {
            border: 1px solid var(--pdk-accent);
            color: var(--pdk-accent);
            background: transparent;
        }

        .pdk-page .btn-outline-accent:hover {
            background: var(--pdk-accent);
            color: #fff;
        }

        .pdk-page .btn-ghost {
            color: var(--pdk-muted);
            background: transparent;
            border: 1px solid var(--pdk-border);
        }

        .pdk-page input[type="number"]::-webkit-outer-spin-button,
        .pdk-page input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .pdk-page input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>
@endpush

@section('content')
    <div class="pdk-page">
        <div class="section-header">
            <h1>Packing Dalam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.packing-dalam.index') }}">
                        Packing Dalam
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Create
                </div>
            </div>
        </div>

        <p class="section-lead">
            Pencatatan proses Packing Dalam berdasarkan Production Batch.
        </p>

        <div class="section-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Data belum dapat disimpan.</strong>

                    <ul class="mb-0 mt-2 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('operator.packing-dalam.store') }}" method="POST">
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

                                    <input type="date" id="tanggal_produksi" class="form-control"
                                        value="{{ old('tanggal_produksi') }}">

                                    <small class="form-text text-muted">
                                        Pilih tanggal terlebih dahulu.
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Production Batch</label>

                                    <select name="production_batch_id" id="production_batch_id"
                                        class="form-control @error('production_batch_id') is-invalid @enderror">
                                        <option value="">
                                            -- Pilih Production Batch --
                                        </option>
                                    </select>

                                    @error('production_batch_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="batch-summary mb-4">
                            <i class="fas fa-info-circle"></i>
                            Production Batch, Product, Product Group, dan Line akan mengikuti batch yang dipilih.
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
                                    <label>Product Group</label>
                                    <input type="text" id="product_group" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Line</label>

                                    <input type="text" name="line" id="line"
                                        class="form-control readonly-highlight" value="{{ old('line') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label>Waktu Kerja Production Batch</label>

                            <input type="text" id="waktu_kerja" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">2</span>
                            Parameter Packing Dalam
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>MHW / Korin</label>

                                    <select name="mhw_korin" class="form-control @error('mhw_korin') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>

                                        <option value="MHW" {{ old('mhw_korin') == 'MHW' ? 'selected' : '' }}>
                                            MHW
                                        </option>

                                        <option value="Korin" {{ old('mhw_korin') == 'Korin' ? 'selected' : '' }}>
                                            Korin
                                        </option>
                                    </select>

                                    @error('mhw_korin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heating Level</label>

                                    <input type="number" name="heating_level" class="form-control" step="0.01"
                                        value="{{ old('heating_level') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Speed</label>

                                    <input type="number" name="speed" class="form-control" step="0.01"
                                        value="{{ old('speed') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pressure</label>

                                    <input type="text" name="pressure" class="form-control"
                                        value="{{ old('pressure') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Packing Manual</label>

                                    <input type="text" name="packing_manual" class="form-control"
                                        value="{{ old('packing_manual') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Timbangan</label>

                                    <input type="text" name="timbangan" class="form-control"
                                        value="{{ old('timbangan') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Heating Level Packing Manual</label>

                                    <input type="number" name="heating_level_packing_manual" class="form-control"
                                        step="0.01" value="{{ old('heating_level_packing_manual') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fe / Sus / Non Fe</label>

                                    <select name="fe_sus_non_fe"
                                        class="form-control @error('fe_sus_non_fe') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>

                                        <option value="OK" {{ old('fe_sus_non_fe') == 'OK' ? 'selected' : '' }}>
                                            OK
                                        </option>

                                        <option value="Tidak" {{ old('fe_sus_non_fe') == 'Tidak' ? 'selected' : '' }}>
                                            Tidak
                                        </option>
                                    </select>

                                    @error('fe_sus_non_fe')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Setting X</label>

                                    <input type="number" name="setting_x" class="form-control" step="0.01"
                                        value="{{ old('setting_x') }}">

                                    @error('setting_x')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Setting Y</label>

                                    <input type="number" name="setting_y" class="form-control" step="0.01"
                                        value="{{ old('setting_y') }}">

                                    @error('setting_y')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Checkweigher PAC</label>

                                    <input type="text" name="checkweigher_pac" class="form-control"
                                        value="{{ old('checkweigher_pac') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">3</span>
                            Personel & Waktu Produksi
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Petugas Sortasi After IQF</label>

                                    <input type="text" name="petugas_sortasi_after_iqf" class="form-control"
                                        value="{{ old('petugas_sortasi_after_iqf') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Operator MD</label>

                                    <input type="text" name="operator_md" class="form-control"
                                        value="{{ old('operator_md') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Leader Produksi</label>

                                    <input type="text" name="leader_produksi" class="form-control"
                                        value="{{ old('leader_produksi') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Waktu Awal</label>

                                    <input type="time" name="waktu_awal" class="form-control"
                                        value="{{ old('waktu_awal') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Waktu Akhir</label>

                                    <input type="time" name="waktu_akhir" class="form-control"
                                        value="{{ old('waktu_akhir') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PIC Produksi</label>

                                    <input type="text" name="pic_produksi" class="form-control"
                                        value="{{ old('pic_produksi') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">4</span>
                            Sampling
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="section-info mb-3">
                            <i class="fas fa-info-circle"></i>
                            Masukkan hasil sampling berat kemasan dan berat per bag.
                        </div>

                        <div class="table-wide-wrap">
                            <table class="table table-bordered sampling-table mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Sampling Ke</th>
                                        <th>Berat Kemasan</th>
                                        <th>Berat Per Bag</th>
                                        <th>Range Berat</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td class="number-cell">
                                                {{ $i }}
                                            </td>

                                            <td class="sampling-no">
                                                <span class="badge badge-light px-3 py-2">
                                                    Sampling {{ $i }}
                                                </span>
                                            </td>

                                            <td>
                                                <input type="number" name="sampling[{{ $i }}][berat_kemasan]"
                                                    class="form-control" step="0.01" min="0"
                                                    value="{{ old("sampling.$i.berat_kemasan") }}">
                                            </td>

                                            <td>
                                                <input type="number" name="sampling[{{ $i }}][berat_per_bag]"
                                                    class="form-control" step="0.01" min="0"
                                                    value="{{ old("sampling.$i.berat_per_bag") }}">
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
                            <span class="step-badge">5</span>
                            Penggunaan Plastik
                        </h4>

                        <button type="button" class="btn btn-outline-accent btn-sm" id="btnTambahPlastik">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah Plastik
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="section-info mb-3">
                            <i class="fas fa-info-circle"></i>
                            Pemakaian dihitung otomatis oleh controller saat data disimpan.
                        </div>

                        <div class="table-wide-wrap">
                            <table class="table table-bordered table-wide mb-0" id="tablePlastik">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Product Plastik</th>
                                        <th>Jumlah</th>
                                        <th>Pemakaian</th>
                                        <th>Sisa</th>
                                        <th>Rijek (%)</th>
                                        <th>Operator MHW</th>
                                        <th>Checker DS</th>
                                        <th>Leader</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="number-cell nomor-plastik">
                                            1
                                        </td>

                                        <td>
                                            <select name="plastik[0][product_id]" class="form-control select2-plastik">
                                                <option value="">
                                                    -- Pilih Product Plastik --
                                                </option>

                                                @foreach ($productsPlastik as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->kode_product ?? '-' }}
                                                        -
                                                        {{ $product->nama ?? '-' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="number" name="plastik[0][jumlah]" class="form-control"
                                                step="0.01" min="0">
                                        </td>

                                        <td>
                                            <input type="number" class="form-control readonly-highlight" step="0.01"
                                                readonly placeholder="Otomatis">
                                        </td>

                                        <td>
                                            <input type="number" name="plastik[0][sisa]" class="form-control"
                                                step="0.01" min="0">
                                        </td>

                                        <td>
                                            <input type="number" name="plastik[0][rijek]" class="form-control"
                                                step="0.01" min="0" max="100">
                                        </td>

                                        <td>
                                            <input type="text" name="plastik[0][operator_mhw]" class="form-control">
                                        </td>

                                        <td>
                                            <input type="text" name="plastik[0][checker_ds]" class="form-control">
                                        </td>

                                        <td>
                                            <input type="text" name="plastik[0][leader]" class="form-control">
                                        </td>

                                        <td class="remove-cell">
                                            <button type="button" class="btn btn-danger btn-sm btnHapusPlastik">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
                            <a href="{{ route('operator.packing-dalam.index') }}" class="btn btn-ghost mr-2">
                                <i class="fas fa-times mr-1"></i>
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>
                                Simpan Packing Dalam
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

            function resetBatchInfo() {
                $('#production_batch_id')
                    .empty()
                    .append('<option value="">-- Pilih Production Batch --</option>')
                    .val(null)
                    .trigger('change');

                $('#no_batch').val('');
                $('#product').val('');
                $('#product_group').val('');
                $('#line').val('');
                $('#waktu_kerja').val('');
            }

            function loadProductionBatches(date, selectedId = null) {
                resetBatchInfo();

                if (!date) {
                    return;
                }

                $.ajax({
                    url: "{{ url('production-batch/by-date') }}/" + date,
                    type: 'GET',
                    dataType: 'json',

                    success: function(data) {
                        if (data.length === 0) {
                            $('#production_batch_id').append(
                                '<option value="">Tidak ada Production Batch pada tanggal ini</option>'
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
                                    '<option value="' + batch.id + '" ' +
                                    'data-no-batch="' + (batch.no_batch ?? '') + '" ' +
                                    'data-product="' + (batch.product ?? '') + '" ' +
                                    'data-product-group="' + (batch.product_group ?? '') +
                                    '" ' +
                                    'data-line="' + (batch.line ?? '') + '" ' +
                                    'data-waktu-kerja="' + (batch.waktu_kerja ?? '') +
                                    '" ' +
                                    selected + '>' +
                                    (batch.no_batch ?? '-') +
                                    ' - ' +
                                    (batch.product ?? '-') +
                                    ' - ' +
                                    (batch.line ?? '-') +
                                    '</option>'
                                );
                            });
                        }

                        $('#production_batch_id').trigger('change');
                    },

                    error: function(xhr) {
                        $('#production_batch_id')
                            .empty()
                            .append(
                                '<option value="">Gagal mengambil Production Batch</option>'
                            )
                            .trigger('change');

                        console.log(xhr.responseText);
                    }
                });
            }

            $('#tanggal_produksi').on('change', function() {
                let date = $(this).val();

                if (!date) {
                    resetBatchInfo();
                    return;
                }

                loadProductionBatches(date);
            });

            $('#production_batch_id').on('change', function() {
                let option = $(this).find('option:selected');

                if (!option.val()) {
                    $('#no_batch').val('');
                    $('#product').val('');
                    $('#product_group').val('');
                    $('#line').val('');
                    $('#waktu_kerja').val('');
                    return;
                }

                $('#no_batch').val(option.attr('data-no-batch') || '');
                $('#product').val(option.attr('data-product') || '');
                $('#product_group').val(option.attr('data-product-group') || '');
                $('#line').val(option.attr('data-line') || '');
                $('#waktu_kerja').val(option.attr('data-waktu-kerja') || '');
            });

            let oldDate = @json(old('tanggal_produksi'));
            let oldBatchId = @json(old('production_batch_id'));

            if (oldDate) {
                $('#tanggal_produksi').val(oldDate);

                loadProductionBatches(
                    oldDate,
                    oldBatchId ? oldBatchId : null
                );
            }

            function initSelect2Plastik() {
                $('.select2-plastik').each(function() {
                    if ($(this).hasClass('select2-hidden-accessible')) {
                        return;
                    }

                    $(this).select2({
                        width: '100%',
                        placeholder: '-- Pilih Product Plastik --',
                        allowClear: true
                    });
                });
            }

            initSelect2Plastik();

            let plastikIndex = 1;

            $('#btnTambahPlastik').on('click', function() {
                let row = `
                <tr>
                    <td class="number-cell nomor-plastik">
                        ${plastikIndex + 1}
                    </td>

                    <td>
                        <select
                            name="plastik[${plastikIndex}][product_id]"
                            class="form-control select2-plastik"
                        >
                            <option value="">
                                -- Pilih Product Plastik --
                            </option>

                            @foreach ($productsPlastik as $product)
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
                            name="plastik[${plastikIndex}][jumlah]"
                            class="form-control"
                            step="0.01"
                            min="0"
                        >
                    </td>

                    <td>
                        <input
                            type="number"
                            class="form-control readonly-highlight"
                            step="0.01"
                            readonly
                            placeholder="Otomatis"
                        >
                    </td>

                    <td>
                        <input
                            type="number"
                            name="plastik[${plastikIndex}][sisa]"
                            class="form-control"
                            step="0.01"
                            min="0"
                        >
                    </td>

                    <td>
                        <input
                            type="number"
                            name="plastik[${plastikIndex}][rijek]"
                            class="form-control"
                            step="0.01"
                            min="0"
                            max="100"
                        >
                    </td>

                    <td>
                        <input
                            type="text"
                            name="plastik[${plastikIndex}][operator_mhw]"
                            class="form-control"
                        >
                    </td>

                    <td>
                        <input
                            type="text"
                            name="plastik[${plastikIndex}][checker_ds]"
                            class="form-control"
                        >
                    </td>

                    <td>
                        <input
                            type="text"
                            name="plastik[${plastikIndex}][leader]"
                            class="form-control"
                        >
                    </td>

                    <td class="remove-cell">
                        <button
                            type="button"
                            class="btn btn-danger btn-sm btnHapusPlastik"
                        >
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

                $('#tablePlastik tbody').append(row);

                initSelect2Plastik();

                plastikIndex++;
            });

            $(document).on('click', '.btnHapusPlastik', function() {
                let totalRow = $('#tablePlastik tbody tr').length;

                if (totalRow <= 1) {
                    return;
                }

                $(this).closest('tr').remove();

                $('#tablePlastik tbody tr').each(function(index) {
                    $(this)
                        .find('.nomor-plastik')
                        .text(index + 1);
                });
            });
        });
    </script>
@endpush
