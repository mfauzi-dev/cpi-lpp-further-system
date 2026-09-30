@extends('layouts.master')

@section('title', 'Detail Produksi Bahan Baku')

@section('content')

    <div class="page-section">

        <div class="section-header">

            <h1>Produksi Bahan Baku</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item">

                    <a href="{{ route('operator.production.index') }}">

                        Produksi Bahan Baku

                    </a>

                </div>

                <div class="breadcrumb-item active">

                    Detail

                </div>

            </div>

        </div>

        <p class="section-lead">

            Detail pencatatan produksi bahan baku berdasarkan production batch dan jenis proses.

        </p>

        <div class="section-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('success') }}

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

            {{-- INFORMASI PRODUKSI --}}

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">1</span>

                        Informasi Produksi

                    </h4>

                </div>

                <div class="card-body">

                    {{-- Batch Highlight --}}

                    <div class="batch-highlight">

                        <div class="row align-items-center">

                            <div class="col-md-8">

                                <div class="batch-label">

                                    Production Batch

                                </div>

                                <div class="batch-number">

                                    {{ $production->productionBatch->no_batch ?? '-' }}

                                </div>

                                <div class="batch-product">

                                    {{ $production->productionBatch->product->nama ?? '-' }}

                                </div>

                            </div>

                            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                                <div class="batch-label">

                                    Tanggal Produksi

                                </div>

                                <div class="batch-number batch-date">

                                    {{ $production->productionBatch?->tanggal_produksi
                                        ? $production->productionBatch->tanggal_produksi->format('d M Y')
                                        : '-' }}

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Informasi Batch --}}

                    <div class="row">

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">

                                    Tanggal Produksi

                                </div>

                                <div class="info-value">

                                    {{ $production->productionBatch?->tanggal_produksi
                                        ? $production->productionBatch->tanggal_produksi->format('d M Y')
                                        : '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">

                                    No Batch

                                </div>

                                <div class="info-value">

                                    {{ $production->productionBatch->no_batch ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">

                                    Product

                                </div>

                                <div class="info-value">

                                    {{ $production->productionBatch->product->nama ?? '-' }}

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 mb-3">

                            <div class="info-box">

                                <div class="info-label">

                                    Line

                                </div>

                                <div class="info-value">

                                    {{ $production->productionBatch->line ?? '-' }}

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Statistic --}}

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-clock"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Waktu Kerja

                                    </div>

                                    <div class="stat-value">

                                        {{ $production->productionBatch?->waktu_kerja !== null
                                            ? $production->productionBatch->waktu_kerja . ' Menit'
                                            : '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-project-diagram"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Jenis Proses

                                    </div>

                                    <div class="stat-value">

                                        {{ $production->processType->name ?? '-' }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <div class="stat-card">

                                <div class="stat-icon">

                                    <i class="fas fa-boxes"></i>

                                </div>

                                <div>

                                    <div class="stat-label">

                                        Jumlah Produk

                                    </div>

                                    <div class="stat-value">

                                        {{ $production->details->count() }} Produk

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- DATA PRODUK --}}

            <div class="card mb-4">

                <div class="card-header">

                    <h4>

                        <span class="step-badge">2</span>

                        Data Produk

                    </h4>

                </div>

                <div class="card-body">

                    <form id="bulkDeleteForm" action="{{ route('operator.production.bulk-destroy') }}" method="POST">

                        @csrf

                        @method('DELETE')

                        <div class="table-responsive">

                            <table class="table table-bordered table-wide">

                                <thead>

                                    <tr>

                                        <th width="50" class="text-center">

                                            <input type="checkbox" id="checkAll">

                                        </th>

                                        <th width="60" class="text-center">

                                            No

                                        </th>

                                        <th>

                                            Kode Produk

                                        </th>

                                        <th>

                                            Nama Produk

                                        </th>

                                        <th>

                                            Kode Batch

                                        </th>

                                        <th>

                                            Suhu (°C)

                                        </th>

                                        <th>

                                            Berat (Kg)

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($production->details as $index => $detail)
                                        <tr>

                                            <td class="text-center align-middle">

                                                <input type="checkbox" name="ids[]" value="{{ $detail->id }}"
                                                    class="detail-checkbox">

                                            </td>

                                            <td class="text-center font-weight-bold">

                                                {{ $index + 1 }}

                                            </td>

                                            <td>

                                                @if ($detail->product)
                                                    <span class="badge-soft">

                                                        {{ $detail->product->kode_product ?? '-' }}

                                                    </span>
                                                @else
                                                    <span class="value-empty">-</span>
                                                @endif

                                            </td>

                                            <td>

                                                {{ $detail->product->nama ?? '-' }}

                                            </td>

                                            <td>

                                                @if ($detail->kode_batch)
                                                    <span class="badge-value">

                                                        {{ $detail->kode_batch }}

                                                    </span>
                                                @else
                                                    <span class="value-empty">-</span>
                                                @endif

                                            </td>

                                            <td>

                                                @if ($detail->suhu !== null)
                                                    {{ $detail->suhu }} °C
                                                @else
                                                    <span class="value-empty">-</span>
                                                @endif

                                            </td>

                                            <td>

                                                @if ($detail->berat_kg !== null)
                                                    <strong>

                                                        {{ number_format($detail->berat_kg, 2, ',', '.') }}

                                                    </strong>

                                                    Kg
                                                @else
                                                    <span class="value-empty">-</span>
                                                @endif

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="7">

                                                <div class="empty-state">

                                                    <i class="fas fa-box-open d-block"></i>

                                                    <div>

                                                        Belum ada data produk.

                                                    </div>

                                                </div>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                                @if ($production->details->count() > 0)
                                    <tfoot>

                                        <tr>

                                            <td colspan="6" class="text-right font-weight-bold">

                                                Total Bahan Baku

                                            </td>

                                            <td class="font-weight-bold">

                                                {{ number_format($production->total_bahan_baku ?? 0, 2, ',', '.') }}

                                                Kg

                                            </td>

                                        </tr>

                                    </tfoot>
                                @endif

                            </table>

                        </div>

                    </form>

                </div>

            </div>

            {{-- ACTION --}}

            <div class="card card-final">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div>

                            <div class="info-label mb-1">

                                Total Bahan Baku

                            </div>

                            <div class="stat-value">

                                {{ number_format($production->total_bahan_baku ?? 0, 2, ',', '.') }}

                                Kg

                            </div>

                        </div>

                        <div class="mt-3 mt-md-0">

                            <a href="{{ route('operator.production.index') }}" class="btn btn-ghost mr-1">

                                <i class="fas fa-arrow-left mr-1"></i>

                                Kembali

                            </a>

                            <a href="{{ route('operator.production.edit', $production->id) }}"
                                class="btn btn-primary mr-1">

                                <i class="fas fa-edit mr-1"></i>

                                Edit

                            </a>

                            <button type="submit" form="bulkDeleteForm" id="btnBulkDelete" class="btn btn-danger"
                                disabled>

                                <i class="fas fa-trash mr-1"></i>

                                Hapus Terpilih

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const checkAll = document.getElementById('checkAll');

            const btnBulkDelete = document.getElementById('btnBulkDelete');

            const checkboxes = document.querySelectorAll('.detail-checkbox');

            function updateButton() {

                const checked = document.querySelectorAll('.detail-checkbox:checked');

                btnBulkDelete.disabled = checked.length === 0;

                checkAll.checked =

                    checkboxes.length > 0 &&

                    checked.length === checkboxes.length;

                checkAll.indeterminate =

                    checked.length > 0 &&

                    checked.length < checkboxes.length;

            }

            checkAll.addEventListener('change', function() {

                checkboxes.forEach(function(checkbox) {

                    checkbox.checked = checkAll.checked;

                });

                updateButton();

            });

            checkboxes.forEach(function(checkbox) {

                checkbox.addEventListener('change', function() {

                    updateButton();

                });

            });

            document

                .getElementById('bulkDeleteForm')

                .addEventListener('submit', function(event) {

                    const checked =

                        document.querySelectorAll('.detail-checkbox:checked');

                    if (checked.length === 0) {

                        event.preventDefault();

                        alert('Pilih minimal satu produk.');

                        return;

                    }

                    const confirmed = confirm(

                        'Yakin ingin menghapus ' +

                        checked.length +

                        ' produk yang dipilih?'

                    );

                    if (!confirmed) {

                        event.preventDefault();

                    }

                });

        });
    </script>
@endpush
