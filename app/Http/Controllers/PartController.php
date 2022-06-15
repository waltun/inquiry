<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PartController extends Controller
{
    public function index()
    {
        Gate::authorize('parts');

        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('collection', false)
                ->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword)->where('collection', false);
        }

        $parts = $parts->where('collection', false)->latest()->paginate(25);

        return view('parts.index', compact('parts'));
    }

    public function create()
    {
        Gate::authorize('parts');

        return view('parts.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('parts');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'code' => 'required|numeric|unique:parts',
            'price' => 'nullable',
            'collection' => 'required|in:true,false'
        ]);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        Part::create($data);

        alert()->success('ثبت موفق', 'ثبت قطعه با موفقیت انجام شد');

        return redirect()->route('parts.index');
    }

    public function show(Part $part)
    {
        //
    }

    public function edit(Part $part)
    {
        Gate::authorize('parts');

        return view('parts.edit', compact('part'));
    }

    public function update(Request $request, Part $part)
    {
        Gate::authorize('parts');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'code' => ['required', 'numeric', Rule::unique('parts')->ignore($part->id)],
            'price' => 'nullable',
            'collection' => 'required|in:true,false'
        ]);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        $part->update($data);

        alert()->success('ویرایش موفق', 'ویرایش قطعه با موفقیت انجام شد');

        return redirect()->route('parts.index');
    }

    public function destroy(Part $part)
    {
        Gate::authorize('parts');

        $part->delete();

        alert()->success('حذف موفق', 'حذف قطعه با موفقیت انجام شد');

        return back();
    }

    public function collectionIndex()
    {
        Gate::authorize('parts');

        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('collection', true)
                ->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword)->where('collection', true);
        }

        $parts = $parts->where('collection', true)->latest()->paginate(25);

        return view('parts.collections', compact('parts'));
    }
}
