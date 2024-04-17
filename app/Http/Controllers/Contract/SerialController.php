<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    public function index(Contract $contract)
    {
        if ($contract->recipe || $contract->products->contains('recipe', 1)) {
            return view('contracts.serials.index', compact('contract'));
        }

        alert()->error('خطا', 'هنوز دستور ساختی صادر نشده');

        return back();
    }
}
