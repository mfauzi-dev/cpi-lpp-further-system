<?php

namespace App\Http\Controllers;

use App\Exports\LaporanPengendalianProdukExport;
use App\Models\Product;
use App\Models\ProductionBatch;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductionBatchController extends Controller
{
    public function getByDate($date)
    {
        $productionBatches = ProductionBatch::with([
                'product',
                'formings',
                'batters',
                'predustBreaders',
                'hlts',
            ])
            ->whereDate('tanggal_produksi', $date)
            ->latest('id')
            ->get();

        return response()->json($productionBatches->map(function ($batch) {

            $proses = null;
            $prosesNama = null;

            if ($batch->tipe_proses === 'forming') {

                $proses = $batch->formings->sortBy('waktu_mulai')->first();
                $prosesNama = 'Forming';

            } elseif ($batch->tipe_proses === 'non_forming') {

                $proses = $batch->batters->sortBy('waktu_mulai')->first();
                $prosesNama = 'Batter';

                if (!$proses) {
                    $proses = $batch->predustBreaders->sortBy('waktu_mulai')->first();
                    $prosesNama = 'Predust Breader';
                }

            } elseif ($batch->tipe_proses === 'non_forming_roasted') {

                $proses = $batch->hlts->sortBy('waktu_mulai')->first();
                $prosesNama = 'HLT';
            }

            return [
                'id' => $batch->id,
                'no_batch' => $batch->no_batch,
                'kode_product' => $batch->product->kode_product ?? '-',
                'product' => $batch->product->nama ?? '-',
                'line' => $batch->line ?? '-',
                'waktu_kerja' => $batch->waktu_kerja,
                'tanggal_produksi' => $batch->tanggal_produksi->format('Y-m-d'),
                'tipe_proses' => $batch->tipe_proses,
                'proses_nama' => $prosesNama,
                'waktu_mulai_proses' => $proses->waktu_mulai ?? null,
            ];
        }));
    }
    
    public function index(Request $request)
    {
        $query = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->latest('id');

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('no_batch')) {
            $query->where(
                'no_batch',
                'like',
                '%' . $request->no_batch . '%'
            );
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
        }

        if ($request->filled('date_from')) {
            $query->whereDate(
                'tanggal_produksi',
                '>=',
                $request->date_from
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'tanggal_produksi',
                '<=',
                $request->date_to
            );
        }

        $productionBatches = $query
            ->paginate(10)
            ->withQueryString();

        $products = Product::orderBy('nama')->get();

        return view(
            'pages.operator.production-batch.index',
            compact(
                'productionBatches',
                'products'
            )
        );
    }

    public function managerIndex(Request $request)
    {
        $query = ProductionBatch::with('product')
            ->latest('tanggal_produksi')
            ->latest('id');

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('no_batch')) {
            $query->where(
                'no_batch',
                'like',
                '%' . $request->no_batch . '%'
            );
        }

        if ($request->filled('line')) {
            $query->where('line', $request->line);
        }

        if ($request->filled('date_from')) {
            $query->whereDate(
                'tanggal_produksi',
                '>=',
                $request->date_from
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'tanggal_produksi',
                '<=',
                $request->date_to
            );
        }

        $productionBatches = $query
            ->paginate(10)
            ->withQueryString();

        $products = Product::orderBy('nama')->get();

        return view(
            'pages.manager.production-batch.index',
            compact(
                'productionBatches',
                'products'
            )
        );
    }

    public function managerDetail($id)
    {
        $productionBatch = ProductionBatch::with([
            'product.productGroup',
            'formings',
            'bowlCutters',
            'grinders',
            'preparasiFlas',
            'tumblers',
            'mixings',
            'batters',
            'hlts',
            'predustBreaders',
            'fryers',
            'pembekuans',
            'packingDalams',
            'packingLuars',
            'kemasanRijeks',
            'productions',
        ])->findOrFail($id);

        return view(
            'pages.manager.production-batch.detail',
            compact('productionBatch')
        );
    }

    public function detail($id)
    {
        $productionBatch = ProductionBatch::with([
            'product.productGroup',
            'formings',
            'bowlCutters',
            'grinders',
            'preparasiFlas',
            'tumblers',
            'mixings',
            'batters',
            'hlts',
            'predustBreaders',
            'fryers',
            'pembekuans',
            'packingDalams',
            'packingLuars',
            'kemasanRijeks',
            'productions',
        ])->findOrFail($id);

        return view(
            'pages.operator.production-batch.detail',
            compact('productionBatch')
        );
    }

    public function create()
    {
        $products = Product::with('productGroup')
            ->orderBy('nama')
            ->get();

        return view(
            'pages.operator.production-batch.create',
            compact('products')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],
            'no_batch' => [
                'required',
                'string',
                'max:100',
            ],
            'tanggal_produksi' => [
                'required',
                'date',
            ],
            'line' => [
                'nullable',
                'string',
                'max:100',
            ],
            'tipe_proses' => [
                'nullable',
                'in:forming,non_forming,non_forming_roasted',
            ],
        ]);

        DB::beginTransaction();

        try {
            ProductionBatch::create([
                'product_id' => $request->product_id,
                'no_batch' => $request->no_batch,
                'tanggal_produksi' => $request->tanggal_produksi,
                'line' => $request->line,
                'tipe_proses' => $request->tipe_proses,
                'waktu_kerja' => null,
                'yield' => null,
                'persen_rijek' => null,
                'produktifitas' => null,
            ]);

            DB::commit();

            return redirect()
                ->route('operator.production-batch.index')
                ->with(
                    'success',
                    'Data production batch berhasil disimpan.'
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
        $productionBatch = ProductionBatch::with(
            'product.productGroup'
        )->findOrFail($id);

        $products = Product::with('productGroup')
            ->orderBy('nama')
            ->get();

        return view(
            'pages.operator.production-batch.edit',
            compact(
                'productionBatch',
                'products'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],
            'no_batch' => [
                'required',
                'string',
                'max:100',
            ],
            'tanggal_produksi' => [
                'required',
                'date',
            ],
            'line' => [
                'nullable',
                'string',
                'max:100',
            ],
            'tipe_proses' => [
                'required',
                'in:forming,non_forming,non_forming_roasted',
            ],
        ]);

        DB::beginTransaction();

        try {
            $productionBatch = ProductionBatch::findOrFail($id);

            $productionBatch->update([
                'product_id' => $request->product_id,
                'no_batch' => $request->no_batch,
                'tanggal_produksi' => $request->tanggal_produksi,
                'line' => $request->line,
                'tipe_proses' => $request->tipe_proses,
            ]);

            DB::commit();

            return redirect()
                ->route(
                    'operator.production-batch.detail',
                    $productionBatch->id
                )
                ->with(
                    'success',
                    'Data production batch berhasil diperbarui.'
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
            $productionBatch = ProductionBatch::findOrFail($id);

            $productionBatch->delete();

            DB::commit();

            return redirect()
                ->route('operator.production-batch.index')
                ->with(
                    'success',
                    'Data production batch berhasil dihapus.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->route('operator.production-batch.index')
                ->with(
                    'error',
                    'Gagal menghapus data: ' . $e->getMessage()
                );
        }
    }

    public function export($id)
    {
        $batch = ProductionBatch::findOrFail($id);

        return Excel::download(
            new LaporanPengendalianProdukExport($batch->id),
            'Laporan-Pengendalian-Produk-' . $batch->no_batch . '.xlsx'
        );
    }

    public function exportPdf($id)
    {
        $productionBatch = ProductionBatch::with([
            'product.productGroup',
            'pembekuans',
            'packingDalams.samplings',
            'packingDalams.plastiks.product',
            'packingLuars.samplings',
            'packingLuars.kemasans.product',
            'packingLuars.palets.product',
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'pages.operator.production-batch.pdf',
            compact('productionBatch')
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream(
            'Laporan-Pengendalian-Produk-' .
            $productionBatch->no_batch .
            '.pdf'
        );
    }

    public function managerExport($id)
    {
        $batch = ProductionBatch::findOrFail($id);

        return Excel::download(
            new LaporanPengendalianProdukExport($batch->id),
            'Laporan-Pengendalian-Produk-' . $batch->no_batch . '.xlsx'
        );
    }
    public function managerExportPdf($id)
    {
        $productionBatch = ProductionBatch::with([
            'product.productGroup',
            'pembekuans',
            'packingDalams.samplings',
            'packingDalams.plastiks.product',
            'packingLuars.samplings',
            'packingLuars.kemasans.product',
            'packingLuars.palets.product',
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'pages.manager.production-batch.pdf',
            compact('productionBatch')
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream(
            'Laporan-Pengendalian-Produk-' .
            $productionBatch->no_batch .
            '.pdf'
        );
    }

}