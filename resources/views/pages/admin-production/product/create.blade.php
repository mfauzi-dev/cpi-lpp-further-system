@extends('layouts.master')

@section('title', 'Create Product')

@section('content')

    <div class="section-header">
        <h1>Create Product</h1>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin-production.product.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Kode Product</label>

                    <input type="text" name="kode_product" value="{{ old('kode_product') }}"
                        class="form-control @error('kode_product') is-invalid @enderror">

                    @error('kode_product')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Product</label>

                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="form-control @error('nama') is-invalid @enderror">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Gramasi</label>

                    <input type="number" name="gramasi" value="{{ old('gramasi') }}"
                        class="form-control @error('gramasi') is-invalid @enderror" step="0.01" min="0">

                    @error('gramasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Pack Per Box</label>

                    <input type="number" name="pack_per_box" value="{{ old('pack_per_box') }}"
                        class="form-control @error('pack_per_box') is-invalid @enderror" min="0">

                    @error('pack_per_box')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Product Group</label>

                    <select name="product_group_id" class="form-control @error('product_group_id') is-invalid @enderror">
                        <option value="">-- Pilih Product Group --</option>

                        @foreach ($productGroupList as $productGroup)
                            <option value="{{ $productGroup->id }}"
                                {{ old('product_group_id') == $productGroup->id ? 'selected' : '' }}>
                                {{ $productGroup->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('product_group_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Process Type</label>

                    <select name="process_type_id" class="form-control @error('process_type_id') is-invalid @enderror">
                        <option value="">-- Pilih Process Type --</option>

                        @foreach ($processTypeList as $processType)
                            <option value="{{ $processType->id }}"
                                {{ old('process_type_id') == $processType->id ? 'selected' : '' }}>
                                {{ $processType->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('process_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                <a href="{{ route('admin-production.product.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>

@endsection
