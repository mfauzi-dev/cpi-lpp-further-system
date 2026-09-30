<?php

namespace App\Http\Controllers;

use App\Models\MetalDetector;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetalDetectorController extends Controller
{

    public function index(Request $request)
    {
        $query = ProductionBatch::with([
            'product',
            'metalDetectors',
        ])->whereHas('metalDetectors');

        if ($request->filled('no_batch')) {
            $query->where(
                'no_batch',
                'like',
                '%' . $request->no_batch . '%'
            );
        }

        if ($request->filled('date_from')) {
            $query->whereDate('tanggal_produksi', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('tanggal_produksi', '<=', $request->date_to);
        }

        $productionBatches = $query
            ->latest('tanggal_produksi')
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.metal-detector.index',
            compact('productionBatches')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.metal-detector.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $productionBatch = ProductionBatch::with([
            'product.productGroup',
            'metalDetectors',
        ])->findOrFail($id);

        return view(
            'pages.operator.metal-detector.detail',
            compact('productionBatch')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'metal_detectors' => [
                'required',
                'array',
                'min:1',
            ],
            'metal_detectors.*.batch_type' => [
                'required',
                'in:HALF BATCH,FULL BATCH',
            ],
            'metal_detectors.*.metal_detector' => [
                'nullable',
                'in:1,2,3,4,5,6',
            ],
            'metal_detectors.*.waktu_awal' => [
                'nullable',
                'date_format:H:i',
            ],
            'metal_detectors.*.waktu_akhir' => [
                'nullable',
                'date_format:H:i',
            ],
        ]);

        $sudahAda = MetalDetector::where(
            'production_batch_id',
            $request->production_batch_id
        )->exists();

        if ($sudahAda) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data metal detector untuk batch ini sudah pernah diinput. Silakan gunakan menu edit untuk mengubahnya.'
                );
        }

        DB::beginTransaction();

        try {
            $productionBatch = ProductionBatch::findOrFail(
                $request->production_batch_id
            );

            $metalDetectorData = $request->input('metal_detectors', []);

            foreach ($metalDetectorData as $item) {
                $batchType = $item['batch_type'] ?? null;
                $metalDetector = $item['metal_detector'] ?? null;
                $waktuAwal = $item['waktu_awal'] ?? null;
                $waktuAkhir = $item['waktu_akhir'] ?? null;

                if (
                    filled($batchType) ||
                    filled($metalDetector) ||
                    filled($waktuAwal) ||
                    filled($waktuAkhir)
                ) {
                    MetalDetector::create([
                        'production_batch_id' => $productionBatch->id,
                        'batch_type' => $batchType,
                        'metal_detector' => $metalDetector,
                        'waktu_awal' => $waktuAwal,
                        'waktu_akhir' => $waktuAkhir,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('operator.metal-detector.index')
                ->with(
                    'success',
                    'Data metal detector berhasil disimpan.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal menyimpan data: ' . $e->getMessage()
                );
        }
    }

    public function edit($id)
    {
        $productionBatch = ProductionBatch::with([
            'product.productGroup',
            'metalDetectors',
        ])->findOrFail($id);

        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.metal-detector.edit',
            compact('productionBatch', 'productionBatches')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'metal_detectors' => [
                'required',
                'array',
                'min:1',
            ],
            'metal_detectors.*.batch_type' => [
                'required',
                'in:HALF BATCH,FULL BATCH',
            ],
            'metal_detectors.*.metal_detector' => [
                'nullable',
                'in:1,2,3,4,5,6',
            ],
            'metal_detectors.*.waktu_awal' => [
                'nullable',
                'date_format:H:i',
            ],
            'metal_detectors.*.waktu_akhir' => [
                'nullable',
                'date_format:H:i',
            ],
        ]);

        DB::beginTransaction();

        try {
            $productionBatch = ProductionBatch::findOrFail(
                $request->production_batch_id
            );

            MetalDetector::where(
                'production_batch_id',
                $productionBatch->id
            )->delete();

            $metalDetectorData = $request->input('metal_detectors', []);

            foreach ($metalDetectorData as $item) {
                $batchType = $item['batch_type'] ?? null;
                $metalDetector = $item['metal_detector'] ?? null;
                $waktuAwal = $item['waktu_awal'] ?? null;
                $waktuAkhir = $item['waktu_akhir'] ?? null;

                if (
                    filled($batchType) ||
                    filled($metalDetector) ||
                    filled($waktuAwal) ||
                    filled($waktuAkhir)
                ) {
                    MetalDetector::create([
                        'production_batch_id' => $productionBatch->id,
                        'batch_type' => $batchType,
                        'metal_detector' => $metalDetector,
                        'waktu_awal' => $waktuAwal,
                        'waktu_akhir' => $waktuAkhir,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('operator.metal-detector.index')
                ->with(
                    'success',
                    'Data metal detector berhasil diperbarui.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal memperbarui data: ' . $e->getMessage()
                );
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            MetalDetector::where('production_batch_id', $id)->delete();

            DB::commit();

            return redirect()
                ->route('operator.metal-detector.index')
                ->with(
                    'success',
                    'Data metal detector berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.metal-detector.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function managerIndex(Request $request)
    {
        $query = ProductionBatch::with([
            'product',
            'metalDetectors',
        ])->whereHas('metalDetectors');

        if ($request->filled('no_batch')) {
            $query->where(
                'no_batch',
                'like',
                '%' . $request->no_batch . '%'
            );
        }

        if ($request->filled('date_from')) {
            $query->whereDate('tanggal_produksi', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('tanggal_produksi', '<=', $request->date_to);
        }

        $productionBatches = $query
            ->latest('tanggal_produksi')
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.metal-detector.index',
            compact('productionBatches')
        );
    }

    public function managerDetail($id)
    {
        $productionBatch = ProductionBatch::with([
            'product.productGroup',
            'metalDetectors',
        ])->findOrFail($id);

        return view(
            'pages.manager.metal-detector.detail',
            compact('productionBatch')
        );
    }
}