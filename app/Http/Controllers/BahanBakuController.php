<?php

namespace App\Http\Controllers;

use App\Imports\BahanBakuImport;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class BahanBakuController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
            'size' => ['nullable', 'integer', 'min:1'],
        ]);

        $query = BahanBaku::query();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('kode', 'like', "%{$request->search}%");
        }

        $bahanBakus = $query->orderBy('name')
            ->paginate($request->size ?? 20)
            ->withQueryString();

        return view('pages.operator.bahan-baku.index', [
            'bahanBakus' => $bahanBakus,
            'search' => $request->search,
        ]);
    }

    public function create()
    {
        return view('pages.operator.bahan-baku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => ['nullable', 'string', 'max:255', 'unique:bahan_bakus,kode'],
            'name' => ['required', 'string', 'max:255', 'unique:bahan_bakus,name'],
        ]);

        BahanBaku::create([
            'kode' => $request->kode,
            'name' => $request->name,
        ]);

        return redirect()
            ->route('operator.bahan-baku.index')
            ->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function detail($id)
    {
        $bahanBaku = BahanBaku::with('productFormulas.product')->findOrFail($id);

        return view('pages.operator.bahan-baku.detail', compact('bahanBaku'));
    }

    public function edit($id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);

        return view('pages.operator.bahan-baku.edit', compact('bahanBaku'));
    }

    public function update(Request $request, $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);

        $request->validate([
            'kode' => ['nullable', 'string', 'max:255', Rule::unique('bahan_bakus', 'kode')->ignore($bahanBaku->id)],
            'name' => ['required', 'string', 'max:255', Rule::unique('bahan_bakus', 'name')->ignore($bahanBaku->id)],
        ]);

        $bahanBaku->update([
            'kode' => $request->kode,
            'name' => $request->name,
        ]);

        return redirect()
            ->route('operator.bahan-baku.index')
            ->with('success', 'Bahan baku berhasil diupdate.');
    }

    public function destroy($id)
    {
        BahanBaku::findOrFail($id)->delete();

        return redirect()
            ->route('operator.bahan-baku.index')
            ->with('success', 'Bahan baku berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:bahan_bakus,id'],
        ]);

        BahanBaku::whereIn('id', $request->ids)->delete();

        return redirect()
            ->route('operator.bahan-baku.index')
            ->with('success', 'Bahan baku terpilih berhasil dihapus.');
    }

    public function importPage()
    {
        return view('pages.operator.bahan-baku.import');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        try {
            Excel::import(new BahanBakuImport(), $request->file('file'));

            return redirect()
                ->route('operator.bahan-baku.index')
                ->with('success', 'Data bahan baku berhasil diimport.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}