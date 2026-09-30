@extends('layouts.master')

@section('title', 'Edit Pembekuan')

@push('addon-style')
    <style>
        :root {
            --pembekuan-primary: #1B4B43;
            --pembekuan-primary-light: #E8F0EE;
            --pembekuan-accent: #D98C3D;
            --pembekuan-border: #E3E7E1;
            --pembekuan-text: #1F2A24;
            --pembekuan-muted: #5B6A62;
            --pembekuan-soft: #F7F9F7;
        }

        .pembekuan-edit .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--pembekuan-text);
        }

        .pembekuan-edit .section-lead {
            color: var(--pembekuan-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .pembekuan-edit .card {
            border: none;
            border-left: 4px solid var(--pembekuan-primary);
            border-radius: 10px;
            box-shadow:
                0 1px 3px rgba(15, 30, 25, 0.06),
                0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .pembekuan-edit .card.card-accent,
        .pembekuan-edit .card.card-final {
            border-left-color: var(--pembekuan-accent);
        }

        .pembekuan-edit .card-header {
            background: #fff;
            border-bottom: 1px solid var(--pembekuan-border);
            padding: 1rem 1.5rem;
        }

        .pembekuan-edit .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--pembekuan-text);
            display: flex;
            align-items: center;
        }

        .pembekuan-edit .card-body {
            padding: 1.5rem;
        }

        .pembekuan-edit .card-footer {
            padding: 1rem 1.5rem;
        }

        .pembekuan-edit .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--pembekuan-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .pembekuan-edit .filter-label {
            color: var(--pembekuan-text);
            font-size: 0.78rem;
            font-weight: 600;
            margin-bottom: 0.45rem;
        }

        .pembekuan-edit .form-control {
            border-color: var(--pembekuan-border);
            border-radius: 7px;
            color: var(--pembekuan-text);
        }

        .pembekuan-edit .form-control:focus {
            border-color: var(--pembekuan-primary);
            box-shadow: 0 0 0 0.2rem rgba(27, 75, 67, 0.08);
        }

        .pembekuan-edit .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid var(--pembekuan-border);
            border-radius: 7px;
        }

        .pembekuan-edit .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            color: var(--pembekuan-text);
        }

        .pembekuan-edit .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .pembekuan-edit .info-box {
            height: 100%;
            background: var(--pembekuan-soft);
            border: 1px solid var(--pembekuan-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .pembekuan-edit .info-label {
            color: var(--pembekuan-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .pembekuan-edit .info-value {
            color: var(--pembekuan-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .pembekuan-edit .section-info {
            background: var(--pembekuan-primary-light);
            border: 1px solid var(--pembekuan-border);
            border-radius: 8px;
            padding: 0.85rem 1rem;
            color: var(--pembekuan-text);
            font-size: 0.875rem;
        }

        .pembekuan-edit .section-info i {
            color: var(--pembekuan-primary);
            margin-right: 0.45rem;
        }

        .pembekuan-edit .input-group-text {
            border-color: var(--pembekuan-border);
            background: var(--pembekuan-soft);
            color: var(--pembekuan-muted);
        }

        .pembekuan-edit .btn-ghost {
            color: var(--pembekuan-muted);
            background: transparent;
            border: 1px solid var(--pembekuan-border);
        }

        .pembekuan-edit .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--pembekuan-text);
        }

        .pembekuan-edit .btn-primary {
            background: var(--pembekuan-primary);
            border-color: var(--pembekuan-primary);
        }

        .pembekuan-edit .btn-primary:hover {
            background: #153C35;
            border-color: #153C35;
        }

        .pembekuan-edit .text-danger {
            color: #C44B4B !important;
        }

        @media (max-width: 767.98px) {
            .pembekuan-edit .card-body {
                padding: 1rem;
            }

            .pembekuan-edit .card-header,
            .pembekuan-edit .card-footer {
                padding: 0.9rem 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="pembekuan-edit">

        <div class="section-header">

            <h1>Pembekuan</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.pembekuan.index') }}">
                        Pembekuan
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Edit
                </div>

            </div>

        </div>

        <div class="section-lead">
            Perbarui data proses produksi Pembekuan berdasarkan production batch.
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

            <form action="{{ route('operator.pembekuan.update', $pembekuan->id) }}" method="POST" id="form-pembekuan">

                @csrf

                @method('PUT')

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

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi', $pembekuan->productionBatch->tanggal_produksi?->format('Y-m-d')) }}"
                                        required>

                                    @error('tanggal_produksi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-8">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Production Batch

                                        <span class="text-danger">*</span>

                                    </label>

                                    <select name="production_batch_id" id="production_batch_id"
                                        class="form-control select2 @error('production_batch_id') is-invalid @enderror"
                                        required>

                                        <option value="">
                                            Pilih Production Batch
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

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">
                                        Product
                                    </div>

                                    <div class="info-value" id="batch_product">
                                        {{ $pembekuan->productionBatch->product->nama ?? '-' }}
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">
                                        Line
                                    </div>

                                    <div class="info-value" id="batch_line">
                                        {{ $pembekuan->productionBatch->line ?? '-' }}
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">
                                        Waktu Kerja
                                    </div>

                                    <div class="info-value" id="batch_waktu_kerja">

                                        @if ($pembekuan->productionBatch->waktu_kerja !== null)
                                            {{ $pembekuan->productionBatch->waktu_kerja }} menit
                                        @else
                                            -
                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card card-accent mb-4">

                    <div class="card-header">

                        <h4>

                            <span class="step-badge">2</span>

                            Parameter Pembekuan

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Suhu Ruang Packing
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_ruang_packing"
                                        class="form-control @error('suhu_ruang_packing') is-invalid @enderror"
                                        placeholder="Masukkan suhu ruang packing"
                                        value="{{ old('suhu_ruang_packing', $pembekuan->suhu_ruang_packing) }}">

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            °C
                                        </span>

                                    </div>

                                </div>

                                @error('suhu_ruang_packing')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Suhu Ruang IQF
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_ruang_iqf"
                                        class="form-control @error('suhu_ruang_iqf') is-invalid @enderror"
                                        placeholder="Masukkan suhu ruang IQF"
                                        value="{{ old('suhu_ruang_iqf', $pembekuan->suhu_ruang_iqf) }}">

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            °C
                                        </span>

                                    </div>

                                </div>

                                @error('suhu_ruang_iqf')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Speed Conveyor
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="speed_conveyor"
                                        class="form-control @error('speed_conveyor') is-invalid @enderror"
                                        placeholder="Masukkan speed conveyor"
                                        value="{{ old('speed_conveyor', $pembekuan->speed_conveyor) }}">

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            m/min
                                        </span>

                                    </div>

                                </div>

                                @error('speed_conveyor')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Temperature Pendinginan
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_pusat"
                                        class="form-control @error('suhu_pusat') is-invalid @enderror"
                                        placeholder="Masukkan temperature pendinginan"
                                        value="{{ old('suhu_pusat', $pembekuan->suhu_pusat) }}">

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            °C
                                        </span>

                                    </div>

                                </div>

                                @error('suhu_pusat')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Suhu Minimum
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_minimum"
                                        class="form-control @error('suhu_minimum') is-invalid @enderror"
                                        placeholder="Masukkan suhu minimum"
                                        value="{{ old('suhu_minimum', $pembekuan->suhu_minimum) }}">

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            °C
                                        </span>

                                    </div>

                                </div>

                                @error('suhu_minimum')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Lama Waktu Kerusakan
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" min="0" name="lama_waktu_kerusakan"
                                        class="form-control @error('lama_waktu_kerusakan') is-invalid @enderror"
                                        placeholder="Masukkan lama waktu kerusakan"
                                        value="{{ old('lama_waktu_kerusakan', $pembekuan->lama_waktu_kerusakan) }}">

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            Menit
                                        </span>

                                    </div>

                                </div>

                                @error('lama_waktu_kerusakan')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Lama Waktu Istirahat
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" min="0" name="lama_waktu_istirahat"
                                        class="form-control @error('lama_waktu_istirahat') is-invalid @enderror"
                                        placeholder="Masukkan lama waktu istirahat"
                                        value="{{ old('lama_waktu_istirahat', $pembekuan->lama_waktu_istirahat) }}">

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            Menit
                                        </span>

                                    </div>

                                </div>

                                @error('lama_waktu_istirahat')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card mb-4">

                    <div class="card-header">

                        <h4>

                            <span class="step-badge">3</span>

                            Waktu Proses

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <div class="form-group mb-0">

                                    <label class="filter-label">
                                        Waktu Mulai
                                    </label>

                                    <input type="time" name="waktu_mulai"
                                        class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        value="{{ old('waktu_mulai', $pembekuan->waktu_mulai ? substr($pembekuan->waktu_mulai, 0, 5) : '') }}">

                                    @error('waktu_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6 mb-3">

                                <div class="form-group mb-0">

                                    <label class="filter-label">
                                        Waktu Selesai
                                    </label>

                                    <input type="time" name="waktu_selesai"
                                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        value="{{ old('waktu_selesai', $pembekuan->waktu_selesai ? substr($pembekuan->waktu_selesai, 0, 5) : '') }}">

                                    @error('waktu_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card card-final">

                    <div class="card-header">

                        <h4>

                            <span class="step-badge">4</span>

                            Petugas & Keterangan

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">
                                        Operator
                                    </label>

                                    <input type="text" name="operator"
                                        class="form-control @error('operator') is-invalid @enderror"
                                        placeholder="Nama Operator" value="{{ old('operator', $pembekuan->operator) }}">

                                    @error('operator')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">
                                        PIC Produksi
                                    </label>

                                    <input type="text" name="pic_produksi"
                                        class="form-control @error('pic_produksi') is-invalid @enderror"
                                        placeholder="Nama PIC Produksi"
                                        value="{{ old('pic_produksi', $pembekuan->pic_produksi) }}">

                                    @error('pic_produksi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="form-group mb-0">

                            <label class="filter-label">
                                Line
                            </label>

                            <input type="text" name="line"
                                class="form-control @error('line') is-invalid @enderror" placeholder="Masukkan line"
                                value="{{ old('line', $pembekuan->line) }}">

                            @error('line')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    <div class="card-footer bg-white border-top">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div class="section-info mb-2 mb-md-0">

                                <i class="fas fa-info-circle"></i>

                                Pastikan data produksi sudah sesuai sebelum diperbarui.

                            </div>

                            <div class="action-buttons">

                                <a href="{{ route('operator.pembekuan.index') }}" class="btn btn-ghost">

                                    <i class="fas fa-arrow-left mr-1"></i>

                                    Kembali

                                </a>

                                <button type="submit" class="btn btn-primary">

                                    <i class="fas fa-save mr-1"></i>

                                    Update

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

            function resetBatchInfo() {

                $('#batch_product').text('-');
                $('#batch_line').text('-');
                $('#batch_waktu_kerja').text('-');

            }

            $('#tanggal_produksi').on('change', function() {

                const date = $(this).val();

                const batchSelect = $('#production_batch_id');

                batchSelect
                    .prop('disabled', true)
                    .empty()
                    .append('<option value="">Memuat production batch...</option>')
                    .trigger('change');

                resetBatchInfo();

                if (!date) {

                    batchSelect
                        .empty()
                        .append('<option value="">Pilih tanggal terlebih dahulu</option>')
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
                            .append('<option value="">Pilih Production Batch</option>');

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

                        const selectedBatchId =
                            '{{ old('production_batch_id', $pembekuan->production_batch_id) }}';

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

            });

            $('#production_batch_id').on('change', function() {

                const selected = $(this).find(':selected');

                if (!$(this).val()) {

                    resetBatchInfo();

                    return;

                }

                $('#batch_product').text(
                    selected.data('product') || '-'
                );

                $('#batch_line').text(
                    selected.data('line') || '-'
                );

                const waktuKerja =
                    selected.data('waktu-kerja');

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

            const currentTanggal =
                '{{ old('tanggal_produksi', $pembekuan->productionBatch->tanggal_produksi?->format('Y-m-d')) }}';

            if (currentTanggal) {

                $('#tanggal_produksi')
                    .val(currentTanggal)
                    .trigger('change');

            }

        });
    </script>
@endpush
