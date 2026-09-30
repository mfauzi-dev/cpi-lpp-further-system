@extends('layouts.master')

@section('title', 'Edit Mixing')

@section('content')

    <div class="page-section">
        <div class="section-header">
            <h1>Mixing</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.mixing.index') }}">
                        Mixing
                    </a>
                </div>
                <div class="breadcrumb-item active">
                    Edit
                </div>
            </div>
        </div>

        <div class="section-lead">
            Ubah data proses produksi Mixing berdasarkan production batch dan parameter proses.
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

            <form action="{{ route('operator.mixing.update', $mixing->id) }}" method="POST" id="form-mixing">

                @csrf
                @method('PUT')

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
                                    value="{{ old('tanggal_produksi', $mixing->productionBatch?->tanggal_produksi?->format('Y-m-d')) }}"
                                    required>

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
                            Parameter Mixing
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>
                                    Mixer Preparation
                                </label>

                                <input type="text" name="mixer_preparation"
                                    class="form-control @error('mixer_preparation') is-invalid @enderror"
                                    placeholder="Cth: Mixer Preparation 1"
                                    value="{{ old('mixer_preparation', $mixing->mixer_preparation) }}">

                                @error('mixer_preparation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Mixer
                                </label>

                                <select name="mixer" class="form-control @error('mixer') is-invalid @enderror">

                                    <option value="">
                                        Pilih Mixer
                                    </option>

                                    <option value="Unimix" {{ old('mixer', $mixing->mixer) == 'Unimix' ? 'selected' : '' }}>
                                        Unimix
                                    </option>

                                    <option value="Inotec" {{ old('mixer', $mixing->mixer) == 'Inotec' ? 'selected' : '' }}>
                                        Inotec
                                    </option>

                                </select>

                                @error('mixer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>
                                    Suhu Air (°C)
                                </label>

                                <input type="number" name="suhu_air"
                                    class="form-control @error('suhu_air') is-invalid @enderror" step="0.01"
                                    placeholder="Cth: 10.5" value="{{ old('suhu_air', $mixing->suhu_air) }}">

                                @error('suhu_air')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Lama Pengadukan (Menit)
                                </label>

                                <input type="number" name="lama_pengadukan"
                                    class="form-control @error('lama_pengadukan') is-invalid @enderror" step="0.01"
                                    min="0" placeholder="Cth: 15"
                                    value="{{ old('lama_pengadukan', $mixing->lama_pengadukan) }}">

                                @error('lama_pengadukan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>
                                    Filter
                                </label>

                                <input type="text" name="filter"
                                    class="form-control @error('filter') is-invalid @enderror"
                                    placeholder="Cth: Filter 80 mesh" value="{{ old('filter', $mixing->filter) }}">

                                @error('filter')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Salinity (%)
                                </label>

                                <input type="number" name="salinity"
                                    class="form-control @error('salinity') is-invalid @enderror" step="0.01"
                                    min="0" placeholder="Cth: 1.50"
                                    value="{{ old('salinity', $mixing->salinity) }}">

                                @error('salinity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>
                                    Brix
                                </label>

                                <input type="number" name="brix"
                                    class="form-control @error('brix') is-invalid @enderror" step="0.01"
                                    min="0" placeholder="Cth: 10" value="{{ old('brix', $mixing->brix) }}">

                                @error('brix')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    Suhu Adonan (°C)
                                </label>

                                <input type="number" name="suhu_adonan"
                                    class="form-control @error('suhu_adonan') is-invalid @enderror" step="0.01"
                                    placeholder="Cth: 12.5" value="{{ old('suhu_adonan', $mixing->suhu_adonan) }}">

                                @error('suhu_adonan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group mb-0">
                            <label>
                                Downtime
                            </label>

                            <input type="text" name="downtime"
                                class="form-control @error('downtime') is-invalid @enderror"
                                placeholder="Cth: 10 menit, mesin macet"
                                value="{{ old('downtime', $mixing->downtime) }}">

                            @error('downtime')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                    value="{{ old('waktu_mulai', $mixing->waktu_mulai ? \Carbon\Carbon::parse($mixing->waktu_mulai)->format('H:i') : '') }}">

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
                                    value="{{ old('waktu_selesai', $mixing->waktu_selesai ? \Carbon\Carbon::parse($mixing->waktu_selesai)->format('H:i') : '') }}">

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
                                    placeholder="Nama Petugas" value="{{ old('petugas', $mixing->petugas) }}">

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
                                    placeholder="Nama PIC Produksi"
                                    value="{{ old('pic_produksi', $mixing->pic_produksi) }}">

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
                                    placeholder="Keterangan tambahan">{{ old('keterangan', $mixing->keterangan) }}</textarea>

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
                                Pastikan perubahan data Mixing sudah sesuai sebelum disimpan.
                            </div>

                            <div class="action-buttons">

                                <a href="{{ route('operator.mixing.detail', $mixing->id) }}" class="btn btn-ghost">
                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="btn btn-add">
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

            const currentBatchId = "{{ old('production_batch_id', $mixing->production_batch_id) }}";

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

            const currentDate = $('#tanggal_produksi').val();

            if (currentDate) {
                $('#tanggal_produksi').trigger('change');
            }

        });
    </script>
@endpush
