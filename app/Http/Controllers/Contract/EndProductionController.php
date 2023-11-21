<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class EndProductionController extends Controller
{
    public function index(Contract $contract)
    {
        if($contract->products->contains('status', 'end')) {
            return view('contracts.end-of-production.index', compact('contract'));
        }

        alert()->error('خطا', 'هنوز پایان ساختی صادر نشده');

        return back();
    }
}
