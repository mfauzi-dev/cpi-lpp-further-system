@extends('layouts.master')

@section('title', 'Edit Product Group')

@section('content')

    <div class="section-header">
        <h1>Edit Product Group</h1>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin-production.product-group.update', $productGroup->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Product Group</label>

                    <input type="text" name="name" value="{{ old('name', $productGroup->name) }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('admin-production.product-group.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>

@endsection
