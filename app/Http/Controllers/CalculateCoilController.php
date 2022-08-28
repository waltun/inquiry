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
            if ($index == 13) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 14) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 16 && !is_null($collectorMessi) && $collectorMessi > 0) {
                $childPart->pivot->parent_part_id = $collectorMessi;
            }
            if ($index == 17 && !is_null($collectorAhani) && $collectorAhani > 0) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 19) {
                $childPart->pivot->parent_part_id = $electrodNoghre;
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
}