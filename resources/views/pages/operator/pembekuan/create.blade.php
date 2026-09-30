@extends('layouts.master')

@section('title', 'Tambah Pembekuan')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Pembekuan</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.pembekuan.index') }}">

                        Pembekuan

                    </a>

                </div>

                <div class="breadcrumb-item active">

                    Tambah

                </div>

            </div>

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

            <form action="{{ route('operator.pembekuan.store') }}" method="POST" id="form-pembekuan">

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

                                    <label class="filter-label">

                                        Tanggal Produksi

                                        <span class="text-danger">*</span>

                                    </label>

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi') }}" required>

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

                                        -

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">

                                        Line

                                    </div>

                                    <div class="info-value" id="batch_line">

                                        -

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">

                                        Waktu Kerja

                                    </div>

                                    <div class="info-value" id="batch_waktu_kerja">

                                        -

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

                            <div class="col-md-6 mb-3">

                                <div class="filter-label">

                                    Suhu Ruang Packing

                                </div>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_ruang_packing"
                                        class="form-control @error('suhu_ruang_packing') is-invalid @enderror"
                                        placeholder="Masukkan suhu ruang packing" value="{{ old('suhu_ruang_packing') }}">

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

                            <div class="col-md-6 mb-3">

                                <div class="filter-label">

                                    Suhu Ruang IQF

                                </div>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_ruang_iqf"
                                        class="form-control @error('suhu_ruang_iqf') is-invalid @enderror"
                                        placeholder="Masukkan suhu ruang IQF" value="{{ old('suhu_ruang_iqf') }}">

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

                            <div class="col-md-6 mb-3">

                                <div class="filter-label">

                                    Speed Conveyor

                                </div>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="speed_conveyor"
                                        class="form-control @error('speed_conveyor') is-invalid @enderror"
                                        placeholder="Masukkan speed conveyor" value="{{ old('speed_conveyor') }}">

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

                            <div class="col-md-6 mb-3">

                                <div class="filter-label">

                                    Suhu Pusat

                                </div>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_pusat"
                                        class="form-control @error('suhu_pusat') is-invalid @enderror"
                                        placeholder="Masukkan suhu pusat" value="{{ old('suhu_pusat') }}">

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

                            <div class="col-md-6 mb-3">

                                <div class="filter-label">

                                    Suhu Minimum

                                </div>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="suhu_minimum"
                                        class="form-control @error('suhu_minimum') is-invalid @enderror"
                                        placeholder="Masukkan suhu minimum" value="{{ old('suhu_minimum') }}">

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

                            <div class="col-md-6 mb-3">

                                <div class="filter-label">

                                    Lama Waktu Kerusakan

                                </div>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="lama_waktu_kerusakan"
                                        class="form-control @error('lama_waktu_kerusakan') is-invalid @enderror"
                                        placeholder="Masukkan lama waktu kerusakan"
                                        value="{{ old('lama_waktu_kerusakan') }}">

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

                            <div class="col-md-6 mb-3">

                                <div class="filter-label">

                                    Lama Waktu Istirahat

                                </div>

                                <div class="input-group">

                                    <input type="number" step="0.01" name="lama_waktu_istirahat"
                                        class="form-control @error('lama_waktu_istirahat') is-invalid @enderror"
                                        placeholder="Masukkan lama waktu istirahat"
                                        value="{{ old('lama_waktu_istirahat') }}">

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
                                        value="{{ old('waktu_mulai') }}">

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
                                        value="{{ old('waktu_selesai') }}">

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

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Operator

                                    </label>

                                    <input type="text" name="operator"
                                        class="form-control @error('operator') is-invalid @enderror"
                                        placeholder="Nama Operator" value="{{ old('operator') }}">

                                    @error('operator')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Line

                                    </label>

                                    <input type="text" name="line"
                                        class="form-control @error('line') is-invalid @enderror"
                                        placeholder="Contoh: Line 1" value="{{ old('line') }}">

                                    @error('line')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="filter-label">

                                        PIC Produksi

                                    </label>

                                    <input type="text" name="pic_produksi"
                                        class="form-control @error('pic_produksi') is-invalid @enderror"
                                        placeholder="Nama PIC Produksi" value="{{ old('pic_produksi') }}">

                                    @error('pic_produksi')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer bg-white border-top">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div class="section-info mb-2 mb-md-0">

                                <i class="fas fa-info-circle"></i>

                                Pastikan data produksi sudah sesuai sebelum disimpan.

                            </div>

                            <div class="action-buttons">

                                <a href="{{ route('operator.pembekuan.index') }}" class="btn btn-ghost">

                                    <i class="fas fa-arrow-left mr-1"></i>

                                    Kembali

                                </a>

                                <button type="submit" class="btn btn-primary">

                                    <i class="fas fa-save mr-1"></i>

                                    Simpan

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

            $('#tanggal_produksi').on('change', function() {

                const date = $(this).val();

                const batchSelect = $('#production_batch_id');

                batchSelect

                    .prop('disabled', true)

                    .empty()

                    .append('<option value="">Memuat production batch...</option>')

                    .trigger('change');

                $('#batch_product').text('-');

                $('#batch_line').text('-');

                $('#batch_waktu_kerja').text('-');

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

                        const oldBatchId =

                            '{{ old('production_batch_id') }}';

                        if (oldBatchId) {

                            batchSelect

                                .val(oldBatchId)

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

            const oldTanggal =

                '{{ old('tanggal_produksi') }}';

            if (oldTanggal) {

                $('#tanggal_produksi')

                    .val(oldTanggal)

                    .trigger('change');

            } else {

                const today =

                    new Date().toISOString().split('T')[0];

                $('#tanggal_produksi')

                    .val(today)

                    .trigger('change');

            }

        });
    </script>
@endpush
