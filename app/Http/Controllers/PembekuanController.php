<?php

namespace App\Http\Controllers;

use App\Models\Pembekuan;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembekuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembekuan::with('productionBatch.product')->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where(
                    'no_batch',
                    'like',
                    '%' . $request->no_batch . '%'
                );
            });
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
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

        $pembekuans = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.pembekuan.index',
            compact('pembekuans')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.pembekuan.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $pembekuan = Pembekuan::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.operator.pembekuan.detail',
            compact('pembekuan')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'suhu_ruang_packing' => [
                'nullable',
                'numeric',
            ],
            'suhu_ruang_iqf' => [
                'nullable',
                'numeric',
            ],
            'speed_conveyor' => [
                'nullable',
                'numeric',
            ],
            'suhu_pusat' => [
                'nullable',
                'numeric',
            ],
            'suhu_minimum' => [
                'nullable',
                'numeric',
            ],
            'waktu_mulai' => [
                'nullable',
                'date_format:H:i',
            ],
            'waktu_selesai' => [
                'nullable',
                'date_format:H:i',
            ],
            'lama_waktu_kerusakan' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'lama_waktu_istirahat' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'operator' => [
                'nullable',
                'string',
                'max:100',
            ],
            'line' => [
                'nullable',
                'string',
                'max:100',
            ],
            'pic_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        DB::beginTransaction();

        try {
            Pembekuan::create([
                'production_batch_id' => $request->production_batch_id,
                'suhu_ruang_packing' => $request->suhu_ruang_packing,
                'suhu_ruang_iqf' => $request->suhu_ruang_iqf,
                'speed_conveyor' => $request->speed_conveyor,
                'suhu_pusat' => $request->suhu_pusat,
                'suhu_minimum' => $request->suhu_minimum,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'lama_waktu_kerusakan' => $request->lama_waktu_kerusakan,
                'lama_waktu_istirahat' => $request->lama_waktu_istirahat,
                'operator' => $request->operator,
                'line' => $request->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            DB::commit();

            return redirect()
                ->route('operator.pembekuan.index')
                ->with(
                    'success',
                    'Data Pembekuan berhasil disimpan.'
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
        $pembekuan = Pembekuan::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.pembekuan.edit',
            compact(
                'pembekuan',
                'productionBatches'
            )
        );
    }

    public function update(Request $request, $id)
    {
        if ($request->filled('waktu_mulai')) {
            $request->merge([
                'waktu_mulai' => substr(
                    $request->waktu_mulai,
                    0,
                    5
                ),
            ]);
        }

        if ($request->filled('waktu_selesai')) {
            $request->merge([
                'waktu_selesai' => substr(
                    $request->waktu_selesai,
                    0,
                    5
                ),
            ]);
        }

        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'suhu_ruang_packing' => [
                'nullable',
                'numeric',
            ],
            'suhu_ruang_iqf' => [
                'nullable',
                'numeric',
            ],
            'speed_conveyor' => [
                'nullable',
                'numeric',
            ],
            'suhu_pusat' => [
                'nullable',
                'numeric',
            ],
            'suhu_minimum' => [
                'nullable',
                'numeric',
            ],
            'waktu_mulai' => [
                'nullable',
                'date_format:H:i',
            ],
            'waktu_selesai' => [
                'nullable',
                'date_format:H:i',
            ],
            'lama_waktu_kerusakan' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'lama_waktu_istirahat' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'operator' => [
                'nullable',
                'string',
                'max:100',
            ],
            'line' => [
                'nullable',
                'string',
                'max:100',
            ],
            'pic_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        DB::beginTransaction();

        try {
            $pembekuan = Pembekuan::findOrFail($id);

            $pembekuan->update([
                'production_batch_id' => $request->production_batch_id,
                'suhu_ruang_packing' => $request->suhu_ruang_packing,
                'suhu_ruang_iqf' => $request->suhu_ruang_iqf,
                'speed_conveyor' => $request->speed_conveyor,
                'suhu_pusat' => $request->suhu_pusat,
                'suhu_minimum' => $request->suhu_minimum,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'lama_waktu_kerusakan' => $request->lama_waktu_kerusakan,
                'lama_waktu_istirahat' => $request->lama_waktu_istirahat,
                'operator' => $request->operator,
                'line' => $request->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            DB::commit();

            return redirect()
                ->route('operator.pembekuan.index')
                ->with(
                    'success',
                    'Data Pembekuan berhasil diperbarui.'
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
            $pembekuan = Pembekuan::findOrFail($id);

            $pembekuan->delete();

            DB::commit();

            return redirect()
                ->route('operator.pembekuan.index')
                ->with(
                    'success',
                    'Data Pembekuan berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.pembekuan.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function summary(Request $request)
    {
        $query = Pembekuan::with('productionBatch.product');

        if ($request->filled('line')) {
            $query->where('line', $request->line);
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

        $pembekuans = $query
            ->get()
            ->sortBy(function ($pembekuan) {
                if ($pembekuan->productionBatch) {
                    return $pembekuan->productionBatch->tanggal_produksi
                        . '_' .
                        str_pad(
                            $pembekuan->production_batch_id,
                            10,
                            '0',
                            STR_PAD_LEFT
                        )
                        . '_' .
                        str_pad(
                            $pembekuan->id,
                            10,
                            '0',
                            STR_PAD_LEFT
                        );
                }

                return '9999-99-99_9999999999_' .
                    str_pad(
                        $pembekuan->id,
                        10,
                        '0',
                        STR_PAD_LEFT
                    );
            })
            ->values();

        $totalRecord = $pembekuans->count();

        $dataDenganSuhu = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null;
        });

        $suhuPusatRataRata = $dataDenganSuhu->count() > 0
            ? $dataDenganSuhu->avg('suhu_pusat')
            : null;

        $diBawahMinimum = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null
                && $pembekuan->suhu_minimum !== null
                && (float) $pembekuan->suhu_pusat < (float) $pembekuan->suhu_minimum;
        })->count();

        $sesuaiMinimum = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null
                && $pembekuan->suhu_minimum !== null
                && (float) $pembekuan->suhu_pusat >= (float) $pembekuan->suhu_minimum;
        })->count();

        $dataDenganSuhuMinimum = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null
                && $pembekuan->suhu_minimum !== null;
        });

        $persentaseSesuai = $dataDenganSuhuMinimum->count() > 0
            ? ($sesuaiMinimum / $dataDenganSuhuMinimum->count()) * 100
            : 0;

        $chartData = $pembekuans
            ->filter(function ($pembekuan) {
                return $pembekuan->productionBatch
                    && $pembekuan->productionBatch->tanggal_produksi
                    && $pembekuan->suhu_pusat !== null;
            })
            ->map(function ($pembekuan) {
                $product = $pembekuan->productionBatch->product;

                return [
                    'id' => $pembekuan->id,
                    'tanggal' => $pembekuan->productionBatch->tanggal_produksi,
                    'no_batch' => $pembekuan->productionBatch->no_batch,
                    'kode_product' => $product->kode_product ?? null,
                    'nama_product' => $product->nama_product ?? null,
                    'line' => $pembekuan->line,
                    'suhu_pusat' => (float) $pembekuan->suhu_pusat,
                    'suhu_minimum' => $pembekuan->suhu_minimum !== null
                        ? (float) $pembekuan->suhu_minimum
                        : null,
                ];
            })
            ->values();

        $lines = Pembekuan::query()
            ->whereNotNull('line')
            ->where('line', '!=', '')
            ->distinct()
            ->orderBy('line')
            ->pluck('line');

        return view(
            'pages.operator.pembekuan.summary',
            compact(
                'totalRecord',
                'suhuPusatRataRata',
                'diBawahMinimum',
                'sesuaiMinimum',
                'persentaseSesuai',
                'chartData',
                'lines'
            )
        );
    }

    public function managerIndex(Request $request)
    {
        $query = Pembekuan::with('productionBatch.product')->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where(
                    'no_batch',
                    'like',
                    '%' . $request->no_batch . '%'
                );
            });
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
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

        $pembekuans = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.pembekuan.index',
            compact('pembekuans')
        );
    }

    public function managerDetail($id)
    {
        $pembekuan = Pembekuan::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.manager.pembekuan.detail',
            compact('pembekuan')
        );
    }
    
    public function managerSummary(Request $request)
    {
        $query = Pembekuan::with('productionBatch.product');

        if ($request->filled('line')) {
            $query->where('line', $request->line);
        }

        if ($request->filled('date_from')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate(
                    'tanggal_produksi',
                    '>=',
                    $request->date_from
                );
            });
        } else {
            $query->whereHas('productionBatch', function ($q) {
                $q->whereDate(
                    'tanggal_produksi',
                    now()->toDateString()
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
        $pembekuans = $query
            ->get()
            ->sortBy(function ($pembekuan) {
                if ($pembekuan->productionBatch) {
                    return $pembekuan->productionBatch->tanggal_produksi
                        . '_'
                        . str_pad(
                            $pembekuan->production_batch_id,
                            10,
                            '0',
                            STR_PAD_LEFT
                        )
                        . '_'
                        . str_pad(
                            $pembekuan->id,
                            10,
                            '0',
                            STR_PAD_LEFT
                        );
                }

                return '9999-99-99_9999999999_'
                    . str_pad(
                        $pembekuan->id,
                        10,
                        '0',
                        STR_PAD_LEFT
                    );
            })
            ->values();

        $totalRecord = $pembekuans->count();

        $dataDenganSuhu = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null;
        });

        $suhuPusatRataRata = $dataDenganSuhu->count() > 0
            ? $dataDenganSuhu->avg('suhu_pusat')
            : null;

        $diBawahMinimum = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null
                && $pembekuan->suhu_minimum !== null
                && (float) $pembekuan->suhu_pusat
                > (float) $pembekuan->suhu_minimum;
        })->count();

        $sesuaiMinimum = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null
                && $pembekuan->suhu_minimum !== null
                && (float) $pembekuan->suhu_pusat
                    <= (float) $pembekuan->suhu_minimum;
        })->count();

        $dataDenganSuhuMinimum = $pembekuans->filter(function ($pembekuan) {
            return $pembekuan->suhu_pusat !== null
                && $pembekuan->suhu_minimum !== null;
        });

        $persentaseSesuai = $dataDenganSuhuMinimum->count() > 0
            ? ($sesuaiMinimum / $dataDenganSuhuMinimum->count()) * 100
            : 0;

        $chartData = $pembekuans
            ->filter(function ($pembekuan) {
                return $pembekuan->productionBatch
                    && $pembekuan->productionBatch->tanggal_produksi
                    && $pembekuan->suhu_pusat !== null;
            })
            ->map(function ($pembekuan) {
                $product = $pembekuan->productionBatch->product;

                return [
                    'id' => $pembekuan->id,
                    'tanggal' => $pembekuan->productionBatch->tanggal_produksi,
                    'no_batch' => $pembekuan->productionBatch->no_batch,
                    'kode_product' => $product->kode_product ?? null,
                    'nama_product' => $product->nama_product ?? null,
                    'line' => $pembekuan->line,
                    'suhu_ruang_packing' => $pembekuan->suhu_ruang_packing !== null
                        ? (float) $pembekuan->suhu_ruang_packing
                        : null,
                    'suhu_ruang_iqf' => $pembekuan->suhu_ruang_iqf !== null
                        ? (float) $pembekuan->suhu_ruang_iqf
                        : null,
                    'speed_conveyor' => $pembekuan->speed_conveyor !== null
                        ? (float) $pembekuan->speed_conveyor
                        : null,
                    'suhu_pusat' => (float) $pembekuan->suhu_pusat,
                    'suhu_minimum' => $pembekuan->suhu_minimum !== null
                        ? (float) $pembekuan->suhu_minimum
                        : null,
                ];
            })
            ->values();

        $lines = Pembekuan::query()
            ->whereNotNull('line')
            ->where('line', '!=', '')
            ->distinct()
            ->orderBy('line')
            ->pluck('line');

        return view(
            'pages.manager.pembekuan.summary',
            compact(
                'totalRecord',
                'suhuPusatRataRata',
                'diBawahMinimum',
                'sesuaiMinimum',
                'persentaseSesuai',
                'chartData',
                'lines'
            )
        );
    }
}