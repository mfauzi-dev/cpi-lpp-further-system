<?php

namespace App\Http\Controllers;

use App\Models\Hlt;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HltController extends Controller
{
    public function index(Request $request)
    {
        $query = Hlt::with('productionBatch.product')->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('no_batch', 'like', '%' . $request->no_batch . '%');
            });
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
        }

        if ($request->filled('kode_product')) {
            $query->whereHas('productionBatch.product', function ($q) use ($request) {
                $q->where('kode_product', 'like', '%' . $request->kode_product . '%');
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

        $hlts = $query->paginate(10)->withQueryString();

        return view('pages.operator.hlt.index', compact(
            'hlts'
        ));
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view('pages.operator.hlt.create', compact(
            'productionBatches'
        ));
    }

    public function detail($id)
    {
        $hlt = Hlt::with('productionBatch.product')
            ->findOrFail($id);

        return view('pages.operator.hlt.detail', compact(
            'hlt'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],

            'suhu_awal_daging' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'suhu_infeed' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'suhu_outfeed' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'steam_valve' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'speed_ventilator' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'lama_pemasakan' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'suhu_pusat_ct' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'organoleptik' => [
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
            Hlt::create([
                'production_batch_id' => $request->production_batch_id,
                'suhu_awal_daging' => $request->suhu_awal_daging,
                'suhu_infeed' => $request->suhu_infeed,
                'suhu_outfeed' => $request->suhu_outfeed,
                'steam_valve' => $request->steam_valve,
                'speed_ventilator' => $request->speed_ventilator,
                'lama_pemasakan' => $request->lama_pemasakan,
                'suhu_pusat_ct' => $request->suhu_pusat_ct,
                'organoleptik' => $request->organoleptik,
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
                ->route('operator.hlt.index')
                ->with(
                    'success',
                    'Data HLT berhasil disimpan.'
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
        $hlt = Hlt::with('productionBatch.product')
            ->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->get();

        return view('pages.operator.hlt.edit', compact(
            'hlt',
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

            'suhu_awal_daging' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'suhu_infeed' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'suhu_outfeed' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'steam_valve' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'speed_ventilator' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'lama_pemasakan' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'suhu_pusat_ct' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'organoleptik' => [
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
            $hlt = Hlt::findOrFail($id);

            $hlt->update([
                'production_batch_id' => $request->production_batch_id,
                'suhu_awal_daging' => $request->suhu_awal_daging,
                'suhu_infeed' => $request->suhu_infeed,
                'suhu_outfeed' => $request->suhu_outfeed,
                'steam_valve' => $request->steam_valve,
                'speed_ventilator' => $request->speed_ventilator,
                'lama_pemasakan' => $request->lama_pemasakan,
                'suhu_pusat_ct' => $request->suhu_pusat_ct,
                'organoleptik' => $request->organoleptik,
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
                ->route('operator.hlt.index')
                ->with(
                    'success',
                    'Data HLT berhasil diperbarui.'
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
            $hlt = Hlt::findOrFail($id);

            $hlt->delete();

            DB::commit();

            return redirect()
                ->route('operator.hlt.index')
                ->with(
                    'success',
                    'Data HLT berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.hlt.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function managerIndex(Request $request)
    {
        $query = Hlt::with('productionBatch.product')->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('no_batch', 'like', '%' . $request->no_batch . '%');
            });
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
        }

        if ($request->filled('kode_product')) {
            $query->whereHas('productionBatch.product', function ($q) use ($request) {
                $q->where('kode_product', 'like', '%' . $request->kode_product . '%');
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

        $hlts = $query->paginate(10)->withQueryString();

        return view('pages.manager.hlt.index', compact(
            'hlts'
        ));
    }

    public function managerDetail($id)
    {
        $hlt = Hlt::with('productionBatch.product')
            ->findOrFail($id);

        return view('pages.manager.hlt.detail', compact(
            'hlt'
        ));
    }
}