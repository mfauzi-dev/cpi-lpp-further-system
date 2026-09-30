<?php

namespace App\Http\Controllers;

use App\Models\ProductionBatch;
use App\Models\Tumbler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TumblerController extends Controller
{
    public function managerIndex(Request $request)
    {
        $query = Tumbler::with('productionBatch.product')
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

        $tumblers = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.tumbler.index',
            compact('tumblers')
        );
    }

    public function managerDetail($id)
    {
        $tumbler = Tumbler::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.manager.tumbler.detail',
            compact('tumbler')
        );
    }

    public function index(Request $request)
    {
        $query = Tumbler::with('productionBatch.product')
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

        $tumblers = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.tumbler.index',
            compact('tumblers')
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
            'pages.operator.tumbler.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $tumbler = Tumbler::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.operator.tumbler.detail',
            compact('tumbler')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'tumbler' => [
                'nullable',
                'in:Tumbler A,Tumbler B',
            ],
            'drum_on' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'drum_off' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'vacuum_a' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'vacuum_b' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
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
            Tumbler::create([
                'production_batch_id' => $request->production_batch_id,
                'tumbler' => $request->tumbler,
                'drum_on' => $request->drum_on,
                'drum_off' => $request->drum_off,
                'vacuum_a' => $request->vacuum_a,
                'vacuum_b' => $request->vacuum_b,
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
                ->route('operator.tumbler.index')
                ->with(
                    'success',
                    'Data tumbler berhasil disimpan.'
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
        $tumbler = Tumbler::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.tumbler.edit',
            compact(
                'tumbler',
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
            'tumbler' => [
                'nullable',
                'in:Tumbler A,Tumbler B',
            ],
            'drum_on' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'drum_off' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'vacuum_a' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],
            'vacuum_b' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
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
            $tumbler = Tumbler::findOrFail($id);

            $tumbler->update([
                'production_batch_id' => $request->production_batch_id,
                'tumbler' => $request->tumbler,
                'drum_on' => $request->drum_on,
                'drum_off' => $request->drum_off,
                'vacuum_a' => $request->vacuum_a,
                'vacuum_b' => $request->vacuum_b,
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
                ->route('operator.tumbler.index')
                ->with(
                    'success',
                    'Data tumbler berhasil diperbarui.'
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
            $tumbler = Tumbler::findOrFail($id);

            $tumbler->delete();

            DB::commit();

            return redirect()
                ->route('operator.tumbler.index')
                ->with(
                    'success',
                    'Data tumbler berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.tumbler.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }
}