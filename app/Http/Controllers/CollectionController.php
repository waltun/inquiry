<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CollectionController extends Controller
{
    public function index()
    {
        Gate::authorize('collections');

        $collections = Collection::query();

        if ($keyword = request('search')) {
            $collections->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $collections = $collections->where('code', 'LIKE', $keyword);
        }

        $collections = $collections->latest()->paginate(25);

        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        return view('collections.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('collections');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|numeric|unique:collections',
            'unit' => 'required|string|max:255'
        ]);

        Collection::create($data);

        alert()->success('ثبت موفق', 'ثبت مجموعه با موفقیت انجام شد');

        return redirect()->route('collections.index');
    }

    public function show(Collection $collection)
    {
        //
    }

    public function edit(Collection $collection)
    {
        return view('collections.edit', compact('collection'));
    }

    public function update(Request $request, Collection $collection)
    {
        Gate::authorize('collections');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'numeric', Rule::unique('collections')->ignore($collection->id)],
            'unit' => 'required|string|max:255'
        ]);

        $collection->update($data);

        alert()->success('ویرایش موفق', 'ویرایش مجموعه با موفقیت انجام شد');

        return redirect()->route('collections.index');
    }

    public function destroy(Collection $collection)
    {
        //
    }
}
