<?php

namespace App\Http\Controllers;

use App\Models\BowlCutter;
use App\Models\ProductionBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BowlCutterController extends Controller
{
    public function managerIndex(Request $request)
    {
        $query = BowlCutter::with('productionBatch.product')
            ->latest();

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

        $bowlCutters = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.manager.bowl-cutter.index',
            compact('bowlCutters')
        );
    }

    public function managerDetail($id)
    {
        $bowlCutter = BowlCutter::with([
            'productionBatch.product',
        ])->findOrFail($id);

        return view(
            'pages.manager.bowl-cutter.detail',
            compact('bowlCutter')
        );
    }

    public function index(Request $request)
    {
        $query = BowlCutter::with('productionBatch.product')
            ->latest();

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

        $bowlCutters = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.operator.bowl-cutter.index',
            compact('bowlCutters')
        );
    }

    public function create()
    {
        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->latest('id')
            ->get();

        return view(
            'pages.operator.bowl-cutter.create',
            compact('productionBatches')
        );
    }

    public function detail($id)
    {
        $bowlCutter = BowlCutter::with([
            'productionBatch.product',
        ])->findOrFail($id);

        return view(
            'pages.operator.bowl-cutter.detail',
            compact('bowlCutter')
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
            'speed' => [
                'nullable',
            ],
            'suhu_emulasi' => [
                'nullable',
                'numeric',
            ],
            'homeganisasi_orlap' => [
                'nullable',
                'in:Ok,Tidak',
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

            BowlCutter::create([
                'production_batch_id' => $productionBatch->id,
                'speed' => $request->speed,
                'suhu_emulasi' => $request->suhu_emulasi,
                'homeganisasi_orlap' => $request->homeganisasi_orlap,
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
                ->route('operator.bowl-cutter.index')
                ->with(
                    'success',
                    'Data bowl cutter berhasil disimpan.'
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
        $bowlCutter = BowlCutter::with([
            'productionBatch.product',
        ])->findOrFail($id);

        $productionBatches = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->latest('id')
            ->get();

        return view(
            'pages.operator.bowl-cutter.edit',
            compact(
                'bowlCutter',
                'productionBatches'
            )
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
            'speed' => [
                'nullable',
            ],
            'suhu_emulasi' => [
                'nullable',
                'numeric',
            ],
            'homeganisasi_orlap' => [
                'nullable',
                'in:Ok,Tidak',
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
            $bowlCutter = BowlCutter::findOrFail($id);

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

            $bowlCutter->update([
                'production_batch_id' => $productionBatch->id,
                'speed' => $request->speed,
                'suhu_emulasi' => $request->suhu_emulasi,
                'homeganisasi_orlap' => $request->homeganisasi_orlap,
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
                ->route('operator.bowl-cutter.index')
                ->with(
                    'success',
                    'Data bowl cutter berhasil diperbarui.'
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
            $bowlCutter = BowlCutter::findOrFail($id);

            $bowlCutter->delete();

            DB::commit();

            return redirect()
                ->route('operator.bowl-cutter.index')
                ->with(
                    'success',
                    'Data bowl cutter berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.bowl-cutter.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }
}