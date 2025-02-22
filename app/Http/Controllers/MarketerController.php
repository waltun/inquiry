<?php

namespace App\Http\Controllers;

use App\Models\Marketer;
use Illuminate\Http\Request;

class MarketerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:marketers')->only(['index']);
        $this->middleware('can:create-marketer')->only(['create', 'store']);
        $this->middleware('can:edit-marketer')->only(['edit', 'update']);
        $this->middleware('can:delete-marketer')->only(['destroy']);
    }

    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $marketers = Marketer::latest()->paginate(20);
        } else {
            $marketers = auth()->user()->marketers()->latest()->paginate(20);
        }

        return view('marketers.index', compact('marketers'));
    }

    public function create()
    {
        return view('marketers.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        auth()->user()->marketers()->create($data);

        alert()->success('ثبت موفق', 'ثبت بازاریاب با موفقیت انجام شد');

        return redirect()->route('marketers.index');
    }

    public function edit(Marketer $marketer)
    {
        return view('marketers.edit', compact('marketer'));
    }

    public function update(Request $request, Marketer $marketer)
    {
        $data = $this->validateData($request);

        $marketer->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی بازاریاب با موفقیت انجام شد');

        return redirect()->route('marketers.index');
    }

    public function destroy(Marketer $marketer)
    {
        $marketer->delete();

        alert()->success('حذف موفق', 'حذف بازاریاب با موفقیت انجام شد');

        return back();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:11',
            'nation' => 'nullable|string|max:255',
        ]);
    }
}
