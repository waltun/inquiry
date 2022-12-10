<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateConverterController extends Controller
{
    public function evaporator(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.converter.evaporator', compact('part', 'product', 'inquiry', 'categories'));
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
            'tonaj' => 'required'
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
        $looleAhani = $tooleLoolePooste * $looleAhaniPart->formula1;
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

        $navdani = ($ghotreLoolePooste * 2.54 / 100) * 2 * $navdaniPart->formula1;

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
            $varaghPolyEtilenBafel = $varaghPolyEtilenBafelA * $varaghPolyEtilenBafelA * ($tedadBafel + 2) * $noeBafelPart->formula1;
        } else {
            $cap = 0;
            $varaghPolyEtilenBafelA = (($ghotreLoolePooste * 2.54) + 6) / 100;
            $varaghPolyEtilenBafel = $varaghPolyEtilenBafelA * $varaghPolyEtilenBafelA * $tedadBafel * $noeBafelPart->formula1;
        }

        if ($capId == '0' || is_null($capId)) {
            $varaghPolyEtilenSpacerA = (($ghotreLoolePooste * 2.54) + 12) / 100;
            $varaghPolyEtilenSpacer = $varaghPolyEtilenSpacerA * $varaghPolyEtilenSpacerA * $spacerPart->formula1;
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
            '15' => $boshenFreezePart,
            '16' => $boshenAirPart,
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
            $boshenFreeze,
            $boshenAir,
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

        $serial = $request['serial'];

        $name = $serial . '-STE-' . $tonaj . "TR-" . $ghotreLoolePooste . 'inch-' . $tooleLooleMessi . 'm-' . $tedadLooleMessi . 'T-'
            . $looleMessiName . '-' . $tedadMadar . 'C';

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'name' => $name]);
    }

    public function storeEvaporator(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price'],
            'standard' => $request['standard'] ?? 0
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

        $newPart->children()->syncWithoutDetaching($part->children()->orderBy('sort', 'ASC')->get());

        foreach ($newPart->children()->orderBy('sort', 'ASC')->get() as $index => $childPart) {
            if ($index == 0) {
                $childPart->pivot->parent_part_id = $request->parts[0];
            }
            if ($index == 1) {
                $childPart->pivot->parent_part_id = $request->parts[1];
            }
            if ($index == 2) {
                $childPart->pivot->parent_part_id = $request->parts[2];
            }
            if ($index == 3) {
                $childPart->pivot->parent_part_id = $request->parts[3];
            }
            if ($index == 4) {
                $childPart->pivot->parent_part_id = $request->parts[4];
            }
            if ($index == 5) { //Cap
                if (!is_null($request->parts[5]) && $request->parts[5] > 0) {
                    $childPart->pivot->parent_part_id = $request->parts[5];
                } else {
                    $childPart->pivot->parent_part_id = 1728;
                }
            }
            if ($index == 6) {
                $childPart->pivot->parent_part_id = $request->parts[6];
            }
            if ($index == 7) {
                $childPart->pivot->parent_part_id = $request->parts[7];
            }
            if ($index == 8) {
                $childPart->pivot->parent_part_id = $request->parts[8];
            }
            if ($index == 9) { //Spacer
                if (!is_null($request->parts[9]) && $request->parts[9] > 0) {
                    $childPart->pivot->parent_part_id = $request->parts[9];
                } else {
                    $childPart->pivot->parent_part_id = 1729;
                }
            }
            if ($index == 10) {
                $childPart->pivot->parent_part_id = $request->parts[10];
            }
            if ($index == 11) {
                $childPart->pivot->parent_part_id = $request->parts[11];
            }
            if ($index == 12) {
                $childPart->pivot->parent_part_id = $request->parts[12];
            }
            if ($index == 13) { //Zanooyi
                if (!is_null($request->parts[13]) && $request->parts[13] > 0) {
                    $childPart->pivot->parent_part_id = $request->parts[13];
                } else {
                    $childPart->pivot->parent_part_id = 1730;
                }
            }
            if ($index == 14) {
                $childPart->pivot->parent_part_id = $request->parts[14];
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $request->parts[15];
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $request->parts[16];
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $request->parts[17];
            }
            if ($index == 24) {
                $childPart->pivot->parent_part_id = $request->parts[18];
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('converter-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه اواپراتور پوسته و لوله با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function condensor(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.converter.condensor', compact('part', 'categories', 'product', 'inquiry'));
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
            'gaz' => 'required'
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

        //--------------------------------------------------------
        $looleAhaniPart = Part::find($sizeLoolePoosteId);
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
        //$looleAhani = $tooleLoolePooste * $looleAhaniPart->formula1;
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

        $navdani = ($ghotreLoolePooste * 2.54 / 100) * 2 * $navdaniPart->formula1;

        $electrodBargh = ($ghotreLoolePooste * 2.54 * 3.14 * 10 * 3);

        $boshenAir = 1;
        $boshenFreeze = 1;
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
            '1' => $looleMessiPart,
            '2' => $tubePart,
            '3' => $ringPart,
            '4' => $pichPart,
            '5' => $looleMessiSucshenPart,
            '6' => $looleMessiMayePart,
            '7' => $sensorPart,
            '8' => $boshenAirPart,
            '9' => $boshenFreezePart,
            '10' => $navdaniPart,
            '17' => $flanchPart,
        ];

        $values = [
            $vaznLoolePooste,
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

        $serial = $request['serial'];

        $name = $serial . '-STC-' . $tonaj . "TR-" . $gaz . "-" . $ghotreLoolePooste . 'inch-' . $tooleLooleMessi . 'm-' . $tedadLooleMessi . 'T-'
            . $looleMessiName;

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'name' => $name]);
    }

    public function storeCondensor(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price'],
            'standard' => $request['standard'] ?? 0
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

        $newPart->children()->sync($part->children()->orderBy('sort', 'ASC')->get());

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 0) {
                $childPart->pivot->parent_part_id = $request->parts[0];
            }
            if ($index == 1) {
                $childPart->pivot->parent_part_id = $request->parts[1];
            }
            if ($index == 2) {
                $childPart->pivot->parent_part_id = $request->parts[2];
            }
            if ($index == 3) {
                $childPart->pivot->parent_part_id = $request->parts[3];
            }
            if ($index == 4) {
                $childPart->pivot->parent_part_id = $request->parts[4];
            }
            if ($index == 5) {
                $childPart->pivot->parent_part_id = $request->parts[5];
            }
            if ($index == 6) {
                $childPart->pivot->parent_part_id = $request->parts[6];
            }
            if ($index == 7) {
                $childPart->pivot->parent_part_id = $request->parts[7];
            }
            if ($index == 8) {
                $childPart->pivot->parent_part_id = $request->parts[8];
            }
            if ($index == 9) {
                $childPart->pivot->parent_part_id = $request->parts[9];
            }
            if ($index == 10) {
                $childPart->pivot->parent_part_id = $request->parts[10];
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $request->parts[11];
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('converter-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه کندانسور آبی با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
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
