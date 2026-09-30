@extends('layouts.master')

@section('title', 'Dashboard Operator')

@section('content')

    <div class="operator-dashboard">

        <div class="section-header">
            <h1>Dashboard Operator</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    Dashboard
                </div>
            </div>
        </div>

        <div class="section-body">

            <div class="operator-header">

                <div class="operator-header-line"></div>

                <div class="operator-header-content">

                    <div class="operator-identity">

                        <div class="operator-avatar">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>

                        <div>
                            <div class="operator-greeting">
                                Halo, {{ $user->name }}
                            </div>

                            <div class="operator-description">
                                Operator Area Produksi
                            </div>
                        </div>

                    </div>

                    <div class="operator-info">

                        <div class="operator-info-item">
                            <span>PROSES</span>
                            <strong>
                                {{ $processName ?? 'Belum ditentukan' }}
                            </strong>
                        </div>

                        <div class="operator-info-divider"></div>

                        <div class="operator-info-item">
                            <span>LINE</span>
                            <strong>
                                {{ $line ?? '-' }}
                            </strong>
                        </div>

                        <div class="operator-info-divider"></div>

                        <div class="operator-info-item">
                            <span>TANGGAL</span>
                            <strong>
                                {{ \Carbon\Carbon::parse($date)->translatedFormat('d M Y') }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>


            <div class="operator-section-title">

                <div class="operator-section-line"></div>

                <div>
                    <h4>Monitoring Input</h4>
                    <p>Status penginputan production batch hari ini</p>
                </div>

            </div>


            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6">

                    <div class="operator-card">

                        <div class="operator-card-line"></div>

                        <div class="operator-card-content">

                            <div>
                                <span class="operator-card-label">
                                    BATCH HARI INI
                                </span>

                                <div class="operator-card-number">
                                    {{ $totalBatch }}
                                </div>

                                <span class="operator-card-description">
                                    Production batch
                                </span>
                            </div>

                            <div class="operator-card-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6 col-sm-6">

                    <div class="operator-card operator-card-success">

                        <div class="operator-card-line"></div>

                        <div class="operator-card-content">

                            <div>
                                <span class="operator-card-label">
                                    SUDAH DIINPUT
                                </span>

                                <div class="operator-card-number">
                                    {{ $completedCount }}
                                </div>

                                <span class="operator-card-description">
                                    Batch selesai
                                </span>
                            </div>

                            <div class="operator-card-icon">
                                <i class="fas fa-check"></i>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6 col-sm-6">

                    <div class="operator-card operator-card-warning">

                        <div class="operator-card-line"></div>

                        <div class="operator-card-content">

                            <div>
                                <span class="operator-card-label">
                                    BELUM DIINPUT
                                </span>

                                <div class="operator-card-number">
                                    {{ $pendingCount }}
                                </div>

                                <span class="operator-card-description">
                                    Menunggu input
                                </span>
                            </div>

                            <div class="operator-card-icon">
                                <i class="fas fa-clock"></i>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6 col-sm-6">

                    <div class="operator-card">

                        <div class="operator-card-line"></div>

                        <div class="operator-card-content">

                            <div>
                                <span class="operator-card-label">
                                    PROGRESS INPUT
                                </span>

                                <div class="operator-card-number">
                                    {{ $progressPct }}%
                                </div>

                                <span class="operator-card-description">
                                    Penyelesaian hari ini
                                </span>
                            </div>

                            <div class="operator-card-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>

                        </div>

                        <div class="operator-progress">
                            <div class="operator-progress-fill" style="width: {{ $progressPct }}%;"></div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="operator-divider"></div>


            <div class="operator-section-title">

                <div class="operator-section-line"></div>

                <div>
                    <h4>Production Batch</h4>
                    <p>Daftar batch yang perlu diproses oleh operator</p>
                </div>

            </div>


            <div class="operator-panel">

                <div class="operator-panel-header">

                    <div>
                        <h5>
                            <i class="fas fa-list-ul"></i>
                            Batch Hari Ini
                        </h5>

                        <span>
                            {{ $totalBatch }} batch terdaftar
                        </span>
                    </div>

                    @if ($pendingCount > 0)
                        <div class="operator-pending-label">
                            <span></span>
                            {{ $pendingCount }} belum diinput
                        </div>
                    @endif

                </div>


                <div class="table-responsive">

                    <table class="table operator-table">

                        <thead>
                            <tr>
                                <th width="60">NO</th>
                                <th>NO. BATCH</th>
                                <th>PRODUCT</th>
                                <th width="100">LINE</th>
                                <th width="100">WAKTU</th>
                                <th width="150">STATUS</th>
                                <th width="120">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($batchList as $index => $batch)

                                <tr>

                                    <td>
                                        <span class="operator-row-number">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong class="operator-batch-number">
                                            {{ $batch['no_batch'] }}
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="operator-product">
                                            {{ $batch['product'] }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="operator-line-badge">
                                            {{ $batch['line'] }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="operator-time">
                                            {{ $batch['waktu'] }}
                                        </span>
                                    </td>

                                    <td>

                                        @if ($batch['inputted'])
                                            <span class="operator-status operator-status-success">
                                                <i class="fas fa-check-circle"></i>
                                                Sudah Diinput
                                            </span>
                                        @else
                                            <span class="operator-status operator-status-warning">
                                                <i class="fas fa-clock"></i>
                                                Belum Diinput
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($batch['inputted'])
                                            @if ($detailRoute)
                                                <a href="{{ route($detailRoute, $batch['id']) }}"
                                                    class="operator-action operator-action-detail">
                                                    <i class="fas fa-eye"></i>
                                                    Detail
                                                </a>
                                            @endif
                                        @else
                                            @if ($createRoute)
                                                <a href="{{ route($createRoute, ['production_batch_id' => $batch['id']]) }}"
                                                    class="operator-action operator-action-input">
                                                    <i class="fas fa-edit"></i>
                                                    Input
                                                </a>
                                            @endif
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7">

                                        <div class="operator-empty">

                                            <div class="operator-empty-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>

                                            <strong>
                                                Belum ada production batch
                                            </strong>

                                            <span>
                                                Belum terdapat batch produksi untuk hari ini.
                                            </span>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            <div class="operator-divider"></div>


            <div class="operator-section-title">

                <div class="operator-section-line"></div>

                <div>
                    <h4>Input Terakhir</h4>
                    <p>Aktivitas input production batch terbaru</p>
                </div>

            </div>


            <div class="operator-panel">

                <div class="operator-panel-header">

                    <div>
                        <h5>
                            <i class="fas fa-history"></i>
                            Riwayat Input
                        </h5>

                        <span>
                            Maksimal 5 input terakhir
                        </span>
                    </div>

                </div>


                <div class="table-responsive">

                    <table class="table operator-table">

                        <thead>
                            <tr>
                                <th width="60">NO</th>
                                <th>NO. BATCH</th>
                                <th>PRODUCT</th>
                                <th width="150">WAKTU INPUT</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($recentInputs as $index => $input)
                                <tr>

                                    <td>
                                        <span class="operator-row-number">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong class="operator-batch-number">
                                            {{ $input['no_batch'] }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $input['product'] }}
                                    </td>

                                    <td>
                                        <span class="operator-time">
                                            {{ $input['waktu'] }}
                                        </span>
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4">

                                        <div class="operator-empty operator-empty-small">

                                            <div class="operator-empty-icon">
                                                <i class="fas fa-history"></i>
                                            </div>

                                            <strong>
                                                Belum ada riwayat input
                                            </strong>

                                            <span>
                                                Aktivitas input operator akan muncul di sini.
                                            </span>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection


@push('addon-style')
    <style>
        .operator-dashboard {
            --operator-primary: #1B4B43;
            --operator-primary-light: #E8F0EE;
            --operator-accent: #D98C3D;
            --operator-border: #E3E7E1;
            --operator-text: #26332F;
            --operator-muted: #7B8581;
            --operator-bg: #F7F9F8;
        }


        .operator-header {
            position: relative;
            background: #FFFFFF;
            border: 1px solid var(--operator-border);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 24px;
        }


        .operator-header-line {
            height: 4px;
            background: var(--operator-primary);
        }


        .operator-header-content {
            padding: 24px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }


        .operator-identity {
            display: flex;
            align-items: center;
            gap: 16px;
        }


        .operator-avatar {
            width: 54px;
            height: 54px;
            border-radius: 10px;
            background: var(--operator-primary-light);
            color: var(--operator-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 800;
            border: 1px solid #D7E4DF;
        }


        .operator-greeting {
            font-size: 20px;
            font-weight: 700;
            color: var(--operator-text);
            line-height: 1.3;
        }


        .operator-description {
            margin-top: 5px;
            color: var(--operator-muted);
            font-size: 13px;
        }


        .operator-info {
            display: flex;
            align-items: center;
            gap: 22px;
        }


        .operator-info-item {
            min-width: 100px;
        }


        .operator-info-item span {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: var(--operator-muted);
            letter-spacing: 1px;
            margin-bottom: 5px;
        }


        .operator-info-item strong {
            display: block;
            font-size: 14px;
            color: var(--operator-primary);
        }


        .operator-info-divider {
            width: 1px;
            height: 32px;
            background: var(--operator-border);
        }


        .operator-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 28px 0 15px;
        }


        .operator-section-line {
            width: 4px;
            height: 34px;
            background: var(--operator-primary);
            border-radius: 3px;
        }


        .operator-section-title h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--operator-text);
        }


        .operator-section-title p {
            margin: 3px 0 0;
            font-size: 12px;
            color: var(--operator-muted);
        }


        .operator-card {
            position: relative;
            background: #FFFFFF;
            border: 1px solid var(--operator-border);
            border-radius: 9px;
            min-height: 130px;
            overflow: hidden;
            margin-bottom: 20px;
        }


        .operator-card-line {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--operator-primary);
        }


        .operator-card-success .operator-card-line {
            background: #3F806F;
        }


        .operator-card-warning .operator-card-line {
            background: var(--operator-accent);
        }


        .operator-card-content {
            padding: 20px 18px 17px 21px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .operator-card-label {
            display: block;
            color: var(--operator-muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .8px;
        }


        .operator-card-number {
            margin-top: 5px;
            color: var(--operator-text);
            font-size: 27px;
            font-weight: 800;
            line-height: 1;
        }


        .operator-card-description {
            display: block;
            margin-top: 7px;
            color: var(--operator-muted);
            font-size: 11px;
        }


        .operator-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--operator-primary-light);
            color: var(--operator-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }


        .operator-card-warning .operator-card-icon {
            background: #FFF4E8;
            color: var(--operator-accent);
        }


        .operator-progress {
            height: 3px;
            margin: 0 18px 14px 21px;
            background: #EDF0EE;
            border-radius: 5px;
            overflow: hidden;
        }


        .operator-progress-fill {
            height: 100%;
            background: var(--operator-primary);
            border-radius: 5px;
        }


        .operator-divider {
            height: 2px;
            margin: 10px 0 24px;
            background: linear-gradient(90deg,
                    var(--operator-primary) 0%,
                    var(--operator-primary) 35%,
                    var(--operator-accent) 55%,
                    #E5E8E6 75%,
                    #E5E8E6 100%);
            opacity: .7;
        }


        .operator-panel {
            background: #FFFFFF;
            border: 1px solid var(--operator-border);
            border-radius: 9px;
            overflow: hidden;
        }


        .operator-panel-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--operator-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .operator-panel-header h5 {
            margin: 0;
            color: var(--operator-text);
            font-size: 14px;
            font-weight: 700;
        }


        .operator-panel-header h5 i {
            margin-right: 7px;
            color: var(--operator-primary);
        }


        .operator-panel-header span {
            display: block;
            margin-top: 4px;
            color: var(--operator-muted);
            font-size: 11px;
        }


        .operator-pending-label {
            color: var(--operator-accent);
            font-size: 11px;
            font-weight: 700;
        }


        .operator-pending-label span {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--operator-accent);
            margin-right: 5px;
        }


        .operator-table {
            margin: 0;
        }


        .operator-table thead th {
            padding: 12px 15px;
            background: #FAFBFA;
            border-bottom: 1px solid var(--operator-border);
            color: #69736F;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .5px;
            white-space: nowrap;
        }


        .operator-table tbody td {
            padding: 14px 15px;
            border-top: 1px solid #EEF1EF;
            color: #46514D;
            font-size: 12px;
            vertical-align: middle;
        }


        .operator-table tbody tr:first-child td {
            border-top: none;
        }


        .operator-table tbody tr:hover {
            background: #FAFCFB;
        }


        .operator-row-number {
            color: #A0A8A5;
            font-size: 11px;
            font-weight: 600;
        }


        .operator-batch-number {
            color: var(--operator-primary);
            font-size: 12px;
        }


        .operator-product {
            color: var(--operator-text);
            font-weight: 500;
        }


        .operator-line-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 5px;
            background: var(--operator-primary-light);
            color: var(--operator-primary);
            font-size: 10px;
            font-weight: 700;
        }


        .operator-time {
            color: #69736F;
            font-size: 11px;
        }


        .operator-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
        }


        .operator-status-success {
            background: #EAF3F0;
            color: #327262;
        }


        .operator-status-warning {
            background: #FFF4E8;
            color: #C27627;
        }


        .operator-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none !important;
            transition: .2s;
        }


        .operator-action-input {
            background: var(--operator-primary);
            color: #FFFFFF !important;
        }


        .operator-action-input:hover {
            background: #143A34;
        }


        .operator-action-detail {
            background: var(--operator-primary-light);
            color: var(--operator-primary) !important;
        }


        .operator-action-detail:hover {
            background: #DCEAE5;
        }


        .operator-empty {
            min-height: 190px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }


        .operator-empty-small {
            min-height: 150px;
        }


        .operator-empty-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--operator-primary-light);
            color: var(--operator-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }


        .operator-empty strong {
            color: var(--operator-text);
            font-size: 13px;
        }


        .operator-empty span {
            margin-top: 4px;
            color: var(--operator-muted);
            font-size: 11px;
        }


        @media (max-width: 991px) {

            .operator-header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .operator-info {
                width: 100%;
                justify-content: flex-start;
            }

        }


        @media (max-width: 767px) {

            .operator-info {
                flex-wrap: wrap;
                gap: 15px;
            }

            .operator-info-divider {
                display: none;
            }

            .operator-panel-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            .operator-table {
                min-width: 850px;
            }

        }
    </style>
@endpush
