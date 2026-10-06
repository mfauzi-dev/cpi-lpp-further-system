<?php

namespace App\Http\Controllers;

use App\Exports\DashboardTableSheet;
use App\Exports\MonitoringDetailExport;
use App\Models\Batter;
use App\Models\BowlCutter;
use App\Models\Forming;
use App\Models\Fryer;
use App\Models\Grinder;
use App\Models\Hlt;
use App\Models\KemasanRijek;
use App\Models\MetalDetector;
use App\Models\Mixing;
use App\Models\PackingDalam;
use App\Models\PackingLuar;
use App\Models\Pembekuan;
use App\Models\PredustBreader;
use App\Models\PreparasiFla;
use App\Models\Production;
use App\Models\ProductionBatch;
use App\Models\Tumbler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role->name;

        switch ($role) {
            case 'Admin':
                return $this->adminDashboard($request);

            case 'General Manager':
                return $this->generalManagerDashboard($request);

            case 'Manager':
                return $this->managerDashboard($request);

            case 'Admin Production':
                return $this->adminProductionDashboard();

            case 'Operator':
                return $this->operatorDashboard();

            default:
                abort(403);
        }
    }

    private function adminDashboard(Request $request)
    {
        return view('pages.dashboard.admin');
    }

    private function generalManagerDashboard(Request $request)
    {
        return view('pages.dashboard.general-manager',);
    }
    
    public function managerDashboard(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
 
        $productionBatches = ProductionBatch::with(['product', 'fryers', 'pembekuans'])
            ->whereDate('tanggal_produksi', $date)
            ->latest('id')
            ->get();
 
        $isBatchCompliant = function (ProductionBatch $batch): bool {
            $fryerOk = $batch->fryers->every(function ($fryer) {
                return $fryer->suhu_pusat_status === null
                    || $fryer->suhu_pusat_status === 'success';
            });
 
            $pembekuanOk = $batch->pembekuans->every(function ($pembekuan) {
                return $pembekuan->suhu_pusat === null
                    || (float) $pembekuan->suhu_pusat <= -18;
            });
 
            return $fryerOk && $pembekuanOk;
        };
 
        $totalBatch = $productionBatches->count();
 
        $totalOutput = $productionBatches->sum(function ($batch) {
            return (float) $batch->yield;
        });
 
        $averageYield = $productionBatches->whereNotNull('yield')->avg('yield');
 
        $averageRijek = $productionBatches->whereNotNull('persen_rijek')->avg('persen_rijek');
 
        $averageProduktifitas = $productionBatches
            ->whereNotNull('produktifitas')
            ->avg('produktifitas');
 
        // ===== Compliance Suhu: Total Berhasil vs Total Rijek =====
        $totalBerhasil = 0;
        $totalRijek = 0;
 
        foreach ($productionBatches as $batch) {
            $compliant = $isBatchCompliant($batch);
 
            // taruh di attribute dinamis biar bisa dipakai lagi di tabel
            // "Batch Terbaru" tanpa query / hitung ulang
            $batch->setAttribute('is_compliant', $compliant);
 
            if ($compliant) {
                $totalBerhasil++;
            } else {
                $totalRijek++;
            }
        }
 
        $persentaseBerhasil = $totalBatch > 0
            ? round(($totalBerhasil / $totalBatch) * 100, 1)
            : 0;
 
        $persentaseRijek = $totalBatch > 0
            ? round(($totalRijek / $totalBatch) * 100, 1)
            : 0;
 
        $processes = [
            'Bowl Cutter' => BowlCutter::class,
            'Grinder' => Grinder::class,
            'Preparasi FLA' => PreparasiFla::class,
            'Tumbler' => Tumbler::class,
            'Mixing' => Mixing::class,
            'Forming' => Forming::class,
            'Batter' => Batter::class,
            'HLT' => Hlt::class,
            'Predust Breader' => PredustBreader::class,
            'Fryer' => Fryer::class,
            'Pembekuan' => Pembekuan::class,
            'Packing Dalam' => PackingDalam::class,
            'Packing Luar' => PackingLuar::class,
            'Kemasan Rijek' => KemasanRijek::class,
        ];
 
        // ikon Font Awesome per proses — biar tampilan grid proses di dashboard
        // nggak cuma teks, enak dipindai manager sekilas lihat.
        $processIcons = [
            'Bowl Cutter' => 'fa-utensils',
            'Grinder' => 'fa-cogs',
            'Preparasi FLA' => 'fa-temperature-low',
            'Tumbler' => 'fa-sync-alt',
            'Mixing' => 'fa-blender',
            'Forming' => 'fa-shapes',
            'Batter' => 'fa-fill-drip',
            'HLT' => 'fa-hot-tub',
            'Predust Breader' => 'fa-bread-slice',
            'Fryer' => 'fa-fire',
            'Pembekuan' => 'fa-snowflake',
            'Packing Dalam' => 'fa-box',
            'Packing Luar' => 'fa-boxes',
            'Kemasan Rijek' => 'fa-exclamation-triangle',
        ];
 
        $batchIds = $productionBatches->pluck('id');
 
        $processStatus = [];
 
        foreach ($processes as $name => $model) {
            $count = $model::whereIn('production_batch_id', $batchIds)->count();
 
            $processStatus[] = [
                'name' => $name,
                'icon' => $processIcons[$name] ?? 'fa-industry',
                'count' => $count,
                'status' => $count > 0 ? 'Selesai' : 'Belum Diinput',
            ];
        }
 
        $totalProcess = count($processes);
 
        $completedProcess = collect($processStatus)
            ->where('count', '>', 0)
            ->count();
 
        $pendingProcess = $totalProcess - $completedProcess;
 
        $kemasanRijekToday = KemasanRijek::whereIn('production_batch_id', $batchIds)->count();
 
        $metalDetectorToday = MetalDetector::whereIn('production_batch_id', $batchIds)->count();
 
        // ===== Tren 7 hari terakhir: jumlah batch, output, & compliance suhu =====
        $outputChart = [];
 
        for ($i = 6; $i >= 0; $i--) {
            $chartDate = Carbon::parse($date)->subDays($i)->format('Y-m-d');
 
            $chartBatches = ProductionBatch::with(['fryers', 'pembekuans'])
                ->whereDate('tanggal_produksi', $chartDate)
                ->get();
 
            $chartBerhasil = $chartBatches->filter($isBatchCompliant)->count();
 
            $outputChart[] = [
                'date' => Carbon::parse($chartDate)->format('d M'),
                'batch' => $chartBatches->count(),
                'output' => $chartBatches->sum(function ($batch) {
                    return (float) $batch->yield;
                }),
                'berhasil' => $chartBerhasil,
                'rijek' => $chartBatches->count() - $chartBerhasil,
            ];
        }
 
        $recentProduction = $productionBatches->take(10);
 
        return view('pages.dashboard.manager', compact(
            'date',
            'totalBatch',
            'totalOutput',
            'averageYield',
            'averageRijek',
            'averageProduktifitas',
            'totalBerhasil',
            'totalRijek',
            'persentaseBerhasil',
            'persentaseRijek',
            'totalProcess',
            'completedProcess',
            'pendingProcess',
            'kemasanRijekToday',
            'metalDetectorToday',
            'processStatus',
            'outputChart',
            'recentProduction'
        ));
    }

    public function operatorDashboard()
    {
        $user = auth()->user();

        $processName = $user->process ?? null;
        $line = $user->line ?? null;
        $date = now()->format('Y-m-d');

        $processModels = [
            'Bowl Cutter' => BowlCutter::class,
            'Grinder' => Grinder::class,
            'Preparasi FLA' => PreparasiFla::class,
            'Tumbler' => Tumbler::class,
            'Mixing' => Mixing::class,
            'Forming' => Forming::class,
            'Batter' => Batter::class,
            'HLT' => Hlt::class,
            'Predust Breader' => PredustBreader::class,
            'Fryer' => Fryer::class,
            'Pembekuan' => Pembekuan::class,
            'Packing Dalam' => PackingDalam::class,
            'Packing Luar' => PackingLuar::class,
            'Kemasan Rijek' => KemasanRijek::class,
        ];

        $createRoutes = [
            'Bowl Cutter' => 'operator.bowl-cutter.create',
            'Grinder' => 'operator.grinder.create',
            'Preparasi FLA' => 'operator.preparasi-fla.create',
            'Tumbler' => 'operator.tumbler.create',
            'Mixing' => 'operator.mixing.create',
            'Forming' => 'operator.forming.create',
            'Batter' => 'operator.batter.create',
            'HLT' => 'operator.hlt.create',
            'Predust Breader' => 'operator.predust-breader.create',
            'Fryer' => 'operator.fryer.create',
            'Pembekuan' => 'operator.pembekuan.create',
            'Packing Dalam' => 'operator.packing-dalam.create',
            'Packing Luar' => 'operator.packing-luar.create',
            'Kemasan Rijek' => 'operator.kemasan-rijek.create',
        ];

        $detailRoutes = [
            'Bowl Cutter' => 'operator.bowl-cutter.detail',
            'Grinder' => 'operator.grinder.detail',
            'Preparasi FLA' => 'operator.preparasi-fla.detail',
            'Tumbler' => 'operator.tumbler.detail',
            'Mixing' => 'operator.mixing.detail',
            'Forming' => 'operator.forming.detail',
            'Batter' => 'operator.batter.detail',
            'HLT' => 'operator.hlt.detail',
            'Predust Breader' => 'operator.predust-breader.detail',
            'Fryer' => 'operator.fryer.detail',
            'Pembekuan' => 'operator.pembekuan.detail',
            'Packing Dalam' => 'operator.packing-dalam.detail',
            'Packing Luar' => 'operator.packing-luar.detail',
            'Kemasan Rijek' => 'operator.kemasan-rijek.detail',
        ];

        $model = $processModels[$processName] ?? null;
        $createRoute = $createRoutes[$processName] ?? null;
        $detailRoute = $detailRoutes[$processName] ?? null;

        $batchQuery = ProductionBatch::with('product')
            ->whereDate('tanggal_produksi', $date)
            ->latest('id');

        if ($line) {
            $batchQuery->where('line', $line);
        }

        $productionBatches = $batchQuery->get();

        $totalBatch = $productionBatches->count();

        $batchIds = $productionBatches->pluck('id')->toArray();

        $inputtedBatchIds = [];

        if ($model && count($batchIds) > 0) {
            $inputtedBatchIds = $model::whereIn(
                'production_batch_id',
                $batchIds
            )
            ->pluck('production_batch_id')
            ->unique()
            ->toArray();
        }

        $completedCount = count($inputtedBatchIds);
        $pendingCount = $totalBatch - $completedCount;

        if ($totalBatch > 0) {
            $progressPct = round(($completedCount / $totalBatch) * 100);
        } else {
            $progressPct = 0;
        }

        $batchList = [];

        foreach ($productionBatches as $batch) {
            $isInputted = in_array($batch->id, $inputtedBatchIds);

            $batchList[] = [
                'id' => $batch->id,
                'no_batch' => $batch->no_batch,
                'product' => $batch->product->nama ?? '-',
                'line' => $batch->line ?? '-',
                'waktu' => $batch->created_at
                    ? $batch->created_at->format('H.i')
                    : '-',
                'inputted' => $isInputted,
            ];
        }

        $recentInputs = [];

        if ($model && count($batchIds) > 0) {
            $inputs = $model::whereIn(
                'production_batch_id',
                $batchIds
            )
            ->latest('id')
            ->limit(5)
            ->get();

            foreach ($inputs as $input) {
                $batch = $productionBatches->firstWhere(
                    'id',
                    $input->production_batch_id
                );

                if ($batch) {
                    $recentInputs[] = [
                        'id' => $input->id,
                        'no_batch' => $batch->no_batch,
                        'product' => $batch->product->nama ?? '-',
                        'waktu' => $input->created_at
                            ? $input->created_at->format('H.i')
                            : '-',
                    ];
                }
            }
        }

        return view('pages.dashboard.operator', compact(
            'user',
            'date',
            'processName',
            'line',
            'totalBatch',
            'completedCount',
            'pendingCount',
            'progressPct',
            'batchList',
            'recentInputs',
            'createRoute',
            'detailRoute'
        ));
    }

    private function adminProductionDashboard()
    {
        return view('pages.dashboard.admin-production');
    }
}
