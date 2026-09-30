@extends('layouts.master')

@section('title', 'Product Group')

@section('content')
    <div class="section-header">
        <h1>Product Group</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Product Group</a></div>
            <div class="breadcrumb-item"><a href="#">Table</a></div>
        </div>
    </div>

    <div class="section-body">
        <a href="{{ route('admin-production.product-group.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Tambah Product Group
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin-production.product-group.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-lg mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama Product Group."
                            value="{{ $search ?? '' }}">
                    </div>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin-production.product-group.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Daftar Product Group</h4>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th width="60">No.</th>
                            <th>Nama Product Group</th>
                            <th width="180" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($productGroups as $index => $productGroup)
                            <tr>
                                <td>{{ $productGroups->firstItem() + $index }}</td>
                                <td>{{ $productGroup->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin-production.product-group.edit', $productGroup->id) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin-production.product-group.destroy', $productGroup->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    Daftar product group belum ada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-right">
            {{ $productGroups->withQueryString()->links() }}
        </div>
    </div>
@endsection
