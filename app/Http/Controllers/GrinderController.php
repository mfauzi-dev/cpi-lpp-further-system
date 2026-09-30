<?php

namespace App\Http\Controllers;

use App\Models\Grinder;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrinderController extends Controller
{
    public function index(Request $request)
    {
        $query = Grinder::with('productionBatch.product')->latest();

        
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

        $grinders = $query->paginate(10)->withQueryString();

        return view('pages.operator.grinder.index', compact(
            'grinders'
        ));
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view('pages.operator.grinder.create', compact(
            'productionBatches'
        ));
    }

    public function detail($id)
    {
        $grinder = Grinder::with('productionBatch.product')
            ->findOrFail($id);

        return view('pages.operator.grinder.detail', compact(
            'grinder'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],

            'ukuran_saringan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'hasil' => [
                'nullable',
                'string',
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
            Grinder::create([
                'production_batch_id' => $request->production_batch_id,
                'ukuran_saringan' => $request->ukuran_saringan,
                'hasil' => $request->hasil,
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
                ->route('operator.grinder.index')
                ->with(
                    'success',
                    'Data grinder berhasil disimpan.'
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
        $grinder = Grinder::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view('pages.operator.grinder.edit', compact(
            'grinder',
            'productionBatches'
        ));
    }

    public function update(Request $request, $id)
    {
        if ($request->filled('waktu_mulai')) {
            $request->merge([
                'waktu_mulai' => substr($request->waktu_mulai, 0, 5),
            ]);
        }

        if ($request->filled('waktu_selesai')) {
            $request->merge([
                'waktu_selesai' => substr($request->waktu_selesai, 0, 5),
            ]);
        }

        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],

            'ukuran_saringan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'hasil' => [
                'nullable',
                'string',
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
            $grinder = Grinder::findOrFail($id);

            $grinder->update([
                'production_batch_id' => $request->production_batch_id,
                'ukuran_saringan' => $request->ukuran_saringan,
                'hasil' => $request->hasil,
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
                ->route('operator.grinder.index')
                ->with(
                    'success',
                    'Data grinder berhasil diperbarui.'
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
            $grinder = Grinder::findOrFail($id);

            $grinder->delete();

            DB::commit();

            return redirect()
                ->route('operator.grinder.index')
                ->with(
                    'success',
                    'Data grinder berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.grinder.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function managerIndex(Request $request)
    {
        $query = Grinder::with('productionBatch.product')->latest();

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

        $grinders = $query->paginate(10)->withQueryString();

        return view('pages.manager.grinder.index', compact(
            'grinders'
        ));
    }

    public function managerDetail($id)
    {
        $grinder = Grinder::with('productionBatch.product')
            ->findOrFail($id);

        return view('pages.manager.grinder.detail', compact(
            'grinder'
        ));
    }
}