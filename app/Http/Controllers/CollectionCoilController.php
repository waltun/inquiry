<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectionCoilController extends Controller
{
    public function index()
    {
        Gate::authorize('collections');

        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('collection', true)
                ->where('coil', true)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('collection', true)->where('coil', true);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('collection', true)->where('coil', true);
            }
        }

        $parts = $parts->where('collection', true)->where('coil', true)->latest()
            ->paginate(25)->withQueryString();

        return view('collection-coils.index', compact('parts', 'categories'));
    }

    public function multiDelete(Request $request)
    {
        foreach ($request->ids as $id) {
            $part = Part::find($id);
            $part->delete();
        }

        return response('success', '200');
    }
}
