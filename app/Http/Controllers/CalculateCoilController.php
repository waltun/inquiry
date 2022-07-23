<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculateCoilController extends Controller
{
    public function evaperator(Part $part, Inquiry $inquiry)
    {
        return view('calculate.coil.evaperator', compact('part', 'inquiry'));
    }

    public function abi(Part $part)
    {
        return view('calculate.coil.abi', compact('part'));
    }

    public function condensor(Part $part)
    {
        return view('calculate.coil.condensor', compact('part'));
    }

    public function fancoil(Part $part)
    {
        return view('calculate.coil.fancoil', compact('part'));
    }

    public function store(Request $request, Part $part, Inquiry $inquiry)
    {
        $data = $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'tedad_radif_coil' => 'required',
            'fin_dar_inch' => 'required',
            'kham' => 'required',
            'tedad_madar_coil' => 'required',
            'zekhamat_frame_coil' => 'required',
            'pooshesh_khordegi' => 'required',
            'collector_ahani' => 'required',
            'collector_messi' => 'required',
            'toole_coil' => 'required',
            'tedad_loole_dar_radif' => 'required',
            'tedad_mogheyiat_loole' => 'required',
            'tedad_madar_loole' => 'required',
            'tedad_soorakh_pakhshkon' => 'required',
        ]);

        $data['price'] = $request->final_price;
        $data['inquiry_id'] = $inquiry->id;

        DB::table('calculate_coil')->insert($data);

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function getData(Request $request)
    {
        $part = Part::find($request->id);
        return response(['data' => $part]);
    }
}
