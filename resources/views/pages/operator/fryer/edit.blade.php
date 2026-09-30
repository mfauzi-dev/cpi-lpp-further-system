@extends('layouts.master')

@section('title', 'Edit Fryer')

@push('addon-style')
    <style>
        :root {
            --fry-primary: #1B4B43;
            --fry-primary-light: #E8F0EE;
            --fry-accent: #D98C3D;
            --fry-border: #E3E7E1;
            --fry-text: #1F2A24;
            --fry-muted: #5B6A62;
            --fry-soft: #F7F9F7;
        }

        .fryer-edit .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--fry-text);
        }

        .fryer-edit .section-lead {
            color: var(--fry-muted);
            font-size: 0.925rem;
            margin: 0.25rem 0 1.5rem;
        }

        .fryer-edit .card {
            border: none;
            border-left: 4px solid var(--fry-primary);
            border-radius: 10px;
            box-shadow:
                0 1px 3px rgba(15, 30, 25, 0.06),
                0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .fryer-edit .card.card-accent,
        .fryer-edit .card.card-final {
            border-left-color: var(--fry-accent);
        }

        .fryer-edit .card-header {
            background: #fff;
            border-bottom: 1px solid var(--fry-border);
            padding: 1rem 1.5rem;
        }

        .fryer-edit .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--fry-text);
            display: flex;
            align-items: center;
        }

        .fryer-edit .card-body {
            padding: 1.5rem;
        }

        .fryer-edit .card-footer {
            padding: 1rem 1.5rem;
        }

        .fryer-edit .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--fry-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .fryer-edit .filter-label {
            color: var(--fry-text);
            font-size: 0.78rem;
            font-weight: 600;
            margin-bottom: 0.45rem;
        }

        .fryer-edit .form-control {
            border-color: var(--fry-border);
            border-radius: 7px;
            color: var(--fry-text);
        }

        .fryer-edit .form-control:focus {
            border-color: var(--fry-primary);
            box-shadow: 0 0 0 0.2rem rgba(27, 75, 67, 0.08);
        }

        .fryer-edit .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid var(--fry-border);
            border-radius: 7px;
        }

        .fryer-edit .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            color: var(--fry-text);
        }

        .fryer-edit .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .fryer-edit .info-box {
            height: 100%;
            background: var(--fry-soft);
            border: 1px solid var(--fry-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .fryer-edit .info-label {
            color: var(--fry-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .fryer-edit .info-value {
            color: var(--fry-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .fryer-edit .section-info {
            background: var(--fry-primary-light);
            border: 1px solid var(--fry-border);
            border-radius: 8px;
            padding: 0.85rem 1rem;
            color: var(--fry-text);
            font-size: 0.875rem;
        }

        .fryer-edit .section-info i {
            color: var(--fry-primary);
            margin-right: 0.45rem;
        }

        .fryer-edit .input-group-text {
            border-color: var(--fry-border);
            background: var(--fry-soft);
            color: var(--fry-muted);
        }

        .fryer-edit .btn-ghost {
            color: var(--fry-muted);
            background: transparent;
            border: 1px solid var(--fry-border);
        }

        .fryer-edit .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--fry-text);
        }

        .fryer-edit .btn-primary {
            background: var(--fry-primary);
            border-color: var(--fry-primary);
        }

        .fryer-edit .btn-primary:hover {
            background: #153C35;
            border-color: #153C35;
        }

        .fryer-edit .text-danger {
            color: #C44B4B !important;
        }

        @media (max-width: 767.98px) {
            .fryer-edit .card-body {
                padding: 1rem;
            }

            .fryer-edit .card-header,
            .fryer-edit .card-footer {
                padding: 0.9rem 1rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="fryer-edit">

        <div class="section-header">
            <h1>Fryer</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.fryer.index') }}">
                        Fryer
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Edit
                </div>
            </div>
        </div>

        <div class="section-lead">
            Perbarui data proses produksi Fryer berdasarkan production batch.
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

            <form action="{{ route('operator.fryer.update', $fryer->id) }}" method="POST" id="form-fryer">

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
                                        value="{{ old('tanggal_produksi', $fryer->productionBatch->tanggal_produksi?->format('Y-m-d')) }}"
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
                                        {{ $fryer->productionBatch->product->nama ?? '-' }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="info-box">

                                    <div class="info-label">
                                        Line
                                    </div>

                                    <div class="info-value" id="batch_line">
                                        {{ $fryer->productionBatch->line ?? '-' }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="info-box">

                                    <div class="info-label">
                                        Waktu Kerja
                                    </div>

                                    <div class="info-value" id="batch_waktu_kerja">

                                        @if ($fryer->productionBatch->waktu_kerja !== null)
                                            {{ $fryer->productionBatch->waktu_kerja }} menit
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
                            Parameter Fryer
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Fryer
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="fryer" class="form-control @error('fryer') is-invalid @enderror" required>

                                    <option value="">
                                        Pilih Fryer
                                    </option>

                                    <option value="1" {{ old('fryer', $fryer->fryer) == '1' ? 'selected' : '' }}>
                                        Fryer 1
                                    </option>

                                    <option value="2" {{ old('fryer', $fryer->fryer) == '2' ? 'selected' : '' }}>
                                        Fryer 2
                                    </option>

                                    <option value="3" {{ old('fryer', $fryer->fryer) == '3' ? 'selected' : '' }}>
                                        Fryer 3
                                    </option>

                                    <option value="4" {{ old('fryer', $fryer->fryer) == '4' ? 'selected' : '' }}>
                                        Fryer 4
                                    </option>

                                    <option value="5" {{ old('fryer', $fryer->fryer) == '5' ? 'selected' : '' }}>
                                        Fryer 5
                                    </option>

                                </select>

                                @error('fryer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Suhu Setting
                                </label>

                                <input type="number" step="0.01" min="0" name="suhu_setting"
                                    class="form-control @error('suhu_setting') is-invalid @enderror"
                                    placeholder="Masukkan suhu setting"
                                    value="{{ old('suhu_setting', $fryer->suhu_setting) }}">

                                @error('suhu_setting')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Suhu Aktual
                                </label>

                                <input type="number" step="0.01" min="0" name="suhu_aktual"
                                    class="form-control @error('suhu_aktual') is-invalid @enderror"
                                    placeholder="Masukkan suhu aktual"
                                    value="{{ old('suhu_aktual', $fryer->suhu_aktual) }}">

                                @error('suhu_aktual')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Suhu Pusat
                                </label>

                                <input type="number" step="0.01" min="0" name="suhu_pusat"
                                    class="form-control @error('suhu_pusat') is-invalid @enderror"
                                    placeholder="Masukkan suhu pusat"
                                    value="{{ old('suhu_pusat', $fryer->suhu_pusat) }}">

                                @error('suhu_pusat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Suhu Minimum
                                </label>

                                <input type="number" step="0.01" min="0" name="suhu_minimum"
                                    class="form-control @error('suhu_minimum') is-invalid @enderror"
                                    placeholder="Masukkan suhu minimum"
                                    value="{{ old('suhu_minimum', $fryer->suhu_minimum) }}">

                                @error('suhu_minimum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">
                                <label class="filter-label">
                                    Hasil Organoleptik
                                </label>

                                <select name="organoleptik"
                                    class="form-control @error('organoleptik') is-invalid @enderror">
                                    <option value="">
                                        Pilih Hasil Organoleptik
                                    </option>

                                    <option value="Ok"
                                        {{ old('organoleptik', $fryer->organoleptik) == 'Ok' ? 'selected' : '' }}>
                                        Ok
                                    </option>

                                    <option value="Tidak"
                                        {{ old('organoleptik', $fryer->organoleptik) == 'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                                </select>

                                @error('organoleptik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-4 mb-3">

                                <label class="filter-label">
                                    Lama Pemasakan
                                </label>

                                <div class="input-group">

                                    <input type="number" step="0.01" min="0" name="lama_pemasakan"
                                        class="form-control @error('lama_pemasakan') is-invalid @enderror"
                                        placeholder="Masukkan lama pemasakan"
                                        value="{{ old('lama_pemasakan', $fryer->lama_pemasakan) }}">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Menit
                                        </span>
                                    </div>

                                </div>

                                @error('lama_pemasakan')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="filter-label">
                                    TPM Minyak
                                </label>

                                <input type="number" step="0.01" min="0" name="tpm_minyak"
                                    class="form-control @error('tpm_minyak') is-invalid @enderror"
                                    placeholder="Masukkan TPM minyak"
                                    value="{{ old('tpm_minyak', $fryer->tpm_minyak) }}">

                                @error('tpm_minyak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="filter-label">
                                    Downtime
                                </label>

                                <input type="text" name="downtime"
                                    class="form-control @error('downtime') is-invalid @enderror"
                                    placeholder="Contoh: 10 menit, mesin macet"
                                    value="{{ old('downtime', $fryer->downtime) }}">

                                @error('downtime')
                                    <div class="invalid-feedback">
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
                                        value="{{ old('waktu_mulai', $fryer->waktu_mulai ? substr($fryer->waktu_mulai, 0, 5) : '') }}">

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
                                        value="{{ old('waktu_selesai', $fryer->waktu_selesai ? substr($fryer->waktu_selesai, 0, 5) : '') }}">

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
                                        Petugas
                                    </label>

                                    <input type="text" name="petugas"
                                        class="form-control @error('petugas') is-invalid @enderror"
                                        placeholder="Nama Petugas" value="{{ old('petugas', $fryer->petugas) }}">

                                    @error('petugas')
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
                                        value="{{ old('pic_produksi', $fryer->pic_produksi) }}">

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
                                Keterangan
                            </label>

                            <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror"
                                placeholder="Keterangan tambahan">{{ old('keterangan', $fryer->keterangan) }}</textarea>

                            @error('keterangan')
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
                                Pastikan data produksi sudah sesuai sebelum disimpan.
                            </div>

                            <div class="action-buttons">

                                <a href="{{ route('operator.fryer.index') }}" class="btn btn-ghost">
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
                            '{{ old('production_batch_id', $fryer->production_batch_id) }}';

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
                '{{ old('tanggal_produksi', $fryer->productionBatch->tanggal_produksi?->format('Y-m-d')) }}';

            if (currentTanggal) {

                $('#tanggal_produksi')
                    .val(currentTanggal)
                    .trigger('change');

            }

        });
    </script>
@endpush
