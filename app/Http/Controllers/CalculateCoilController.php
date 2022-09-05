<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateCoilController extends Controller
{
    public function evaperator(Part $part, Product $product)
    {
        return view('calculate.coil.evaperator', compact('part', 'product'));
    }

    public function waterCold(Part $part, Product $product)
    {
        return view('calculate.coil.cold-water', compact('part', 'product'));
    }

    public function waterWarm(Part $part, Product $product)
    {
        return view('calculate.coil.warm-water', compact('part', 'product'));
    }

    public function condensor(Part $part, Product $product)
    {
        return view('calculate.coil.condensor', compact('part', 'product'));
    }

    public function fancoil(Part $part, Product $product)
    {
        return view('calculate.coil.fancoil', compact('part', 'product'));
    }

    public function storeEvaperator(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'zekhamat_frame_coil' => 'required',
            'collector_ahani' => 'required',
            'collector_messi' => 'required',
            'electrod_noghre' => 'required',
            'name' => 'required'
        ]);

        $looleMessi = $request['loole_messi'];
        $fin = $request['fin_coil'];
        $zekhamat_frame = $request['zekhamat_frame_coil'];
        $collectorAhani = $request['collector_ahani'];
        $collectorMessi = $request['collector_messi'];
        $electrodNoghre = $request['electrod_noghre'];

        $name = $request['name'];
        $code = $this->getLastCode($part);
        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true
        ]);

        $newPart->save();

        foreach ($part->categories as $category) {
            $newPart->categories()->syncWithoutDetaching($category->id);
        }

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 14) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 17 && !is_null($collectorMessi) && $collectorMessi > 0) {
                $childPart->pivot->parent_part_id = $collectorMessi;
            }
            if ($index == 18 && !is_null($collectorAhani) && $collectorAhani > 0) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $electrodNoghre;
            }
            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeCondensor(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'zekhamat_frame_coil' => 'required',
            'collector_ahani' => 'required',
            'collector_messi' => 'required',
            'electrod_noghre' => 'required',
            'name' => 'required'
        ]);

        $looleMessi = $request['loole_messi'];
        $fin = $request['fin_coil'];
        $zekhamat_frame = $request['zekhamat_frame_coil'];
        $collectorAhani = $request['collector_ahani'];
        $collectorMessi = $request['collector_messi'];
        $electrodNoghre = $request['electrod_noghre'];

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true
        ]);

        $newPart->save();

        foreach ($part->categories as $category) {
            $newPart->categories()->syncWithoutDetaching($category->id);
        }

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 14) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 17 && !is_null($collectorMessi) && $collectorMessi > 0) {
                $childPart->pivot->parent_part_id = $collectorMessi;
            }
            if ($index == 18 && !is_null($collectorAhani) && $collectorAhani > 0) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $electrodNoghre;
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeFancoil(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true
        ]);

        $newPart->save();
        $newPart->categories()->syncWithoutDetaching($part->categories);
        $newPart->children()->syncWithoutDetaching($part->children);

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 13) {
                $childPart->pivot->parent_part_id = $request->parts[0];
            }
            if ($index == 14) {
                $childPart->pivot->parent_part_id = $request->parts[1];
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $request->parts[2];
            }
            if ($index == 16 && !is_null($request->parts[3]) &&  $request->parts[3] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[3];
            }
            if ($index == 17 && !is_null($request->parts[4]) && $request->parts[4] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[4];
            }
            if ($index == 18) {
                $childPart->pivot->parent_part_id = $request->parts[5];
            }
            if ($index == 19) {
                $childPart->pivot->parent_part_id = $request->parts[6];
            }
            if ($index == 21) {
                $childPart->pivot->parent_part_id = $request->parts[7];
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeWaterCold(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'zekhamat_frame_coil' => 'required',
            'collector_ahani' => 'required',
            'collector_messi' => 'required',
            'electrod_noghre' => 'required',
            'name' => 'required'
        ]);

        $looleMessi = $request['loole_messi'];
        $fin = $request['fin_coil'];
        $zekhamat_frame = $request['zekhamat_frame_coil'];
        $collectorAhani = $request['collector_ahani'];
        $collectorMessi = $request['collector_messi'];
        $electrodNoghre = $request['electrod_noghre'];

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true
        ]);

        $newPart->save();

        foreach ($part->categories as $category) {
            $newPart->categories()->syncWithoutDetaching($category->id);
        }

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 18 && !is_null($collectorMessi) && $collectorMessi > 0) {
                $childPart->pivot->parent_part_id = $collectorMessi;
            }
            if ($index == 19 && !is_null($collectorAhani) && $collectorAhani > 0) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 21) {
                $childPart->pivot->parent_part_id = $electrodNoghre;
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeWaterWarm(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'zekhamat_frame_coil' => 'required',
            'collector_ahani' => 'required',
            'collector_messi' => 'required',
            'electrod_noghre' => 'required',
            'name' => 'required'
        ]);

        $looleMessi = $request['loole_messi'];
        $fin = $request['fin_coil'];
        $zekhamat_frame = $request['zekhamat_frame_coil'];
        $collectorAhani = $request['collector_ahani'];
        $collectorMessi = $request['collector_messi'];
        $electrodNoghre = $request['electrod_noghre'];

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true
        ]);

        $newPart->save();

        foreach ($part->categories as $category) {
            $newPart->categories()->syncWithoutDetaching($category->id);
        }

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 18 && !is_null($collectorMessi) && $collectorMessi > 0) {
                $childPart->pivot->parent_part_id = $collectorMessi;
            }
            if ($index == 19 && !is_null($collectorAhani) && $collectorAhani > 0) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 21) {
                $childPart->pivot->parent_part_id = $electrodNoghre;
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function getData(Request $request)
    {
        $part = Part::find($request->id);
        return response(['data' => $part]);
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


    public function calculateCoil(Request $request)
    {
        $inputs = $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'tedad_radif_coil' => 'required',
            'fin_dar_inch' => 'required',
            'zekhamat_frame_coil' => 'required',
            'pooshesh_khordegi' => 'required',
            'electrod_noghre' => 'required',
            'noe_coil' => 'required',
            'toole_coil' => 'required',
            'tedad_loole_dar_radif' => 'required',
            'tedad_mogheyiat_loole' => 'required',
            'tedad_madar_loole' => 'required',
            'collector_messi' => 'required',
            'collector_ahani' => 'required'
        ]);

        //Ids
        $looleMessiId = $request['loole_messi'];
        $finCoilId = $request['fin_coil'];
        $collectorAhaniId = $request['collector_ahani'];
        $collectorMessiId = $request['collector_messi'];
        $electrodNoghreId = $request['electrod_noghre'];
        $zekhamatFrameId = $request['zekhamat_frame_coil'];

        //Inputs
        $tedadRadifCoil = $request['tedad_radif_coil'];
        $finDarInch = $request['fin_dar_inch'];
        $poosheshKhordegi = $request['pooshesh_khordegi'];
        $noeCoil = $request['noe_coil'];
        $tooleCoil = $request['toole_coil'];
        $tedadLooleDarRadif = $request['tedad_loole_dar_radif'];
        $tedadMogheyiatLoole = $request['tedad_mogheyiat_loole'];
        $tedadMadarLoole = $request['tedad_madar_loole'];

        //--------------------------------------------------------

        $varaghGalvanizePart = Part::find($zekhamatFrameId);
        $looleMessiPart = Part::find($looleMessiId);
        $finPart = Part::find($finCoilId);
        $electrodNoghrePart = Part::find($electrodNoghreId);
        //Collector Messi
        if (is_null($collectorMessiId) || $collectorMessiId == '0') {
            $collectorMessiPart = Part::find('313');
        } else {
            $collectorMessiPart = Part::find($collectorMessiId);
        }
        //Collector Ahani
        if (is_null($collectorAhaniId) || $collectorAhaniId == '0') {
            $collectorAhaniPart = Part::find('314');
        } else {
            $collectorAhaniPart = Part::find($collectorAhaniId);
        }
        //Sardande
        if ($collectorAhaniId == '0' && $collectorMessiId == '0') {
            $sardandePart = Part::find('166');
            if ($noeCoil === '2') {
                $sardande = 2;
            }
            if ($noeCoil === '4') {
                $sardande = 4;
            }
        }
        if ($collectorMessiId != '0') {
            $sardandePart = Part::find('416');
            if ($noeCoil === '2') {
                $sardande = 2;
            }
            if ($noeCoil === '4') {
                $sardande = 4;
            }
        }
        if ($collectorAhaniId != '0') {
            $sardandePart = Part::find('417');
            $sardande = 0;
        }

        //U Messi
        if ($looleMessiId == '58' || $looleMessiId == '59') {
            $uMessiPart = Part::find('96');
        }
        if ($looleMessiId == '53' || $looleMessiId == '54' || $looleMessiId == '55') {
            $uMessiPart = Part::find('89');
        }
        if ($looleMessiId == '56' || $looleMessiId == '57') {
            $uMessiPart = Part::find('92');
        }

        $selectedParts = [
            '13' => $varaghGalvanizePart,
            '14' => $looleMessiPart,
            '15' => $finPart,
            '16' => $collectorMessiPart,
            '17' => $collectorAhaniPart,
            '18' => $uMessiPart,
            '19' => $electrodNoghrePart,
            '21' => $sardandePart
        ];

        //--------------------------------------------------------

        //Tedad fin masrafi
        $tedadFinMasrafi = $tooleCoil * $finDarInch;

        //Zekahamt Fin
        $zekhamatFin = $this->calculateFin($finCoilId);

        //Loole messi 5/8
        if ($looleMessiId == '58' || $looleMessiId == '59') {
            //Zekhamat 0.5
            if ($looleMessiId == '58') {
                $looleMessi = ($tooleCoil + 4) * $tedadRadifCoil * $tedadLooleDarRadif * 0.0055118;
            }
            //Zekhamat 0.63
            if ($looleMessiId == '59') {
                $looleMessi = ($tooleCoil + 4) * $tedadRadifCoil * $tedadLooleDarRadif * 0.006858;
            }
            $tedadU = ($tedadRadifCoil * $tedadLooleDarRadif) - $tedadMadarLoole;
            $gamDarRadif = 32.5;
            $gamDarErtefa = 37.5;
            $sabetVaznVaragh = 100;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.5 * $tooleCoil) / 144;
            $electrodNoghre = $tedadRadifCoil * $tedadLooleDarRadif * 2 * 2.8;
            $azot = $tedadRadifCoil * $satheCoil * 0.23;
            $electrodBerenj = ($tedadMadarLoole * 2) * 4.5;
        }

        //Loole Messi 3/8
        if ($looleMessiId == '53' || $looleMessiId == '54' || $looleMessiId == '55') {
            //Zekhamat 0.35
            if ($looleMessiId == '53') {
                $looleMessi = ($tooleCoil + 4) * $tedadRadifCoil * $tedadLooleDarRadif * 0.002286;
            }
            //Zekhamat 0.4
            if ($looleMessiId == '54') {
                $looleMessi = ($tooleCoil + 4) * $tedadRadifCoil * $tedadLooleDarRadif * 0.0026162;
            }
            //Zekhamat 0.5
            if ($looleMessiId == '55') {
                $looleMessi = ($tooleCoil + 4) * $tedadRadifCoil * $tedadLooleDarRadif * 0.0032258;
            }
            $tedadU = ($tedadRadifCoil * $tedadLooleDarRadif / 2) - $tedadMadarLoole;
            $gamDarRadif = 21.6;
            $gamDarErtefa = 25;
            $sabetVaznVaragh = 70;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 0.984 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2;
            $azot = $tedadRadifCoil * $satheCoil * 0.15;
            $electrodBerenj = ($tedadMadarLoole * 2) * 3;
        }

        //Loole Messi 1/2
        if ($looleMessiId == '56' || $looleMessiId == '57') {
            //Zekhamat 0.5
            if ($looleMessiId == '56') {
                $looleMessi = ($tooleCoil + 4) * $tedadRadifCoil * $tedadLooleDarRadif * 0.0043688;
            }
            //Zekhamat 0.63
            if ($looleMessiId == '57') {
                $looleMessi = ($tooleCoil + 4) * $tedadRadifCoil * $tedadLooleDarRadif * 0.0054356;
            }
            $tedadU = ($tedadRadifCoil * $tedadLooleDarRadif) - $tedadMadarLoole;
            $gamDarRadif = 27.5;
            $gamDarErtefa = 31.75;
            $sabetVaznVaragh = 80;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.25 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2.6;
            $azot = $tedadRadifCoil * $satheCoil * 0.2;
            $electrodBerenj = ($tedadMadarLoole * 2) * 4;
        }

        //Fin Al & Golden
        $vaznFinAl = $this->calculateFinAl($finCoilId, $ertefaFin, $gamDarRadif, $tedadRadifCoil, $zekhamatFin, $tedadFinMasrafi);

        //Masahat tube sheet
        $masahatTubSheet = (2 * (($ertefaFin) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatVaraghMasrafi = $masahatTubSheet;

        //Varagh Galvnize - Zekhamat 0.5
        $zekhamatFrame = $this->calculateZekhamatFrame($zekhamatFrameId, $masahatVaraghMasrafi);

        //Flaks maye
        $flaksMaye = $tedadU * 0.002;

        //Pooshesh zede khordegi & tiner
        if ($poosheshKhordegi === '1') {
            $poosheshKhordegiResult = $satheCoil * $tedadRadifCoil * 0.05;
            $tiner = $satheCoil * $tedadRadifCoil * 0.1;
        } else {
            $poosheshKhordegiResult = 0;
            $tiner = 0;
        }

        //Ab & Oxygen
        $abeMasrafi = $satheCoil * $tedadRadifCoil * 0.7;
        $oxygenMasrafi = $tedadU * 0.006;

        //Roghane tabkhir shavande
        $roghaneTabkhirShavande = $tedadRadifCoil * $satheCoil * 0.015;

        //Collector Ahani
        list ($collectorAhani, $electrod6013) = $this->collectorAhani($collectorAhaniId, $noeCoil, $ertefaFin);

        //Collector Messi
        $collectorMessi = $this->collectorMessi($collectorMessiId, $noeCoil, $ertefaFin);

        if ($collectorAhaniId == '0' || $collectorAhaniId == '') {
            $electrodBerenj = 0;
        }

        //Shire Havagiri - Shire Takhlie
        if ($noeCoil == '4') {
            $shireHavagiri = 2;
            $shireTakhlie = 2;
        }
        if ($noeCoil == '2') {
            $shireHavagiri = 1;
            $shireTakhlie = 1;
        }

        //Sardande - Loole Messi 38
        if ($collectorAhaniId == '0' && $collectorMessiId == '0') {
            $looleMessi38 = $tedadMadarLoole * $noeCoil * 0.06 * 0.158;
        } else {
            $looleMessi38 = 0;
        }

        $values = [
            0,
            $abeMasrafi,
            0.2,
            $poosheshKhordegiResult,
            $tiner,
            $flaksMaye,
            $azot,
            $oxygenMasrafi,
            $electrodBerenj,
            0,
            $roghaneTabkhirShavande,
            $shireHavagiri,
            $shireTakhlie,
            $zekhamatFrame,
            $looleMessi,
            $vaznFinAl,
            $collectorMessi,
            $collectorAhani,
            $tedadU,
            $electrodNoghre,
            $electrod6013,
            $sardande,
            $looleMessi38
        ];

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'satheCoil' => $satheCoil]);
    }

    public function calculateZekhamatFrame($zekhamatFrameId, $masahatVaraghMasrafi)
    {
        if ($zekhamatFrameId === '1') {
            $zekhamatFrame = $masahatVaraghMasrafi * 0.5 * 7.874;
        }
        if ($zekhamatFrameId === '2') {
            $zekhamatFrame = $masahatVaraghMasrafi * 0.6 * 7.874;
        }
        if ($zekhamatFrameId === '3') {
            $zekhamatFrame = $masahatVaraghMasrafi * 0.8 * 7.874;
        }
        if ($zekhamatFrameId === '4') {
            $zekhamatFrame = $masahatVaraghMasrafi * 0.9 * 7.874;
        }
        if ($zekhamatFrameId === '5') {
            $zekhamatFrame = $masahatVaraghMasrafi * 7.874;
        }
        if ($zekhamatFrameId === '7') {
            $zekhamatFrame = $masahatVaraghMasrafi * 1.25 * 7.874;
        }
        if ($zekhamatFrameId === '8') {
            $zekhamatFrame = $masahatVaraghMasrafi * 1.5 * 7.874;
        }
        if ($zekhamatFrameId === '9') {
            $zekhamatFrame = $masahatVaraghMasrafi * 2 * 7.874;
        }
        if ($zekhamatFrameId === '10') {
            $zekhamatFrame = $masahatVaraghMasrafi * 2.5 * 7.874;
        }
        if ($zekhamatFrameId === '11') {
            $zekhamatFrame = $masahatVaraghMasrafi * 3 * 7.874;
        }
        if ($zekhamatFrameId === '12') {
            $zekhamatFrame = $masahatVaraghMasrafi * 4 * 7.874;
        }

        return $zekhamatFrame;
    }

    public function calculateFin($finCoilId)
    {
        if ($finCoilId == '60' || $finCoilId == '63' || $finCoilId == '67') {
            $zekhamatFin = 0.13; //130 micron
        }
        if ($finCoilId == '61' || $finCoilId == '64' || $finCoilId == '68') {
            $zekhamatFin = 0.14; //140 micron
        }
        if ($finCoilId == '62' || $finCoilId == '65' || $finCoilId == '69') {
            $zekhamatFin = 0.15; //150 micron
        }
        if ($finCoilId === '66') {
            $zekhamatFin = 0.10; //100 micron
        }
        return $zekhamatFin;
    }

    public function calculateFinAl($finCoilId, $ertefaFin, $gamDarRadif, $tedadRadifCoil, $zekhamatFin, $tedadFinMasrafi)
    {
        if ($finCoilId == '60' || $finCoilId == '61' || $finCoilId == '62' || $finCoilId == '63' || $finCoilId == '64' || $finCoilId == '65') {
            $vaznFinAl = (($ertefaFin * ($gamDarRadif * $tedadRadifCoil) * $zekhamatFin) * 2.7 * $tedadFinMasrafi) / 1000000;
        } else {
            //Fin Messi
            $vaznFinAl = (($ertefaFin * ($gamDarRadif * $tedadRadifCoil) * $zekhamatFin) * 8.96 * $tedadFinMasrafi) / 1000000;
        }
        return $vaznFinAl;
    }

    public function collectorAhani($collectorAhaniId, $noeCoil, $ertefaFin)
    {
        if ($collectorAhaniId === '70') {
            if ($noeCoil === '4') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 1.94 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 1.94 * 2;
            }
            $electrod6013 = 2 * 16;
        }
        if ($collectorAhaniId === '71') {
            if ($noeCoil === '4') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 2.48 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 2.48 * 2;
            }
            $electrod6013 = 3 * 16;
        }
        if ($collectorAhaniId === '72') {
            if ($noeCoil === '4') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 2.81 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 2.81 * 2;
            }
            $electrod6013 = 4 * 16;
        }
        if ($collectorAhaniId === '73') {
            if ($noeCoil === '4') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 4.32 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 4.32 * 2;
            }
            $electrod6013 = 5 * 16;
        }
        if ($collectorAhaniId === '74') {
            if ($noeCoil === '4') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 5.48 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 5.48 * 2;
            }
            $electrod6013 = 7 * 16;
        }
        if ($collectorAhaniId === '75') {
            if ($noeCoil === '4') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 7.56 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 7.56 * 2;
            }
            $electrod6013 = 8 * 16;
        }
        if ($collectorAhaniId === '76') {
            if ($noeCoil === '4') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 11.18 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorAhani = (($ertefaFin + 150) / 1000) * 11.18 * 2;
            }
            $electrod6013 = 10 * 16;
        }

        if (is_null($collectorAhaniId) || $collectorAhaniId == '0') {
            $collectorAhani = 0;
            $electrod6013 = 0;
        }

        return [$collectorAhani, $electrod6013];
    }

    public function collectorMessi($collectorMessiId, $noeCoil, $ertefaFin)
    {
        if ($collectorMessiId === '77') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.196 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.196 * 2;
            }
        }
        if ($collectorMessiId === '78') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.268 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.268 * 2;
            }
        }
        if ($collectorMessiId === '79') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.339 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.339 * 2;
            }
        }
        if ($collectorMessiId === '80') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.54 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.54 * 2;
            }
        }
        if ($collectorMessiId === '81') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.975 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 0.975 * 2;
            }
        }
        if ($collectorMessiId === '82') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 1.410 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 1.410 * 2;
            }
        }
        if ($collectorMessiId === '83') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 1.685 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 1.685 * 2;
            }
        }
        if ($collectorMessiId === '84') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 2.360 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 2.360 * 2;
            }
        }
        if ($collectorMessiId === '85') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 3.616 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 3.616 * 2;
            }
        }
        if ($collectorMessiId === '86') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 4.95 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 4.95 * 2;
            }
        }
        if ($collectorMessiId === '87') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 6.9 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 6.9 * 2;
            }
        }
        if ($collectorMessiId === '88') {
            if ($noeCoil === '4') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 7.89 * 2 * 2;
            }
            if ($noeCoil === '2') {
                $collectorMessi = (($ertefaFin + 150) / 1000) * 7.89 * 2;
            }
        }

        if (is_null($collectorMessiId) || $collectorMessiId == '0') {
            $collectorMessi = 0;
        }

        return $collectorMessi;
    }


}
