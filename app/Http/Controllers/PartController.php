<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword);
        }

        $parts = $parts->latest()->paginate(25);

        return view('parts.index', compact('parts'));
    }

    public function create()
    {
        return view('parts.create');
    }

    public function store(Request $request)
    {
        // Validation form data
        $data = $this->validateData($request);

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
        return view('parts.edit', compact('part'));
    }

    public function update(Request $request, Part $part)
    {
        // Validation form data
        $data = $this->validateData($request);

        $part->update($data);

        alert()->success('ویرایش موفق', 'ویرایش قطعه با موفقیت انجام شد');

        return redirect()->route('parts.index');
    }

    public function destroy(Part $part)
    {
        $part->delete();

        alert()->success('حذف موفق', 'حذف قطعه با موفقیت انجام شد');

        return back();
    }

    /*
     * Validation form data
     */
    public function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'code' => 'required|numeric',
            'price' => 'nullable'
        ]);
    }
}
