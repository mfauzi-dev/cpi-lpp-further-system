<?php

namespace App\Http\Controllers;

use App\Imports\FormulaImport;
use App\Models\BahanBaku;
use App\Models\Product;
use App\Models\ProductFormula;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductFormulaController extends Controller
{
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $bahanBakus = BahanBaku::orderBy('name')->get();

        $formulas = $product->formulas()
            ->with('bahanBaku')
            ->orderBy('name')
            ->get()
            ->groupBy('name');

        return view('pages.operator.product.formula', compact('product', 'bahanBakus', 'formulas'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $request->validate([
            'bahan_baku_id' => ['required', 'exists:bahan_bakus,id'],
            'name' => ['required', 'string', 'max:255'],
            'total_kg' => ['required', 'numeric', 'min:0'],
        ]);

        $exists = ProductFormula::where('product_id', $product->id)
            ->where('bahan_baku_id', $request->bahan_baku_id)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Kombinasi bahan baku + nama formula ini sudah ada.');
        }

        $product->formulas()->create($request->only('bahan_baku_id', 'name', 'total_kg'));

        return back()->with('success', 'Formula berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $formula = ProductFormula::findOrFail($id);

        $request->validate(['total_kg' => ['required', 'numeric', 'min:0']]);

        $formula->update(['total_kg' => $request->total_kg]);

        return back()->with('success', 'Formula berhasil diupdate.');
    }

    public function destroy($id)
    {
        ProductFormula::findOrFail($id)->delete();

        return back()->with('success', 'Formula berhasil dihapus.');
    }

    public function getBahanBakuByProduct($productId)
    {
        $product = Product::findOrFail($productId);

        $bahanBakus = $product->formulas()
            ->with('bahanBaku')
            ->get()
            ->pluck('bahanBaku')
            ->unique('id')
            ->values();

        return response()->json($bahanBakus);
    }

    public function importPage()
    {
        $products = Product::orderBy('nama')->get();

        return view('pages.operator.product.formula-import', compact('products'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'name' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        try {
            Excel::import(
                new FormulaImport((int) $request->product_id, $request->name),
                $request->file('file')
            );

            return redirect()
                ->route('operator.product.formula.index', $request->product_id)
                ->with('success', 'Data formula berhasil diimport.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}