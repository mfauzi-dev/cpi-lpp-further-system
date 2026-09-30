@extends('layouts.master')

@section('title', 'Edit Batter')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Batter</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.batter.index') }}">

                        Batter

                    </a>

                </div>

                <div class="breadcrumb-item active">

                    Edit Batter

                </div>

            </div>

        </div>

        <div class="section-lead">

            Ubah data proses produksi Batter berdasarkan production batch dan parameter proses.

        </div>

        <div class="section-body">

            @if ($errors->any())

                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    <strong>Periksa kembali data yang diinput.</strong>

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

            <form action="{{ route('operator.batter.update', $batter->id) }}" method="POST" id="form-batter">

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

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Tanggal Produksi

                                    </label>

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi', $batter->productionBatch?->tanggal_produksi ? \Carbon\Carbon::parse($batter->productionBatch->tanggal_produksi)->format('Y-m-d') : '') }}">

                                    @error('tanggal_produksi')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Production Batch

                                    </label>

                                    <select name="production_batch_id" id="production_batch_id"
                                        class="form-control select2 @error('production_batch_id') is-invalid @enderror"
                                        style="width: 100%;">

                                        <option value="">-- Pilih Production Batch --</option>

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

                                    <div class="info-value" id="product">

                                        {{ $batter->productionBatch->product->nama ?? '-' }}

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">

                                        Line

                                    </div>

                                    <div class="info-value" id="line">

                                        {{ $batter->productionBatch->line ?? '-' }}

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">

                                        Waktu Kerja

                                    </div>

                                    <div class="info-value">

                                        <span id="waktu_kerja">

                                            {{ $batter->productionBatch->waktu_kerja ?? '-' }}

                                        </span>

                                        @if ($batter->productionBatch?->waktu_kerja !== null)
                                            <span id="waktu_kerja_unit">

                                                Menit

                                            </span>
                                        @else
                                            <span id="waktu_kerja_unit"></span>
                                        @endif

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

                            Parameter Batter

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="filter-label">
                                        Batter
                                    </label>

                                    <input type="text" name="batter"
                                        class="form-control @error('batter') is-invalid @enderror"
                                        placeholder="Masukkan batter" value="{{ old('batter', $batter->batter) }}">

                                    @error('batter')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Suhu Batter

                                    </label>

                                    <div class="input-group">

                                        <input type="number" step="0.01" name="suhu_batter"
                                            class="form-control @error('suhu_batter') is-invalid @enderror"
                                            placeholder="Masukkan suhu batter"
                                            value="{{ old('suhu_batter', $batter->suhu_batter) }}">

                                        <div class="input-group-append">

                                            <span class="input-group-text">

                                                °C

                                            </span>

                                        </div>

                                        @error('suhu_batter')
                                            <div class="invalid-feedback">

                                                {{ $message }}

                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Viskositas

                                    </label>

                                    <input type="number" step="0.01" name="viskositas"
                                        class="form-control @error('viskositas') is-invalid @enderror"
                                        placeholder="Masukkan viskositas"
                                        value="{{ old('viskositas', $batter->viskositas) }}">

                                    @error('viskositas')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Salinity

                                    </label>

                                    <input type="number" step="0.01" name="salinity"
                                        class="form-control @error('salinity') is-invalid @enderror"
                                        placeholder="Masukkan salinity" value="{{ old('salinity', $batter->salinity) }}">

                                    @error('salinity')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Downtime

                                    </label>

                                    <input type="text" name="downtime"
                                        class="form-control @error('downtime') is-invalid @enderror"
                                        placeholder="Cth: 10 menit, mesin macet"
                                        value="{{ old('downtime', $batter->downtime) }}">

                                    @error('downtime')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

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

                            <div class="col-md-6">

                                <div class="form-group mb-md-0">

                                    <label class="filter-label">

                                        Waktu Mulai

                                    </label>

                                    <input type="time" name="waktu_mulai"
                                        class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        value="{{ old('waktu_mulai', $batter->waktu_mulai ? \Carbon\Carbon::parse($batter->waktu_mulai)->format('H:i') : '') }}">

                                    @error('waktu_mulai')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group mb-0">

                                    <label class="filter-label">

                                        Waktu Selesai

                                    </label>

                                    <input type="time" name="waktu_selesai"
                                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        value="{{ old('waktu_selesai', $batter->waktu_selesai ? \Carbon\Carbon::parse($batter->waktu_selesai)->format('H:i') : '') }}">

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

                <div class="card card-final mb-4">

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
                                        placeholder="Nama Petugas" value="{{ old('petugas', $batter->petugas) }}">

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
                                        value="{{ old('pic_produksi', $batter->pic_produksi) }}">

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
                                placeholder="Keterangan tambahan">{{ old('keterangan', $batter->keterangan) }}</textarea>

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

                                Pastikan perubahan data Batter sudah sesuai.

                            </div>

                            <div class="action-buttons">

                                <button type="submit" class="btn btn-primary">

                                    <i class="fas fa-save mr-1"></i>

                                    Update

                                </button>

                                <a href="{{ route('operator.batter.index') }}" class="btn btn-ghost">

                                    <i class="fas fa-arrow-left mr-1"></i>

                                    Batal

                                </a>

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

            $('#production_batch_id').select2({
                width: '100%',
                placeholder: '-- Pilih Production Batch --',
                allowClear: true
            });

            function resetProductionBatchInfo() {

                $('#product').text('-');
                $('#line').text('-');
                $('#waktu_kerja').text('-');
                $('#waktu_kerja_unit').text('');

            }

            function loadProductionBatches(date, selectedId = null) {

                if (!date) {

                    $('#production_batch_id')
                        .empty()
                        .append('<option value="">-- Pilih Production Batch --</option>')
                        .val(null)
                        .trigger('change');

                    resetProductionBatchInfo();

                    return;

                }

                $.ajax({

                    url: '{{ url('production-batch/by-date') }}/' + date,

                    type: 'GET',

                    dataType: 'json',

                    success: function(batches) {

                        $('#production_batch_id')
                            .empty()
                            .append('<option value="">-- Pilih Production Batch --</option>');

                        batches.forEach(function(batch) {

                            const option = new Option(
                                batch.no_batch + ' - ' + batch.product + ' - ' + batch.line,
                                batch.id,
                                false,
                                String(batch.id) === String(selectedId)
                            );

                            $('#production_batch_id').append(option);

                        });

                        if (selectedId) {

                            $('#production_batch_id')
                                .val(String(selectedId))
                                .trigger('change');

                        } else {

                            $('#production_batch_id')
                                .val(null)
                                .trigger('change');

                        }

                    },

                    error: function() {

                        $('#production_batch_id')
                            .empty()
                            .append('<option value="">-- Pilih Production Batch --</option>')
                            .val(null)
                            .trigger('change');

                        resetProductionBatchInfo();

                        alert('Gagal mengambil data Production Batch.');

                    }

                });

            }

            $('#production_batch_id').on('change', function() {

                const selectedId = $(this).val();

                if (!selectedId) {

                    resetProductionBatchInfo();

                    return;

                }

                const date = $('#tanggal_produksi').val();

                if (!date) {

                    resetProductionBatchInfo();

                    return;

                }

                $.ajax({

                    url: '{{ url('production-batch/by-date') }}/' + date,

                    type: 'GET',

                    dataType: 'json',

                    success: function(batches) {

                        const batch = batches.find(function(item) {

                            return String(item.id) === String(selectedId);

                        });

                        if (!batch) {

                            resetProductionBatchInfo();

                            return;

                        }

                        $('#product').text(batch.product || '-');

                        $('#line').text(batch.line || '-');

                        if (batch.waktu_kerja !== null) {

                            $('#waktu_kerja').text(batch.waktu_kerja);
                            $('#waktu_kerja_unit').text(' Menit');

                        } else {

                            $('#waktu_kerja').text('-');
                            $('#waktu_kerja_unit').text('');

                        }

                    },

                    error: function() {

                        resetProductionBatchInfo();

                    }

                });

            });

            $('#tanggal_produksi').on('change', function() {

                loadProductionBatches($(this).val());

            });

            const currentDate = $('#tanggal_produksi').val();

            const currentBatchId = '{{ old('production_batch_id', $batter->production_batch_id) }}';

            if (currentDate) {

                loadProductionBatches(currentDate, currentBatchId);

            }

        });
    </script>
@endpush
