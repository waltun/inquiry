<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;

class SeparateCalculateConverter extends Controller
{
    public function index()
    {
        $evaporator = Part::find('1194');
        return view('calculate.separate-converters.index', compact('evaporator'));
    }

    public function evaporator(Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-converters.evaporator', compact('part', 'categories'));
    }

    public function calculateEvaporator(Request $request)
    {
        $inputs = $request->validate([
            'loole_messi' => 'required',
            'loole_messi_sucshen' => 'required',
            'loole_messi_maye' => 'required',
            'size_loole_pooste' => 'required',
            'picho_mohre' => 'required',
            'ayegh' => 'required',
            'sensor' => 'required',
            'cap' => 'required',
            'navdani' => 'required',
            'boshen1' => 'required',
            'boshen2' => 'required',
            'flanch' => 'required',
            'size_loole_ab' => 'required',
            'sardande' => 'required',
            'tube' => 'required',
            'ring' => 'required',
            'tedad_madar' => 'required',
            'toole_loole_messi' => 'required',
            'tedad_loole_messi' => 'required',
            'toole_loole_pooste' => 'required'
        ]);

        //Ids
        $looleMessiId = $request['loole_messi'];
        $looleMessiSucshenId = $request['loole_messi_sucshen'];
        $looleMessiMayeId = $request['loole_messi_maye'];
        $sizeLoolePoosteId = $request['size_loole_pooste'];
        $pichId = $request['picho_mohre'];
        $ayeghId = $request['ayegh'];
        $sensorId = $request['sensor'];
        $capId = $request['cap'];
        $navdaniId = $request['navdani'];
        $boshenAirId = $request['boshen1'];
        $boshenFreezeId = $request['boshen2'];
        $flanchId = $request['flanch'];
        $sizeLooleAbId = $request['size_loole_ab'];
        $sardandeId = $request['sardande'];
        $tubeId = $request['tube'];
        $ringId = $request['ring'];

        //Inputs
        $tooleLooleMessi = $request['toole_loole_messi'];
        $tedadLooleMessi = $request['tedad_loole_messi'];
        $tooleLoolePooste = $request['toole_loole_pooste'];
        $tedadMadar = $request['tedad_madar'];

        //--------------------------------------------------------
        $looleAhaniPart = Part::find($sizeLoolePoosteId);
        $looleMessiPart = Part::find($looleMessiId);
        $looleMessiSucshenPart = Part::find($looleMessiSucshenId);
        $looleMessiMayePart = Part::find($looleMessiMayeId);
        $sizeLooleAbPart = Part::find($sizeLooleAbId);


        // Values
        $looleAhani = $tooleLoolePooste * $looleAhaniPart->formula1;
        $looleMessi = $tooleLooleMessi * $tedadLooleMessi * $looleMessiPart->formula1;

        $looleMessiSucshen = 0.2 * $looleMessiSucshenPart->formula1 * $tedadMadar;
        $looleMessiMaye = 0.2 * $looleMessiMayePart->formula1 * $tedadMadar;

        $sizeLooleConnectionAb = 0.25 * 2 * $sizeLooleAbPart->formula;
    }

    public function storeEvaporator(Request $request, Part $part)
    {
        dd($request->all());
    }
}
