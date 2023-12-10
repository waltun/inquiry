<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('settings.information.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Information $information)
    {
        //
    }

    public function update(Request $request, Information $information)
    {
        //
    }

    public function destroy(Information $information)
    {
        //
    }
}
