<?php

namespace App\Http\Controllers;

use App\Models\ProcessType;
use App\Models\Product;
use App\Models\Production;
use App\Models\ProductionBatch;
use App\Models\ProductionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    public function managerIndex(Request $request)
    {
        $query = Production::with([
            'productionBatch.product',
            'processType',
        ])->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where(
                    'no_batch',
                    'like',
                    '%' . $request->no_batch . '%'
                );
            });
        }

        if ($request->filled('process_type_id')) {
            $query->where('process_type_id', $request->process_type_id);
        }

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

        $productions = $query
            ->paginate(10)
            ->withQueryString();

        $processTypes = ProcessType::orderBy('name')->get();

        return view(
            'pages.manager.production.index',
            compact(
                'productions',
                'processTypes'
            )
        );
    }

    public function managerDetail($id)
    {
        $production = Production::with([
            'productionBatch.product.productGroup',
            'processType',
            'details.product',
        ])->findOrFail($id);

        return view(
            'pages.manager.production.detail',
            compact('production')
        );
    }

    public function index(Request $request)
    {
        $query = Production::with([
            'productionBatch.product',
            'processType',
        ])->latest();

        if ($request->filled('process_type_id')) {
            $query->where('process_type_id', $request->process_type_id);
        }

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

        $productions = $query
            ->paginate(10)
            ->withQueryString();

        $processTypes = ProcessType::orderBy('name')->get();

        return view(
            'pages.operator.production.index',
            compact(
                'productions',
                'processTypes'
            )
        );
    }

    public function create()
    {
        $processTypes = ProcessType::orderBy('name')->get();

        return view(
            'pages.operator.production.create',
            compact(
                'processTypes'
            )
        );
    }

    public function getProducts($processTypeId)
    {
        $products = Product::where(
            'process_type_id',
            $processTypeId
        )
            ->orderBy('kode_product')
            ->get([
                'id',
                'kode_product',
                'nama',
            ]);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'process_type_id' => [
                'required',
                'exists:process_types,id',
            ],
            'products' => [
                'required',
                'array',
                'min:1',
            ],
            'products.*.product_id' => [
                'required',
                'exists:products,id',
            ],
            'products.*.kode_batch' => [
                'nullable',
                'string',
                'max:100',
            ],
            'products.*.suhu' => [
                'nullable',
                'numeric',
            ],
            'products.*.berat_kg' => [
                'nullable',
                'numeric',
            ],
        ]);

        DB::beginTransaction();

        try {
            $production = Production::create([
                'production_batch_id' => $request->production_batch_id,
                'process_type_id' => $request->process_type_id,
                'total_bahan_baku' => 0,
            ]);

            $hasDetail = false;

            foreach ($request->products as $row) {
                $isFilled = !empty($row['kode_batch'])
                    || !empty($row['suhu'])
                    || !empty($row['berat_kg']);

                if ($isFilled) {
                    $production->details()->create([
                        'product_id' => $row['product_id'],
                        'kode_batch' => $row['kode_batch'] ?? null,
                        'suhu' => $row['suhu'] ?? null,
                        'berat_kg' => $row['berat_kg'] ?? null,
                    ]);

                    $hasDetail = true;
                }
            }

            if (!$hasDetail) {
                throw new \Exception(
                    'Minimal satu produk harus diisi datanya.'
                );
            }

            $production->update([
                'total_bahan_baku' => $production->details()->sum('berat_kg'),
            ]);

            // Hitung ulang Yield Production Batch
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
                $productionBatch->yield = (
                    ($totalKgPackingLuarPalet + $totalRijekPacking)
                    / $grandTotalBahanBaku
                ) * 100;
            } else {
                $productionBatch->yield = 0;
            }

            $productionBatch->save();

            DB::commit();

            return redirect()
                ->route('operator.production.index')
                ->with(
                    'success',
                    'Data produksi berhasil disimpan.'
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

    public function detail($id)
    {
        $production = Production::with([
            'productionBatch.product.productGroup',
            'processType',
            'details.product',
        ])->findOrFail($id);

        return view(
            'pages.operator.production.detail',
            compact('production')
        );
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => [
                'required',
                'array',
                'min:1',
            ],
            'ids.*' => [
                'required',
                'exists:production_details,id',
            ],
        ]);

        DB::beginTransaction();

        try {
            $details = ProductionDetail::whereIn(
                'id',
                $request->ids
            )->get();

            $productionIds = $details
                ->pluck('production_id')
                ->unique();

            ProductionDetail::whereIn(
                'id',
                $request->ids
            )->delete();

            foreach ($productionIds as $productionId) {
                $production = Production::find($productionId);

                if ($production) {
                    $remainingDetails = ProductionDetail::where(
                        'production_id',
                        $productionId
                    )->count();

                    if ($remainingDetails === 0) {
                        $production->delete();
                    } else {
                        $production->update([
                            'total_bahan_baku' => ProductionDetail::where(
                                'production_id',
                                $productionId
                            )->sum('berat_kg'),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('operator.production.index')
                ->with(
                    'success',
                    'Data produk yang dipilih berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.production.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function edit($id)
    {
        $production = Production::with([
            'productionBatch.product.productGroup',
            'processType',
            'details.product',
        ])->findOrFail($id);

        $processTypes = ProcessType::orderBy('name')->get();

        $products = Product::where(
            'process_type_id',
            $production->process_type_id
        )
            ->orderBy('kode_product')
            ->get();

        return view(
            'pages.operator.production.edit',
            compact(
                'production',
                'processTypes',
                'products'
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
            'process_type_id' => [
                'required',
                'exists:process_types,id',
            ],
            'products' => [
                'required',
                'array',
                'min:1',
            ],
            'products.*.product_id' => [
                'required',
                'exists:products,id',
            ],
            'products.*.kode_batch' => [
                'nullable',
                'string',
                'max:100',
            ],
            'products.*.suhu' => [
                'nullable',
                'numeric',
            ],
            'products.*.berat_kg' => [
                'nullable',
                'numeric',
            ],
        ]);

        DB::beginTransaction();

        try {
            $production = Production::findOrFail($id);

            $production->update([
                'production_batch_id' => $request->production_batch_id,
                'process_type_id' => $request->process_type_id,
            ]);

            $production->details()->delete();

            $hasDetail = false;

            foreach ($request->products as $row) {
                $isFilled = !empty($row['kode_batch'])
                    || !empty($row['suhu'])
                    || !empty($row['berat_kg']);

                if ($isFilled) {
                    $production->details()->create([
                        'product_id' => $row['product_id'],
                        'kode_batch' => $row['kode_batch'] ?? null,
                        'suhu' => $row['suhu'] ?? null,
                        'berat_kg' => $row['berat_kg'] ?? null,
                    ]);

                    $hasDetail = true;
                }
            }

            if (!$hasDetail) {
                throw new \Exception(
                    'Minimal satu produk harus diisi datanya.'
                );
            }

            $production->update([
                'total_bahan_baku' => $production->details()->sum('berat_kg'),
            ]);

            // Hitung ulang Yield Production Batch
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
                $productionBatch->yield = (
                    ($totalKgPackingLuarPalet + $totalRijekPacking)
                    / $grandTotalBahanBaku
                ) * 100;
            } else {
                $productionBatch->yield = 0;
            }

            $productionBatch->save();

            DB::commit();

            return redirect()
                ->route(
                    'operator.production.detail',
                    $production->id
                )
                ->with(
                    'success',
                    'Data produksi berhasil diperbarui.'
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
}