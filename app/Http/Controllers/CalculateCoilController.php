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

    public function abi(Part $part, Product $product)
    {
        return view('calculate.coil.abi', compact('part', 'product'));
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

        $name = $request['name'];

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => random_int(1111, 9999),
        ]);

        $newPart->save();

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 18) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 2) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 19) {
                $childPart->pivot->parent_part_id = $collectorMessi;
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

        $name = $request['name'];

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => random_int(1111, 9999),
        ]);

        $newPart->save();

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 18) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 2) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 19) {
                $childPart->pivot->parent_part_id = $collectorMessi;
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
        $collectorBerenji = $request['collector_berenji'];

        $name = $request['name'];

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => random_int(1111, 9999),
        ]);

        $newPart->save();

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 16) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 15) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 2) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 18) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $collectorMessi;
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $collectorBerenji;
            }

            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function storeWater(Request $request, Part $part, Product $product)
    {

        $looleMessi = $request['loole_messi'];
        $fin = $request['fin_coil'];
        $zekhamat_frame = $request['zekhamat_frame_coil'];
        $collectorAhani = $request['collector_ahani'];
        $collectorMessi = $request['collector_messi'];

        $name = $request['name'];

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => random_int(1111, 9999),
        ]);

        $newPart->save();

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            if ($index == 18) {
                $childPart->pivot->parent_part_id = $looleMessi;
            }
            if ($index == 17) {
                $childPart->pivot->parent_part_id = $fin;
            }
            if ($index == 2) {
                $childPart->pivot->parent_part_id = $zekhamat_frame;
            }
            if ($index == 20) {
                $childPart->pivot->parent_part_id = $collectorAhani;
            }
            if ($index == 19) {
                $childPart->pivot->parent_part_id = $collectorMessi;
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
}
