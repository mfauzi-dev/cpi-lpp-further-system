@extends('layouts.master')

@section('title', 'User')

@section('content')
    <style>
        :root {
            --user-primary: #1B4B43;
            --user-primary-light: #E8F0EE;
            --user-accent: #D98C3D;
            --user-border: #E3E7E1;
            --user-text: #1F2A24;
            --user-muted: #5B6A62;
            --user-soft: #F7F9F7;
        }

        .user-page .section-header h1 {
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--user-text);
        }

        .user-page .section-lead {
            color: var(--user-muted);
            font-size: .925rem;
            margin: .25rem 0 1.5rem;
        }

        .user-page .card {
            border: none;
            border-left: 4px solid var(--user-primary);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(15, 30, 25, .06), 0 1px 2px rgba(15, 30, 25, .04);
            overflow: hidden;
        }

        .user-page .card.card-final {
            border-left-color: var(--user-accent);
        }

        .user-page .card-header {
            background: #fff;
            border-bottom: 1px solid var(--user-border);
            padding: 1rem 1.5rem;
        }

        .user-page .card-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--user-text);
            display: flex;
            align-items: center;
        }

        .user-page .card-header h4 i {
            color: var(--user-primary);
        }

        .user-page .card-body {
            padding: 1.5rem;
        }

        .user-page .filter-label {
            color: var(--user-muted);
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .user-page .form-control {
            border-color: var(--user-border);
            border-radius: 7px;
        }

        .user-page .form-control:focus {
            border-color: var(--user-primary);
            box-shadow: 0 0 0 .15rem rgba(27, 75, 67, .1);
        }

        .user-page .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .user-page .table {
            margin-bottom: 0;
        }

        .user-page .table thead th {
            background: var(--user-primary-light);
            color: var(--user-primary);
            font-weight: 600;
            font-size: .78rem;
            border-bottom: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: .8rem .9rem;
        }

        .user-page .table td {
            vertical-align: middle;
            font-size: .85rem;
            color: var(--user-text);
            padding: .8rem .9rem;
        }

        .user-page .table-bordered td,
        .user-page .table-bordered th {
            border-color: var(--user-border);
        }

        .user-page .table tbody tr:hover {
            background: #FAFBF9;
        }

        .user-page .table-wide {
            min-width: 850px;
        }

        .user-page .table-wide th,
        .user-page .table-wide td {
            white-space: nowrap;
        }

        .user-page .badge-soft {
            display: inline-block;
            background: var(--user-primary-light);
            color: var(--user-primary);
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .user-page .badge-value {
            display: inline-block;
            background: #FFF3E5;
            color: #A96018;
            border-radius: 20px;
            padding: .3rem .65rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .user-page .value-empty {
            color: #9AA59F;
            font-style: italic;
            font-weight: 400;
        }

        .user-page .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--user-muted);
        }

        .user-page .empty-state i {
            font-size: 1.8rem;
            margin-bottom: .6rem;
            opacity: .55;
        }

        .user-page .btn-primary {
            background: var(--user-primary);
            border-color: var(--user-primary);
        }

        .user-page .btn-primary:hover {
            background: #153B35;
            border-color: #153B35;
        }

        .user-page .btn-ghost {
            color: var(--user-muted);
            background: transparent;
            border: 1px solid var(--user-border);
        }

        .user-page .btn-ghost:hover {
            background: #F3F5F3;
            color: var(--user-text);
        }

        .user-page .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            white-space: nowrap;
        }

        .user-page .action-buttons .btn {
            padding: .45rem .7rem;
            font-size: .78rem;
        }

        .user-page .user-name {
            font-weight: 600;
            color: var(--user-text);
        }

        .user-page .user-email {
            color: var(--user-muted);
            font-size: .8rem;
        }

        @media (max-width: 767.98px) {
            .user-page .card-body {
                padding: 1rem;
            }

            .user-page .card-header {
                padding: .9rem 1rem;
            }
        }
    </style>

    <div class="user-page">

        <div class="section-header">
            <h1>User</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="#">User</a>
                </div>

                <div class="breadcrumb-item">
                    Table
                </div>
            </div>
        </div>

        <div class="section-lead">
            Kelola akun user dan hak akses aplikasi.
        </div>

        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('manager.user.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i>
                Tambah User
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>
                    <i class="fas fa-filter mr-2"></i>
                    Filter Data
                </h4>
            </div>

            <div class="card-body">
                <form method="GET" action="{{ route('manager.user.index') }}">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="filter-label">
                                    Pencarian
                                </label>

                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari nama, email, atau role..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="filter-label">
                                    Jumlah Data
                                </label>

                                <select name="size" class="form-control">
                                    <option value="10" {{ request('size', 10) == 10 ? 'selected' : '' }}>
                                        10 Data
                                    </option>
                                    <option value="25" {{ request('size') == 25 ? 'selected' : '' }}>
                                        25 Data
                                    </option>
                                    <option value="50" {{ request('size') == 50 ? 'selected' : '' }}>
                                        50 Data
                                    </option>
                                    <option value="100" {{ request('size') == 100 ? 'selected' : '' }}>
                                        100 Data
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center" style="gap: .5rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search mr-1"></i>
                            Tampilkan
                        </button>

                        <a href="{{ route('manager.user.index') }}" class="btn btn-ghost">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-final">

            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>
                        <i class="fas fa-users mr-2"></i>
                        Data User
                    </h4>
                </div>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-bordered table-wide">

                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Dibuat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>

                                    <td class="text-center">
                                        {{ $users->firstItem() + $index }}
                                    </td>

                                    <td>
                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="user-email">
                                            {{ $user->email }}
                                        </div>
                                    </td>

                                    <td>
                                        @if ($user->role)
                                            <span class="badge-soft">
                                                {{ $user->role->name }}
                                            </span>
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->created_at)
                                            {{ $user->created_at->format('d/m/Y H:i') }}
                                        @else
                                            <span class="value-empty">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="action-buttons">

                                            <a href="{{ route('manager.user.edit', $user->id) }}"
                                                class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>

                                            <form action="{{ route('manager.user.destroy', $user->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash mr-1"></i>
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-users d-block"></i>

                                            <div>
                                                Belum ada data user.
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

            <div class="card-footer bg-white border-top">
                {{ $users->withQueryString()->links() }}
            </div>

        </div>

    </div>
@endsection
