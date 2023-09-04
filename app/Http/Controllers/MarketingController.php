<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Marketing;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index()
    {
        $marketings = Marketing::latest()->where('confirm', 1)->with(['marketer', 'contract', 'payments'])->paginate(20);
        return view('marketings.index', compact('marketings'));
    }
}
