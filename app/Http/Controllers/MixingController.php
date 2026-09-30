<?php

namespace App\Http\Controllers;

use App\Models\Mixing;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MixingController extends Controller
{
    public function index(Request $request)
    {
        $query = Mixing::with('productionBatch.product')->latest();

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

        $mixings = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.mixing.index',
            compact('mixings')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.mixing.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $mixing = Mixing::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.operator.mixing.detail',
            compact('mixing')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'mixer_preparation' => [
                'nullable',
                'string',
                'max:100',
            ],
            'suhu_air' => [
                'nullable',
                'numeric',
            ],
            'lama_pengadukan' => [
                'nullable',
                'numeric',
            ],
            'filter' => [
                'nullable',
                'string',
                'max:100',
            ],
            'salinity' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'brix' => [
                'nullable',
                'string',
                'max:100',
            ],
            'mixer' => [
                'nullable',
                'in:Unimix,Inotec',
            ],
            'suhu_adonan' => [
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
        ]);

        DB::beginTransaction();

        try {
            Mixing::create([
                'production_batch_id' => $request->production_batch_id,
                'mixer_preparation' => $request->mixer_preparation,
                'suhu_air' => $request->suhu_air,
                'lama_pengadukan' => $request->lama_pengadukan,
                'filter' => $request->filter,
                'salinity' => $request->salinity,
                'brix' => $request->brix,
                'mixer' => $request->mixer,
                'suhu_adonan' => $request->suhu_adonan,
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
                ->route('operator.mixing.index')
                ->with(
                    'success',
                    'Data mixing berhasil disimpan.'
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
        $mixing = Mixing::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.mixing.edit',
            compact(
                'mixing',
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
            'mixer_preparation' => [
                'nullable',
                'string',
                'max:100',
            ],
            'suhu_air' => [
                'nullable',
                'numeric',
            ],
            'lama_pengadukan' => [
                'nullable',
                'numeric',
            ],
            'filter' => [
                'nullable',
                'string',
                'max:100',
            ],
            'salinity' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'brix' => [
                'nullable',
                'string',
                'max:100',
            ],
            'mixer' => [
                'nullable',
                'in:Unimix,Inotec',
            ],
            'suhu_adonan' => [
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
        ]);

        DB::beginTransaction();

        try {
            $mixing = Mixing::findOrFail($id);

            $mixing->update([
                'production_batch_id' => $request->production_batch_id,
                'mixer_preparation' => $request->mixer_preparation,
                'suhu_air' => $request->suhu_air,
                'lama_pengadukan' => $request->lama_pengadukan,
                'filter' => $request->filter,
                'salinity' => $request->salinity,
                'brix' => $request->brix,
                'mixer' => $request->mixer,
                'suhu_adonan' => $request->suhu_adonan,
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
                ->route('operator.mixing.index')
                ->with(
                    'success',
                    'Data mixing berhasil diperbarui.'
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
            $mixing = Mixing::findOrFail($id);

            $mixing->delete();

            DB::commit();

            return redirect()
                ->route('operator.mixing.index')
                ->with(
                    'success',
                    'Data mixing berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.mixing.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function managerIndex(Request $request)
    {
        $query = Mixing::with('productionBatch.product')->latest();

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

        $mixings = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.mixing.index',
            compact('mixings')
        );
    }

    public function managerDetail($id)
    {
        $mixing = Mixing::with('productionBatch.product')
            ->findOrFail($id);

        return view(
            'pages.manager.mixing.detail',
            compact('mixing')
        );
    }
}