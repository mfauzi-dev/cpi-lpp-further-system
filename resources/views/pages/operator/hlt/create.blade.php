@extends('layouts.master')

@section('title', 'Tambah HLT')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>HLT</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.hlt.index') }}">

                        HLT

                    </a>

                </div>

                <div class="breadcrumb-item active">

                    Tambah HLT

                </div>

            </div>

        </div>

        <div class="section-body">

            @if ($errors->any())

                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    <div class="font-weight-bold mb-1">

                        Terdapat kesalahan pada input data.

                    </div>

                    <ul class="mb-0 pl-3">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

            @endif

            <form action="{{ route('operator.hlt.store') }}" method="POST">

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

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Tanggal Produksi

                                    </label>

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi', date('Y-m-d')) }}">

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
                                        class="form-control select2 @error('production_batch_id') is-invalid @enderror">

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

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">

                                        Product

                                    </div>

                                    <div class="info-value" id="product">

                                        -

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">

                                        Line

                                    </div>

                                    <div class="info-value" id="line">

                                        -

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 mb-3">

                                <div class="info-box">

                                    <div class="info-label">

                                        Waktu Kerja

                                    </div>

                                    <div class="info-value">

                                        <span id="waktu_kerja">-</span>

                                        <span id="waktu_kerja_unit"></span>

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

                            Parameter HLT

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Suhu Awal Daging (°C)

                                    </label>

                                    <input type="number" name="suhu_awal_daging" step="0.01"
                                        class="form-control @error('suhu_awal_daging') is-invalid @enderror"
                                        placeholder="Cth: 5.50" value="{{ old('suhu_awal_daging') }}">

                                    @error('suhu_awal_daging')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Suhu Infeed (°C)

                                    </label>

                                    <input type="number" name="suhu_infeed" step="0.01"
                                        class="form-control @error('suhu_infeed') is-invalid @enderror"
                                        placeholder="Cth: 75.00" value="{{ old('suhu_infeed') }}">

                                    @error('suhu_infeed')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Suhu Outfeed (°C)

                                    </label>

                                    <input type="number" name="suhu_outfeed" step="0.01"
                                        class="form-control @error('suhu_outfeed') is-invalid @enderror"
                                        placeholder="Cth: 80.00" value="{{ old('suhu_outfeed') }}">

                                    @error('suhu_outfeed')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Steam Valve

                                    </label>

                                    <input type="number" name="steam_valve" step="0.01"
                                        class="form-control @error('steam_valve') is-invalid @enderror"
                                        placeholder="Cth: 50.00" value="{{ old('steam_valve') }}">

                                    @error('steam_valve')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Speed Ventilator

                                    </label>

                                    <input type="number" name="speed_ventilator" step="0.01"
                                        class="form-control @error('speed_ventilator') is-invalid @enderror"
                                        placeholder="Cth: 60.00" value="{{ old('speed_ventilator') }}">

                                    @error('speed_ventilator')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Lama Pemasakan (Menit)

                                    </label>

                                    <input type="number" name="lama_pemasakan" step="0.01" min="0"
                                        class="form-control @error('lama_pemasakan') is-invalid @enderror"
                                        placeholder="Cth: 30" value="{{ old('lama_pemasakan') }}">

                                    @error('lama_pemasakan')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Suhu Pusat CT (°C)

                                    </label>

                                    <input type="number" name="suhu_pusat_ct" step="0.01"
                                        class="form-control @error('suhu_pusat_ct') is-invalid @enderror"
                                        placeholder="Cth: 75.00" value="{{ old('suhu_pusat_ct') }}">

                                    @error('suhu_pusat_ct')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="filter-label">

                                        Organoleptik

                                    </label>

                                    <input type="text" name="organoleptik"
                                        class="form-control @error('organoleptik') is-invalid @enderror"
                                        placeholder="Cth: Normal" value="{{ old('organoleptik') }}">

                                    @error('organoleptik')
                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="form-group mb-0">

                            <label class="filter-label">

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
                                        value="{{ old('waktu_mulai') }}">

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
                                        placeholder="Nama Petugas" value="{{ old('petugas') }}">

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
                                        placeholder="Nama PIC Produksi" value="{{ old('pic_produksi') }}">

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

                            <textarea name="keterangan" rows="4" class="form-control @error('keterangan') is-invalid @enderror"
                                placeholder="Keterangan tambahan">{{ old('keterangan') }}</textarea>

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

                                Pastikan data HLT sudah sesuai sebelum disimpan.

                            </div>

                            <div class="action-buttons">

                                <button type="submit" class="btn btn-primary">

                                    <i class="fas fa-save mr-1"></i>

                                    Simpan

                                </button>

                                <a href="{{ route('operator.hlt.index') }}" class="btn btn-ghost">

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

            function loadProductionBatches(date, selectedId = null) {

                $('#production_batch_id').empty();

                $('#production_batch_id').append(
                    '<option value="">-- Pilih Production Batch --</option>'
                );

                $('#product').text('-');
                $('#line').text('-');
                $('#waktu_kerja').text('-');
                $('#waktu_kerja_unit').text('');

                if (!date) {

                    $('#production_batch_id').trigger('change');

                    return;

                }

                $.ajax({

                    url: "{{ url('production-batch/by-date') }}/" + date,
                    type: 'GET',
                    dataType: 'json',

                    success: function(data) {

                        if (data.length === 0) {

                            $('#production_batch_id').append(
                                '<option value="">Tidak ada Production Batch</option>'
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
                                    '<option value="' + batch.id + '" ' + selected + '>' +
                                    batch.no_batch +
                                    ' - ' +
                                    batch.product +
                                    ' - ' +
                                    batch.line +
                                    '</option>'
                                );

                            });

                        }

                        $('#production_batch_id').trigger('change');

                    },

                    error: function() {

                        $('#production_batch_id').append(
                            '<option value="">Gagal mengambil Production Batch</option>'
                        );

                        $('#production_batch_id').trigger('change');

                    }

                });

            }

            $('#tanggal_produksi').on('change', function() {

                loadProductionBatches($(this).val());

            });

            $('#production_batch_id').on('change', function() {

                let selectedId = $(this).val();

                if (!selectedId) {

                    $('#product').text('-');
                    $('#line').text('-');
                    $('#waktu_kerja').text('-');
                    $('#waktu_kerja_unit').text('');

                    return;

                }

                let selectedText = $(this).find('option:selected').text();

                let parts = selectedText.split(' - ');

                $('#product').text(parts[1] ?? '-');
                $('#line').text(parts[2] ?? '-');

                let date = $('#tanggal_produksi').val();

                if (!date) {

                    return;

                }

                $.ajax({

                    url: "{{ url('production-batch/by-date') }}/" + date,
                    type: 'GET',
                    dataType: 'json',

                    success: function(data) {

                        let batch = data.find(function(item) {

                            return String(item.id) === String(selectedId);

                        });

                        if (batch) {

                            $('#product').text(batch.product ?? '-');
                            $('#line').text(batch.line ?? '-');

                            if (batch.waktu_kerja !== null) {

                                $('#waktu_kerja').text(batch.waktu_kerja);
                                $('#waktu_kerja_unit').text(' Menit');

                            } else {

                                $('#waktu_kerja').text('-');
                                $('#waktu_kerja_unit').text('');

                            }

                        }

                    }

                });

            });

            let oldBatchId = "{{ old('production_batch_id') }}";

            let currentDate = $('#tanggal_produksi').val();

            if (currentDate) {

                loadProductionBatches(
                    currentDate,
                    oldBatchId ? oldBatchId : null
                );

            }

        });
    </script>
@endpush
