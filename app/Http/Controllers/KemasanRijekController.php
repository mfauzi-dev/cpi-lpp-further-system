<?php

namespace App\Http\Controllers;

use App\Models\KemasanRijek;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KemasanRijekController extends Controller
{
    public function index(Request $request)
    {
        $query = KemasanRijek::with('productionBatch.product')->latest();

        if ($request->filled('date_from')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate('tanggal_produksi', '>=', $request->date_from);
            });
        }

        if ($request->filled('date_to')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate('tanggal_produksi', '<=', $request->date_to);
            });
        }

        $kemasanRijeks = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.kemasan-rijek.index',
            compact('kemasanRijeks')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.kemasan-rijek.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $kemasanRijek = KemasanRijek::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.operator.kemasan-rijek.detail',
            compact('kemasanRijek')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'total_cooking_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'total_packing_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'rusak_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'rusak_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'jatuh_lantai_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'jatuh_lantai_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'kulit_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'kulit_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_crumb_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_crumb_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_predust_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_predust_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'scrap_adonan_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'scrap_adonan_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'gosong_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'gosong_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'overweight_underweight_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'overweight_underweight_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampel_qc_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampel_qc_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'lain_lain_cooking' => [
                'nullable',
                'string',
            ],
            'lain_lain_packing' => [
                'nullable',
                'string',
            ],
            'lain_lain_cooking_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'lain_lain_packing_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $totalRijekCooking =
            ($request->rusak_cooking ?? 0)
            + ($request->jatuh_lantai_cooking ?? 0)
            + ($request->kulit_cooking ?? 0)
            + ($request->waste_bread_crumb_cooking ?? 0)
            + ($request->waste_bread_predust_cooking ?? 0)
            + ($request->scrap_adonan_cooking ?? 0)
            + ($request->gosong_cooking ?? 0)
            + ($request->overweight_underweight_cooking ?? 0)
            + ($request->sampel_qc_cooking ?? 0)
            + ($request->lain_lain_cooking_kg ?? 0);

        $totalRijekPacking =
            ($request->rusak_packing ?? 0)
            + ($request->jatuh_lantai_packing ?? 0)
            + ($request->kulit_packing ?? 0)
            + ($request->waste_bread_crumb_packing ?? 0)
            + ($request->waste_bread_predust_packing ?? 0)
            + ($request->scrap_adonan_packing ?? 0)
            + ($request->gosong_packing ?? 0)
            + ($request->overweight_underweight_packing ?? 0)
            + ($request->sampel_qc_packing ?? 0)
            + ($request->lain_lain_packing_kg ?? 0);

        DB::beginTransaction();

        try {
            KemasanRijek::create([
                'production_batch_id' => $request->production_batch_id,
                'total_cooking_kg' => $request->total_cooking_kg,
                'total_packing_kg' => $request->total_packing_kg,
                'rusak_cooking' => $request->rusak_cooking ?? 0,
                'rusak_packing' => $request->rusak_packing ?? 0,
                'jatuh_lantai_cooking' => $request->jatuh_lantai_cooking ?? 0,
                'jatuh_lantai_packing' => $request->jatuh_lantai_packing ?? 0,
                'kulit_cooking' => $request->kulit_cooking ?? 0,
                'kulit_packing' => $request->kulit_packing ?? 0,
                'waste_bread_crumb_cooking' => $request->waste_bread_crumb_cooking ?? 0,
                'waste_bread_crumb_packing' => $request->waste_bread_crumb_packing ?? 0,
                'waste_bread_predust_cooking' => $request->waste_bread_predust_cooking ?? 0,
                'waste_bread_predust_packing' => $request->waste_bread_predust_packing ?? 0,
                'scrap_adonan_cooking' => $request->scrap_adonan_cooking ?? 0,
                'scrap_adonan_packing' => $request->scrap_adonan_packing ?? 0,
                'gosong_cooking' => $request->gosong_cooking ?? 0,
                'gosong_packing' => $request->gosong_packing ?? 0,
                'overweight_underweight_cooking' => $request->overweight_underweight_cooking ?? 0,
                'overweight_underweight_packing' => $request->overweight_underweight_packing ?? 0,
                'sampel_qc_cooking' => $request->sampel_qc_cooking ?? 0,
                'sampel_qc_packing' => $request->sampel_qc_packing ?? 0,
                'lain_lain_cooking' => $request->lain_lain_cooking,
                'lain_lain_packing' => $request->lain_lain_packing,
                'lain_lain_cooking_kg' => $request->lain_lain_cooking_kg ?? 0,
                'lain_lain_packing_kg' => $request->lain_lain_packing_kg ?? 0,
                'total_rijek_cooking_kg' => $totalRijekCooking,
                'total_rijek_packing_kg' => $totalRijekPacking,
            ]);

            $productionBatch = ProductionBatch::with([
                'productions',
                'packingLuars.palets',
                'kemasanRijeks',
            ])->findOrFail($request->production_batch_id);

            $grandTotalBahanBaku = $productionBatch->productions
                ->sum('total_bahan_baku');

            $totalKgPackingLuarPalet = $productionBatch->packingLuars
                ->sum(function ($packingLuar) {
                    return $packingLuar->palets->sum('jumlah_kg');
                });

            $totalRijekPacking = $productionBatch->kemasanRijeks
                ->sum('total_rijek_packing_kg');

            if ($grandTotalBahanBaku > 0) {
                $productionBatch->yield =
                    (
                        ($totalKgPackingLuarPalet + $totalRijekPacking)
                        / $grandTotalBahanBaku
                    ) * 100;
            } else {
                $productionBatch->yield = 0;
            }

            $productionBatch->save();

            DB::commit();

            return redirect()
                ->route('operator.kemasan-rijek.index')
                ->with(
                    'success',
                    'Data kemasan rijek berhasil disimpan.'
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
        $kemasanRijek = KemasanRijek::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.kemasan-rijek.edit',
            compact(
                'kemasanRijek',
                'productionBatches'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'total_cooking_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'total_packing_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'rusak_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'rusak_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'jatuh_lantai_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'jatuh_lantai_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'kulit_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'kulit_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_crumb_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_crumb_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_predust_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waste_bread_predust_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'scrap_adonan_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'scrap_adonan_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'gosong_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'gosong_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'overweight_underweight_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'overweight_underweight_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampel_qc_cooking' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampel_qc_packing' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'lain_lain_cooking' => [
                'nullable',
                'string',
            ],
            'lain_lain_packing' => [
                'nullable',
                'string',
            ],
            'lain_lain_cooking_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'lain_lain_packing_kg' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $totalRijekCooking =
            ($request->rusak_cooking ?? 0)
            + ($request->jatuh_lantai_cooking ?? 0)
            + ($request->kulit_cooking ?? 0)
            + ($request->waste_bread_crumb_cooking ?? 0)
            + ($request->waste_bread_predust_cooking ?? 0)
            + ($request->scrap_adonan_cooking ?? 0)
            + ($request->gosong_cooking ?? 0)
            + ($request->overweight_underweight_cooking ?? 0)
            + ($request->sampel_qc_cooking ?? 0)
            + ($request->lain_lain_cooking_kg ?? 0);

        $totalRijekPacking =
            ($request->rusak_packing ?? 0)
            + ($request->jatuh_lantai_packing ?? 0)
            + ($request->kulit_packing ?? 0)
            + ($request->waste_bread_crumb_packing ?? 0)
            + ($request->waste_bread_predust_packing ?? 0)
            + ($request->scrap_adonan_packing ?? 0)
            + ($request->gosong_packing ?? 0)
            + ($request->overweight_underweight_packing ?? 0)
            + ($request->sampel_qc_packing ?? 0)
            + ($request->lain_lain_packing_kg ?? 0);

        DB::beginTransaction();

        try {
            $kemasanRijek = KemasanRijek::findOrFail($id);

            $kemasanRijek->update([
                'production_batch_id' => $request->production_batch_id,
                'total_cooking_kg' => $request->total_cooking_kg,
                'total_packing_kg' => $request->total_packing_kg,
                'rusak_cooking' => $request->rusak_cooking ?? 0,
                'rusak_packing' => $request->rusak_packing ?? 0,
                'jatuh_lantai_cooking' => $request->jatuh_lantai_cooking ?? 0,
                'jatuh_lantai_packing' => $request->jatuh_lantai_packing ?? 0,
                'kulit_cooking' => $request->kulit_cooking ?? 0,
                'kulit_packing' => $request->kulit_packing ?? 0,
                'waste_bread_crumb_cooking' => $request->waste_bread_crumb_cooking ?? 0,
                'waste_bread_crumb_packing' => $request->waste_bread_crumb_packing ?? 0,
                'waste_bread_predust_cooking' => $request->waste_bread_predust_cooking ?? 0,
                'waste_bread_predust_packing' => $request->waste_bread_predust_packing ?? 0,
                'scrap_adonan_cooking' => $request->scrap_adonan_cooking ?? 0,
                'scrap_adonan_packing' => $request->scrap_adonan_packing ?? 0,
                'gosong_cooking' => $request->gosong_cooking ?? 0,
                'gosong_packing' => $request->gosong_packing ?? 0,
                'overweight_underweight_cooking' => $request->overweight_underweight_cooking ?? 0,
                'overweight_underweight_packing' => $request->overweight_underweight_packing ?? 0,
                'sampel_qc_cooking' => $request->sampel_qc_cooking ?? 0,
                'sampel_qc_packing' => $request->sampel_qc_packing ?? 0,
                'lain_lain_cooking' => $request->lain_lain_cooking,
                'lain_lain_packing' => $request->lain_lain_packing,
                'lain_lain_cooking_kg' => $request->lain_lain_cooking_kg ?? 0,
                'lain_lain_packing_kg' => $request->lain_lain_packing_kg ?? 0,
                'total_rijek_cooking_kg' => $totalRijekCooking,
                'total_rijek_packing_kg' => $totalRijekPacking,
            ]);

            $productionBatch = ProductionBatch::with([
                'productions',
                'packingLuars.palets',
                'kemasanRijeks',
            ])->findOrFail($request->production_batch_id);

            $grandTotalBahanBaku = $productionBatch->productions
                ->sum('total_bahan_baku');

            $totalKgPackingLuarPalet = $productionBatch->packingLuars
                ->sum(function ($packingLuar) {
                    return $packingLuar->palets->sum('jumlah_kg');
                });

            $totalRijekPacking = $productionBatch->kemasanRijeks
                ->sum('total_rijek_packing_kg');

            if ($grandTotalBahanBaku > 0) {
                $productionBatch->yield =
                    (
                        ($totalKgPackingLuarPalet + $totalRijekPacking)
                        / $grandTotalBahanBaku
                    ) * 100;
            } else {
                $productionBatch->yield = 0;
            }

            $productionBatch->save();

            DB::commit();

            return redirect()
                ->route('operator.kemasan-rijek.index')
                ->with(
                    'success',
                    'Data kemasan rijek berhasil diperbarui.'
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
            $kemasanRijek = KemasanRijek::findOrFail($id);

            $kemasanRijek->delete();

            DB::commit();

            return redirect()
                ->route('operator.kemasan-rijek.index')
                ->with(
                    'success',
                    'Data kemasan rijek berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.kemasan-rijek.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function managerIndex(Request $request)
    {
        $query = KemasanRijek::with('productionBatch.product')->latest();

        if ($request->filled('date_from')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate('tanggal_produksi', '>=', $request->date_from);
            });
        }

        if ($request->filled('date_to')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate('tanggal_produksi', '<=', $request->date_to);
            });
        }

        $kemasanRijeks = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.kemasan-rijek.index',
            compact('kemasanRijeks')
        );
    }

    public function managerDetail($id)
    {
        $kemasanRijek = KemasanRijek::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.manager.kemasan-rijek.detail',
            compact('kemasanRijek')
        );
    }
}