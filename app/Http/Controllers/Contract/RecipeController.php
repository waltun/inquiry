<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.recipe.index', compact('contract'));
    }

    public function revision(Contract $contract, $revision)
    {
        return view('contracts.recipe.revision', compact('contract', 'revision'));
    }
}
