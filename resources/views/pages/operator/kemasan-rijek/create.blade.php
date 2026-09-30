@extends('layouts.master')

@section('title', 'Tambah Kemasan Rijek')

@push('addon-style')
    <style>
        :root {
            --kr-primary: #1B4B43;
            --kr-primary-light: #E8F0EE;
            --kr-accent: #D98C3D;
            --kr-border: #E3E7E1;
            --kr-text: #1F2A24;
            --kr-muted: #5B6A62;
        }

        .kr-page .section-header h1 {
            font-weight: 700;
            color: var(--kr-text);
        }

        .kr-page .section-lead {
            color: var(--kr-muted);
            font-size: .925rem;
            margin: .25rem 0 1.5rem;
        }

        .kr-page .card {
            border: none;
            border-left: 4px solid var(--kr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06);
            overflow: hidden;
        }

        .kr-page .card-final {
            border-left-color: var(--kr-accent);
        }

        .kr-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--kr-border);
            padding: 1rem 1.5rem;
        }

        .kr-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--kr-text);
            display: flex;
            align-items: center;
        }

        .kr-page .card-header h4 i {
            color: var(--kr-primary);
        }

        .kr-page .card-body {
            padding: 1.5rem;
        }

        .kr-page .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--kr-primary);
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            margin-right: .75rem;
            flex-shrink: 0;
        }

        .kr-page label {
            font-size: .8rem;
            font-weight: 600;
            color: var(--kr-muted);
            margin-bottom: .35rem;
        }

        .kr-page .form-control {
            border-radius: 6px;
            border-color: var(--kr-border);
            font-size: .9rem;
        }

        .kr-page .form-control:focus {
            border-color: var(--kr-primary);
            box-shadow: 0 0 0 3px rgba(27, 75, 67, .12);
        }

        .kr-page .form-control[readonly] {
            background: #F3F5F3;
            color: var(--kr-muted);
        }

        .kr-page .select2-container {
            width: 100% !important;
        }

        .kr-page .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid var(--kr-border);
            border-radius: 6px;
        }

        .kr-page .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            font-size: .9rem;
            color: #495057;
            padding-left: 12px;
        }

        .kr-page .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .kr-page .batch-summary {
            padding: .75rem 1rem;
            border-radius: 7px;
            background: var(--kr-primary-light);
            color: var(--kr-primary);
            font-size: .8rem;
        }

        .kr-page .batch-summary i {
            margin-right: .35rem;
        }

        .kr-page .readonly-highlight {
            background: #F3F5F3;
            color: var(--kr-primary);
            font-weight: 600;
        }

        .kr-page .section-info {
            padding: .75rem 1rem;
            border-radius: 7px;
            background: var(--kr-primary-light);
            color: var(--kr-primary);
            font-size: .8rem;
        }

        .kr-page .table-wide-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .kr-page .rijek-table {
            min-width: 950px;
        }

        .kr-page .table thead th {
            background: var(--kr-primary-light);
            color: var(--kr-primary);
            font-weight: 600;
            font-size: .78rem;
            white-space: nowrap;
            vertical-align: middle;
        }

        .kr-page .table td {
            vertical-align: middle;
        }

        .kr-page .table-bordered td,
        .kr-page .table-bordered th {
            border-color: var(--kr-border);
        }

        .kr-page .table td input[type="number"] {
            min-width: 120px;
            text-align: right;
        }

        .kr-page .table td input[type="text"] {
            min-width: 180px;
        }

        .kr-page .total-box {
            background: #F3F5F3;
            border: 1px solid var(--kr-border);
            border-radius: 8px;
            padding: 1rem;
        }

        .kr-page .total-box label {
            margin-bottom: .5rem;
        }

        .kr-page .btn-primary {
            background: var(--kr-primary);
            border-color: var(--kr-primary);
        }

        .kr-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .kr-page .btn-ghost {
            color: var(--kr-muted);
            background: transparent;
            border: 1px solid var(--kr-border);
        }

        .kr-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--kr-text);
        }

        .kr-page input[type="number"]::-webkit-outer-spin-button,
        .kr-page input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .kr-page input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>
@endpush

