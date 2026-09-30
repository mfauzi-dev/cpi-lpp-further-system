<?php

namespace App\Http\Controllers;

use App\Models\Fryer;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FryerController extends Controller
{
    public function index(Request $request)
    {
        $query = Fryer::with('productionBatch.product')->latest();

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

        $fryers = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.fryer.index',
            compact('fryers')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.fryer.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $fryer = Fryer::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.operator.fryer.detail',
            compact('fryer')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'fryer' => [
                'required',
                'in:1,2,3,4,5',
            ],
            'suhu_setting' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'suhu_aktual' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'suhu_pusat' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'suhu_minimum' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'organoleptik' => [
                'nullable',
                'in:Ok,Tidak',
            ],
            'lama_pemasakan' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'tpm_minyak' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waktu_mulai' => [
                'nullable',
                'date_format:H:i',
            ],
            'waktu_selesai' => [
                'nullable',
                'date_format:H:i',
            ],
            'downtime' => [
                'nullable',
                'string',
                'max:100',
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
            'petugas' => [
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
            Fryer::create([
                'production_batch_id' => $request->production_batch_id,
                'fryer' => $request->fryer,
                'suhu_setting' => $request->suhu_setting,
                'suhu_aktual' => $request->suhu_aktual,
                'suhu_pusat' => $request->suhu_pusat,
                'suhu_minimum' => $request->suhu_minimum,
                'organoleptik' => $request->organoleptik,
                'lama_pemasakan' => $request->lama_pemasakan,
                'tpm_minyak' => $request->tpm_minyak,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'downtime' => $request->downtime,
                'keterangan' => $request->keterangan,
                'petugas' => $request->petugas,
                'line' => $request->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            DB::commit();

            return redirect()
                ->route('operator.fryer.index')
                ->with(
                    'success',
                    'Data Fryer berhasil disimpan.'
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
        $fryer = Fryer::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.fryer.edit',
            compact(
                'fryer',
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
            'fryer' => [
                'required',
                'in:1,2,3,4,5',
            ],
            'suhu_setting' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'suhu_aktual' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'suhu_pusat' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'suhu_minimum' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'organoleptik' => [
                'nullable',
                'in:Ok,Tidak',
            ],
            'lama_pemasakan' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'tpm_minyak' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'waktu_mulai' => [
                'nullable',
                'date_format:H:i',
            ],
            'waktu_selesai' => [
                'nullable',
                'date_format:H:i',
            ],
            'downtime' => [
                'nullable',
                'string',
                'max:100',
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
            'petugas' => [
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
            $fryer = Fryer::findOrFail($id);

            $fryer->update([
                'production_batch_id' => $request->production_batch_id,
                'fryer' => $request->fryer,
                'suhu_setting' => $request->suhu_setting,
                'suhu_aktual' => $request->suhu_aktual,
                'suhu_pusat' => $request->suhu_pusat,
                'suhu_minimum' => $request->suhu_minimum,
                'organoleptik' => $request->organoleptik,
                'lama_pemasakan' => $request->lama_pemasakan,
                'tpm_minyak' => $request->tpm_minyak,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'downtime' => $request->downtime,
                'keterangan' => $request->keterangan,
                'petugas' => $request->petugas,
                'line' => $request->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            DB::commit();

            return redirect()
                ->route('operator.fryer.index')
                ->with(
                    'success',
                    'Data Fryer berhasil diperbarui.'
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
            $fryer = Fryer::findOrFail($id);
            $fryer->delete();

            DB::commit();

            return redirect()
                ->route('operator.fryer.index')
                ->with(
                    'success',
                    'Data Fryer berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.fryer.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function summary(Request $request)
    {
        $query = Fryer::with('productionBatch.product');

        if ($request->filled('line')) {
            $query->where('line', $request->line);
        }

        if ($request->filled('fryer')) {
            $query->where('fryer', $request->fryer);
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

        $fryers = $query
            ->orderByDesc('id')
            ->get();

        $totalRecord = $fryers->count();

        $dataDenganSuhu = $fryers->filter(function ($fryer) {
            return $fryer->suhu_pusat !== null;
        });

        $suhuPusatRataRata = $dataDenganSuhu->avg('suhu_pusat');

        $diBawahMinimum = $fryers->filter(function ($fryer) {
            return $fryer->suhu_pusat !== null
                && $fryer->suhu_minimum !== null
                && $fryer->suhu_pusat < $fryer->suhu_minimum;
        })->count();

        $sesuaiMinimum = $fryers->filter(function ($fryer) {
            return $fryer->suhu_pusat !== null
                && $fryer->suhu_minimum !== null
                && $fryer->suhu_pusat >= $fryer->suhu_minimum;
        })->count();

        $dataDenganMinimum = $fryers->filter(function ($fryer) {
            return $fryer->suhu_pusat !== null
                && $fryer->suhu_minimum !== null;
        });

        $persentaseSesuai = $dataDenganMinimum->count() > 0
            ? ($sesuaiMinimum / $dataDenganMinimum->count()) * 100
            : 0;

        $chartData = $fryers
            ->filter(function ($fryer) {
                return $fryer->productionBatch
                    && $fryer->suhu_pusat !== null;
            })
            ->sortBy(function ($fryer) {
                return $fryer->productionBatch->tanggal_produksi;
            })
            ->map(function ($fryer) {
                return [
                    'tanggal' => $fryer->productionBatch->tanggal_produksi,
                    'no_batch' => $fryer->productionBatch->no_batch,
                    'kode_product' => $fryer->productionBatch->product
                        ? $fryer->productionBatch->product->kode_product
                        : null,
                    'nama_product' => $fryer->productionBatch->product
                        ? $fryer->productionBatch->product->nama
                        : null,
                    'line' => $fryer->line,
                    'fryer' => $fryer->fryer,
                    'suhu_pusat' => (float) $fryer->suhu_pusat,
                    'suhu_minimum' => $fryer->suhu_minimum !== null
                        ? (float) $fryer->suhu_minimum
                        : null,
                ];
            })
            ->values();

        $lines = Fryer::query()
            ->whereNotNull('line')
            ->where('line', '!=', '')
            ->distinct()
            ->orderBy('line')
            ->pluck('line');

        $fryersList = Fryer::query()
            ->whereNotNull('fryer')
            ->distinct()
            ->orderBy('fryer')
            ->pluck('fryer');

        return view(
            'pages.operator.fryer.summary',
            compact(
                'totalRecord',
                'suhuPusatRataRata',
                'diBawahMinimum',
                'sesuaiMinimum',
                'persentaseSesuai',
                'chartData',
                'lines',
                'fryersList'
            )
        );
    }

    public function managerIndex(Request $request)
    {
        $query = Fryer::with('productionBatch.product')->latest();

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

        $fryers = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.fryer.index',
            compact('fryers')
        );
    }

    public function managerDetail($id)
    {
        $fryer = Fryer::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.manager.fryer.detail',
            compact('fryer')
        );
    }

   public function managerSummary(Request $request)
    {
        $query = Fryer::with('productionBatch.product');
    
        if ($request->filled('line')) {
            $query->where('line', $request->line);
        }
    
        if ($request->filled('fryer')) {
            $query->where('fryer', $request->fryer);
        }
    
        if ($request->filled('date_from')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate('tanggal_produksi', '>=', $request->date_from);
            });
        } else {
            $query->whereHas('productionBatch', function ($q) {
                $q->whereDate('tanggal_produksi', now()->toDateString());
            });
        }
    
        if ($request->filled('date_to')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->whereDate('tanggal_produksi', '<=', $request->date_to);
            });
        }
    
        $fryers = $query->orderByDesc('id')->get();
    
        $totalRecord = $fryers->count();
    
        $dataDenganSuhu = $fryers->filter(fn ($fryer) => $fryer->suhu_pusat !== null);
    
        $suhuPusatRataRata = $dataDenganSuhu->avg('suhu_pusat');
    
        $diBawahMinimum = $fryers->filter(function ($fryer) {
            return $fryer->suhu_pusat !== null
                && $fryer->suhu_minimum !== null
                && $fryer->suhu_pusat < $fryer->suhu_minimum;
        })->count();
    
        $sesuaiMinimum = $fryers->filter(function ($fryer) {
            return $fryer->suhu_pusat !== null
                && $fryer->suhu_minimum !== null
                && $fryer->suhu_pusat >= $fryer->suhu_minimum;
        })->count();
    
        $dataDenganMinimum = $fryers->filter(function ($fryer) {
            return $fryer->suhu_pusat !== null && $fryer->suhu_minimum !== null;
        });
    
        $persentaseSesuai = $dataDenganMinimum->count() > 0
            ? ($sesuaiMinimum / $dataDenganMinimum->count()) * 100
            : 0;
    
        $chartData = $fryers
            ->filter(fn ($fryer) => $fryer->productionBatch && $fryer->suhu_pusat !== null)
            ->sortBy(fn ($fryer) => $fryer->productionBatch->tanggal_produksi)
            ->map(function ($fryer) {
                return [
                    'tanggal' => $fryer->productionBatch->tanggal_produksi,
                    'no_batch' => $fryer->productionBatch->no_batch,
                    'kode_product' => $fryer->productionBatch->product?->kode_product,
                    'nama_product' => $fryer->productionBatch->product?->nama,
                    'line' => $fryer->line,
                    'fryer' => $fryer->fryer,
                    // BARU: dipakai blade & JS untuk menentukan ambang batas suhu
                    'tipe_proses' => $fryer->productionBatch->tipe_proses,
                    'suhu_pusat' => (float) $fryer->suhu_pusat,
                    'suhu_minimum' => $fryer->suhu_minimum !== null ? (float) $fryer->suhu_minimum : null,
                    'organoleptik' => $fryer->organoleptik,
                ];
            })
            ->values();
    
        $lines = Fryer::query()
            ->whereNotNull('line')
            ->where('line', '!=', '')
            ->distinct()
            ->orderBy('line')
            ->pluck('line');
    
        $fryersList = Fryer::query()
            ->whereNotNull('fryer')
            ->distinct()
            ->orderBy('fryer')
            ->pluck('fryer');
    
        return view(
            'pages.manager.fryer.summary',
            compact(
                'totalRecord',
                'suhuPusatRataRata',
                'diBawahMinimum',
                'sesuaiMinimum',
                'persentaseSesuai',
                'chartData',
                'lines',
                'fryersList'
            )
        );
    }
}