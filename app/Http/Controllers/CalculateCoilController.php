<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CoilInput;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateCoilController extends Controller
{
    public function evaperator(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.coil.evaperator', compact('part', 'product', 'inquiry', 'categories'));
    }

    public function waterCold(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.coil.cold-water', compact('part', 'product', 'inquiry', 'categories'));
    }

    public function waterWarm(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.coil.warm-water', compact('part', 'product', 'inquiry', 'categories'));
    }

    public function condensor(Part $part, Product $product)
    {
        session()->reflash();

        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.coil.condensor', compact('part', 'product', 'inquiry', 'categories'));
    }

    public function fancoil(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.coil.fancoil', compact('part', 'product', 'inquiry', 'categories'));
    }

    public function storeEvaperator(Request $request, Part $part, Product $product)
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
            'inquiry_id' => $product->inquiry_id,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price'],
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

        $newPart->children()->syncWithoutDetaching($part->children);

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 14) {
                $childPart->pivot->parent_part_id = $request->parts[0];
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $request->parts[1];
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $request->parts[2];
            }
            if ($index == 17 && !is_null($request->parts[3]) && $request->parts[3] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[3];
            }
            if ($index == 18 && !is_null($request->parts[4]) && $request->parts[4] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[4];
            }
            if ($index == 19) {
                $childPart->pivot->parent_part_id = $request->parts[5];
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $request->parts[6];
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('coil-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        if ($inputs["loole_messi"]) {
            $inputs["loole_messi"] = Part::find($inputs["loole_messi"])->name_en;
        }
        if ($inputs["fin_coil"]) {
            $inputs["fin_coil"] = Part::find($inputs["fin_coil"])->name_en;
        }
        if ($inputs["zekhamat_frame_coil"]) {
            $inputs["zekhamat_frame_coil"] = Part::find($inputs["zekhamat_frame_coil"])->name_en;
        }
        if ($inputs["collector_ahani"]) {
            $inputs["collector_ahani"] = Part::find($inputs["collector_ahani"])->name_en;
        }
        if ($inputs["collector_messi"]) {
            $inputs["collector_messi"] = Part::find($inputs["collector_messi"])->name_en;
        }
        if ($inputs["electrod_noghre"]) {
            $inputs["electrod_noghre"] = Part::find($inputs["electrod_noghre"])->name_en;
        }

        if ($inputs["pooshesh_khordegi"] == '1') {
            $inputs["pooshesh_khordegi"] = 'Hersite';
        } else {
            $inputs["pooshesh_khordegi"] = '-';
        }

        $coilInput = CoilInput::create($inputs);
        $coilInput->type = 'Evaporator';
        $coilInput->part_id = $newPart->id;
        $coilInput->inquiry_id = $product->inquiry_id;
        $coilInput->save();

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeCondensor(Request $request, Part $part, Product $product)
    {
        session()->reflash();

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
            'inquiry_id' => $product->inquiry_id,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price'],
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

        $newPart->children()->syncWithoutDetaching($part->children);

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 14) {
                $childPart->pivot->parent_part_id = $request->parts[0];
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $request->parts[1];
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $request->parts[2];
            }
            if ($index == 17 && !is_null($request->parts[3]) && $request->parts[3] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[3];
            }
            if ($index == 18 && !is_null($request->parts[4]) && $request->parts[4] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[4];
            }
            if ($index == 19) {
                $childPart->pivot->parent_part_id = $request->parts[5];
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $request->parts[6];
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('coil-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        if ($inputs["loole_messi"]) {
            $inputs["loole_messi"] = Part::find($inputs["loole_messi"])->name_en;
        }
        if ($inputs["fin_coil"]) {
            $inputs["fin_coil"] = Part::find($inputs["fin_coil"])->name_en;
        }
        if ($inputs["zekhamat_frame_coil"]) {
            $inputs["zekhamat_frame_coil"] = Part::find($inputs["zekhamat_frame_coil"])->name_en;
        }
        if ($inputs["collector_ahani"]) {
            $inputs["collector_ahani"] = Part::find($inputs["collector_ahani"])->name_en;
        }
        if ($inputs["collector_messi"]) {
            $inputs["collector_messi"] = Part::find($inputs["collector_messi"])->name_en;
        }
        if ($inputs["electrod_noghre"]) {
            $inputs["electrod_noghre"] = Part::find($inputs["electrod_noghre"])->name_en;
        }

        if ($inputs["pooshesh_khordegi"] == '1') {
            $inputs["pooshesh_khordegi"] = 'Hersite';
        } else {
            $inputs["pooshesh_khordegi"] = '-';
        }

        $coilInput = CoilInput::create($inputs);
        $coilInput->type = 'Condensor';
        $coilInput->part_id = $newPart->id;
        $coilInput->inquiry_id = $product->inquiry_id;
        $coilInput->save();

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeFancoil(Request $request, Part $part, Product $product)
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
            'inquiry_id' => $product->inquiry_id,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price'],
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
            if ($index == 16 && !is_null($request->parts[3]) && $request->parts[3] > 0) {
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

        $request->session()->put('coil-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        if ($inputs["loole_messi"]) {
            $inputs["loole_messi"] = Part::find($inputs["loole_messi"])->name_en;
        }
        if ($inputs["fin_coil"]) {
            $inputs["fin_coil"] = Part::find($inputs["fin_coil"])->name_en;
        }
        if ($inputs["zekhamat_frame_coil"]) {
            $inputs["zekhamat_frame_coil"] = Part::find($inputs["zekhamat_frame_coil"])->name_en;
        }
        if ($inputs["collector_ahani"]) {
            $inputs["collector_ahani"] = Part::find($inputs["collector_ahani"])->name_en;
        }
        if ($inputs["collector_messi"]) {
            $inputs["collector_messi"] = Part::find($inputs["collector_messi"])->name_en;
        }
        if ($inputs["electrod_noghre"]) {
            $inputs["electrod_noghre"] = Part::find($inputs["electrod_noghre"])->name_en;
        }

        if ($inputs["pooshesh_khordegi"] == '1') {
            $inputs["pooshesh_khordegi"] = 'Hersite';
        } else {
            $inputs["pooshesh_khordegi"] = '-';
        }

        $coilInput = CoilInput::create($inputs);
        $coilInput->type = 'Fancoil';
        $coilInput->part_id = $newPart->id;
        $coilInput->inquiry_id = $product->inquiry_id;
        $coilInput->save();

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeWaterCold(Request $request, Part $part, Product $product)
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
            'inquiry_id' => $product->inquiry_id,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price'],
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

        $newPart->children()->syncWithoutDetaching($part->children);

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $request->parts[0];
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $request->parts[1];
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $request->parts[2];
            }
            if ($index == 18 && !is_null($request->parts[3]) && $request->parts[3] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[3];
            }
            if ($index == 19 && !is_null($request->parts[4]) && $request->parts[4] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[4];
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $request->parts[5];
            }
            if ($index == 21) {
                $childPart->pivot->parent_part_id = $request->parts[6];
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('coil-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        if ($inputs["loole_messi"]) {
            $inputs["loole_messi"] = Part::find($inputs["loole_messi"])->name_en;
        }
        if ($inputs["fin_coil"]) {
            $inputs["fin_coil"] = Part::find($inputs["fin_coil"])->name_en;
        }
        if ($inputs["zekhamat_frame_coil"]) {
            $inputs["zekhamat_frame_coil"] = Part::find($inputs["zekhamat_frame_coil"])->name_en;
        }
        if ($inputs["collector_ahani"]) {
            $inputs["collector_ahani"] = Part::find($inputs["collector_ahani"])->name_en;
        }
        if ($inputs["collector_messi"]) {
            $inputs["collector_messi"] = Part::find($inputs["collector_messi"])->name_en;
        }
        if ($inputs["electrod_noghre"]) {
            $inputs["electrod_noghre"] = Part::find($inputs["electrod_noghre"])->name_en;
        }

        if ($inputs["pooshesh_khordegi"] == '1') {
            $inputs["pooshesh_khordegi"] = 'Hersite';
        } else {
            $inputs["pooshesh_khordegi"] = '-';
        }

        $coilInput = CoilInput::create($inputs);
        $coilInput->type = 'Cold';
        $coilInput->part_id = $newPart->id;
        $coilInput->inquiry_id = $product->inquiry_id;
        $coilInput->save();

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeWaterWarm(Request $request, Part $part, Product $product)
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
            'inquiry_id' => $product->inquiry_id,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price'],
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

        $newPart->children()->syncWithoutDetaching($part->children);

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $request->parts[0];
            }
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $request->parts[1];
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $request->parts[2];
            }
            if ($index == 18 && !is_null($request->parts[3]) && $request->parts[3] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[3];
            }
            if ($index == 19 && !is_null($request->parts[4]) && $request->parts[4] > 0) {
                $childPart->pivot->parent_part_id = $request->parts[4];
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $request->parts[5];
            }
            if ($index == 21) {
                $childPart->pivot->parent_part_id = $request->parts[6];
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('coil-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        if ($inputs["loole_messi"]) {
            $inputs["loole_messi"] = Part::find($inputs["loole_messi"])->name_en;
        }
        if ($inputs["fin_coil"]) {
            $inputs["fin_coil"] = Part::find($inputs["fin_coil"])->name_en;
        }
        if ($inputs["zekhamat_frame_coil"]) {
            $inputs["zekhamat_frame_coil"] = Part::find($inputs["zekhamat_frame_coil"])->name_en;
        }
        if ($inputs["collector_ahani"]) {
            $inputs["collector_ahani"] = Part::find($inputs["collector_ahani"])->name_en;
        }
        if ($inputs["collector_messi"]) {
            $inputs["collector_messi"] = Part::find($inputs["collector_messi"])->name_en;
        }
        if ($inputs["electrod_noghre"]) {
            $inputs["electrod_noghre"] = Part::find($inputs["electrod_noghre"])->name_en;
        }

        if ($inputs["pooshesh_khordegi"] == '1') {
            $inputs["pooshesh_khordegi"] = 'Hersite';
        } else {
            $inputs["pooshesh_khordegi"] = '-';
        }

        $coilInput = CoilInput::create($inputs);
        $coilInput->type = 'Warm';
        $coilInput->part_id = $newPart->id;
        $coilInput->inquiry_id = $product->inquiry_id;
        $coilInput->save();

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

    public function calculateFancoilCoil(Request $request)
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

        //Loole Messi Name
        if ($looleMessiId == '58' || $looleMessiId == '59') {
            $looleMessiName = '58';
        }
        if ($looleMessiId == '53' || $looleMessiId == '54' || $looleMessiId == '55') {
            $looleMessiName = '38';
        }
        if ($looleMessiId == '56' || $looleMessiId == '57') {
            $looleMessiName = '12';
        }

        //Fin Al - Cu - Bg name
        if ($finCoilId == '60' || $finCoilId == '61' || $finCoilId == '62') {
            $finName = 'Al';
        }
        if ($finCoilId == '63' || $finCoilId == '64' || $finCoilId == '65') {
            $finName = 'BG';
        }
        if ($finCoilId == '66' || $finCoilId == '67' || $finCoilId == '68' || $finCoilId == '69') {
            $finName = 'Cu';
        }

        $name = 'FC-' . $looleMessiName . '-' . $tedadRadifCoil . 'R-' . $finDarInch . 'FPI-' . $tedadMogheyiatLoole . 'H-'
            . $tedadLooleDarRadif . 'T-' . $tooleCoil . 'FL-' . $tedadMadarLoole . 'C-' . $finName . '-' . number_format($satheCoil, 2) . 'SQFT';

        $inputs["sathe_coil"] = $satheCoil;

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'satheCoil' => $satheCoil,
            'name' => $name]);
    }

    public function calculateWarmCoil(Request $request)
    {
        $inputs = $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'tedad_radif_coil' => 'required',
            'fin_dar_inch' => 'required',
            'kham' => 'required',
            'zekhamat_frame_coil' => 'required',
            'pooshesh_khordegi' => 'required',
            'electrod_noghre' => 'required',
            'toole_coil' => 'required',
            'tedad_loole_dar_radif' => 'required',
            'tedad_mogheyiat_loole' => 'required',
            'tedad_madar_loole' => 'required',
            'collector_messi' => 'nullable',
            'collector_ahani' => 'nullable',
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
        $kham = $request['kham'];
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
            '15' => $varaghGalvanizePart,
            '16' => $looleMessiPart,
            '17' => $finPart,
            '18' => $collectorMessiPart,
            '19' => $collectorAhaniPart,
            '20' => $uMessiPart,
            '21' => $electrodNoghrePart,
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
            $sabetVaznVaragh = 130;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.5 * $tooleCoil) / 144;
            $electrodNoghre = $tedadRadifCoil * $tedadLooleDarRadif * 2 * 2.8;
            $azot = $tedadRadifCoil * $satheCoil * 0.23;
            $electrodBerenj = ($tedadMadarLoole * 2) * 11;
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
            $sabetVaznVaragh = 110;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 0.984 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2;
            $azot = $tedadRadifCoil * $satheCoil * 0.15;
            $electrodBerenj = ($tedadMadarLoole * 2) * 7.6;
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
            $sabetVaznVaragh = 120;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.25 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2.6;
            $azot = $tedadRadifCoil * $satheCoil * 0.2;
            $electrodBerenj = ($tedadMadarLoole * 2) * 10;
        }

        //Fin Al & Golden
        $vaznFinAl = $this->calculateFinAl($finCoilId, $ertefaFin, $gamDarRadif, $tedadRadifCoil, $zekhamatFin, $tedadFinMasrafi);

        //Masahat tube sheet
        $masahatTubSheet = (2 * (($ertefaFin + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatFrame = (2 * ((($tooleCoil * 25.4) + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatVaraghMasrafi = $masahatTubSheet + $masahatFrame;

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
        list ($collectorAhani, $electrod6013) = $this->collectorAhaniWarm($collectorAhaniId, $ertefaFin);

        //Collector Messi
        $collectorMessi = $this->collectorMessiWarm($collectorMessiId, $ertefaFin);

        $values = [
            0,
            $abeMasrafi,
            0.2,
            $kham,
            $poosheshKhordegiResult,
            $tiner,
            $flaksMaye,
            $azot,
            $oxygenMasrafi,
            $electrodBerenj,
            0,
            12,
            $roghaneTabkhirShavande,
            1,
            1,
            $zekhamatFrame,
            $looleMessi,
            $vaznFinAl,
            $collectorMessi,
            $collectorAhani,
            $tedadU,
            $electrodNoghre,
            $electrod6013,
        ];

        //Loole Messi Name
        if ($looleMessiId == '58' || $looleMessiId == '59') {
            $looleMessiName = '58';
        }
        if ($looleMessiId == '53' || $looleMessiId == '54' || $looleMessiId == '55') {
            $looleMessiName = '38';
        }
        if ($looleMessiId == '56' || $looleMessiId == '57') {
            $looleMessiName = '12';
        }

        //Fin Al - Cu - Bg name
        if ($finCoilId == '60' || $finCoilId == '61' || $finCoilId == '62') {
            $finName = 'Al';
        }
        if ($finCoilId == '63' || $finCoilId == '64' || $finCoilId == '65') {
            $finName = 'BG';
        }
        if ($finCoilId == '66' || $finCoilId == '67' || $finCoilId == '68' || $finCoilId == '69') {
            $finName = 'Cu';
        }

        $name = 'HW-' . $looleMessiName . '-' . $tedadRadifCoil . 'R-' . $finDarInch . 'FPI-' . $tedadMogheyiatLoole . 'H-'
            . $tedadLooleDarRadif . 'T-' . $tooleCoil . 'FL-' . $tedadMadarLoole . 'C-' . $finName . '-' . number_format($satheCoil, 2) . 'SQFT';

        if (!array_key_exists('collector_messi', $inputs)) {
            $inputs['collector_messi'] = 0;
        }

        if (!array_key_exists('collector_ahani', $inputs)) {
            $inputs['collector_ahani'] = 0;
        }

        $inputs["sathe_coil"] = $satheCoil;

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'satheCoil' => $satheCoil,
            'name' => $name]);
    }

    public function calculateColdCoil(Request $request)
    {
        $inputs = $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'tedad_radif_coil' => 'required',
            'fin_dar_inch' => 'required',
            'kham' => 'required',
            'zekhamat_frame_coil' => 'required',
            'pooshesh_khordegi' => 'required',
            'electrod_noghre' => 'required',
            'toole_coil' => 'required',
            'tedad_loole_dar_radif' => 'required',
            'tedad_mogheyiat_loole' => 'required',
            'tedad_madar_loole' => 'required',
            'collector_messi' => 'nullable',
            'collector_ahani' => 'nullable',
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
        $kham = $request['kham'];
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
            '15' => $varaghGalvanizePart,
            '16' => $looleMessiPart,
            '17' => $finPart,
            '18' => $collectorMessiPart,
            '19' => $collectorAhaniPart,
            '20' => $uMessiPart,
            '21' => $electrodNoghrePart,
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
            $sabetVaznVaragh = 130;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.5 * $tooleCoil) / 144;
            $electrodNoghre = $tedadRadifCoil * $tedadLooleDarRadif * 2 * 2.8;
            $azot = $tedadRadifCoil * $satheCoil * 0.23;
            $electrodBerenj = ($tedadMadarLoole * 2) * 11;
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
            $sabetVaznVaragh = 110;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 0.984 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2;
            $azot = $tedadRadifCoil * $satheCoil * 0.15;
            $electrodBerenj = ($tedadMadarLoole * 2) * 7.6;
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
            $sabetVaznVaragh = 120;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.25 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2.6;
            $azot = $tedadRadifCoil * $satheCoil * 0.2;
            $electrodBerenj = ($tedadMadarLoole * 2) * 10;
        }

        //Fin Al & Golden
        $vaznFinAl = $this->calculateFinAl($finCoilId, $ertefaFin, $gamDarRadif, $tedadRadifCoil, $zekhamatFin, $tedadFinMasrafi);

        //Masahat tube sheet
        $masahatTubSheet = (2 * (($ertefaFin + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatFrame = (2 * ((($tooleCoil * 25.4) + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatVaraghMasrafi = $masahatTubSheet + $masahatFrame;

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
        list ($collectorAhani, $electrod6013) = $this->collectorAhaniWarm($collectorAhaniId, $ertefaFin);

        //Collector Messi
        $collectorMessi = $this->collectorMessiWarm($collectorMessiId, $ertefaFin);

        $values = [
            0,
            $abeMasrafi,
            0.2,
            $kham,
            $poosheshKhordegiResult,
            $tiner,
            $flaksMaye,
            $azot,
            $oxygenMasrafi,
            $electrodBerenj,
            0,
            12,
            $roghaneTabkhirShavande,
            1,
            1,
            $zekhamatFrame,
            $looleMessi,
            $vaznFinAl,
            $collectorMessi,
            $collectorAhani,
            $tedadU,
            $electrodNoghre,
            $electrod6013,
        ];

        //Loole Messi Name
        if ($looleMessiId == '58' || $looleMessiId == '59') {
            $looleMessiName = '58';
        }
        if ($looleMessiId == '53' || $looleMessiId == '54' || $looleMessiId == '55') {
            $looleMessiName = '38';
        }
        if ($looleMessiId == '56' || $looleMessiId == '57') {
            $looleMessiName = '12';
        }

        //Fin Al - Cu - Bg name
        if ($finCoilId == '60' || $finCoilId == '61' || $finCoilId == '62') {
            $finName = 'Al';
        }
        if ($finCoilId == '63' || $finCoilId == '64' || $finCoilId == '65') {
            $finName = 'BG';
        }
        if ($finCoilId == '66' || $finCoilId == '67' || $finCoilId == '68' || $finCoilId == '69') {
            $finName = 'Cu';
        }

        $name = 'CW-' . $looleMessiName . '-' . $tedadRadifCoil . 'R-' . $finDarInch . 'FPI-' . $tedadMogheyiatLoole . 'H-'
            . $tedadLooleDarRadif . 'T-' . $tooleCoil . 'FL-' . $tedadMadarLoole . 'C-' . $finName . '-' . number_format($satheCoil, 2) . 'SQFT';

        if (!array_key_exists('collector_messi', $inputs)) {
            $inputs['collector_messi'] = 0;
        }

        if (!array_key_exists('collector_ahani', $inputs)) {
            $inputs['collector_ahani'] = 0;
        }

        $inputs["sathe_coil"] = $satheCoil;

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'satheCoil' => $satheCoil,
            'name' => $name]);
    }

    public function calculateCondensorCoil(Request $request)
    {
        session()->reflash();

        $inputs = $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'tedad_radif_coil' => 'required',
            'fin_dar_inch' => 'required',
            'kham' => 'required',
            'zekhamat_frame_coil' => 'required',
            'pooshesh_khordegi' => 'required',
            'electrod_noghre' => 'required',
            'toole_coil' => 'required',
            'tedad_loole_dar_radif' => 'required',
            'tedad_mogheyiat_loole' => 'required',
            'tedad_madar_loole' => 'required',
            'collector_messi' => 'required',
            'collector_ahani' => 'required',
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
        $kham = $request['kham'];
        $poosheshKhordegi = $request['pooshesh_khordegi'];
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
            '14' => $varaghGalvanizePart,
            '15' => $looleMessiPart,
            '16' => $finPart,
            '17' => $collectorMessiPart,
            '18' => $collectorAhaniPart,
            '19' => $uMessiPart,
            '20' => $electrodNoghrePart,
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
            $sabetVaznVaragh = 130;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.5 * $tooleCoil) / 144;
            $electrodNoghre = $tedadRadifCoil * $tedadLooleDarRadif * 2 * 2.8;
            $azot = $tedadRadifCoil * $satheCoil * 0.23;
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
            $sabetVaznVaragh = 110;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 0.984 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2;
            $azot = $tedadRadifCoil * $satheCoil * 0.15;
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
            $sabetVaznVaragh = 120;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.25 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2.6;
            $azot = $tedadRadifCoil * $satheCoil * 0.2;
        }

        //Fin Al & Golden
        $vaznFinAl = $this->calculateFinAl($finCoilId, $ertefaFin, $gamDarRadif, $tedadRadifCoil, $zekhamatFin, $tedadFinMasrafi);

        //Masahat tube sheet
        $masahatTubSheet = (2 * (($ertefaFin + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatFrame = (2 * ((($tooleCoil * 25.4) + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatVaraghMasrafi = $masahatTubSheet + $masahatFrame;

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
        $collectorAhani = $this->collectorAhaniCondensor($collectorAhaniId, $ertefaFin);

        //Collector Messi
        $collectorMessi = $this->collectorMessiCondensor($collectorMessiId, $ertefaFin);

        $values = [
            0,
            $abeMasrafi,
            0.2,
            $kham,
            $poosheshKhordegiResult,
            $tiner,
            $flaksMaye,
            $azot,
            $oxygenMasrafi,
            0,
            2,
            12,
            0,
            $roghaneTabkhirShavande,
            $zekhamatFrame,
            $looleMessi,
            $vaznFinAl,
            $collectorMessi,
            $collectorAhani,
            $tedadU,
            $electrodNoghre,
        ];

        //Loole Messi Name
        if ($looleMessiId == '58' || $looleMessiId == '59') {
            $looleMessiName = '58';
        }
        if ($looleMessiId == '53' || $looleMessiId == '54' || $looleMessiId == '55') {
            $looleMessiName = '38';
        }
        if ($looleMessiId == '56' || $looleMessiId == '57') {
            $looleMessiName = '12';
        }

        //Fin Al - Cu - Bg name
        if ($finCoilId == '60' || $finCoilId == '61' || $finCoilId == '62') {
            $finName = 'Al';
        }
        if ($finCoilId == '63' || $finCoilId == '64' || $finCoilId == '65') {
            $finName = 'BG';
        }
        if ($finCoilId == '66' || $finCoilId == '67' || $finCoilId == '68' || $finCoilId == '69') {
            $finName = 'Cu';
        }

        $inputs["sathe_coil"] = $satheCoil;

        $name = 'CO-' . $looleMessiName . '-' . $tedadRadifCoil . 'R-' . $finDarInch . 'FPI-' . $tedadMogheyiatLoole . 'H-'
            . $tedadLooleDarRadif . 'T-' . $tooleCoil . 'FL-' . $tedadMadarLoole . 'C-' . $finName . '-' . number_format($satheCoil, 2) . 'SQFT';

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'satheCoil' => $satheCoil, 'name' => $name]);
    }

    public function calculateEvaperatorCoil(Request $request)
    {
        $inputs = $request->validate([
            'loole_messi' => 'required',
            'fin_coil' => 'required',
            'tedad_radif_coil' => 'required',
            'fin_dar_inch' => 'required',
            'kham' => 'required',
            'tedad_madar_coil' => 'required',
            'zekhamat_frame_coil' => 'required',
            'pooshesh_khordegi' => 'required',
            'electrod_noghre' => 'required',
            'toole_coil' => 'required',
            'tedad_loole_dar_radif' => 'required',
            'tedad_mogheyiat_loole' => 'required',
            'tedad_madar_loole' => 'required',
            'collector_messi' => 'required',
            'collector_ahani' => 'required',
            'tedad_soorakh_pakhshkon' => 'required'
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
        $kham = $request['kham'];
        $poosheshKhordegi = $request['pooshesh_khordegi'];
        $tooleCoil = $request['toole_coil'];
        $tedadLooleDarRadif = $request['tedad_loole_dar_radif'];
        $tedadMogheyiatLoole = $request['tedad_mogheyiat_loole'];
        $tedadMadarLoole = $request['tedad_madar_loole'];
        $tedadMadarCoil = $request['tedad_madar_coil'];
        $soorakhPakhshKon = $request['tedad_soorakh_pakhshkon'];

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
            '14' => $varaghGalvanizePart,
            '15' => $looleMessiPart,
            '16' => $finPart,
            '17' => $collectorMessiPart,
            '18' => $collectorAhaniPart,
            '19' => $uMessiPart,
            '20' => $electrodNoghrePart,
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
            $sabetVaznVaragh = 130;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.5 * $tooleCoil) / 144;
            $electrodNoghre = $tedadRadifCoil * $tedadLooleDarRadif * 2 * 2.8;
            $azot = $tedadRadifCoil * $satheCoil * 0.23;
            if ($collectorAhaniId > 0 && !is_null($collectorAhaniId)) {
                $electrodBerenj = $tedadMadarLoole * 4.5;
            } else {
                $electrodBerenj = 0;
            }
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
            $sabetVaznVaragh = 110;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 0.984 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2;
            $azot = $tedadRadifCoil * $satheCoil * 0.15;
            if ($collectorAhaniId > 0 && !is_null($collectorAhaniId)) {
                $electrodBerenj = $tedadMadarLoole * 3;
            } else {
                $electrodBerenj = 0;
            }
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
            $sabetVaznVaragh = 120;
            $ertefaFin = $tedadMogheyiatLoole * $gamDarErtefa;
            $satheCoil = ($tedadMogheyiatLoole * 1.25 * $tooleCoil) / 144;
            $electrodNoghre = $tedadU * 2.6;
            $azot = $tedadRadifCoil * $satheCoil * 0.2;
            if ($collectorAhaniId > 0 && !is_null($collectorAhaniId)) {
                $electrodBerenj = $tedadMadarLoole * 4;
            } else {
                $electrodBerenj = 0;
            }
        }

        //Fin Al & Golden
        $vaznFinAl = $this->calculateFinAl($finCoilId, $ertefaFin, $gamDarRadif, $tedadRadifCoil, $zekhamatFin, $tedadFinMasrafi);

        //Masahat tube sheet
        $masahatTubSheet = (2 * (($ertefaFin + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatFrame = (2 * ((($tooleCoil * 25.4) + 70) * ($sabetVaznVaragh + ($gamDarRadif * $tedadRadifCoil)))) / 1000000;
        $masahatVaraghMasrafi = $masahatTubSheet + $masahatFrame;

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

        //Loole Messi 316
        $looleMessi316 = $soorakhPakhshKon * 0.0365;

        //Roghane tabkhir shavande
        $roghaneTabkhirShavande = $tedadRadifCoil * $satheCoil * 0.015;

        //Collector Ahani
        $collectorAhani = $this->collectorAhaniEvaperator($collectorAhaniId, $ertefaFin, $tedadMadarCoil);

        //Collector Messi
        $collectorMessi = $this->collectorMessiEvaperator($collectorMessiId, $ertefaFin, $tedadMadarCoil);

        $values = [
            $looleMessi316,
            $abeMasrafi,
            0.2,
            $kham,
            $poosheshKhordegiResult,
            $tiner,
            $flaksMaye,
            $azot,
            $oxygenMasrafi,
            $electrodBerenj,
            2,
            12,
            $soorakhPakhshKon,
            $roghaneTabkhirShavande,
            $zekhamatFrame,
            $looleMessi,
            $vaznFinAl,
            $collectorMessi,
            $collectorAhani,
            $tedadU,
            $electrodNoghre,
            0
        ];

        //Loole Messi Name
        if ($looleMessiId == '58' || $looleMessiId == '59') {
            $looleMessiName = '58';
        }
        if ($looleMessiId == '53' || $looleMessiId == '54' || $looleMessiId == '55') {
            $looleMessiName = '38';
        }
        if ($looleMessiId == '56' || $looleMessiId == '57') {
            $looleMessiName = '12';
        }

        //Fin Al - Cu - Bg name
        if ($finCoilId == '60' || $finCoilId == '61' || $finCoilId == '62') {
            $finName = 'Al';
        }
        if ($finCoilId == '63' || $finCoilId == '64' || $finCoilId == '65') {
            $finName = 'BG';
        }
        if ($finCoilId == '66' || $finCoilId == '67' || $finCoilId == '68' || $finCoilId == '69') {
            $finName = 'Cu';
        }

        $name = 'DX-' . $looleMessiName . '-' . $tedadRadifCoil . 'R-' . $finDarInch . 'FPI-' . $tedadMogheyiatLoole . 'H-'
            . $tedadLooleDarRadif . 'T-' . $tooleCoil . 'FL-' . $tedadMadarLoole . 'C-' . $finName . '-' . number_format($satheCoil, 2) . 'SQFT';

        $inputs["sathe_coil"] = $satheCoil;

        return back()->with(['values' => $values, 'selectedParts' => $selectedParts, 'inputs' => $inputs, 'satheCoil' => $satheCoil, 'name' => $name]);
    }

    public function calculateZekhamatFrame($zekhamatFrameId, $masahatVaraghMasrafi)
    {
        if ($zekhamatFrameId === '5' || $zekhamatFrameId === '660' || $zekhamatFrameId === '667') {
            $zekhamatFrame = $masahatVaraghMasrafi * 7.874;
        }
        if ($zekhamatFrameId === '7' || $zekhamatFrameId === '661' || $zekhamatFrameId === '668') {
            $zekhamatFrame = $masahatVaraghMasrafi * 1.25 * 7.874;
        }
        if ($zekhamatFrameId === '8' || $zekhamatFrameId === '662' || $zekhamatFrameId === '669') {
            $zekhamatFrame = $masahatVaraghMasrafi * 1.5 * 7.874;
        }
        if ($zekhamatFrameId === '9' || $zekhamatFrameId === '663' || $zekhamatFrameId === '670') {
            $zekhamatFrame = $masahatVaraghMasrafi * 2 * 7.874;
        }
        if ($zekhamatFrameId === '10' || $zekhamatFrameId === '664' || $zekhamatFrameId === '671') {
            $zekhamatFrame = $masahatVaraghMasrafi * 2.5 * 7.874;
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

    public function collectorAhaniWarm($collectorAhaniId, $ertefaFin)
    {
        if ($collectorAhaniId === '70') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 1.94 * 2;
            $electrod6013 = 2 * 16;
        }
        if ($collectorAhaniId === '71') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 2.48 * 2;
            $electrod6013 = 3 * 16;
        }
        if ($collectorAhaniId === '72') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 2.81 * 2;
            $electrod6013 = 4 * 16;
        }
        if ($collectorAhaniId === '73') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 4.32 * 2;
            $electrod6013 = 5 * 16;
        }
        if ($collectorAhaniId === '74') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 5.48 * 2;
            $electrod6013 = 7 * 16;
        }
        if ($collectorAhaniId === '75') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 7.56 * 2;
            $electrod6013 = 8 * 16;
        }
        if ($collectorAhaniId === '76') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 11.18 * 2;
            $electrod6013 = 10 * 16;
        }

        if (is_null($collectorAhaniId) || $collectorAhaniId == '0') {
            $collectorAhani = 0;
            $electrod6013 = 0;
        }

        return [$collectorAhani, $electrod6013];
    }

    public function collectorMessiWarm($collectorMessiId, $ertefaFin)
    {
        if ($collectorMessiId === '77') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.196 * 2;
        }
        if ($collectorMessiId === '78') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.268 * 2;
        }
        if ($collectorMessiId === '79') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.339 * 2;
        }
        if ($collectorMessiId === '80') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.54 * 2;
        }
        if ($collectorMessiId === '81') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.975 * 2;
        }
        if ($collectorMessiId === '82') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 1.410 * 2;
        }
        if ($collectorMessiId === '83') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 1.685 * 2;
        }
        if ($collectorMessiId === '84') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 2.360 * 2;
        }
        if ($collectorMessiId === '85') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 3.616 * 2;
        }
        if ($collectorMessiId === '86') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 4.95 * 2;
        }
        if ($collectorMessiId === '87') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 6.9 * 2;
        }
        if ($collectorMessiId === '88') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 7.89 * 2;
        }

        if (is_null($collectorMessiId) || $collectorMessiId == '0') {
            $collectorMessi = 0;
        }

        return $collectorMessi;
    }

    public function collectorMessiCondensor($collectorMessiId, $ertefaFin)
    {
        if ($collectorMessiId === '77') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.196;
        }
        if ($collectorMessiId === '78') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.268;
        }
        if ($collectorMessiId === '79') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.339;
        }
        if ($collectorMessiId === '80') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.54;
        }
        if ($collectorMessiId === '81') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 0.975;
        }
        if ($collectorMessiId === '82') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 1.410;
        }
        if ($collectorMessiId === '83') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 1.685;
        }
        if ($collectorMessiId === '84') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 2.360;
        }
        if ($collectorMessiId === '85') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 3.616;
        }
        if ($collectorMessiId === '86') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 4.95;
        }
        if ($collectorMessiId === '87') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 6.9;
        }
        if ($collectorMessiId === '88') {
            $collectorMessi = (($ertefaFin + 150) / 1000) * 7.89;
        }

        if (is_null($collectorMessiId) || $collectorMessiId == '0') {
            $collectorMessi = 0;
        }

        return $collectorMessi;
    }

    public function collectorAhaniCondensor($collectorAhaniId, $ertefaFin)
    {
        if ($collectorAhaniId === '77') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 0.196;
        }
        if ($collectorAhaniId === '78') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 0.268;
        }
        if ($collectorAhaniId === '79') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 0.339;
        }
        if ($collectorAhaniId === '80') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 0.54;
        }
        if ($collectorAhaniId === '81') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 0.975;
        }
        if ($collectorAhaniId === '82') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 1.410;
        }
        if ($collectorAhaniId === '83') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 1.685;
        }
        if ($collectorAhaniId === '84') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 2.360;
        }
        if ($collectorAhaniId === '85') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 3.616;
        }
        if ($collectorAhaniId === '86') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 4.95;
        }
        if ($collectorAhaniId === '87') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 6.9;
        }
        if ($collectorAhaniId === '88') {
            $collectorAhani = (($ertefaFin + 150) / 1000) * 7.89;
        }

        if (is_null($collectorAhaniId) || $collectorAhaniId == '0') {
            $collectorAhani = 0;
        }

        return $collectorAhani;
    }

    public function collectorAhaniEvaperator($collectorAhaniId, $ertefaFin, $tedadMadarCoil)
    {
        if ($collectorAhaniId === '70') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 1.94 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 1.94 / 2;
            }
        }
        if ($collectorAhaniId === '71') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 2.48 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 2.48 / 2;
            }
        }
        if ($collectorAhaniId === '72') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 2.81 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 2.84 / 2;
            }
        }
        if ($collectorAhaniId === '73') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 4.32 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 4.32 / 2;
            }
        }
        if ($collectorAhaniId === '74') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 5.48 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 5.48 / 2;
            }
        }
        if ($collectorAhaniId === '75') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 7.56 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 7.56 / 2;
            }
        }
        if ($collectorAhaniId === '76') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 11.18 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorAhani = (($ertefaFin + 250) / 1000) * 11.18 / 2;
            }
        }

        if (is_null($collectorAhaniId) || $collectorAhaniId == '0') {
            $collectorAhani = 0;
        }

        return $collectorAhani;
    }

    public function collectorMessiEvaperator($collectorMessiId, $ertefaFin, $tedadMadarCoil)
    {
        if ($collectorMessiId == '77') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.196 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.196 / 2;
            }
        }
        if ($collectorMessiId == '78') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.268 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.268 / 2;
            }
        }
        if ($collectorMessiId == '79') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.339 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.339 / 2;
            }
        }
        if ($collectorMessiId == '80') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.54 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.54 / 2;
            }
        }
        if ($collectorMessiId == '81') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.975 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 0.975 / 2;
            }
        }
        if ($collectorMessiId == '82') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 1.410 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 1.410 / 2;
            }
        }
        if ($collectorMessiId == '83') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 1.685 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 1.685 / 2;
            }
        }
        if ($collectorMessiId == '84') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 2.360 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 2.360 / 2;
            }
        }
        if ($collectorMessiId == '85') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 3.616 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 3.616 / 2;
            }
        }
        if ($collectorMessiId == '86') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 4.95 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 4.95 / 2;
            }
        }
        if ($collectorMessiId == '87') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 6.9 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 6.9 / 2;
            }
        }
        if ($collectorMessiId == '88') {
            if ($tedadMadarCoil == 1 || $tedadMadarCoil == 2 || $tedadMadarCoil == 3) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 7.89 * $tedadMadarCoil;
            }
            if ($tedadMadarCoil == 4 || $tedadMadarCoil == 6 || $tedadMadarCoil == 8) {
                $collectorMessi = (($ertefaFin + 250) / 1000) * 7.89 / 2;
            }
        }

        if (is_null($collectorMessiId) || $collectorMessiId == '0') {
            $collectorMessi = 0;
        }

        return $collectorMessi;
    }
}
