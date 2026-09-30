<?php

namespace App\Http\Controllers;

use App\Models\PackingDalam;
use App\Models\PackingLuar;
use App\Models\Product;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackingDalamController extends Controller
{
    public function managerIndex(Request $request)
    {
        $query = PackingDalam::with('productionBatch.product')->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('no_batch', 'like', '%' . $request->no_batch . '%');
            });
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
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

        $packingDalams = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.packing-dalam.index',
            compact('packingDalams')
        );
    }

    public function managerDetail($id)
    {
        $packingDalam = PackingDalam::with([
            'productionBatch.product.productGroup',
            'samplings',
            'plastiks.product',
        ])->findOrFail($id);

        return view(
            'pages.manager.packing-dalam.detail',
            compact('packingDalam')
        );
    }

    public function index(Request $request)
    {
        $query = PackingDalam::with('productionBatch.product')->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('no_batch', 'like', '%' . $request->no_batch . '%');
            });
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
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

        $packingDalams = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.packing-dalam.index',
            compact('packingDalams')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        $productsPlastik = Product::whereHas('processType', function ($query) {
            $query->where('name', 'Plastik');
        })
            ->with('productGroup')
            ->orderBy('nama')
            ->get();

        return view(
            'pages.operator.packing-dalam.create',
            compact(
                'productionBatches',
                'productsPlastik'
            )
        );
    }

    public function detail($id)
    {
        $packingDalam = PackingDalam::with([
            'productionBatch.product.productGroup',
            'samplings',
            'plastiks.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.operator.packing-dalam.detail',
            compact('packingDalam')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'mhw_korin' => [
                'nullable',
                'string',
                'max:100',
            ],
            'heating_level' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'speed' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'pressure' => [
                'nullable',
            ],
            'packing_manual' => [
                'nullable',
                'string',
                'max:100',
            ],
            'timbangan' => [
                'nullable',
                'string',
                'max:100',
            ],
            'heating_level_packing_manual' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'fe_sus_non_fe' => [
                'nullable',
                'string',
                'max:100',
            ],
            'setting_x' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'setting_y' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'checkweigher_pac' => [
                'nullable',
                'string',
                'max:100',
            ],
            'petugas_sortasi_after_iqf' => [
                'nullable',
                'string',
                'max:100',
            ],
            'operator_md' => [
                'nullable',
                'string',
                'max:100',
            ],
            'leader_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
            'waktu_awal' => [
                'nullable',
                'date_format:H:i',
            ],
            'waktu_akhir' => [
                'nullable',
                'date_format:H:i',
            ],
            'pic_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
            'sampling' => [
                'nullable',
                'array',
            ],
            'sampling.*.berat_kemasan' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampling.*.berat_per_bag' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampling.*.range_berat' => [
                'nullable',
                'string',
                'max:100',
            ],
            'plastik' => [
                'nullable',
                'array',
            ],
            'plastik.*.product_id' => [
                'nullable',
                'integer',
                'exists:products,id',
            ],
            'plastik.*.jumlah' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'plastik.*.sisa' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'plastik.*.rijek' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],
            'plastik.*.operator_mhw' => [
                'nullable',
                'string',
                'max:100',
            ],
            'plastik.*.checker_ds' => [
                'nullable',
                'string',
                'max:100',
            ],
            'plastik.*.leader' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        DB::beginTransaction();

        try {
            $productionBatch = ProductionBatch::with([
                'product.productGroup',
            ])->findOrFail($request->production_batch_id);

            $packingDalam = PackingDalam::create([
                'production_batch_id' => $productionBatch->id,
                'mhw_korin' => $request->mhw_korin,
                'heating_level' => $request->heating_level,
                'speed' => $request->speed,
                'pressure' => $request->pressure,
                'packing_manual' => $request->packing_manual,
                'timbangan' => $request->timbangan,
                'heating_level_packing_manual' => $request->heating_level_packing_manual,
                'fe_sus_non_fe' => $request->fe_sus_non_fe,
                'setting_x' => $request->setting_x,
                'setting_y' => $request->setting_y,
                'checkweigher_pac' => $request->checkweigher_pac,
                'petugas_sortasi_after_iqf' => $request->petugas_sortasi_after_iqf,
                'operator_md' => $request->operator_md,
                'leader_produksi' => $request->leader_produksi,
                'waktu_awal' => $request->waktu_awal,
                'waktu_akhir' => $request->waktu_akhir,
                'line' => $productionBatch->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            $samplingData = $request->input('sampling', []);

            for ($i = 1; $i <= 10; $i++) {
                $sampling = $samplingData[$i] ?? [];

                $beratKemasan = $sampling['berat_kemasan'] ?? null;
                $beratPerBag = $sampling['berat_per_bag'] ?? null;
                $rangeBerat = $sampling['range_berat'] ?? null;

                if (
                    filled($beratKemasan) ||
                    filled($beratPerBag) ||
                    filled($rangeBerat)
                ) {
                    $packingDalam->samplings()->create([
                        'sampling_ke' => $i,
                        'berat_kemasan' => $beratKemasan ?: null,
                        'berat_per_bag' => $beratPerBag ?: null,
                        'range_berat' => $rangeBerat ?: null,
                    ]);
                }
            }

            $productsPlastik = Product::whereHas('processType', function ($query) {
                $query->where('name', 'Plastik');
            })
                ->with('productGroup')
                ->get();

            $allowedProductIds = $productsPlastik->pluck('id')->toArray();

            $packingLuar = PackingLuar::with('palets')
                ->where('production_batch_id', $productionBatch->id)
                ->latest('id')
                ->first();

            $jumlahPack = $packingLuar
                ? $packingLuar->palets->sum('jumlah_pack')
                : 0;

            $plastikData = $request->input('plastik', []);

            foreach ($plastikData as $plastik) {
                $productId = $plastik['product_id'] ?? null;

                if ($productId && in_array($productId, $allowedProductIds)) {
                    $product = $productsPlastik->firstWhere('id', $productId);

                    $jumlah = $plastik['jumlah'] ?? null;
                    $sisa = $plastik['sisa'] ?? null;
                    $rijek = $plastik['rijek'] ?? null;
                    $operatorMhw = $plastik['operator_mhw'] ?? null;
                    $checkerDs = $plastik['checker_ds'] ?? null;
                    $leader = $plastik['leader'] ?? null;

                    $pemakaian = null;

                    if ($product && $jumlahPack > 0) {
                        $gramasi = (float) $product->gramasi;

                        $productGroup = strtolower(
                            trim($product->productGroup->name ?? '')
                        );

                        $faktor = null;

                        if ($productGroup === 'stick') {
                            if ($gramasi == 225 || $gramasi == 250) {
                                $faktor = 0.215;
                            }
                        } elseif ($productGroup === 'nugget') {
                            if ($gramasi == 225 || $gramasi == 250) {
                                $faktor = 0.2;
                            }
                        } else {
                            if ($gramasi == 200) {
                                $faktor = 0.19;
                            } elseif ($gramasi == 225 || $gramasi == 250) {
                                $faktor = 0.2;
                            } elseif ($gramasi == 315 || $gramasi == 360) {
                                $faktor = 0.25;
                            } elseif (
                                $gramasi == 400 ||
                                $gramasi == 450 ||
                                $gramasi == 500
                            ) {
                                $faktor = 0.253;
                            } elseif (
                                $gramasi == 900 ||
                                $gramasi == 1000
                            ) {
                                $faktor = 0.34;
                            }
                        }

                        if ($faktor !== null) {
                            $pemakaianDasar = $jumlahPack * $faktor;
                            $pemakaian = $pemakaianDasar;

                            if (filled($rijek)) {
                                $pemakaian = $pemakaianDasar
                                    + ($pemakaianDasar * ((float) $rijek / 100));
                            }

                            $pemakaian = round($pemakaian, 2);
                        }
                    }

                    if (
                        filled($jumlah) ||
                        $pemakaian !== null ||
                        filled($sisa) ||
                        filled($rijek) ||
                        filled($operatorMhw) ||
                        filled($checkerDs) ||
                        filled($leader)
                    ) {
                        $packingDalam->plastiks()->create([
                            'product_id' => $productId,
                            'jumlah' => $jumlah ?: null,
                            'pemakaian' => $pemakaian,
                            'sisa' => $sisa ?: null,
                            'rijek' => $rijek ?: null,
                            'operator_mhw' => $operatorMhw ?: null,
                            'checker_ds' => $checkerDs ?: null,
                            'leader' => $leader ?: null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('operator.packing-dalam.index')
                ->with(
                    'success',
                    'Data packing dalam berhasil disimpan.'
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
        $packingDalam = PackingDalam::with([
            'productionBatch.product.productGroup',
            'samplings',
            'plastiks.product.productGroup',
        ])->findOrFail($id);

        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        $productsPlastik = Product::whereHas('processType', function ($query) {
            $query->where('name', 'Plastik');
        })
            ->with('productGroup')
            ->orderBy('nama')
            ->get();

        return view(
            'pages.operator.packing-dalam.edit',
            compact(
                'packingDalam',
                'productionBatches',
                'productsPlastik'
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
            'mhw_korin' => [
                'nullable',
                'string',
                'max:100',
            ],
            'heating_level' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'speed' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'pressure' => [
                'nullable',
            ],
            'packing_manual' => [
                'nullable',
                'string',
                'max:100',
            ],
            'timbangan' => [
                'nullable',
                'string',
                'max:100',
            ],
            'heating_level_packing_manual' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'fe_sus_non_fe' => [
                'nullable',
                'string',
                'max:100',
            ],
            'setting_x' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'setting_y' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'checkweigher_pac' => [
                'nullable',
                'string',
                'max:100',
            ],
            'petugas_sortasi_after_iqf' => [
                'nullable',
                'string',
                'max:100',
            ],
            'operator_md' => [
                'nullable',
                'string',
                'max:100',
            ],
            'leader_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
            'waktu_awal' => [
                'nullable',
                'date_format:H:i',
            ],
            'waktu_akhir' => [
                'nullable',
                'date_format:H:i',
            ],
            'pic_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
            'sampling' => [
                'nullable',
                'array',
            ],
            'sampling.*.berat_kemasan' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampling.*.berat_per_bag' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'sampling.*.range_berat' => [
                'nullable',
                'string',
                'max:100',
            ],
            'plastik' => [
                'nullable',
                'array',
            ],
            'plastik.*.product_id' => [
                'nullable',
                'integer',
                'exists:products,id',
            ],
            'plastik.*.jumlah' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'plastik.*.sisa' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'plastik.*.rijek' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],
            'plastik.*.operator_mhw' => [
                'nullable',
                'string',
                'max:100',
            ],
            'plastik.*.checker_ds' => [
                'nullable',
                'string',
                'max:100',
            ],
            'plastik.*.leader' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        DB::beginTransaction();

        try {
            $packingDalam = PackingDalam::findOrFail($id);

            $productionBatch = ProductionBatch::with([
                'product.productGroup',
            ])->findOrFail($request->production_batch_id);

            $packingDalam->update([
                'production_batch_id' => $productionBatch->id,
                'mhw_korin' => $request->mhw_korin,
                'heating_level' => $request->heating_level,
                'speed' => $request->speed,
                'pressure' => $request->pressure,
                'packing_manual' => $request->packing_manual,
                'timbangan' => $request->timbangan,
                'heating_level_packing_manual' => $request->heating_level_packing_manual,
                'fe_sus_non_fe' => $request->fe_sus_non_fe,
                'setting_x' => $request->setting_x,
                'setting_y' => $request->setting_y,
                'checkweigher_pac' => $request->checkweigher_pac,
                'petugas_sortasi_after_iqf' => $request->petugas_sortasi_after_iqf,
                'operator_md' => $request->operator_md,
                'leader_produksi' => $request->leader_produksi,
                'waktu_awal' => $request->waktu_awal,
                'waktu_akhir' => $request->waktu_akhir,
                'line' => $productionBatch->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            $packingDalam->samplings()->delete();

            $samplingData = $request->input('sampling', []);

            for ($i = 1; $i <= 10; $i++) {
                $sampling = $samplingData[$i] ?? [];

                $beratKemasan = $sampling['berat_kemasan'] ?? null;
                $beratPerBag = $sampling['berat_per_bag'] ?? null;
                $rangeBerat = $sampling['range_berat'] ?? null;

                if (
                    filled($beratKemasan) ||
                    filled($beratPerBag) ||
                    filled($rangeBerat)
                ) {
                    $packingDalam->samplings()->create([
                        'sampling_ke' => $i,
                        'berat_kemasan' => $beratKemasan ?: null,
                        'berat_per_bag' => $beratPerBag ?: null,
                        'range_berat' => $rangeBerat ?: null,
                    ]);
                }
            }

            $packingDalam->plastiks()->delete();

            $productsPlastik = Product::whereHas('processType', function ($query) {
                $query->where('name', 'Plastik');
            })
                ->with('productGroup')
                ->get();

            $allowedProductIds = $productsPlastik->pluck('id')->toArray();

            $packingLuar = PackingLuar::with('palets')
                ->where('production_batch_id', $productionBatch->id)
                ->latest('id')
                ->first();

            $jumlahPack = $packingLuar
                ? $packingLuar->palets->sum('jumlah_pack')
                : 0;

            $plastikData = $request->input('plastik', []);

            foreach ($plastikData as $plastik) {
                $productId = $plastik['product_id'] ?? null;

                if ($productId && in_array($productId, $allowedProductIds)) {
                    $product = $productsPlastik->firstWhere('id', $productId);

                    $jumlah = $plastik['jumlah'] ?? null;
                    $sisa = $plastik['sisa'] ?? null;
                    $rijek = $plastik['rijek'] ?? null;
                    $operatorMhw = $plastik['operator_mhw'] ?? null;
                    $checkerDs = $plastik['checker_ds'] ?? null;
                    $leader = $plastik['leader'] ?? null;

                    $pemakaian = null;

                    if ($product && $jumlahPack > 0) {
                        $gramasi = (float) $product->gramasi;

                        $productGroup = strtolower(
                            trim($product->productGroup->name ?? '')
                        );

                        $faktor = null;

                        if ($productGroup === 'stick') {
                            if ($gramasi == 225 || $gramasi == 250) {
                                $faktor = 0.215;
                            }
                        } elseif ($productGroup === 'nugget') {
                            if ($gramasi == 225 || $gramasi == 250) {
                                $faktor = 0.2;
                            }
                        } else {
                            if ($gramasi == 200) {
                                $faktor = 0.19;
                            } elseif ($gramasi == 225 || $gramasi == 250) {
                                $faktor = 0.2;
                            } elseif ($gramasi == 315 || $gramasi == 360) {
                                $faktor = 0.25;
                            } elseif (
                                $gramasi == 400 ||
                                $gramasi == 450 ||
                                $gramasi == 500
                            ) {
                                $faktor = 0.253;
                            } elseif (
                                $gramasi == 900 ||
                                $gramasi == 1000
                            ) {
                                $faktor = 0.34;
                            }
                        }

                        if ($faktor !== null) {
                            $pemakaianDasar = $jumlahPack * $faktor;
                            $pemakaian = $pemakaianDasar;

                            if (filled($rijek)) {
                                $pemakaian = $pemakaianDasar
                                    + ($pemakaianDasar * ((float) $rijek / 100));
                            }

                            $pemakaian = round($pemakaian, 2);
                        }
                    }

                    if (
                        filled($jumlah) ||
                        $pemakaian !== null ||
                        filled($sisa) ||
                        filled($rijek) ||
                        filled($operatorMhw) ||
                        filled($checkerDs) ||
                        filled($leader)
                    ) {
                        $packingDalam->plastiks()->create([
                            'product_id' => $productId,
                            'jumlah' => $jumlah ?: null,
                            'pemakaian' => $pemakaian,
                            'sisa' => $sisa ?: null,
                            'rijek' => $rijek ?: null,
                            'operator_mhw' => $operatorMhw ?: null,
                            'checker_ds' => $checkerDs ?: null,
                            'leader' => $leader ?: null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('operator.packing-dalam.index')
                ->with(
                    'success',
                    'Data packing dalam berhasil diperbarui.'
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
            $packingDalam = PackingDalam::findOrFail($id);

            $packingDalam->delete();

            DB::commit();

            return redirect()
                ->route('operator.packing-dalam.index')
                ->with(
                    'success',
                    'Data packing dalam berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.packing-dalam.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }
}