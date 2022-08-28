<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiryPartController extends Controller
{
    public function index(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        return view('inquiry-part.index', compact('inquiry'));
    }

    public function create(Inquiry $inquiry)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->where('coil', false)
                ->whereNotIn('id', $inquiry->products->pluck('part_id'));
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('coil', false);
            }
        }

        $parts = $parts->whereNotIn('id', $inquiry->products->pluck('part_id'))
            ->where('coil', false)->latest()->paginate(25);

        return view('inquiry-part.create', compact('inquiry', 'categories', 'parts'));
    }

    public function store(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'quantity' => 'required|numeric'
        ]);

        $inquiry->products()->create([
            'part_id' => $part->id,
            'quantity' => $request['quantity']
        ]);

        alert()->success('ثبت موفق', 'ثبت قطعه برای استعلام با موفقیت انجام شد');

        return back();
    }
}
