<?php

namespace App\Http\Controllers;

use App\Models\Batter;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatterController extends Controller
{
    public function index(Request $request)
    {
        $query = Batter::with([
            'productionBatch.product',
        ])->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('no_batch', 'like', '%' . $request->no_batch . '%');
            });
        }

        if ($request->filled('line')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('line', $request->line);
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

        $batters = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.batter.index',
            compact('batters')
        );
    }

    public function create()
    {
        return view('pages.operator.batter.create');
    }

    public function detail($id)
    {
        $batter = Batter::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.operator.batter.detail',
            compact('batter')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_produksi' => [
                'required',
                'date',
            ],
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'batter' => [
                'nullable',
                'string',
                'max:100',
            ],
            'suhu_batter' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'viskositas' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'salinity' => [
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
            'pic_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        DB::beginTransaction();

        try {
            $productionBatch = ProductionBatch::findOrFail(
                $request->production_batch_id
            );

            if (
                $productionBatch->tanggal_produksi->format('Y-m-d')
                !== $request->tanggal_produksi
            ) {
                throw new \Exception(
                    'Production Batch tidak sesuai dengan tanggal produksi.'
                );
            }

            Batter::create([
                'production_batch_id' => $productionBatch->id,
                'batter' => $request->batter,
                'suhu_batter' => $request->suhu_batter,
                'viskositas' => $request->viskositas,
                'salinity' => $request->salinity,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'downtime' => $request->downtime,
                'keterangan' => $request->keterangan,
                'petugas' => $request->petugas,
                'line' => $productionBatch->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            DB::commit();

            return redirect()
                ->route('operator.batter.index')
                ->with(
                    'success',
                    'Data batter berhasil disimpan.'
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
        $batter = Batter::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.operator.batter.edit',
            compact('batter')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_produksi' => [
                'required',
                'date',
            ],
            'production_batch_id' => [
                'required',
                'exists:production_batches,id',
            ],
            'batter' => [
                'nullable',
                'string',
                'max:100',
            ],
            'suhu_batter' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'viskositas' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'salinity' => [
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
            'pic_produksi' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        DB::beginTransaction();

        try {
            $batter = Batter::findOrFail($id);

            $productionBatch = ProductionBatch::findOrFail(
                $request->production_batch_id
            );

            if (
                $productionBatch->tanggal_produksi->format('Y-m-d')
                !== $request->tanggal_produksi
            ) {
                throw new \Exception(
                    'Production Batch tidak sesuai dengan tanggal produksi.'
                );
            }

            $batter->update([
                'production_batch_id' => $productionBatch->id,
                'batter' => $request->batter,
                'suhu_batter' => $request->suhu_batter,
                'viskositas' => $request->viskositas,
                'salinity' => $request->salinity,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'downtime' => $request->downtime,
                'keterangan' => $request->keterangan,
                'petugas' => $request->petugas,
                'line' => $productionBatch->line,
                'pic_produksi' => $request->pic_produksi,
            ]);

            DB::commit();

            return redirect()
                ->route('operator.batter.detail', $batter->id)
                ->with(
                    'success',
                    'Data batter berhasil diperbarui.'
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
            $batter = Batter::findOrFail($id);

            $batter->delete();

            DB::commit();

            return redirect()
                ->route('operator.batter.index')
                ->with(
                    'success',
                    'Data batter berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.batter.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function managerIndex(Request $request)
    {
        $query = Batter::with([
            'productionBatch.product',
        ])->latest();

        if ($request->filled('no_batch')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('no_batch', 'like', '%' . $request->no_batch . '%');
            });
        }

        if ($request->filled('line')) {
            $query->whereHas('productionBatch', function ($q) use ($request) {
                $q->where('line', $request->line);
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

        $batters = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.batter.index',
            compact('batters')
        );
    }

    public function managerDetail($id)
    {
        $batter = Batter::with([
            'productionBatch.product.productGroup',
        ])->findOrFail($id);

        return view(
            'pages.manager.batter.detail',
            compact('batter')
        );
    }
}