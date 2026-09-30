@extends('layouts.master')

@section('title', 'Tambah Tumbler A/B')

@section('content')
    <div class="page-section">
        <div class="section-header">
            <h1>Tumbler A/B</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.tumbler.index') }}">
                        Tumbler A/B
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Tambah
                </div>
            </div>
        </div>

        <div class="section-lead">
            Tambahkan data proses produksi Tumbler A/B berdasarkan production batch dan parameter mesin.
        </div>

        <div class="section-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('operator.tumbler.store') }}" method="POST" id="form-tumbler">
                @csrf

                {{-- STEP 1 --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">1</span>
                            Informasi Produksi
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>
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

                            <div class="col-md-8 mb-3">
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

                {{-- STEP 2 --}}
                <div class="card card-accent mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">2</span>
                            Parameter Mesin
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>
                                    Tumbler
                                </label>

                                <select name="tumbler" class="form-control @error('tumbler') is-invalid @enderror">
                                    <option value="">
                                        Pilih Tumbler
                                    </option>

                                    <option value="Tumbler A" {{ old('tumbler') == 'Tumbler A' ? 'selected' : '' }}>
                                        Tumbler A
                                    </option>

                                    <option value="Tumbler B" {{ old('tumbler') == 'Tumbler B' ? 'selected' : '' }}>
                                        Tumbler B
                                    </option>
                                </select>

                                @error('tumbler')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Drum On (Menit)
                                </label>

                                <input type="number" name="drum_on"
                                    class="form-control @error('drum_on') is-invalid @enderror" step="0.01"
                                    min="0" placeholder="Cth: 10" value="{{ old('drum_on') }}">

                                @error('drum_on')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Drum Off (Menit)
                                </label>

                                <input type="number" name="drum_off"
                                    class="form-control @error('drum_off') is-invalid @enderror" step="0.01"
                                    min="0" placeholder="Cth: 5" value="{{ old('drum_off') }}">

                                @error('drum_off')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Vacuum A (%)
                                </label>
                                <input type="number" name="vacuum_a"
                                    class="form-control @error('vacuum_a') is-invalid @enderror" step="0.01"
                                    min="0" max="100" placeholder="Cth: 80.00" value="{{ old('vacuum_a') }}">
                                @error('vacuum_a')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Vacuum B (%)
                                </label>
                                <input type="number" name="vacuum_b"
                                    class="form-control @error('vacuum_b') is-invalid @enderror" step="0.01"
                                    min="0" max="100" placeholder="Cth: 80.00"
                                    value="{{ old('vacuum_b') }}">
                                @error('vacuum_b')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label>
                                    Downtime
                                </label>

                                <input type="text" name="downtime"
                                    class="form-control @error('downtime') is-invalid @enderror"
                                    placeholder="Cth: 10 menit, mesin macet" value="{{ old('downtime') }}">

                                @error('downtime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 3 --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">3</span>
                            Waktu Proses
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label>
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

                            <div class="col-md-6">
                                <label>
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

                {{-- STEP 4 --}}
                <div class="card card-final mb-4">
                    <div class="card-header">
                        <h4>
                            <span class="step-badge">4</span>
                            Petugas & Keterangan
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>
                                    Petugas
                                </label>

                                <input type="text" name="petugas"
                                    class="form-control @error('petugas') is-invalid @enderror"
                                    placeholder="Nama Petugas" value="{{ old('petugas') }}">

                                @error('petugas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
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

                            <div class="col-md-12">
                                <label>
                                    Keterangan
                                </label>

                                <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror"
                                    placeholder="Keterangan tambahan">{{ old('keterangan') }}</textarea>

                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="section-info mb-2 mb-md-0">
                                <i class="fas fa-info-circle"></i>
                                Pastikan data Tumbler A/B sudah sesuai sebelum disimpan.
                            </div>

                            <div class="action-buttons">
                                <a href="{{ route('operator.tumbler.index') }}" class="btn btn-ghost">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="btn btn-add">
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

                        const oldBatchId = '{{ old('production_batch_id') }}';

                        if (oldBatchId) {
                            batchSelect
                                .val(oldBatchId)
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

            const oldTanggal = '{{ old('tanggal_produksi') }}';

            if (oldTanggal) {
                $('#tanggal_produksi')
                    .val(oldTanggal)
                    .trigger('change');
            } else {
                const now = new Date();

                const today = [
                    now.getFullYear(),
                    String(now.getMonth() + 1).padStart(2, '0'),
                    String(now.getDate()).padStart(2, '0')
                ].join('-');

                $('#tanggal_produksi')
                    .val(today)
                    .trigger('change');
            }
        });
    </script>
@endpush
