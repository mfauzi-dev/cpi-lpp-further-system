<?php

namespace App\Http\Controllers;

use App\Models\SuhuRuang;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuhuRuangController extends Controller
{
    /**
     * Rules validasi, dipakai bersama oleh store() dan update().
     */
    protected function rules(): array
    {
        return [
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'suhu_ruang_meatprep' => [
                'nullable',
                'numeric',
            ],
            'suhu_ruang_chillroom' => [
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
        ];
    }

    public function index(Request $request)
    {
        $query = SuhuRuang::with('productionBatch.product')->latest();

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

        $suhuRuangs = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.suhu-ruang.index',
            compact('suhuRuangs')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.suhu-ruang.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $suhuRuang = SuhuRuang::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.operator.suhu-ruang.detail',
            compact('suhuRuang')
        );
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        DB::beginTransaction();

        try {
            SuhuRuang::create([
                'production_batch_id' => $request->production_batch_id,
                'suhu_ruang_meatprep' => $request->suhu_ruang_meatprep,
                'suhu_ruang_chillroom' => $request->suhu_ruang_chillroom,
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
                ->route('operator.suhu-ruang.index')
                ->with(
                    'success',
                    'Data Suhu Ruang berhasil disimpan.'
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
        $suhuRuang = SuhuRuang::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.suhu-ruang.edit',
            compact(
                'suhuRuang',
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

        $request->validate($this->rules());

        DB::beginTransaction();

        try {
            $suhuRuang = SuhuRuang::findOrFail($id);

            $suhuRuang->update([
                'production_batch_id' => $request->production_batch_id,
                'suhu_ruang_meatprep' => $request->suhu_ruang_meatprep,
                'suhu_ruang_chillroom' => $request->suhu_ruang_chillroom,
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
                ->route('operator.suhu-ruang.index')
                ->with(
                    'success',
                    'Data Suhu Ruang berhasil diperbarui.'
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
            $suhuRuang = SuhuRuang::findOrFail($id);

            $suhuRuang->delete();

            DB::commit();

            return redirect()
                ->route('operator.suhu-ruang.index')
                ->with(
                    'success',
                    'Data Suhu Ruang berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.suhu-ruang.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------
    | MANAGER
    |--------------------------------------------------------------------
    */

    public function managerIndex(Request $request)
    {
        $query = SuhuRuang::with('productionBatch.product')->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where(
                    'no_batch',
                    'like',
                    '%' . $request->no_batch . '%'
                );
            });
        }

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

        $suhuRuangs = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.suhu-ruang.index',
            compact('suhuRuangs')
        );
    }

    public function managerDetail($id)
    {
        $suhuRuang = SuhuRuang::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.manager.suhu-ruang.detail',
            compact('suhuRuang')
        );
    }
}