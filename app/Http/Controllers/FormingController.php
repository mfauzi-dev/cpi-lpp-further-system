<?php

namespace App\Http\Controllers;

use App\Models\Forming;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormingController extends Controller
{
    public function index(Request $request)
    {
        $query = Forming::with('productionBatch.product')->latest();

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

        $formings = $query->paginate(10)->withQueryString();

        return view('pages.operator.forming.index', compact(
            'formings'
        ));
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view('pages.operator.forming.create', compact(
            'productionBatches'
        ));
    }

    public function detail($id)
    {
        $forming = Forming::with('productionBatch.product')
            ->findOrFail($id);

        return view('pages.operator.forming.detail', compact(
            'forming'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],

            'alat' => [
                'nullable',
                'in:Revo 600,Revo 400,Rheon',
            ],

            'suhu_adonan' => [
                'nullable',
                'numeric',
            ],

            'pressure' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'speed' => [
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
            Forming::create([
                'production_batch_id' => $request->production_batch_id,
                'alat' => $request->alat,
                'suhu_adonan' => $request->suhu_adonan,
                'pressure' => $request->pressure,
                'speed' => $request->speed,
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
                ->route('operator.forming.index')
                ->with('success', 'Data forming berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $forming = Forming::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view('pages.operator.forming.edit', compact(
            'forming',
            'productionBatches'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],

            'alat' => [
                'nullable',
                'in:Revo 600,Revo 400,Rheon',
            ],

            'suhu_adonan' => [
                'nullable',
                'numeric',
            ],

            'pressure' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'speed' => [
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
            $forming = Forming::findOrFail($id);

            $forming->update([
                'production_batch_id' => $request->production_batch_id,
                'alat' => $request->alat,
                'suhu_adonan' => $request->suhu_adonan,
                'pressure' => $request->pressure,
                'speed' => $request->speed,
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
                ->route('operator.forming.index')
                ->with('success', 'Data forming berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $forming = Forming::findOrFail($id);

            $forming->delete();

            DB::commit();

            return redirect()
                ->route('operator.forming.index')
                ->with('success', 'Data forming berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.forming.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function managerIndex(Request $request)
    {
        $query = Forming::with('productionBatch.product')->latest();

                
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

        $formings = $query->paginate(10)->withQueryString();

        return view('pages.manager.forming.index', compact(
            'formings'
        ));
    }

    public function managerDetail($id)
    {
        $forming = Forming::with('productionBatch.product')
            ->findOrFail($id);

        return view('pages.manager.forming.detail', compact(
            'forming'
        ));
    }
}