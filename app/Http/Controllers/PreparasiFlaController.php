<?php

namespace App\Http\Controllers;

use App\Models\PreparasiFla;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreparasiFlaController extends Controller
{
    public function managerIndex(Request $request)
    {
        $query = PreparasiFla::with('productionBatch.product')
            ->latest();

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

        $preparasiFlas = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.preparasi-fla.index',
            compact('preparasiFlas')
        );
    }

    public function managerDetail($id)
    {
        $preparasiFla = PreparasiFla::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.manager.preparasi-fla.detail',
            compact('preparasiFla')
        );
    }

    public function index(Request $request)
    {
        $query = PreparasiFla::with('productionBatch.product')
            ->latest();

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

        $preparasiFlas = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.preparasi-fla.index',
            compact('preparasiFlas')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.preparasi-fla.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $preparasiFla = PreparasiFla::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.operator.preparasi-fla.detail',
            compact('preparasiFla')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'homeganisasi_orlap' => [
                'nullable',
                'in:Ok,Tidak',
            ],
            'suhu_fla_after_cooling_down' => [
                'nullable',
                'in:Ok,Tidak',
            ],
            'setting_speed_x' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'setting_speed_y' => [
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
            PreparasiFla::create([
                'production_batch_id' => $request->production_batch_id,
                'homeganisasi_orlap' => $request->homeganisasi_orlap,
                'suhu_fla_after_cooling_down' => $request->suhu_fla_after_cooling_down,
                'setting_speed_x' => $request->setting_speed_x,
                'setting_speed_y' => $request->setting_speed_y,
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
                ->route('operator.preparasi-fla.index')
                ->with(
                    'success',
                    'Data preparasi fla berhasil disimpan.'
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
        $preparasiFla = PreparasiFla::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.preparasi-fla.edit',
            compact(
                'preparasiFla',
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
            'homeganisasi_orlap' => [
                'nullable',
                'in:Ok,Tidak',
            ],
            'suhu_fla_after_cooling_down' => [
                'nullable',
                'in:Ok,Tidak',
            ],
            'setting_speed_x' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'setting_speed_y' => [
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
            $preparasiFla = PreparasiFla::findOrFail($id);

            $preparasiFla->update([
                'production_batch_id' => $request->production_batch_id,
                'homeganisasi_orlap' => $request->homeganisasi_orlap,
                'suhu_fla_after_cooling_down' => $request->suhu_fla_after_cooling_down,
                'setting_speed_x' => $request->setting_speed_x,
                'setting_speed_y' => $request->setting_speed_y,
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
                ->route('operator.preparasi-fla.index')
                ->with(
                    'success',
                    'Data preparasi fla berhasil diperbarui.'
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
            $preparasiFla = PreparasiFla::findOrFail($id);

            $preparasiFla->delete();

            DB::commit();

            return redirect()
                ->route('operator.preparasi-fla.index')
                ->with(
                    'success',
                    'Data preparasi fla berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.preparasi-fla.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }
}