<?php

namespace App\Http\Controllers;

use App\Models\ProcessType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProcessTypeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
            'size' => ['nullable', 'integer'],
        ]);

        $search = $request->search;
        $size = $request->size ?? 50;

        $query = ProcessType::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $processTypes = $query->orderBy('name')->paginate($size)->withQueryString();

        return view('pages.admin-production.process-type.index', compact([
            'processTypes',
            'search',
        ]));
    }

    public function create()
    {
        return view('pages.admin-production.process-type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:process_types,name'],
        ]);

        ProcessType::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin-production.process-type.index')
            ->with('success', 'Process type berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $processType = ProcessType::findOrFail($id);

        return view('pages.admin-production.process-type.edit', compact('processType'));
    }

    public function update(Request $request, $id)
    {
        $processType = ProcessType::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('process_types', 'name')->ignore($processType->id),
            ],
        ]);

        $processType->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin-production.process-type.index')
            ->with('success', 'Process type berhasil diupdate.');
    }

    public function destroy($id)
    {
        $processType = ProcessType::findOrFail($id);

        $processType->delete();

        return redirect()
            ->route('admin-production.process-type.index')
            ->with('success', 'Process type berhasil dihapus.');
    }
}