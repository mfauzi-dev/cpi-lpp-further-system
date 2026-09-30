<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\ProcessType;
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
            'product_group_id' => ['nullable', 'exists:product_groups,id'],
            'process_type_id' => ['nullable', 'exists:process_types,id'],
        ]);

        $search = $request->search;
        $size = $request->size ?? 50;
        $productGroupId = $request->input('product_group_id');
        $processTypeId = $request->input('process_type_id');

        $query = Product::query();

        if ($search) {
            $query->where('kode_product', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        }

        if ($productGroupId) {
            $query->where('product_group_id', $productGroupId);
        }

        if ($processTypeId) {
            $query->where('process_type_id', $processTypeId);
        }

        $productGroupList = ProductGroup::orderBy('name')->get();
        $processTypeList = ProcessType::orderBy('name')->get();

        $products = $query->orderBy('nama')->paginate($size)->withQueryString();

        return view('pages.admin-production.product.index', compact([
            'products',
            'search',
            'productGroupId',
            'processTypeId',
            'productGroupList',
            'processTypeList',
        ]));
    }

    public function create()
    {
        $productGroupList = ProductGroup::orderBy('name')->get();
        $processTypeList = ProcessType::orderBy('name')->get();

        return view('pages.admin-production.product.create', compact([
            'productGroupList',
            'processTypeList',
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_product' => ['nullable', 'string', 'max:255', 'unique:products,kode_product'],
            'nama' => ['required', 'string', 'max:255'],
            'gramasi' => ['nullable', 'numeric', 'min:0'],
            'pack_per_box' => ['nullable', 'integer', 'min:0'],
            'product_group_id' => ['nullable', 'exists:product_groups,id'],
            'process_type_id' => ['nullable', 'exists:process_types,id'],
        ]);

        Product::create([
            'kode_product' => $request->kode_product,
            'nama' => $request->nama,
            'gramasi' => $request->gramasi,
            'pack_per_box' => $request->pack_per_box,
            'product_group_id' => $request->product_group_id,
            'process_type_id' => $request->process_type_id,
        ]);

        return redirect()
            ->route('admin-production.product.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $productGroupList = ProductGroup::orderBy('name')->get();
        $processTypeList = ProcessType::orderBy('name')->get();

        return view('pages.admin-production.product.edit', compact([
            'product',
            'productGroupList',
            'processTypeList',
        ]));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'kode_product' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'kode_product')->ignore($product->id),
            ],
            'nama' => ['required', 'string', 'max:255'],
            'gramasi' => ['nullable', 'numeric', 'min:0'],
            'pack_per_box' => ['nullable', 'integer', 'min:0'],
            'product_group_id' => ['nullable', 'exists:product_groups,id'],
            'process_type_id' => ['nullable', 'exists:process_types,id'],
        ]);

        $product->update([
            'kode_product' => $request->kode_product,
            'nama' => $request->nama,
            'gramasi' => $request->gramasi,
            'pack_per_box' => $request->pack_per_box,
            'product_group_id' => $request->product_group_id,
            'process_type_id' => $request->process_type_id,
        ]);

        return redirect()
            ->route('admin-production.product.index')
            ->with('success', 'Product berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()
            ->route('admin-production.product.index')
            ->with('success', 'Product berhasil dihapus.');
    }

    public function importPage()
    {
        return view('pages.admin-production.product.import');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        try {
            Excel::import(new ProductImport(), $request->file('file'));

            return redirect()
                ->route('admin-production.product.index')
                ->with('success', 'Data product berhasil diimport.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}