@extends('layouts.master')

@section('title', 'Edit Predust Breader')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Predust Breader</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.predust-breader.index') }}">
                        Predust Breader
                    </a>

                </div>

                <div class="breadcrumb-item active">
                    Edit
                </div>

            </div>

        </div>

        <div class="section-body">

            <div class="section-lead">
                Edit data proses produksi Predust Breader berdasarkan production batch dan parameter mesin.
            </div>

            @if ($errors->any())

                <div class="alert alert-danger alert-dismissible fade show">

                    <strong>Terjadi kesalahan:</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                    <button type="button" class="close" data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            @endif

            <form action="{{ route('operator.predust-breader.update', $predustBreader->id) }}" method="POST"
                id="form-predust-breader">

                @csrf
                @method('PUT')

                {{-- STEP 1 --}}
                <div class="card">

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

                                    <label>

                                        Tanggal Produksi

                                        <span class="text-danger">*</span>

                                    </label>

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old(
                                            'tanggal_produksi',
                                            $predustBreader->productionBatch->tanggal_produksi
                                                ? $predustBreader->productionBatch->tanggal_produksi->format('Y-m-d')
                                                : '',
                                        ) }}"
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

                                    <label>

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

                            <div class="col-md-4">

                                <div class="info-box">

                                    <div class="info-label">
                                        Product
                                    </div>

                                    <div class="info-value" id="batch_product">

                                        {{ $predustBreader->productionBatch->product->nama ?? '-' }}

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="info-box">

                                    <div class="info-label">
                                        Line
                                    </div>

                                    <div class="info-value" id="batch_line">

                                        {{ $predustBreader->productionBatch->line ?? '-' }}

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="info-box">

                                    <div class="info-label">
                                        Waktu Kerja
                                    </div>

                                    <div class="info-value" id="batch_waktu_kerja">

                                        @if ($predustBreader->productionBatch->waktu_kerja !== null)
                                            {{ $predustBreader->productionBatch->waktu_kerja }} menit
                                        @else
                                            -
                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- STEP 2 --}}
                <div class="card card-accent mt-3">

                    <div class="card-header">

                        <h4>

                            <span class="step-badge">2</span>

                            Parameter Predust Breader

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Predust Breader
                                    </label>
                                    <select name="predust_breader"
                                        class="form-control select2 @error('predust_breader') is-invalid @enderror">
                                        <option value="">
                                            Pilih Predust Breader
                                        </option>
                                        <option value="Breader"
                                            {{ old('predust_breader', $predustBreader->predust_breader) == 'Breader' ? 'selected' : '' }}>
                                            Breader
                                        </option>
                                        <option value="Predust A"
                                            {{ old('predust_breader', $predustBreader->predust_breader) == 'Predust A' ? 'selected' : '' }}>
                                            Predust A
                                        </option>
                                        <option value="Predust B"
                                            {{ old('predust_breader', $predustBreader->predust_breader) == 'Predust B' ? 'selected' : '' }}>
                                            Predust B
                                        </option>
                                        <option value="Predust A dan B"
                                            {{ old('predust_breader', $predustBreader->predust_breader) == 'Predust A dan B' ? 'selected' : '' }}>
                                            Predust A dan B
                                        </option>
                                    </select>

                                    @error('predust_breader')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Superflex
                                    </label>

                                    <input type="number" name="superflex"
                                        class="form-control @error('superflex') is-invalid @enderror" step="0.01"
                                        min="0" placeholder="Cth: 50.00"
                                        value="{{ old('superflex', $predustBreader->superflex) }}">

                                    @error('superflex')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="form-group mb-0">

                            <label>
                                Downtime
                            </label>

                            <input type="text" name="downtime"
                                class="form-control @error('downtime') is-invalid @enderror"
                                placeholder="Cth: 10 menit, mesin macet"
                                value="{{ old('downtime', $predustBreader->downtime) }}">

                            @error('downtime')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- STEP 3 --}}
                <div class="card mt-3">

                    <div class="card-header">

                        <h4>

                            <span class="step-badge">3</span>

                            Waktu Proses

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group mb-0">

                                    <label>
                                        Waktu Mulai
                                    </label>

                                    <input type="time" name="waktu_mulai"
                                        class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        value="{{ old('waktu_mulai', $predustBreader->waktu_mulai ? substr($predustBreader->waktu_mulai, 0, 5) : '') }}">

                                    @error('waktu_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group mb-0">

                                    <label>
                                        Waktu Selesai
                                    </label>

                                    <input type="time" name="waktu_selesai"
                                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        value="{{ old('waktu_selesai', $predustBreader->waktu_selesai ? substr($predustBreader->waktu_selesai, 0, 5) : '') }}">

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

                {{-- STEP 4 --}}
                <div class="card card-accent mt-3">

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

                                    <label>
                                        Petugas
                                    </label>

                                    <input type="text" name="petugas"
                                        class="form-control @error('petugas') is-invalid @enderror"
                                        placeholder="Nama Petugas"
                                        value="{{ old('petugas', $predustBreader->petugas) }}">

                                    @error('petugas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        PIC Produksi
                                    </label>

                                    <input type="text" name="pic_produksi"
                                        class="form-control @error('pic_produksi') is-invalid @enderror"
                                        placeholder="Nama PIC Produksi"
                                        value="{{ old('pic_produksi', $predustBreader->pic_produksi) }}">

                                    @error('pic_produksi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="form-group mb-0">

                            <label>
                                Keterangan
                            </label>

                            <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror"
                                placeholder="Keterangan tambahan">{{ old('keterangan', $predustBreader->keterangan) }}</textarea>

                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    <div class="card-footer">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="section-info">

                                <i class="fas fa-info-circle"></i>

                                Pastikan data Predust Breader sudah sesuai sebelum menyimpan perubahan.

                            </div>

                            <div>

                                <a href="{{ route('operator.predust-breader.index') }}" class="btn btn-ghost mr-2">

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

            const currentBatchId =
                '{{ old('production_batch_id', $predustBreader->production_batch_id) }}';

            function resetBatchInfo() {

                $('#batch_product').text('-');
                $('#batch_line').text('-');
                $('#batch_waktu_kerja').text('-');

            }

            function loadProductionBatches(date) {

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
                                data-waktu-kerja="${batch.waktu_kerja ?? ''}">
                                ${batch.no_batch} - ${batch.product ?? '-'}
                            </option>
                        `);

                        });

                        batchSelect
                            .prop('disabled', false)
                            .trigger('change');

                        if (currentBatchId) {

                            batchSelect
                                .val(currentBatchId)
                                .trigger('change');

                        }

                    },

                    error: function() {

                        batchSelect
                            .empty()
                            .append('<option value="">Gagal memuat production batch</option>')
                            .prop('disabled', true)
                            .trigger('change');

                    }

                });

            }

            $('#tanggal_produksi').on('change', function() {

                loadProductionBatches($(this).val());

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

            $('#tanggal_produksi').trigger('change');

        });
    </script>
@endpush
