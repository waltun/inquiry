<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\InquiryPrice;
use App\Models\Part;
use Illuminate\Http\Request;

class InquiryPriceController extends Controller
{
    public function index()
    {
        $inquiryPrices = InquiryPrice::all();
        return view('inquiry-price.index', compact('inquiryPrices'));
    }

    public function store(Request $request)
    {
        auth()->user()->inquiryPrices()->create([
            'part_id' => $request->part_id,
            'inquiry_id' => $request->inquiry_id
        ]);
    }
}
