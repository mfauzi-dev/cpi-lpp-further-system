@extends('layouts.master')

@section('title', 'Edit Metal Detector')

@section('content')

    <div class="page-section">

        <div class="section-header">
            <h1>Metal Detector</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.metal-detector.index') }}">
                        Metal Detector
                    </a>
                </div>

                <div class="breadcrumb-item active">
                    Edit Metal Detector
                </div>
            </div>
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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @php
                $metalDetectorData = $productionBatch->metalDetectors->values();
                $maxBagian = 10;
            @endphp

            <form action="{{ route('operator.metal-detector.update', $productionBatch->id) }}" method="POST"
                id="form-metal-detector">
                @csrf
                @method('PUT')

                <input type="hidden" name="production_batch_id"
                    value="{{ old('production_batch_id', $productionBatch->id) }}">

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

                                    <input type="date" name="tanggal_produksi" id="tanggal_produksi" class="form-control"
                                        value="{{ old('tanggal_produksi', $productionBatch->tanggal_produksi) }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label class="filter-label">
                                        Production Batch
                                    </label>

                                    <select name="production_batch_id_select" id="production_batch_id"
                                        class="form-control select2" style="width: 100%;">
                                        <option value="">
                                            -- Pilih Production Batch --
                                        </option>

                                        <option value="{{ $productionBatch->id }}" selected>
                                            {{ $productionBatch->no_batch }}
                                            -
                                            {{ $productionBatch->product->kode_product ?? '-' }}
                                            -
                                            {{ $productionBatch->line ?? '-' }}
                                        </option>
                                    </select>

                                    @error('production_batch_id')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="info-box">

                                    <div class="info-label">
                                        Product
                                    </div>

                                    <div class="info-value" id="product">
                                        {{ $productionBatch->product->kode_product ?? '-' }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="info-box">

                                    <div class="info-label">
                                        Line
                                    </div>

                                    <div class="info-value" id="line">
                                        {{ $productionBatch->line ?? '-' }}
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                @for ($i = 0; $i < $maxBagian; $i++)

                    @php
                        $item = $metalDetectorData->get($i);

                        $batchType = old("metal_detectors.$i.batch_type", $item->batch_type ?? null);

                        $metalDetector = old("metal_detectors.$i.metal_detector", $item->metal_detector ?? '');

                        $waktuAwal = old(
                            "metal_detectors.$i.waktu_awal",
                            $item && $item->waktu_awal ? substr($item->waktu_awal, 0, 5) : '',
                        );

                        $waktuAkhir = old(
                            "metal_detectors.$i.waktu_akhir",
                            $item && $item->waktu_akhir ? substr($item->waktu_akhir, 0, 5) : '',
                        );

                        if ($i === 0 && !$batchType) {
                            $batchType = 'FULL BATCH';
                        }
                    @endphp

                    <div class="card mb-4 metal-detector-card" id="card-bagian-{{ $i + 1 }}"
                        style="{{ $i > 0 ? 'display: none;' : '' }}">

                        <div class="card-header">
                            <h4>
                                <span class="step-badge">
                                    {{ $i + 2 }}
                                </span>

                                Metal Detector - Bagian {{ $i + 1 }}
                            </h4>
                        </div>

                        <div class="card-body">

                            <div class="form-group">

                                <label class="filter-label d-block mb-2">
                                    Tipe Batch
                                </label>

                                <div class="d-flex" style="gap: 1.5rem;">

                                    <div class="custom-control custom-radio">

                                        <input type="radio" id="batch_type_full_{{ $i }}"
                                            name="metal_detectors[{{ $i }}][batch_type]" value="FULL BATCH"
                                            class="custom-control-input" data-batch-index="{{ $i }}"
                                            {{ $batchType === 'FULL BATCH' ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="batch_type_full_{{ $i }}">
                                            FULL BATCH
                                        </label>

                                    </div>

                                    <div class="custom-control custom-radio">

                                        <input type="radio" id="batch_type_half_{{ $i }}"
                                            name="metal_detectors[{{ $i }}][batch_type]" value="HALF BATCH"
                                            class="custom-control-input" data-batch-index="{{ $i }}"
                                            {{ $batchType === 'HALF BATCH' ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="batch_type_half_{{ $i }}">
                                            HALF BATCH
                                        </label>

                                    </div>

                                </div>

                                @error("metal_detectors.$i.batch_type")
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label class="filter-label">
                                            Metal Detector
                                        </label>

                                        <select name="metal_detectors[{{ $i }}][metal_detector]"
                                            class="form-control">
                                            <option value="">
                                                -- Pilih --
                                            </option>

                                            @foreach (['1', '2', '3', '4', '5', '6'] as $md)
                                                <option value="{{ $md }}"
                                                    {{ (string) $metalDetector === (string) $md ? 'selected' : '' }}>
                                                    {{ $md }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error("metal_detectors.$i.metal_detector")
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label class="filter-label">
                                            Waktu Awal
                                        </label>

                                        <input type="time" name="metal_detectors[{{ $i }}][waktu_awal]"
                                            class="form-control" value="{{ $waktuAwal }}">

                                        @error("metal_detectors.$i.waktu_awal")
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-0">

                                        <label class="filter-label">
                                            Waktu Akhir
                                        </label>

                                        <input type="time" name="metal_detectors[{{ $i }}][waktu_akhir]"
                                            class="form-control" value="{{ $waktuAkhir }}">

                                        @error("metal_detectors.$i.waktu_akhir")
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                @endfor

                <div class="card card-final mb-4">

                    <div class="card-footer bg-white border-top">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div class="section-info mb-2 mb-md-0">
                                <i class="fas fa-info-circle"></i>
                                Pastikan data Metal Detector sudah sesuai sebelum disimpan.
                            </div>

                            <div class="action-buttons">

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>
                                    Simpan Perubahan
                                </button>

                                <a href="{{ route('operator.metal-detector.index') }}" class="btn btn-ghost">
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
            }

            function loadProductionBatches(date, selectedId = null) {

                if (!date) {
                    $('#production_batch_id')
                        .empty()
                        .append(
                            '<option value="">-- Pilih Production Batch --</option>'
                        )
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
                            .append(
                                '<option value="">-- Pilih Production Batch --</option>'
                            );

                        batches.forEach(function(batch) {

                            const option = new Option(
                                batch.no_batch +
                                ' - ' +
                                batch.product +
                                ' - ' +
                                batch.line,
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
                            .append(
                                '<option value="">-- Pilih Production Batch --</option>'
                            )
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
                    },

                    error: function() {
                        resetProductionBatchInfo();
                    }
                });
            });

            $('#tanggal_produksi').on('change', function() {

                const date = $(this).val();

                if (!date) {
                    resetProductionBatchInfo();
                    return;
                }

                loadProductionBatches(date, null);
            });

            const currentDate = $('#tanggal_produksi').val();
            const currentBatchId = '{{ old('production_batch_id', $productionBatch->id) }}';

            if (currentDate) {
                loadProductionBatches(
                    currentDate,
                    currentBatchId
                );
            }

            function clearSection(index) {

                $('input[name="metal_detectors[' + index + '][batch_type]"]')
                    .prop('checked', false);

                $('select[name="metal_detectors[' + index + '][metal_detector]"]')
                    .val('');

                $('input[name="metal_detectors[' + index + '][waktu_awal]"]')
                    .val('');

                $('input[name="metal_detectors[' + index + '][waktu_akhir]"]')
                    .val('');
            }

            function setSectionDisabled(index, disabled) {

                const card = $('#card-bagian-' + (index + 1));

                card.find('input, select')
                    .prop('disabled', disabled);

                if (disabled) {
                    card.hide();
                } else {
                    card.show();
                }
            }

            function updateSections() {

                const totalSections = {{ $maxBagian }};
                let previousIsHalf = true;

                for (let i = 0; i < totalSections; i++) {

                    if (i === 0) {

                        setSectionDisabled(i, false);

                        const firstValue = $(
                            'input[name="metal_detectors[0][batch_type]"]:checked'
                        ).val();

                        previousIsHalf = firstValue === 'HALF BATCH';

                    } else {

                        if (previousIsHalf) {

                            setSectionDisabled(i, false);

                            const currentValue = $(
                                'input[name="metal_detectors[' +
                                i +
                                '][batch_type]"]:checked'
                            ).val();

                            previousIsHalf = currentValue === 'HALF BATCH';

                        } else {

                            setSectionDisabled(i, true);
                            clearSection(i);

                            previousIsHalf = false;
                        }
                    }
                }
            }

            $('input[data-batch-index]').on('change', function() {
                updateSections();
            });

            updateSections();

        });
    </script>
@endpush
