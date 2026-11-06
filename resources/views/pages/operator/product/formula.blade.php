@extends('layouts.master')

@section('title', 'Formula - ' . $product->nama)

@push('addon-style')
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }

        .btn-formula-add {
            height: 38px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0f5c4c;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 14px;
            transition: background-color 0.15s ease, transform 0.1s ease;
        }

        .btn-formula-add:hover {
            background-color: #0c4a3d;
            color: #fff;
        }

        .btn-formula-add:active {
            transform: scale(0.96);
        }

        .btn-formula-add:focus {
            box-shadow: 0 0 0 3px rgba(15, 92, 76, 0.25);
            outline: none;
        }

        .formula-mode-group {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .formula-mode-option {
            position: relative;
        }

        .formula-mode-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .formula-mode-option label {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .5rem 1rem;
            border: 1.5px solid #d8dee3;
            border-radius: 999px;
            font-size: 14px;
            color: #4b5563;
            cursor: pointer;
            margin-bottom: 0;
            transition: all 0.15s ease;
            user-select: none;
        }

        .formula-mode-option label:hover {
            border-color: #0f5c4c;
            color: #0f5c4c;
        }

        .formula-mode-option label::before {
            content: '';
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1.5px solid #d8dee3;
            flex-shrink: 0;
            transition: all 0.15s ease;
        }

        .formula-mode-option input[type="radio"]:checked+label {
            border-color: #0f5c4c;
            background-color: rgba(15, 92, 76, 0.08);
            color: #0f5c4c;
            font-weight: 500;
        }

        .formula-mode-option input[type="radio"]:checked+label::before {
            border-color: #0f5c4c;
            border-width: 4px;
        }

        .formula-mode-option input[type="radio"]:focus-visible+label {
            box-shadow: 0 0 0 3px rgba(15, 92, 76, 0.25);
        }
    </style>
@endpush

@section('content')
    <div class="page-section">
        <div class="section-header">
            <h1>Formula: {{ $product->nama }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('operator.product.index') }}">
                        Produk
                    </a>
                </div>
                <div class="breadcrumb-item active">
                    Formula
                </div>
            </div>
        </div>

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

        <div class="mb-4 d-flex align-items-center flex-wrap" style="gap: .5rem;">
            <a href="{{ route('operator.product.index') }}" class="btn btn-ghost">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali ke Produk
            </a>

            <a href="{{ route('operator.product.formula.import') }}" class="btn btn-add">
                <i class="fas fa-file-import mr-1"></i>
                Import Formula
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>
                    <span class="step-badge">1</span>
                    Tambah Bahan Baku ke Formula
                </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('operator.product.formula.store', $product->id) }}" method="POST">
                    @csrf

                    @if ($formulas->isNotEmpty())
                        <div class="form-group mb-3">
                            <div class="formula-mode-group">
                                <div class="formula-mode-option">
                                    <input type="radio" name="formula_mode" id="mode_existing" value="existing" checked>
                                    <label for="mode_existing">Tambah ke Formula yang Sudah Ada</label>
                                </div>
                                <div class="formula-mode-option">
                                    <input type="radio" name="formula_mode" id="mode_new" value="new">
                                    <label for="mode_new">Buat Formula Baru</label>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row align-items-end">
                        <div class="col-md-5 mb-3">
                            <label class="filter-label">Bahan Baku</label>
                            <select name="bahan_baku_id"
                                class="form-control select2 @error('bahan_baku_id') is-invalid @enderror">
                                <option value="">-- Pilih Bahan Baku --</option>
                                @foreach ($bahanBakus as $bb)
                                    <option value="{{ $bb->id }}"
                                        {{ old('bahan_baku_id') == $bb->id ? 'selected' : '' }}>
                                        {{ $bb->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bahan_baku_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="filter-label">Nama Formula</label>

                            @if ($formulas->isNotEmpty())
                                <select name="existing_name" id="existing_name_select"
                                    class="form-control @error('name') is-invalid @enderror">
                                    <option value="">-- Pilih Formula --</option>
                                    @foreach ($formulas->keys() as $formulaName)
                                        <option value="{{ $formulaName }}"
                                            {{ old('name') == $formulaName ? 'selected' : '' }}>
                                            {{ $formulaName }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="text" name="new_name" id="new_name_input"
                                    class="form-control mt-2 @error('name') is-invalid @enderror" style="display: none;"
                                    placeholder="Nama formula baru" value="{{ old('name') }}">
                            @else
                                <input type="text" name="new_name" id="new_name_input"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Misal: Alternatif 1" value="{{ old('name') }}">
                            @endif

                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="filter-label">Total Kg</label>
                            <input type="number" step="0.001" name="total_kg"
                                class="form-control @error('total_kg') is-invalid @enderror" placeholder="0.000"
                                value="{{ old('total_kg') }}">
                            @error('total_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-1 mb-3">
                            <button type="submit" class="btn-formula-add" title="Tambah">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @forelse ($formulas as $name => $rows)
            <div class="card card-accent mb-4">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-flask mr-2"></i>
                        Formula {{ $name }}
                    </h4>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-wide">
                            <thead>
                                <tr>
                                    <th>Bahan Baku</th>
                                    <th width="150" class="text-right">Total KG</th>
                                    <th width="120" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $row->bahanBaku->name }}</td>
                                        <td class="text-right">
                                            {{ number_format($row->total_kg, 3, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <form action="{{ route('operator.product.formula.destroy', $row->id) }}"
                                                    method="POST" style="display: inline;"
                                                    onsubmit="return confirm('Yakin ingin menghapus baris formula ini?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <div class="empty-state">
                        <i class="fas fa-flask d-block"></i>
                        <div>
                            Belum ada formula untuk produk ini. Tambah manual di atas, atau import dari Excel.
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih Bahan Baku',
                width: '100%'
            });

            function toggleFormulaNameInput() {
                var mode = $('input[name="formula_mode"]:checked').val();

                if (mode === 'new') {
                    $('#existing_name_select').attr('name', '').hide();
                    $('#new_name_input').attr('name', 'name').show();
                } else {
                    $('#new_name_input').attr('name', '').hide();
                    $('#existing_name_select').attr('name', 'name').show();
                }
            }

            if ($('input[name="formula_mode"]').length) {
                toggleFormulaNameInput();
                $('input[name="formula_mode"]').on('change', toggleFormulaNameInput);
            } else {
                $('#new_name_input').attr('name', 'name');
            }
        });
    </script>
@endpush
