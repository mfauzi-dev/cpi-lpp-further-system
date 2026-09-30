<?php

namespace App\Http\Controllers;

use App\Models\PackingLuar;
use App\Models\PackingLuarKemasan;
use App\Models\PackingLuarPalet;
use App\Models\PackingLuarSampling;
use App\Models\Product;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackingLuarController extends Controller
{
    public function index(Request $request)
    {
        $query = PackingLuar::with('productionBatch.product');

        if ($request->filled('kode_product')) {
            $query->whereHas('productionBatch.product', function ($q) use ($request) {
                $q->where(
                    'kode_product',
                    'like',
                    '%' . $request->kode_product . '%'
                );
            });
        }

        if ($request->filled('line')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('line', $request->line);
            });
        }

        if ($request->filled('date_from')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate(
                    'tanggal_produksi',
                    '>=',
                    $request->date_from
                );
            });
        }

        if ($request->filled('date_to')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate(
                    'tanggal_produksi',
                    '<=',
                    $request->date_to
                );
            });
        }

        $packingLuars = $query
            ->latest()
            ->paginate(10);

        return view(
            'pages.operator.packing-luar.index',
            compact('packingLuars')
        );
    }

    public function managerIndex(Request $request)
    {
        $query = PackingLuar::with('productionBatch.product')->latest();

        if ($request->filled('kode_product')) {
            $query->whereHas('productionBatch.product', function ($q) use ($request) {
                $q->where('kode_product', 'like', '%' . $request->kode_product . '%');
            });
        }

        if ($request->filled('line')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('line', $request->line);
            });
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

        $packingLuars = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.packing-luar.index',
            compact('packingLuars')
        );
    }

    public function managerDetail($id)
    {
        $packingLuar = PackingLuar::with([
            'productionBatch.product.productGroup',
            'samplings',
            'kemasans.product.productGroup',
            'palets.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.manager.packing-luar.detail',
            compact('packingLuar')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->orderByDesc('tanggal_produksi')
            ->orderBy('no_batch')
            ->get();

        $productsKemasan = Product::orderBy('nama')->get();

        $productsPalet = Product::whereHas('processType', function ($query) {
                            $query->where('name', 'CARTON BOX');
                        })
                        ->orderBy('nama')
                        ->get();

        return view(
            'pages.operator.packing-luar.create',
            compact(
                'productionBatches',
                'productsKemasan',
                'productsPalet'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_produksi' => 'required|date',
            'production_batch_id' => 'required|exists:production_batches,id',
            'pengisian_ke_dalam_box' => 'nullable|string|max:255',
            'sealer_box' => 'nullable|string|max:255',
            'check_weigher_box' => 'nullable|string|max:255',
            'petugas' => 'nullable|string|max:255',
            'pic_produksi' => 'nullable|string|max:255',
            'waktu_awal' => 'nullable|date_format:H:i',
            'waktu_akhir' => 'nullable|date_format:H:i',
            'sampling' => 'nullable|array',
            'sampling.*.sampling_ke' => 'nullable|integer|min:1',
            'sampling.*.berat_per_box' => 'nullable|numeric|min:0',
            'sampling.*.range_berat' => 'nullable|string|max:255',
            'kemasan' => 'nullable|array',
            'kemasan.*.product_id' => 'required|exists:products,id',
            'kemasan.*.jumlah' => 'nullable|numeric|min:0',
            'kemasan.*.pemakaian' => 'nullable|numeric|min:0',
            'kemasan.*.sisa' => 'nullable|numeric|min:0',
            'kemasan.*.rijek' => 'nullable|numeric|min:0',
            'kemasan.*.petugas' => 'nullable|string|max:255',
            'palet' => 'nullable|array',
            'palet.*.no_palet' => 'nullable|integer|min:1',
            'palet.*.product_id' => 'required|exists:products,id',
            'palet.*.jumlah_pack' => 'nullable|integer|min:0',
            'palet.*.jumlah_box' => 'nullable|numeric|min:0',
            'palet.*.jumlah_kg' => 'nullable|numeric|min:0',
            'palet.*.no_bstb' => 'required|string|max:255',
            'palet.*.jumlah_wip_keluar_bag' => 'nullable|numeric|min:0',
            'palet.*.jumlah_wip_keluar_kg' => 'nullable|numeric|min:0',
            'palet.*.jumlah_wip_keluar_lot' => 'nullable|numeric|min:0',
            'palet.*.jumlah_wip_masuk' => 'nullable|numeric|min:0',
            'palet.*.checker_fg' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {

            $packingLuar = PackingLuar::create([
                'production_batch_id' => $request->production_batch_id,
                'pengisian_ke_dalam_box' => $request->pengisian_ke_dalam_box,
                'sealer_box' => $request->sealer_box,
                'check_weigher_box' => $request->check_weigher_box,
                'petugas' => $request->petugas,
                'pic_produksi' => $request->pic_produksi,
                'waktu_awal' => $request->waktu_awal,
                'waktu_akhir' => $request->waktu_akhir,
            ]);

            if (!empty($request->waktu_awal)) {
                $productionBatch = ProductionBatch::with('formings')
                    ->findOrFail($request->production_batch_id);

                $forming = $productionBatch->formings
                    ->sortBy('waktu_mulai')
                    ->first();

                if ($forming && !empty($forming->waktu_mulai)) {
                    $waktuMulaiForming = \Carbon\Carbon::parse($forming->waktu_mulai);
                    $waktuAwalPackingLuar = \Carbon\Carbon::parse($request->waktu_awal);

                    if ($waktuAwalPackingLuar->lt($waktuMulaiForming)) {
                        $waktuAwalPackingLuar->addDay();
                    }

                    $waktuKerja = $waktuMulaiForming->diffInMinutes(
                        $waktuAwalPackingLuar
                    );

                    $productionBatch->update([
                        'waktu_kerja' => $waktuKerja,
                    ]);
                }
            }

            if ($request->filled('sampling')) {
                foreach ($request->sampling as $sampling) {
                    if (
                        empty($sampling['sampling_ke']) &&
                        empty($sampling['berat_per_box']) &&
                        empty($sampling['range_berat'])
                    ) {
                        continue;
                    }

                    PackingLuarSampling::create([
                        'packing_luar_id' => $packingLuar->id,
                        'sampling_ke' => $sampling['sampling_ke'],
                        'berat_per_box' => $sampling['berat_per_box'] ?? null,
                        'range_berat' => $sampling['range_berat'] ?? null,
                    ]);
                }
            }

            if ($request->filled('kemasan')) {
                foreach ($request->kemasan as $kemasan) {
                    if (empty($kemasan['product_id'])) {
                        continue;
                    }

                    PackingLuarKemasan::create([
                        'packing_luar_id' => $packingLuar->id,
                        'product_id' => $kemasan['product_id'],
                        'jumlah' => $kemasan['jumlah'] ?? null,
                        'pemakaian' => $kemasan['pemakaian'] ?? null,
                        'sisa' => $kemasan['sisa'] ?? null,
                        'rijek' => $kemasan['rijek'] ?? null,
                        'petugas' => $kemasan['petugas'] ?? null,
                    ]);
                }
            }

            if ($request->filled('palet')) {
                foreach ($request->palet as $index => $palet) {
                    if (empty($palet['product_id'])) {
                        continue;
                    }

                    $product = Product::find($palet['product_id']);
                    $jumlahBox = $palet['jumlah_box'] ?? null;
                    $jumlahPack = null;

                    if (
                        $product &&
                        $product->pack_per_box !== null &&
                        $jumlahBox !== null
                    ) {
                        $jumlahPack = $product->pack_per_box * $jumlahBox;
                    }

                    PackingLuarPalet::create([
                        'packing_luar_id' => $packingLuar->id,
                        'product_id' => $palet['product_id'],
                        'no_palet' => $palet['no_palet'] ?? ($index + 1),
                        'jumlah_pack' => $jumlahPack,
                        'jumlah_box' => $jumlahBox,
                        'jumlah_kg' => $palet['jumlah_kg'] ?? null,
                        'no_bstb' => $palet['no_bstb'],
                        'jumlah_wip_keluar_bag' => $palet['jumlah_wip_keluar_bag'] ?? null,
                        'jumlah_wip_keluar_kg' => $palet['jumlah_wip_keluar_kg'] ?? null,
                        'jumlah_wip_keluar_lot' => $palet['jumlah_wip_keluar_lot'] ?? null,
                        'jumlah_wip_masuk' => $palet['jumlah_wip_masuk'] ?? null,
                        'checker_fg' => $palet['checker_fg'] ?? null,
                    ]);
                }
            }

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
        });

        return redirect()
            ->route('operator.packing-luar.index')
            ->with('success', 'Data Packing Luar berhasil disimpan.');
    }

    public function show($id)
    {
        $packingLuar = PackingLuar::with([
            'productionBatch.product',
            'samplings',
            'kemasans.product',
            'palets.product',
        ])->findOrFail($id);

        return view(
            'pages.operator.packing-luar.detail',
            compact('packingLuar')
        );
    }

    public function edit($id)
    {
        $packingLuar = PackingLuar::with([
            'productionBatch.product',
            'samplings',
            'kemasans.product',
            'palets.product',
        ])->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->orderByDesc('tanggal_produksi')
            ->orderBy('no_batch')
            ->get();

        $productsKemasan = Product::orderBy('nama')->get();

        $productsPalet = Product::orderBy('nama')->get();

        return view(
            'pages.operator.packing-luar.edit',
            compact(
                'packingLuar',
                'productionBatches',
                'productsKemasan',
                'productsPalet'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_produksi' => 'required|date',
            'production_batch_id' => 'required|exists:production_batches,id',
            'pengisian_ke_dalam_box' => 'nullable|string|max:255',
            'sealer_box' => 'nullable|string|max:255',
            'check_weigher_box' => 'nullable|string|max:255',
            'petugas' => 'nullable|string|max:255',
            'pic_produksi' => 'nullable|string|max:255',
            'waktu_awal' => 'nullable|date_format:H:i',
            'waktu_akhir' => 'nullable|date_format:H:i',
            'sampling' => 'nullable|array',
            'sampling.*.sampling_ke' => 'nullable|integer|min:1',
            'sampling.*.berat_per_box' => 'nullable|numeric|min:0',
            'sampling.*.range_berat' => 'nullable|string|max:255',
            'kemasan' => 'nullable|array',
            'kemasan.*.product_id' => 'required|exists:products,id',
            'kemasan.*.jumlah' => 'nullable|numeric|min:0',
            'kemasan.*.pemakaian' => 'nullable|numeric|min:0',
            'kemasan.*.sisa' => 'nullable|numeric|min:0',
            'kemasan.*.rijek' => 'nullable|numeric|min:0',
            'kemasan.*.petugas' => 'nullable|string|max:255',
            'palet' => 'nullable|array',
            'palet.*.no_palet' => 'nullable|integer|min:1',
            'palet.*.product_id' => 'required|exists:products,id',
            'palet.*.jumlah_pack' => 'nullable|integer|min:0',
            'palet.*.jumlah_box' => 'nullable|numeric|min:0',
            'palet.*.jumlah_kg' => 'nullable|numeric|min:0',
            'palet.*.no_bstb' => 'required|string|max:255',
            'palet.*.jumlah_wip_keluar_bag' => 'nullable|numeric|min:0',
            'palet.*.jumlah_wip_keluar_kg' => 'nullable|numeric|min:0',
            'palet.*.jumlah_wip_keluar_lot' => 'nullable|numeric|min:0',
            'palet.*.jumlah_wip_masuk' => 'nullable|numeric|min:0',
            'palet.*.checker_fg' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $id) {

            $packingLuar = PackingLuar::findOrFail($id);

            $packingLuar->update([
                'production_batch_id' => $request->production_batch_id,
                'pengisian_ke_dalam_box' => $request->pengisian_ke_dalam_box,
                'sealer_box' => $request->sealer_box,
                'check_weigher_box' => $request->check_weigher_box,
                'petugas' => $request->petugas,
                'pic_produksi' => $request->pic_produksi,
                'waktu_awal' => $request->waktu_awal,
                'waktu_akhir' => $request->waktu_akhir,
            ]);

            if (!empty($request->waktu_awal)) {
                $productionBatch = ProductionBatch::with([
                        'formings',
                        'batters',
                        'predustBreaders',
                        'hlts',
                    ])->findOrFail($request->production_batch_id);

                    $proses = null;

                    if ($productionBatch->tipe_proses === 'forming') {

                        $proses = $productionBatch->formings
                            ->sortBy('waktu_mulai')
                            ->first();

                    } elseif ($productionBatch->tipe_proses === 'non_forming') {

                        // salah satu dari batter / breader yang is_used = true
                        $proses = $productionBatch->batters
                            ->sortBy('waktu_mulai')
                            ->first();

                        if (!$proses) {
                            $proses = $productionBatch->predustBreaders
                                ->sortBy('waktu_mulai')
                                ->first();
                        }

                    } elseif ($productionBatch->tipe_proses === 'non_forming_roasted') {

                        $proses = $productionBatch->hlts
                            ->sortBy('waktu_mulai')
                            ->first();
                    }

                    if ($proses && !empty($proses->waktu_mulai)) {
                        $waktuMulai = \Carbon\Carbon::parse($proses->waktu_mulai);
                        $waktuAwalPackingLuar = \Carbon\Carbon::parse($request->waktu_awal);

                        if ($waktuAwalPackingLuar->lt($waktuMulai)) {
                            $waktuAwalPackingLuar->addDay();
                        }

                        $waktuKerja = $waktuMulai->diffInMinutes($waktuAwalPackingLuar);

                        $productionBatch->update([
                            'waktu_kerja' => $waktuKerja,
                        ]);
                    }
            }

            $packingLuar->samplings()->delete();
            $packingLuar->kemasans()->delete();
            $packingLuar->palets()->delete();

            if ($request->filled('sampling')) {
                foreach ($request->sampling as $sampling) {
                    if (
                        empty($sampling['sampling_ke']) &&
                        empty($sampling['berat_per_box']) &&
                        empty($sampling['range_berat'])
                    ) {
                        continue;
                    }

                    PackingLuarSampling::create([
                        'packing_luar_id' => $packingLuar->id,
                        'sampling_ke' => $sampling['sampling_ke'],
                        'berat_per_box' => $sampling['berat_per_box'] ?? null,
                        'range_berat' => $sampling['range_berat'] ?? null,
                    ]);
                }
            }

            if ($request->filled('kemasan')) {
                foreach ($request->kemasan as $kemasan) {
                    if (empty($kemasan['product_id'])) {
                        continue;
                    }

                    PackingLuarKemasan::create([
                        'packing_luar_id' => $packingLuar->id,
                        'product_id' => $kemasan['product_id'],
                        'jumlah' => $kemasan['jumlah'] ?? null,
                        'pemakaian' => $kemasan['pemakaian'] ?? null,
                        'sisa' => $kemasan['sisa'] ?? null,
                        'rijek' => $kemasan['rijek'] ?? null,
                        'petugas' => $kemasan['petugas'] ?? null,
                    ]);
                }
            }

            if ($request->filled('palet')) {
                foreach ($request->palet as $index => $palet) {
                    if (empty($palet['product_id'])) {
                        continue;
                    }

                    $product = Product::find($palet['product_id']);
                    $jumlahBox = $palet['jumlah_box'] ?? null;
                    $jumlahPack = null;

                    if (
                        $product &&
                        $product->pack_per_box !== null &&
                        $jumlahBox !== null
                    ) {
                        $jumlahPack = $product->pack_per_box * $jumlahBox;
                    }

                    PackingLuarPalet::create([
                        'packing_luar_id' => $packingLuar->id,
                        'product_id' => $palet['product_id'],
                        'no_palet' => $palet['no_palet'] ?? ($index + 1),
                        'jumlah_pack' => $jumlahPack,
                        'jumlah_box' => $jumlahBox,
                        'jumlah_kg' => $palet['jumlah_kg'] ?? null,
                        'no_bstb' => $palet['no_bstb'],
                        'jumlah_wip_keluar_bag' => $palet['jumlah_wip_keluar_bag'] ?? null,
                        'jumlah_wip_keluar_kg' => $palet['jumlah_wip_keluar_kg'] ?? null,
                        'jumlah_wip_keluar_lot' => $palet['jumlah_wip_keluar_lot'] ?? null,
                        'jumlah_wip_masuk' => $palet['jumlah_wip_masuk'] ?? null,
                        'checker_fg' => $palet['checker_fg'] ?? null,
                    ]);
                }
            }

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
        });

        return redirect()
            ->route('operator.packing-luar.index')
            ->with('success', 'Data Packing Luar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $packingLuar = PackingLuar::findOrFail($id);

        $packingLuar->delete();

        return redirect()
            ->route('operator.packing-luar.index')
            ->with('success', 'Data Packing Luar berhasil dihapus.');
    }
}