<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Marketing;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:marketings')->only(['index']);
    }

    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $marketings = Marketing::latest()->where('confirm', 1)->with(['marketer', 'contract', 'payments'])->paginate(20);
        } else {
            $marketings = Marketing::latest()->with(['contract', 'payments', 'marketer'])->whereHas('contract', function ($query) {
                $query->where('user_id', auth()->id());
            })->paginate(20);
        }

        return view('marketings.index', compact('marketings'));
    }
}
