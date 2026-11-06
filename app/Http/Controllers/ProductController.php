<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
            'size' => ['nullable', 'integer'],
        ]);

        $search = $request->search;
        $size = $request->size ?? 50;

        $query = Product::withCount('formulas');

        if ($search) {
            $query->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        }

        $products = $query->orderBy('nama')->paginate($size)->withQueryString();

        return view('pages.operator.product.index', compact([
            'products',
            'search',
        ]));
    }

    public function create()
    {
        return view('pages.operator.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => ['nullable', 'string', 'max:255', 'unique:products,kode'],
            'nama' => ['required', 'string', 'max:255'],
            'gramasi' => ['nullable', 'numeric', 'min:0'],
            'pack_per_box' => ['nullable', 'integer', 'min:0'],
        ]);

        Product::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'gramasi' => $request->gramasi,
            'pack_per_box' => $request->pack_per_box,
        ]);

        return redirect()
            ->route('operator.product.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.operator.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'kode' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products', 'kode')->ignore($product->id),
            ],
            'nama' => ['required', 'string', 'max:255'],
            'gramasi' => ['nullable', 'numeric', 'min:0'],
            'pack_per_box' => ['nullable', 'integer', 'min:0'],
        ]);

        $product->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'gramasi' => $request->gramasi,
            'pack_per_box' => $request->pack_per_box,
        ]);

        return redirect()
            ->route('operator.product.index')
            ->with('success', 'Product berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()
            ->route('operator.product.index')
            ->with('success', 'Product berhasil dihapus.');
    }

    public function importPage()
    {
        return view('pages.operator.product.import');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        try {
            Excel::import(new ProductImport(), $request->file('file'));

            return redirect()
                ->route('operator.product.index')
                ->with('success', 'Data product berhasil diimport.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}