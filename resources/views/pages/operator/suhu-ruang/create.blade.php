@extends('layouts.master')

@section('title', 'Tambah Suhu Ruang')

@push('addon-style')
    <style>
        :root {
            --sr-primary: #1B4B43;
            --sr-primary-light: #E8F0EE;
            --sr-accent: #D98C3D;
            --sr-border: #E3E7E1;
            --sr-text: #1F2A24;
            --sr-muted: #5B6A62;
            --sr-soft: #F7F9F7;
        }

        .suhu-ruang-form .card {
            border: none;
            border-left: 4px solid var(--sr-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, 0.06), 0 1px 2px rgba(15, 30, 25, 0.04);
            overflow: hidden;
        }

        .suhu-ruang-form .card.card-accent,
        .suhu-ruang-form .card.card-final {
            border-left-color: var(--sr-accent);
        }

        .suhu-ruang-form .card-header {
            background: #fff;
            border-bottom: 1px solid var(--sr-border);
            padding: 1rem 1.5rem;
        }

        .suhu-ruang-form .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--sr-text);
            display: flex;
            align-items: center;
        }

        .suhu-ruang-form .card-body {
            padding: 1.5rem;
        }

        .suhu-ruang-form .step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--sr-primary);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .suhu-ruang-form .filter-label {
            color: var(--sr-text);
            font-size: 0.78rem;
            font-weight: 600;
            margin-bottom: 0.45rem;
        }

        .suhu-ruang-form .info-box {
            height: 100%;
            background: var(--sr-soft);
            border: 1px solid var(--sr-border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
        }

        .suhu-ruang-form .info-label {
            color: var(--sr-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.35rem;
        }

        .suhu-ruang-form .info-value {
            color: var(--sr-text);
            font-size: 0.95rem;
            font-weight: 600;
            min-height: 22px;
        }

        .suhu-ruang-form .section-info {
            background: var(--sr-primary-light);
            border: 1px solid var(--sr-border);
            border-radius: 8px;
            padding: 0.85rem 1rem;
            color: var(--sr-text);
            font-size: 0.875rem;
        }

        .suhu-ruang-form .section-info i {
            color: var(--sr-primary);
            margin-right: 0.45rem;
        }

        .suhu-ruang-form .btn-ghost {
            color: var(--sr-muted);
            background: transparent;
            border: 1px solid var(--sr-border);
        }

        .suhu-ruang-form .btn-primary {
            background: var(--sr-primary);
            border-color: var(--sr-primary);
        }
    </style>
@endpush

@section('content')

    <div class="page-section suhu-ruang-form">

        <div class="section-header">
            <h1>Suhu Ruang</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.suhu-ruang.index') }}">Suhu Ruang</a>
                </div>
                <div class="breadcrumb-item active">Tambah</div>
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

            <form action="{{ route('operator.suhu-ruang.store') }}" method="POST" id="form-suhu-ruang">
                @csrf

                <div class="card mb-4">

                    <div class="card-header">
                        <h4><span class="step-badge">1</span> Informasi Produksi</h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="filter-label">
                                        Tanggal Produksi <span class="text-danger">*</span>
                                    </label>

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi') }}" required>

                                    @error('tanggal_produksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="filter-label">
                                        Production Batch <span class="text-danger">*</span>
                                    </label>

                                    <select name="production_batch_id" id="production_batch_id"
                                        class="form-control select2 @error('production_batch_id') is-invalid @enderror"
                                        required>
                                        <option value="">Pilih Production Batch</option>
                                    </select>

                                    @error('production_batch_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <div class="info-label">Product</div>
                                    <div class="info-value" id="batch_product">-</div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <div class="info-label">Line</div>
                                    <div class="info-value" id="batch_line">-</div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <div class="info-label">Waktu Kerja</div>
                                    <div class="info-value" id="batch_waktu_kerja">-</div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card card-accent mb-4">

                    <div class="card-header">
                        <h4><span class="step-badge">2</span> Parameter Suhu Ruang</h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="filter-label">Suhu Ruang Meatprep</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="suhu_ruang_meatprep"
                                        class="form-control @error('suhu_ruang_meatprep') is-invalid @enderror"
                                        placeholder="Masukkan suhu ruang meatprep" value="{{ old('suhu_ruang_meatprep') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">°C</span>
                                    </div>
                                </div>
                                @error('suhu_ruang_meatprep')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="filter-label">Suhu Ruang Chillroom</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="suhu_ruang_chillroom"
                                        class="form-control @error('suhu_ruang_chillroom') is-invalid @enderror"
                                        placeholder="Masukkan suhu ruang chillroom"
                                        value="{{ old('suhu_ruang_chillroom') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">°C</span>
                                    </div>
                                </div>
                                @error('suhu_ruang_chillroom')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card mb-4">

                    <div class="card-header">
                        <h4><span class="step-badge">3</span> Waktu Proses</h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <div class="form-group mb-0">
                                    <label class="filter-label">Waktu Mulai</label>
                                    <input type="time" name="waktu_mulai"
                                        class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        value="{{ old('waktu_mulai') }}">
                                    @error('waktu_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group mb-0">
                                    <label class="filter-label">Waktu Selesai</label>
                                    <input type="time" name="waktu_selesai"
                                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        value="{{ old('waktu_selesai') }}">
                                    @error('waktu_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group mb-0">
                                    <label class="filter-label">Downtime</label>
                                    <input type="text" name="downtime"
                                        class="form-control @error('downtime') is-invalid @enderror"
                                        placeholder="Cth: 15 menit" value="{{ old('downtime') }}">
                                    @error('downtime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card card-final">

                    <div class="card-header">
                        <h4><span class="step-badge">4</span> Petugas & Keterangan</h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="filter-label">Petugas</label>
                                    <input type="text" name="petugas"
                                        class="form-control @error('petugas') is-invalid @enderror"
                                        placeholder="Nama Petugas" value="{{ old('petugas') }}">
                                    @error('petugas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="filter-label">Line</label>
                                    <input type="text" name="line"
                                        class="form-control @error('line') is-invalid @enderror"
                                        placeholder="Contoh: Line 1" value="{{ old('line') }}">
                                    @error('line')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="filter-label">PIC Produksi</label>
                                    <input type="text" name="pic_produksi"
                                        class="form-control @error('pic_produksi') is-invalid @enderror"
                                        placeholder="Nama PIC Produksi" value="{{ old('pic_produksi') }}">
                                    @error('pic_produksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-0">
                            <label class="filter-label">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror"
                                placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                                <a href="{{ route('operator.suhu-ruang.index') }}" class="btn btn-ghost">
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
                            batchSelect.val(oldBatchId).trigger('change');
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

                $('#batch_product').text(selected.data('product') || '-');
                $('#batch_line').text(selected.data('line') || '-');

                const waktuKerja = selected.data('waktu-kerja');

                if (waktuKerja !== '' && waktuKerja !== null && waktuKerja !== undefined) {
                    $('#batch_waktu_kerja').text(waktuKerja + ' menit');
                } else {
                    $('#batch_waktu_kerja').text('-');
                }

            });

            const oldTanggal = '{{ old('tanggal_produksi') }}';

            if (oldTanggal) {
                $('#tanggal_produksi').val(oldTanggal).trigger('change');
            } else {
                const today = new Date().toISOString().split('T')[0];
                $('#tanggal_produksi').val(today).trigger('change');
            }

        });
    </script>
@endpush
