<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Part;
use Illuminate\Http\Request;

class CalculateCoilController extends Controller
{
    public function evaperator(Part $part, Inquiry $inquiry)
    {
        return view('calculate.coil.evaperator', compact('part', 'inquiry'));
    }

    public function abi(Part $part, Inquiry $inquiry)
    {
        return view('calculate.coil.abi', compact('part', 'inquiry'));
    }

    public function condensor(Part $part, Inquiry $inquiry)
    {
        return view('calculate.coil.condensor', compact('part', 'inquiry'));
    }

    public function fancoil(Part $part, Inquiry $inquiry)
    {
        return view('calculate.coil.fancoil', compact('part', 'inquiry'));
    }

    public function storeEvaperator(Request $request, Part $part, Inquiry $inquiry)
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

        return redirect()->route('inquiries.index');
    }

    public function storeCondensor(Request $request, Part $part, Inquiry $inquiry)
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

        return redirect()->route('inquiries.index');
    }

    public function storeFancoil(Request $request, Part $part, Inquiry $inquiry)
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

        return redirect()->route('inquiries.index');
    }

    public function storeWater(Request $request, Part $part, Inquiry $inquiry)
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

        return redirect()->route('inquiries.index');
    }

    public function getData(Request $request)
    {
        $part = Part::find($request->id);
        return response(['data' => $part]);
    }
}
