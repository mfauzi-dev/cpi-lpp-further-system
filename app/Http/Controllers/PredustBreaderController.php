<?php

namespace App\Http\Controllers;

use App\Models\PredustBreader;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PredustBreaderController extends Controller
{
    public function managerIndex(Request $request)
    {
        $query = PredustBreader::with('productionBatch.product')
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

        $predustBreaders = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.predust-breader.index',
            compact('predustBreaders')
        );
    }

    public function managerDetail($id)
    {
        $predustBreader = PredustBreader::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.manager.predust-breader.detail',
            compact('predustBreader')
        );
    }

    public function index(Request $request)
    {
        $query = PredustBreader::with('productionBatch.product')
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

        $predustBreaders = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.predust-breader.index',
            compact('predustBreaders')
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
            'pages.operator.predust-breader.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $predustBreader = PredustBreader::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.operator.predust-breader.detail',
            compact('predustBreader')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'predust_breader' => [
                'required',
                'in:Breader,Predust A,Predust B,Predust A dan B',
            ],
            'superflex' => [
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
            PredustBreader::create([
                'production_batch_id' => $request->production_batch_id,
                'predust_breader' => $request->predust_breader,
                'superflex' => $request->superflex,
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
                ->route('operator.predust-breader.index')
                ->with(
                    'success',
                    'Data Predust Breader berhasil disimpan.'
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
        $predustBreader = PredustBreader::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        $productionBatches = ProductionBatch::with([
            'product.productGroup',
        ])
            ->latest('tanggal_produksi')
            ->get();

        return view(
            'pages.operator.predust-breader.edit',
            compact(
                'predustBreader',
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
            'predust_breader' => [
                'required',
                'in:Breader,Predust A,Predust B,Predust A dan B'
            ],
            'superflex' => [
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
            $predustBreader = PredustBreader::findOrFail($id);

            $predustBreader->update([
                'production_batch_id' => $request->production_batch_id,
                'predust_breader' => $request->predust_breader,
                'superflex' => $request->superflex,
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
                ->route('operator.predust-breader.index')
                ->with(
                    'success',
                    'Data Predust Breader berhasil diperbarui.'
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
            $predustBreader = PredustBreader::findOrFail($id);

            $predustBreader->delete();

            DB::commit();

            return redirect()
                ->route('operator.predust-breader.index')
                ->with(
                    'success',
                    'Data Predust Breader berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.predust-breader.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }
}