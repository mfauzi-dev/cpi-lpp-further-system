<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductGroupController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
            'size' => ['nullable', 'integer'],
        ]);

        $search = $request->search;
        $size = $request->size ?? 50;

        $query = ProductGroup::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $productGroups = $query->orderBy('name')->paginate($size)->withQueryString();

        return view('pages.admin-production.product-group.index', compact([
            'productGroups',
            'search',
        ]));
    }

    public function create()
    {
        return view('pages.admin-production.product-group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:product_groups,name'],
        ]);

        ProductGroup::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin-production.product-group.index')
            ->with('success', 'Product group berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $productGroup = ProductGroup::findOrFail($id);

        return view('pages.admin-production.product-group.edit', compact('productGroup'));
    }

    public function update(Request $request, $id)
    {
        $productGroup = ProductGroup::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_groups', 'name')->ignore($productGroup->id),
            ],
        ]);

        $productGroup->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin-production.product-group.index')
            ->with('success', 'Product group berhasil diupdate.');
    }

    public function destroy($id)
    {
        $productGroup = ProductGroup::findOrFail($id);

        $productGroup->delete();

        return redirect()
            ->route('admin-production.product-group.index')
            ->with('success', 'Product group berhasil dihapus.');
    }
}
