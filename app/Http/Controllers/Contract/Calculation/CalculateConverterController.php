<?php

namespace App\Http\Controllers\Contract\Calculation;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\ConvertorInput;
use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateConverterController extends Controller
{
    public function evaporator(Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('contracts.calculation.converter.evaporator', compact('part', 'product', 'contract', 'categories', 'part2'));
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
            'cap' => 'nullable',
            'navdani' => 'required',
            'boshen1' => 'required',
            'boshen2' => 'required',
            'flanch' => 'required',
            'size_loole_ab' => 'required',
            'tube' => 'required',
            'ring' => 'required',
            'tedad_madar' => 'required',
            'setare' => 'required',
            'noe_bafel' => 'required',
            'spacer' => 'nullable',
            'tedad_loole_messi' => 'required',
            'toole_loole_pooste' => 'required',
            'tedad_bafel' => 'required',
            'zanooyi' => 'nullable',
            'tonaj' => 'required',
            'gaz' => 'required',
            'pass' => 'required',
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
        $tubeId = $request['tube'];
        $ringId = $request['ring'];
        $setareId = $request['setare'];
        $noeBafelId = $request['noe_bafel'];
        $spacerId = $request['spacer'];
        $zanooyiId = $request['zanooyi'];

        //Inputs
        $tedadLooleMessi = $request['tedad_loole_messi'];
        $tooleLoolePooste = $request['toole_loole_pooste'];
        $tedadMadar = $request['tedad_madar'];
        $tedadBafel = $request['tedad_bafel'];
        $tooleLooleMessi = $tooleLoolePooste;
        $tonaj = $request['tonaj'];
        $gaz = $request['gaz'];
        $pass = $request['pass'];

        //--------------------------------------------------------
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
        $pichPart = Part::find($pichId);
        $boshenAirPart = Part::find($boshenAirId);
        $boshenFreezePart = Part::find($boshenFreezeId);
        $flanchPart = Part::find($flanchId);
        $sizeLoolePoostePart = Part::find($sizeLoolePoosteId);
        $sensorPart = Part::find($sensorId);
        if (is_null($zanooyiId) || $zanooyiId == '0') {
            $zanooyiPart = Part::find('1730');
        } else {
            $zanooyiPart = Part::find($zanooyiId);
        }

        if (is_null($spacerId) || $spacerId == '0') {
            $spacerPart = Part::find('1729');
        } else {
            $spacerPart = Part::find($spacerId);
        }

        if (is_null($capId) || $capId == '0') {
            $capPart = Part::find('1728');
        } else {
            $capPart = Part::find($capId);
        }

        // Values
        $looleMessi = $tooleLooleMessi * $tedadLooleMessi * $looleMessiPart->formula1;

        $looleMessiSucshen = 0.2 * $looleMessiSucshenPart->formula1 * $tedadMadar;
        $looleMessiMaye = 0.2 * $looleMessiMayePart->formula1 * $tedadMadar;

        $sizeLooleConnectionAb = 0.25 * 2 * $sizeLooleAbPart->formula1; // 1

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

        $vaznLoolePooste = $tooleLoolePooste * $sizeLoolePoostePart->formula1;

        if ($navdaniId == '9' || $navdaniId == '10' || $navdaniId == '11' || $navdaniId == '12') {
            $navdani = (($ghotreLoolePooste * 2.54 / 100) * 0.3) * 2 * $navdaniPart->formula1;
        } else {
            $navdani = ($ghotreLoolePooste * 2.54 / 100) * 2 * $navdaniPart->formula1;
        }

        $electrodBargh = ($ghotreLoolePooste * 2.54 * 3.14 * 16 * 3);

        $ayegh = (($ghotreLoolePooste * 2.54 * 3.14) + 10) / 100 * $tooleLoolePooste * 1.25;

        $boshenAir = 1;
        $boshenFreeze = 1;
        $sensor = 2;

        $varaghMasrafiTubeA = (($ghotreLoolePooste * 2.54) + 12) / 100;
        $varaghMasrafiTube = $varaghMasrafiTubeA * $varaghMasrafiTubeA * 2 * $tubePart->formula1;
        $varaghMasrafiRingA = (($ghotreLoolePooste * 2.54) + 12) / 100;
        $varaghMasrafiRing = $varaghMasrafiRingA * $varaghMasrafiRingA * 2 * $ringPart->formula1;

        $profilSetare = $tooleLooleMessi * $tedadLooleMessi * $setarePart->formula1;

        if ($spacerId == '0' || is_null($spacerId)) {
            $cap = 2;
            $varaghPolyEtilenBafelA = (($ghotreLoolePooste * 2.54) + 6) / 100;
            if ($spacerId == '1151' || $spacerId == '1152' || $spacerId == '1153' || $spacerId == '1154') {
                $varaghPolyEtilenBafel = $varaghPolyEtilenBafelA * $varaghPolyEtilenBafelA * ($tedadBafel + 2) * $noeBafelPart->formula1;
            } else {
                $varaghPolyEtilenBafel = $varaghPolyEtilenBafelA * $varaghPolyEtilenBafelA * ($tedadBafel + 4) * $noeBafelPart->formula1;
            }
        } else {
            $cap = 0;
            $varaghPolyEtilenBafelA = (($ghotreLoolePooste * 2.54) + 6) / 100;
            if ($spacerId == '1151' || $spacerId == '1152' || $spacerId == '1153' || $spacerId == '1154') {
                $varaghPolyEtilenBafel = $varaghPolyEtilenBafelA * $varaghPolyEtilenBafelA * ($tedadBafel) * $noeBafelPart->formula1;
            } else {
                $varaghPolyEtilenBafel = $varaghPolyEtilenBafelA * $varaghPolyEtilenBafelA * ($tedadBafel + 4) * $noeBafelPart->formula1;
            }
        }

        if ($capId == '0' || is_null($capId)) {
            $varaghPolyEtilenSpacerA = (($ghotreLoolePooste * 2.54) + 12) / 100;
            $varaghPolyEtilenSpacer = ($varaghPolyEtilenSpacerA * $varaghPolyEtilenSpacerA * $spacerPart->formula1) * 2;
        } else {
            $varaghPolyEtilenSpacer = 0;
        }

        $khamirLikLak = $tedadLooleMessi * 2;

        $pich = ((($ghotreLoolePooste * 2.54) + 6) * 3.14) / 6;

        $roundPich = round($pich);
        if ($roundPich % 2 != 0) {
            $roundPich = $roundPich + 1;
        }

        $rang = (($ghotreLoolePooste * 2.54 * 3.14 / 100) * $tooleLoolePooste * 1.2) / 11;

        if ($zanooyiId == 0 || is_null($zanooyiId)) {
            $zanooyi = 0;
        } else {
            $zanooyi = 2;
        }

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

        $azotA = ($ghotreLoolePooste * 2.54);
        $azot = (((($azotA * $azotA * 3.14) / 4) * ($tooleLoolePooste * 100)) / 1000) / 3;

        $chasb = (($ghotreLoolePooste * 2.54 * 3.14 / 100 * 10) + (4 * $tooleLoolePooste)) / 45;

        $tiner = $rang * 2;

        $flanch = 2;

        $selectedParts = [
            '0' => $sizeLoolePoostePart,
            '1' => $looleMessiPart,
            '2' => $setarePart,
            '3' => $tubePart,
            '4' => $ringPart,
            '5' => $capPart,
            '6' => $sizeLooleAbPart,
            '7' => $flanchPart,
            '8' => $noeBafelPart,
            '9' => $spacerPart,
            '10' => $looleMessiSucshenPart,
            '11' => $looleMessiMayePart,
            '12' => $navdaniPart,
            '13' => $zanooyiPart,
            '14' => $sensorPart,
            '15' => $boshenAirPart,
            '16' => $boshenFreezePart,
            '17' => $pichPart,
            '24' => $ayeghPart,
        ];

        $values = [
            $vaznLoolePooste,
            $looleMessi,
            $profilSetare,
            $varaghMasrafiTube,
            $varaghMasrafiRing,
            $cap,
            $sizeLooleConnectionAb,
            $flanch,
            $varaghPolyEtilenBafel,
            $varaghPolyEtilenSpacer,
            $looleMessiSucshen,
            $looleMessiMaye,
            $navdani,
            $zanooyi,
            $sensor,
            $boshenAir,
            $boshenFreeze,
            $roundPich,
            $electrodBargh,
            $electrodBerenj,
            $azot,
            $khamirLikLak,
            $tiner,
            $rang,
            $ayegh,
            $chasb
        ];

        if (!array_key_exists('zanooyi', $inputs)) {
            $inputs['zanooyi'] = 0;
        }

        if (!array_key_exists('spacer', $inputs)) {
            $inputs['spacer'] = 0;
        }

        if (!array_key_exists('cap', $inputs)) {
            $inputs['cap'] = 0;
        }

        if ($looleMessiId == '79' || $looleMessiId == '1327') {
            $looleMessiName = '58';
        }
        if ($looleMessiId == '1324' || $looleMessiId == '1325') {
            $looleMessiName = '38';
        }
        if ($looleMessiId == '78' || $looleMessiId == '1326') {
            $looleMessiName = '12';
        }

        $name = 'TA-STE-' . $tonaj . "TR-" . $gaz . "-" . $ghotreLoolePooste . 'inch-' . $tooleLooleMessi . 'm-' . $tedadLooleMessi . 'T-'
            . $looleMessiName . '-' . $tedadMadar . 'C-' . $pass . 'P-' . $tedadBafel . 'B';

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'name' => $name]);
    }

    public function storeEvaporator(Request $request, Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $inputs = json_decode($request->input('inputs'), true);
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'contract_id' => $contract->id,
            'price' => $request['price'],
            'standard' => $request['standard'] ?? 0,
            'weight' => $request['weight']
        ]);

        $newPart->save();

        if (isset($request->categories)) {
            if (!is_null($request->categories[0])) {
                $newPart->categories()->sync($request['categories']);
            } else {
                $newPart->categories()->sync($part->categories);
            }
        } else {
            $newPart->categories()->sync($part->categories);
        }

        foreach ($request->parts as $index => $id) {
            if ($index == 5 && is_null($request->parts[5]) && $request->parts[5] > 0) {
                $id = 1728;
            }
            if ($index == 9 && is_null($request->parts[9]) && $request->parts[9] > 0) {
                $id = 1729;
            }
            if ($index == 13 && is_null($request->parts[13]) && $request->parts[13] > 0) {
                $id = 1730;
            }
            $newPart->children()->attach($id, [
                'sort' => $request->sorts[$index],
                'value' => $request->values[$index]
            ]);
        }

        if ($inputs["loole_messi"]) {
            $inputs["loole_messi"] = Part::find($inputs["loole_messi"])->name_en;
        }
        if ($inputs["size_loole_pooste"]) {
            $inputs["size_loole_pooste"] = Part::find($inputs["size_loole_pooste"])->name_en;
        }
        if ($inputs["ayegh"]) {
            $inputs["ayegh"] = Part::find($inputs["ayegh"])->name_en;
        }
        if ($inputs["flanch"]) {
            $inputs["flanch"] = Part::find($inputs["flanch"])->name_en;
        }
        if ($inputs["noe_bafel"]) {
            $inputs["noe_bafel"] = Part::find($inputs["noe_bafel"])->name_en;
        }

        $converterInput = ConvertorInput::create($inputs);
        $converterInput->type = 'Evaporator';
        $converterInput->part_id = $newPart->id;
        $converterInput->contract_id = $contract->id;
        $converterInput->save();

        $product->spareAmounts()->where('part_id', $part2->id)->first()->update([
            'part_id' => $newPart->id
        ]);

        alert()->success('محاسبه موفق', 'محاسبه اواپراتور پوسته و لوله با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function condensor(Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('contracts.calculation.converter.condensor', compact('part', 'categories', 'product', 'contract', 'part2'));
    }

    public function calculateCondensor(Request $request)
    {
        $inputs = $request->validate([
            'loole_messi' => 'required',
            'loole_messi_sucshen' => 'required',
            'loole_messi_maye' => 'required',
            'size_loole_pooste' => 'required',
            'picho_mohre' => 'required',
            'sensor' => 'required',
            'navdani' => 'required',
            'boshen1' => 'required',
            'boshen2' => 'required',
            'flanch' => 'required',
            'tube' => 'required',
            'ring' => 'required',
            'tedad_loole_messi' => 'required',
            'toole_loole_pooste' => 'required',
            'tonaj' => 'required',
            'gaz' => 'required',
            'pass' => 'required'
        ]);

        //Ids
        $looleMessiId = $request['loole_messi'];
        $looleMessiSucshenId = $request['loole_messi_sucshen'];
        $looleMessiMayeId = $request['loole_messi_maye'];
        $sizeLoolePoosteId = $request['size_loole_pooste'];
        $pichId = $request['picho_mohre'];
        $sensorId = $request['sensor'];
        $navdaniId = $request['navdani'];
        $boshenAirId = $request['boshen1'];
        $boshenFreezeId = $request['boshen2'];
        $flanchId = $request['flanch'];
        $tubeId = $request['tube'];
        $ringId = $request['ring'];

        //Inputs
        $tedadLooleMessi = $request['tedad_loole_messi'];
        $tooleLoolePooste = $request['toole_loole_pooste'];
        $tooleLooleMessi = $tooleLoolePooste;
        $tonaj = $request['tonaj'];
        $gaz = $request['gaz'];
        $pass = $request['pass'];

        //--------------------------------------------------------
        $looleMessiPart = Part::find($looleMessiId);
        $looleMessiSucshenPart = Part::find($looleMessiSucshenId);
        $looleMessiMayePart = Part::find($looleMessiMayeId);
        $navdaniPart = Part::find($navdaniId);
        $tubePart = Part::find($tubeId);
        $ringPart = Part::find($ringId);
        $pichPart = Part::find($pichId);
        $boshenAirPart = Part::find($boshenAirId);
        $boshenFreezePart = Part::find($boshenFreezeId);
        $flanchPart = Part::find($flanchId);
        $sizeLoolePoostePart = Part::find($sizeLoolePoosteId);
        $sensorPart = Part::find($sensorId);

        // Values
        $looleMessi = $tooleLooleMessi * $tedadLooleMessi * $looleMessiPart->formula1;

        $looleMessiSucshen = 0.2 * $looleMessiSucshenPart->formula1;
        $looleMessiMaye = 0.2 * $looleMessiMayePart->formula1;

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

        $vaznLoolePooste = $tooleLoolePooste * $sizeLoolePoostePart->formula1;
        $vaznLoolePooste2 = 0.14 * $sizeLoolePoostePart->formula1;

        if ($navdaniId == '9' || $navdaniId == '10' || $navdaniId == '11' || $navdaniId == '12') {
            $navdani = (($ghotreLoolePooste * 2.54 / 100) * 0.3) * 2 * $navdaniPart->formula1;
        } else {
            $navdani = ($ghotreLoolePooste * 2.54 / 100) * 2 * $navdaniPart->formula1;
        }

        $electrodBargh = ($ghotreLoolePooste * 2.54 * 3.14 * 10 * 3);

        $boshenAir = 0.1;
        $boshenFreeze = 0.1;
        $sensor = 2;

        $varaghMasrafiTubeA = (($ghotreLoolePooste * 2.54) + 12) / 100;
        $varaghMasrafiTube = $varaghMasrafiTubeA * $varaghMasrafiTubeA * 2 * $tubePart->formula1;
        $varaghMasrafiRingA = (($ghotreLoolePooste * 2.54) + 12) / 100;
        $varaghMasrafiRing = $varaghMasrafiRingA * $varaghMasrafiRingA * 2 * $ringPart->formula1;

        $khamirLikLak = $tedadLooleMessi * 2;

        $pich = ((($ghotreLoolePooste * 2.54) + 6) * 3.14) / 6;

        $roundPich = round($pich);
        if ($roundPich % 2 != 0) {
            $roundPich = $roundPich + 1;
        }

        $rang = (($ghotreLoolePooste * 2.54 * 3.14 / 100) * $tooleLoolePooste * 1.2) / 11;

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

        $electrodBerenj = (($ghotrSucshen * 3.14) + ($ghotrMaye * 3.14)) * 2;

        $azotA = ($ghotreLoolePooste * 2.54);
        $azot = (((($azotA * $azotA * 3.14) / 4) * ($tooleLoolePooste * 100)) / 1000) / 3;

        $tiner = $rang * 2;

        $flanch = 2;

        $selectedParts = [
            '0' => $sizeLoolePoostePart,
            '1' => $sizeLoolePoostePart,
            '2' => $looleMessiPart,
            '3' => $tubePart,
            '4' => $ringPart,
            '5' => $pichPart,
            '6' => $looleMessiSucshenPart,
            '7' => $looleMessiMayePart,
            '8' => $sensorPart,
            '9' => $boshenAirPart,
            '10' => $boshenFreezePart,
            '11' => $navdaniPart,
            '17' => $flanchPart,
        ];

        $values = [
            $vaznLoolePooste,
            $vaznLoolePooste2,
            $looleMessi,
            $varaghMasrafiTube,
            $varaghMasrafiRing,
            $roundPich,
            $looleMessiSucshen,
            $looleMessiMaye,
            $sensor,
            $boshenAir,
            $boshenFreeze,
            $navdani,
            $electrodBargh,
            $electrodBerenj,
            $azot,
            $tiner,
            $rang,
            $khamirLikLak,
            $flanch,
        ];

        if ($looleMessiId == '79' || $looleMessiId == '1327') {
            $looleMessiName = '58';
        }
        if ($looleMessiId == '1324' || $looleMessiId == '1325') {
            $looleMessiName = '38';
        }
        if ($looleMessiId == '78' || $looleMessiId == '1326') {
            $looleMessiName = '12';
        }
        if ($looleMessiId == '1882' || $looleMessiId == '10181') {
            $looleMessiName = '34';
        }

        $name = 'TA-STC-' . $tonaj . "TR-" . $gaz . "-" . $ghotreLoolePooste . 'inch-' . $tooleLooleMessi . 'm-' . $tedadLooleMessi . 'T-'
            . $looleMessiName . '-' . $pass . 'P';

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'name' => $name]);
    }

    public function storeCondensor(Request $request, Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $inputs = json_decode($request->input('inputs'), true);
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'contract_id' => $contract->id,
            'price' => $request['price'],
            'standard' => $request['standard'] ?? 0,
            'weight' => $request['weight']
        ]);

        $newPart->save();

        if (isset($request->categories)) {
            if (!is_null($request->categories[0])) {
                $newPart->categories()->sync($request['categories']);
            } else {
                $newPart->categories()->sync($part->categories);
            }
        } else {
            $newPart->categories()->sync($part->categories);
        }

        foreach ($request->parts as $index => $id) {
            $newPart->children()->attach($id, [
                'sort' => $request->sorts[$index],
                'value' => $request->values[$index]
            ]);
        }

        if ($inputs["loole_messi"]) {
            $inputs["loole_messi"] = Part::find($inputs["loole_messi"])->name_en;
        }
        if ($inputs["size_loole_pooste"]) {
            $inputs["size_loole_pooste"] = Part::find($inputs["size_loole_pooste"])->name_en;
        }
        if ($inputs["flanch"]) {
            $inputs["flanch"] = Part::find($inputs["flanch"])->name_en;
        }

        $converterInput = ConvertorInput::create($inputs);
        $converterInput->type = 'Condensor';
        $converterInput->part_id = $newPart->id;
        $converterInput->contract_id = $contract->id;
        $converterInput->save();

        $product->spareAmounts()->where('part_id', $part2->id)->first()->update([
            'part_id' => $newPart->id
        ]);

        alert()->success('محاسبه موفق', 'محاسبه کندانسور آبی با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function getLastCode($part)
    {
        $category = $part->categories()->latest()->first();
        $categoryPart = $category->parts->toArray();
        if (count($categoryPart) > 0) {
            $lastPart = $categoryPart[count($categoryPart) - 1];
            $code = str_pad($lastPart['code'] + 1, 4, "0", STR_PAD_LEFT);
        }
        return $code;
    }
}
