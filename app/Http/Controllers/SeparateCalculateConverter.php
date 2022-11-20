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
        $setareId = $request['setare'];
        $noeBafelId = $request['noe_bafel'];
        $spacerId = $request['spacer'];

        //Inputs
        $tooleLooleMessi = $request['toole_loole_messi'];
        $tedadLooleMessi = $request['tedad_loole_messi'];
        $tooleLoolePooste = $request['toole_loole_pooste'];
        $tedadMadar = $request['tedad_madar'];
        $tedadBafel = $request['tedad_bafel'];

        //--------------------------------------------------------
        $looleAhaniPart = Part::find($sizeLoolePoosteId);
        $looleMessiPart = Part::find($looleMessiId);
        $looleMessiSucshenPart = Part::find($looleMessiSucshenId);
        $looleMessiMayePart = Part::find($looleMessiMayeId);
        $sizeLooleAbPart = Part::find($sizeLooleAbId);
        $navdaniPart = Part::find($navdaniId);
        $ayeghPart = Part::find($ayeghId);
        $tubePart = Part::find($tubeId);
        $ringPart = Part::find($ringId);
        $setarePart = Part::find($setareId);
        $noeBafelPart = Part::find($noeBafelId);
        $spacerPart = Part::find($spacerId);

        // Values
        $looleAhani = $tooleLoolePooste * $looleAhaniPart->formula1;
        $looleMessi = $tooleLooleMessi * $tedadLooleMessi * $looleMessiPart->formula1;

        $looleMessiSucshen = 0.2 * $looleMessiSucshenPart->formula1 * $tedadMadar;
        $looleMessiMaye = 0.2 * $looleMessiMayePart->formula1 * $tedadMadar;

        $sizeLooleConnectionAb = 0.25 * 2 * $sizeLooleAbPart->formula; // 1

        //Ghotre Loole Pooste (Size Loole Pooste - inch)
        $ghotreLoolePooste = 0;
        if ($sizeLoolePoosteId == '975') {
            $ghotreLoolePooste = 4;
        }
        if ($sizeLoolePoosteId == '976') {
            $ghotreLoolePooste = 5;
        }
        if ($sizeLoolePoosteId == '977') {
            $ghotreLoolePooste = 6;
        }
        if ($sizeLoolePoosteId == '978') {
            $ghotreLoolePooste = 8;
        }
        if ($sizeLoolePoosteId == '1098') {
            $ghotreLoolePooste = 10;
        }
        if ($sizeLoolePoosteId == '1099') {
            $ghotreLoolePooste = 12;
        }
        if ($sizeLoolePoosteId == '1100') {
            $ghotreLoolePooste = 14;
        }
        if ($sizeLoolePoosteId == '1101') {
            $ghotreLoolePooste = 16;
        }
        if ($sizeLoolePoosteId == '1102') {
            $ghotreLoolePooste = 18;
        }
        if ($sizeLoolePoosteId == '1103') {
            $ghotreLoolePooste = 20;
        }
        if ($sizeLoolePoosteId == '1104') {
            $ghotreLoolePooste = 22;
        }
        if ($sizeLoolePoosteId == '1105') {
            $ghotreLoolePooste = 24;
        }
        if ($sizeLoolePoosteId == '1106') {
            $ghotreLoolePooste = 26;
        }
        if ($sizeLoolePoosteId == '1144') {
            $ghotreLoolePooste = 28;
        }
        if ($sizeLoolePoosteId == '1145') {
            $ghotreLoolePooste = 30;
        }

        $navdani = ($ghotreLoolePooste * 2.54 / 100) * 2 * $navdaniPart->formula1;

        $electrodBargh = ($ghotreLoolePooste * 2.54 * 3.14 * 16 * 3);

        $ayegh = (($ghotreLoolePooste * 2.54 * 3.14) + 10) / 100 * $tooleLoolePooste * 1.25;

        $cap = 2;

        $boshenAir = 1;
        $boshenFreeze = 1;
        $sensor = 2;

        $varaghMasrafiTube *= (($ghotreLoolePooste * 2.54 / 100) + 12) * 2 * $tubePart->formula1;
        $varaghMasrafiRing *= (($ghotreLoolePooste * 2.54 / 100) + 12) * 2 * $ringPart->formula1;

        $profilSetare = $tooleLooleMessi * $tedadLooleMessi * $setarePart->formula1;

        $varaghPolyEtilenBafel *= ((($ghotreLoolePooste * 2.54) + 6) / 100 * ($tedadBafel + 2)) * $noeBafelPart->formula1;

        //TODO: select box Spacer
        $varaghPolyEtilenSpacer *= (($ghotreLoolePooste * 2.54) + 12) / 100 * $spacerPart->formula;

        $flanch = 2;

        $khamirLikLak = $tedadLooleMessi * 2;

        $pich = ((($ghotreLoolePooste * 2.54) + 6) * 3.14) / 6;

        $rang = (($ghotreLoolePooste * 2.54 * 3.14 / 100) * $tooleLoolePooste * 1.2) / 11;

        $zanooyi = 2;

        $ghotrSucshen = 0;
        if ($looleMessiSucshenId == '77') {
            $ghotrSucshen = 0.952;
        }
        if ($looleMessiSucshenId == '78') {
            $ghotrSucshen = 1.27;
        }
        if ($looleMessiSucshenId == '79') {
            $ghotrSucshen = 1.587;
        }
        if ($looleMessiSucshenId == '80') {
            $ghotrSucshen = 2.222;
        }
        if ($looleMessiSucshenId == '81') {
            $ghotrSucshen = 2.857;
        }
        if ($looleMessiSucshenId == '82') {
            $ghotrSucshen = 3.5;
        }
        if ($looleMessiSucshenId == '83') {
            $ghotrSucshen = 4.127;
        }
        if ($looleMessiSucshenId == '84') { // 2 1/8
            $ghotrSucshen = 5.397;
        }
        if ($looleMessiSucshenId == '85') { // 2 5/8
            $ghotrSucshen = 6.667;
        }
        if ($looleMessiSucshenId == '86') { // 3 1/8
            $ghotrSucshen = 8.572;
        }
        if ($looleMessiSucshenId == '87') { // 3 5/8
            $ghotrSucshen = 9.207;
        }
        if ($looleMessiSucshenId == '88') { // 4 1/8
            $ghotrSucshen = 10.477;
        }

        $ghotrMaye = 0;
        if ($looleMessiMayeId == '77') {
            $ghotrMaye = 0.952;
        }
        if ($looleMessiMayeId == '78') {
            $ghotrMaye = 1.27;
        }
        if ($looleMessiMayeId == '79') {
            $ghotrMaye = 1.587;
        }
        if ($looleMessiMayeId == '80') {
            $ghotrMaye = 2.222;
        }
        if ($looleMessiMayeId == '81') {
            $ghotrMaye = 2.857;
        }
        if ($looleMessiMayeId == '82') {
            $ghotrMaye = 3.5;
        }
        if ($looleMessiMayeId == '83') {
            $ghotrMaye = 4.127;
        }
        if ($looleMessiMayeId == '84') { // 2 1/8
            $ghotrMaye = 5.397;
        }
        if ($looleMessiMayeId == '85') { // 2 5/8
            $ghotrMaye = 6.667;
        }
        if ($looleMessiMayeId == '86') { // 3 1/8
            $ghotrMaye = 8.572;
        }
        if ($looleMessiMayeId == '87') { // 3 5/8
            $ghotrMaye = 9.207;
        }
        if ($looleMessiMayeId == '88') { // 4 1/8
            $ghotrMaye = 10.477;
        }

        $electrodBerenj = (($ghotrSucshen * 3.14 * $tedadMadar) + ($ghotrMaye * 3.14 * $tedadMadar)) * 2;

        $azot = (((($ghotreLoolePooste * 2.54) ^ 2 * 3.14) / 4) * ($tooleLoolePooste * 100)) / 1000;

        $chasb = ((($ghotreLoolePooste * 2.54 * 3.14 / 100 * 10) + 4) * $tooleLoolePooste) / 45;

        $tiner = $rang * 2;

        //Agar darad bood khodesh 2 va flanch 0, agar nadasht khodesh 0
        //agar flanch darad bood, sardande 0 shavad
        //Sardande va flanch mesle collector ahani va messi coil ha disabli bashad, gozine nadarad dashte bashan
    }

    public function storeEvaporator(Request $request, Part $part)
    {
        dd($request->all());
    }
}