@section('content')

    <div class="kr-page">

        <div class="section-header">
            <h1>Kemasan Rijek</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('operator.kemasan-rijek.index') }}">
                        Kemasan Rijek
                    </a>
                </div>

                <div class="breadcrumb-item">
                    Create
                </div>
            </div>
        </div>

        <p class="section-lead">
            Pencatatan hasil rijek Cooking dan Packing berdasarkan Production Batch.
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

            <form action="{{ route('operator.kemasan-rijek.store') }}" method="POST">
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

                                    <input type="text" id="line" class="form-control readonly-highlight" readonly>
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
                            Rijek Cooking
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="section-info mb-4">
                            <i class="fas fa-utensils"></i>
                            Masukkan berat rijek berdasarkan kategori pada proses Cooking.
                        </div>

                        <div class="table-wide-wrap">

                            <table class="table table-bordered rijek-table mb-4">

                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 70px;">No</th>
                                        <th>Kategori</th>
                                        <th style="width: 220px;">Berat (Kg)</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Rusak</td>
                                        <td>
                                            <input type="number" name="rusak_cooking" class="form-control" step="0.01"
                                                min="0" value="{{ old('rusak_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Jatuh Lantai</td>
                                        <td>
                                            <input type="number" name="jatuh_lantai_cooking" class="form-control"
                                                step="0.01" min="0" value="{{ old('jatuh_lantai_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Kulit</td>
                                        <td>
                                            <input type="number" name="kulit_cooking" class="form-control" step="0.01"
                                                min="0" value="{{ old('kulit_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Waste Bread Crumb</td>
                                        <td>
                                            <input type="number" name="waste_bread_crumb_cooking" class="form-control"
                                                step="0.01" min="0"
                                                value="{{ old('waste_bread_crumb_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Waste Bread Predust</td>
                                        <td>
                                            <input type="number" name="waste_bread_predust_cooking" class="form-control"
                                                step="0.01" min="0"
                                                value="{{ old('waste_bread_predust_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">6</td>
                                        <td>Scrap Adonan</td>
                                        <td>
                                            <input type="number" name="scrap_adonan_cooking" class="form-control"
                                                step="0.01" min="0" value="{{ old('scrap_adonan_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">7</td>
                                        <td>Gosong</td>
                                        <td>
                                            <input type="number" name="gosong_cooking" class="form-control"
                                                step="0.01" min="0" value="{{ old('gosong_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">8</td>
                                        <td>Overweight / Underweight</td>
                                        <td>
                                            <input type="number" name="overweight_underweight_cooking"
                                                class="form-control" step="0.01" min="0"
                                                value="{{ old('overweight_underweight_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">9</td>
                                        <td>Sampel QC</td>
                                        <td>
                                            <input type="number" name="sampel_qc_cooking" class="form-control"
                                                step="0.01" min="0" value="{{ old('sampel_qc_cooking') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">10</td>
                                        <td>Lain-lain</td>
                                        <td>
                                            <input type="number" name="lain_lain_cooking_kg" class="form-control"
                                                step="0.01" min="0" value="{{ old('lain_lain_cooking_kg') }}">
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label>Keterangan Lain-lain Cooking</label>

                                    <input type="text" name="lain_lain_cooking" class="form-control"
                                        value="{{ old('lain_lain_cooking') }}"
                                        placeholder="Masukkan keterangan jika ada">
                                </div>
                            </div>

                        </div>

                        <div class="row mt-4">

                            <div class="col-md-6 offset-md-6">
                                <div class="total-box">
                                    <label>Total Rijek Cooking (Kg)</label>

                                    <input type="number" name="total_rijek_cooking_kg" id="total_rijek_cooking_kg"
                                        class="form-control readonly-highlight" step="0.01"
                                        value="{{ old('total_rijek_cooking_kg') }}" readonly>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card mb-4">

                    <div class="card-header">
                        <h4>
                            <span class="step-badge">3</span>
                            Rijek Packing
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="section-info mb-4">
                            <i class="fas fa-box-open"></i>
                            Masukkan berat rijek berdasarkan kategori pada proses Packing.
                        </div>

                        <div class="table-wide-wrap">

                            <table class="table table-bordered rijek-table mb-4">

                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 70px;">No</th>
                                        <th>Kategori</th>
                                        <th style="width: 220px;">Berat (Kg)</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Rusak</td>
                                        <td>
                                            <input type="number" name="rusak_packing" class="form-control"
                                                step="0.01" min="0" value="{{ old('rusak_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Jatuh Lantai</td>
                                        <td>
                                            <input type="number" name="jatuh_lantai_packing" class="form-control"
                                                step="0.01" min="0" value="{{ old('jatuh_lantai_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Kulit</td>
                                        <td>
                                            <input type="number" name="kulit_packing" class="form-control"
                                                step="0.01" min="0" value="{{ old('kulit_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Waste Bread Crumb</td>
                                        <td>
                                            <input type="number" name="waste_bread_crumb_packing" class="form-control"
                                                step="0.01" min="0"
                                                value="{{ old('waste_bread_crumb_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Waste Bread Predust</td>
                                        <td>
                                            <input type="number" name="waste_bread_predust_packing" class="form-control"
                                                step="0.01" min="0"
                                                value="{{ old('waste_bread_predust_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">6</td>
                                        <td>Scrap Adonan</td>
                                        <td>
                                            <input type="number" name="scrap_adonan_packing" class="form-control"
                                                step="0.01" min="0" value="{{ old('scrap_adonan_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">7</td>
                                        <td>Gosong</td>
                                        <td>
                                            <input type="number" name="gosong_packing" class="form-control"
                                                step="0.01" min="0" value="{{ old('gosong_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">8</td>
                                        <td>Overweight / Underweight</td>
                                        <td>
                                            <input type="number" name="overweight_underweight_packing"
                                                class="form-control" step="0.01" min="0"
                                                value="{{ old('overweight_underweight_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">9</td>
                                        <td>Sampel QC</td>
                                        <td>
                                            <input type="number" name="sampel_qc_packing" class="form-control"
                                                step="0.01" min="0" value="{{ old('sampel_qc_packing') }}">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">10</td>
                                        <td>Lain-lain</td>
                                        <td>
                                            <input type="number" name="lain_lain_packing_kg" class="form-control"
                                                step="0.01" min="0" value="{{ old('lain_lain_packing_kg') }}">
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label>Keterangan Lain-lain Packing</label>

                                    <input type="text" name="lain_lain_packing" class="form-control"
                                        value="{{ old('lain_lain_packing') }}"
                                        placeholder="Masukkan keterangan jika ada">
                                </div>
                            </div>

                        </div>

                        <div class="row mt-4">

                            <div class="col-md-6 offset-md-6">
                                <div class="total-box">
                                    <label>Total Rijek Packing (Kg)</label>

                                    <input type="number" name="total_rijek_packing_kg" id="total_rijek_packing_kg"
                                        class="form-control readonly-highlight" step="0.01"
                                        value="{{ old('total_rijek_packing_kg') }}" readonly>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card card-final">

                    <div class="card-body">

                        <div class="d-flex justify-content-end">

                            <a href="{{ route('operator.kemasan-rijek.index') }}" class="btn btn-ghost mr-2">
                                <i class="fas fa-times mr-1"></i>
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>
                                Simpan Kemasan Rijek
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

            function calculateTotalCooking() {

                let total = 0;

                const fields = [
                    'rusak_cooking',
                    'jatuh_lantai_cooking',
                    'kulit_cooking',
                    'waste_bread_crumb_cooking',
                    'waste_bread_predust_cooking',
                    'scrap_adonan_cooking',
                    'gosong_cooking',
                    'overweight_underweight_cooking',
                    'sampel_qc_cooking',
                    'lain_lain_cooking_kg'
                ];

                fields.forEach(function(field) {

                    let value = parseFloat(
                        $('input[name="' + field + '"]').val()
                    );

                    if (!isNaN(value)) {
                        total += value;
                    }

                });

                $('#total_rijek_cooking_kg').val(total.toFixed(2));
            }

            function calculateTotalPacking() {

                let total = 0;

                const fields = [
                    'rusak_packing',
                    'jatuh_lantai_packing',
                    'kulit_packing',
                    'waste_bread_crumb_packing',
                    'waste_bread_predust_packing',
                    'scrap_adonan_packing',
                    'gosong_packing',
                    'overweight_underweight_packing',
                    'sampel_qc_packing',
                    'lain_lain_packing_kg'
                ];

                fields.forEach(function(field) {

                    let value = parseFloat(
                        $('input[name="' + field + '"]').val()
                    );

                    if (!isNaN(value)) {
                        total += value;
                    }

                });

                $('#total_rijek_packing_kg').val(total.toFixed(2));
            }

            $(document).on(
                'input',
                'input[name$="_cooking"], input[name="lain_lain_cooking_kg"]',
                function() {
                    calculateTotalCooking();
                }
            );

            $(document).on(
                'input',
                'input[name$="_packing"], input[name="lain_lain_packing_kg"]',
                function() {
                    calculateTotalPacking();
                }
            );

            calculateTotalCooking();
            calculateTotalPacking();

        });
    </script>
@endpush
