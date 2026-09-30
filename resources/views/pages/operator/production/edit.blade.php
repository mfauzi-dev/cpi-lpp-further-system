@extends('layouts.master')

@section('title', 'Edit Produksi Bahan Baku')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Produksi Bahan Baku</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.production.index') }}">
                        Produksi Bahan Baku
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Edit
                </div>
            </div>
        </div>

        <div class="section-lead">
            Perbarui data produksi bahan baku berdasarkan production batch dan jenis proses.
        </div>

        <div class="section-body">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan.</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('operator.production.update', $production->id) }}" method="POST" id="productionForm">
                @csrf
                @method('PUT')

                {{-- INFORMASI PRODUKSI --}}
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
                                    <label class="filter-label">
                                        Tanggal Produksi
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi" class="form-control"
                                        value="{{ old('tanggal_produksi', optional($production->productionBatch->tanggal_produksi)->format('Y-m-d')) }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="filter-label">
                                        Production Batch
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select name="production_batch_id" id="production_batch_id" class="form-control select2"
                                        required>
                                        <option value="">
                                            Pilih Production Batch
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <div class="info-label">
                                        Product
                                    </div>

                                    <div class="info-value" id="batch_product">
                                        {{ $production->productionBatch->product->nama ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <div class="info-label">
                                        Line
                                    </div>

                                    <div class="info-value" id="batch_line">
                                        {{ $production->productionBatch->line ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <div class="info-label">
                                        Waktu Kerja
                                    </div>

                                    <div class="info-value" id="batch_waktu_kerja">
                                        {{ $production->productionBatch->waktu_kerja !== null
                                            ? $production->productionBatch->waktu_kerja . ' menit'
                                            : '-' }}
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="process-highlight mt-3 mb-0">

                            <div class="process-label mb-2">
                                Tipe Jenis Proses
                            </div>

                            <div class="form-group mb-0">

                                <select name="process_type_id" id="process_type_id" class="form-control select2" required>
                                    <option value="">
                                        -- Pilih Tipe Jenis Proses --
                                    </option>

                                    @foreach ($processTypes as $processType)
                                        <option value="{{ $processType->id }}"
                                            {{ old('process_type_id', $production->process_type_id) == $processType->id ? 'selected' : '' }}>
                                            {{ $processType->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- DATA PRODUK --}}
                <div class="card card-accent mb-4" id="product-card">

                    <div class="card-header">
                        <h4>
                            <span class="step-badge">2</span>
                            Data Produk
                        </h4>
                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-bordered table-wide" id="productTable">

                                <thead>
                                    <tr>
                                        <th width="70" class="text-center">
                                            No
                                        </th>

                                        <th>
                                            Produk
                                        </th>

                                        <th>
                                            Kode Batch
                                        </th>

                                        <th>
                                            Suhu
                                        </th>

                                        <th>
                                            Berat (Kg)
                                        </th>

                                        <th width="100" class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody id="product-table-body">

                                    @foreach ($production->details as $index => $detail)
                                        <tr data-row-index="{{ $index }}">

                                            <td class="text-center align-middle nomor">
                                                {{ $index + 1 }}
                                            </td>

                                            <td>

                                                <select name="products[{{ $index }}][product_id]"
                                                    class="form-control select2 product" required>

                                                    <option value="">
                                                        Pilih Produk
                                                    </option>

                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            {{ $detail->product_id == $product->id ? 'selected' : '' }}>
                                                            {{ $product->nama }}
                                                            {{ $product->kode_product ? ' - ' . $product->kode_product : '' }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                            </td>

                                            <td>

                                                <input type="text" name="products[{{ $index }}][kode_batch]"
                                                    class="form-control" placeholder="Kode batch"
                                                    value="{{ $detail->kode_batch }}">

                                            </td>

                                            <td>

                                                <input type="number" step="0.01"
                                                    name="products[{{ $index }}][suhu]" class="form-control"
                                                    placeholder="Suhu" value="{{ $detail->suhu }}">

                                            </td>

                                            <td>

                                                <input type="number" step="0.01"
                                                    name="products[{{ $index }}][berat_kg]" class="form-control"
                                                    placeholder="Berat" value="{{ $detail->berat_kg }}">

                                            </td>

                                            <td class="text-center align-middle">

                                                <button type="button" class="btn btn-outline-danger btn-sm removeRow"
                                                    title="Hapus Baris">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                    <div class="card-footer bg-white border-top">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <button type="button" id="btnAddRow" class="btn btn-add mb-2 mb-md-0">
                                <i class="fas fa-plus mr-1"></i>
                                Tambah Baris
                            </button>

                            <div class="action-buttons">

                                <a href="{{ route('operator.production.detail', $production->id) }}"
                                    class="btn btn-ghost">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>
                                    Simpan Perubahan
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                width: '100%'
            });

            let productList = @json($products);
            let rowIndex = {{ $production->details->count() }};

            const oldProducts = @json(old('products', []));

            function buildProductOptions(selectedProductId = '') {

                let options = '<option value="">Pilih Produk</option>';

                productList.forEach(function(product) {

                    const selected =
                        String(product.id) === String(selectedProductId) ?
                        'selected' :
                        '';

                    options += `
                <option
                    value="${product.id}"
                    ${selected}
                >
                    ${product.nama}
                    ${product.kode_product
                        ? ' - ' + product.kode_product
                        : ''}
                </option>
            `;
                });

                return options;
            }

            function appendProductRow(data = {}, index) {

                const productId = data.product_id ?? '';
                const kodeBatch = data.kode_batch ?? '';
                const suhu = data.suhu ?? '';
                const beratKg = data.berat_kg ?? '';

                const html = `
            <tr data-row-index="${index}">

                <td class="text-center align-middle nomor">
                </td>

                <td>

                    <select
                        name="products[${index}][product_id]"
                        class="form-control select2 product"
                        required
                    >
                        ${buildProductOptions(productId)}
                    </select>

                </td>

                <td>

                    <input
                        type="text"
                        name="products[${index}][kode_batch]"
                        class="form-control"
                        placeholder="Kode batch"
                        value="${kodeBatch}"
                    >

                </td>

                <td>

                    <input
                        type="number"
                        step="0.01"
                        name="products[${index}][suhu]"
                        class="form-control"
                        placeholder="Suhu"
                        value="${suhu}"
                    >

                </td>

                <td>

                    <input
                        type="number"
                        step="0.01"
                        name="products[${index}][berat_kg]"
                        class="form-control"
                        placeholder="Berat"
                        value="${beratKg}"
                    >

                </td>

                <td class="text-center align-middle">

                    <button
                        type="button"
                        class="btn btn-outline-danger btn-sm removeRow"
                        title="Hapus Baris"
                    >
                        <i class="fas fa-trash"></i>
                    </button>

                </td>

            </tr>
        `;

                $('#product-table-body').append(html);

                $('#product-table-body tr:last .select2').select2({
                    width: '100%'
                });

                renumberRows();
            }

            function renumberRows() {

                $('#product-table-body tr').each(function(index) {

                    $(this)
                        .find('.nomor')
                        .text(index + 1);

                });

            }

            function loadProductionBatch(date, selectedBatchId = '') {

                const batchSelect = $('#production_batch_id');

                batchSelect
                    .prop('disabled', true)
                    .empty()
                    .append(
                        '<option value="">Memuat production batch...</option>'
                    )
                    .trigger('change');

                $('#batch_product').text('-');
                $('#batch_line').text('-');
                $('#batch_waktu_kerja').text('-');

                if (!date) {

                    batchSelect
                        .empty()
                        .append(
                            '<option value="">Pilih tanggal terlebih dahulu</option>'
                        )
                        .prop('disabled', true)
                        .trigger('change');

                    return;
                }

                $.ajax({

                    url: `{{ url('production-batch/by-date') }}/${date}`,

                    type: 'GET',

                    success: function(response) {

                        batchSelect
                            .empty()
                            .append(
                                '<option value="">Pilih Production Batch</option>'
                            );

                        if (response.length === 0) {

                            batchSelect
                                .append(
                                    '<option value="">Tidak ada production batch pada tanggal ini</option>'
                                )
                                .prop('disabled', true)
                                .trigger('change');

                            return;
                        }

                        response.forEach(function(batch) {

                            batchSelect.append(`
                        <option
                            value="${batch.id}"
                            data-product="${batch.product ?? '-'}"
                            data-line="${batch.line ?? '-'}"
                            data-waktu-kerja="${batch.waktu_kerja ?? ''}"
                        >
                            ${batch.no_batch} - ${batch.product ?? '-'}
                        </option>
                    `);

                        });

                        batchSelect
                            .prop('disabled', false)
                            .trigger('change');

                        if (selectedBatchId) {

                            batchSelect
                                .val(selectedBatchId)
                                .trigger('change');

                        }

                    },

                    error: function() {

                        batchSelect
                            .empty()
                            .append(
                                '<option value="">Gagal memuat production batch</option>'
                            )
                            .prop('disabled', true)
                            .trigger('change');

                    }

                });

            }

            $('#tanggal_produksi').on('change', function() {

                const date = $(this).val();

                loadProductionBatch(
                    date,
                    '{{ old('production_batch_id', $production->production_batch_id) }}'
                );

            });

            $('#production_batch_id').on('change', function() {

                const selected = $(this).find(':selected');

                if (!$(this).val()) {

                    $('#batch_product').text('-');
                    $('#batch_line').text('-');
                    $('#batch_waktu_kerja').text('-');

                    return;
                }

                $('#batch_product').text(
                    selected.data('product') || '-'
                );

                $('#batch_line').text(
                    selected.data('line') || '-'
                );

                const waktuKerja = selected.data('waktu-kerja');

                if (
                    waktuKerja !== '' &&
                    waktuKerja !== null &&
                    waktuKerja !== undefined
                ) {

                    $('#batch_waktu_kerja').text(
                        waktuKerja + ' menit'
                    );

                } else {

                    $('#batch_waktu_kerja').text('-');

                }

            });

            $('#process_type_id').on('change', function() {

                const processTypeId = $(this).val();

                $('#product-card').show();

                if (!processTypeId) {

                    productList = [];

                    $('#product-table-body').html(`
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Pilih jenis proses terlebih dahulu.
                    </td>
                </tr>
            `);

                    return;
                }

                $.ajax({

                    url: `{{ url('production/get-products') }}/${processTypeId}`,

                    type: 'GET',

                    success: function(response) {

                        productList = response;

                        if (response.length === 0) {

                            $('#product-table-body').html(`
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Tidak ada produk untuk jenis proses ini.
                            </td>
                        </tr>
                    `);

                            return;
                        }

                        /*
                         * Jika ada old input karena validasi gagal,
                         * gunakan kembali data tersebut.
                         */
                        if (
                            oldProducts &&
                            Object.keys(oldProducts).length > 0
                        ) {

                            $('#product-table-body').empty();

                            Object.keys(oldProducts).forEach(function(index) {

                                appendProductRow(
                                    oldProducts[index],
                                    parseInt(index)
                                );

                            });

                            rowIndex =
                                Math.max(
                                    ...Object.keys(oldProducts).map(Number)
                                ) + 1;

                            renumberRows();

                            return;
                        }

                        /*
                         * Jika tidak ada old input,
                         * data detail existing sudah dirender dari Blade.
                         */
                        $('#product-table-body tr').each(function() {

                            const select = $(this).find('.product');

                            if (select.length) {

                                select.select2({
                                    width: '100%'
                                });

                            }

                        });

                        renumberRows();

                    },

                    error: function() {

                        $('#product-table-body').html(`
                    <tr>
                        <td colspan="6" class="text-center text-danger">
                            Gagal memuat produk.
                        </td>
                    </tr>
                `);

                    }

                });

            });

            $('#btnAddRow').on('click', function() {

                if (productList.length === 0) {

                    alert(
                        'Pilih jenis proses terlebih dahulu.'
                    );

                    return;
                }

                appendProductRow({}, rowIndex);

                rowIndex++;

            });

            $(document).on('click', '.removeRow', function() {

                const rows =
                    $('#product-table-body tr');

                if (rows.length <= 1) {

                    alert(
                        'Minimal harus ada 1 baris.'
                    );

                    return;
                }

                $(this)
                    .closest('tr')
                    .remove();

                renumberRows();

            });

            $('#tanggal_produksi').trigger('change');

            $('#process_type_id').trigger('change');

        });
    </script>
@endpush
