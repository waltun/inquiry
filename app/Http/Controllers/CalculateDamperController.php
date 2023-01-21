<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateDamperController extends Controller
{
    public function taze(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.damper.taze', compact('part', 'product', 'inquiry'));
    }

    public function raft(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.damper.raft', compact('part', 'product', 'inquiry'));
    }

    public function bargasht(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.damper.bargasht', compact('part', 'product', 'inquiry'));
    }

    public function exast(Part $part, Product $product)
    {
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.damper.exast', compact('part', 'product', 'inquiry'));
    }

    public function store(Request $request, Part $part, Product $product)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'inquiry_id' => $product->inquiry_id,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['final_price'],
            'weight' => $request['weight']
        ]);

        $newPart->save();
        $newPart->categories()->syncWithoutDetaching($part->categories);
        $newPart->children()->syncWithoutDetaching($part->children);

        foreach ($newPart->children as $index => $childPart) {
            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('damper-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه دمپر با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function calculateTaze(Request $request)
    {
        $inputs = $request->validate([
            'debi_hava_taze' => 'required',
            'sorat_hava' => 'required',
            'tedad_pare' => 'required',
        ]);

        //Inputs
        $debiHavaTaze = $request['debi_hava_taze'];
        $soratHava = $request['sorat_hava'];
        $tedadPare = $request['tedad_pare'];

        //Tolle Pare
        $toolePare = ((($debiHavaTaze / $soratHava) / 10.7639) / $tedadPare) * 1000;
        $toolePare = round($toolePare);
        $ertefaDamper = ($tedadPare * 10) + 1;

        //Profile Pare
        $profilePare = (($tedadPare * $toolePare) / 100);

        //Profile Sotoon
        $profileSotoon = (2 * (($tedadPare * 10) + 1)) / 100;

        //Profile Bala Payin
        if ($toolePare <= 120) {
            $profileBalaPayin = ((($toolePare + 6) * 2) / 100);
        } else {
            $profileBalaPayin = ((($toolePare + 9) * 2) / 100);
        }

        //Profile Sotoon Vasat
        if ($toolePare <= 120) {
            $profileSotoonVasat = 0;
        } else {
            $profileSotoonVasat = ((($tedadPare * 10) + 1) / 100);
        }

        //Charkh Dande
        if ($toolePare <= 120) {
            $charkhDande = $tedadPare;
        } else {
            $charkhDande = $tedadPare * 2;
        }

        //Keshoyi Rast & Chap
        $keshoyiRast = $charkhDande;
        $keshoyiChap = $charkhDande;

        //Dastgire Damper
        if ($toolePare <= 120) {
            $dastgireDamper = 1;
        } else {
            $dastgireDamper = 2;
        }

        //PVC Chap & Rast
        $pvcChap = $charkhDande;
        $pvcRast = $charkhDande;

        //Pin 4 Pahloo
        $pin4Pahloo = $charkhDande * 2;

        //Gerdi Damper
        $gerdi = $charkhDande;

        //Navar Havabandi
        $navarHavaBandi = $profilePare + $profileBalaPayin;

        $values = [
            $profilePare,
            $profileSotoon,
            $profileBalaPayin,
            $profileSotoonVasat,
            $charkhDande,
            $dastgireDamper,
            $keshoyiChap,
            $keshoyiRast,
            $pvcChap,
            $pvcRast,
            $navarHavaBandi,
            $gerdi,
            $pin4Pahloo,
        ];

        $name = "-FD-OPB-" . $tedadPare . "BL-" . number_format($toolePare, 2) . "L";

        return back()->with(['values' => $values, 'name' => $name, 'inputs' => $inputs, 'toolePare' => $toolePare, 'ertefa' => $ertefaDamper
            , 'sotoonVasat' => $profileSotoonVasat]);
    }

    public function calculateExast(Request $request)
    {
        $inputs = $request->validate([
            'debi_hava_exast' => 'required',
            'sorat_hava' => 'required',
            'tedad_pare' => 'required',
        ]);

        //Inputs
        $debiHavaExast = $request['debi_hava_exast'];
        $soratHava = $request['sorat_hava'];
        $tedadPare = $request['tedad_pare'];

        //Tolle Pare
        $toolePare = ((($debiHavaExast / $soratHava) / 10.7639) / $tedadPare) * 1000;
        $toolePare = round($toolePare);
        $ertefaDamper = ($tedadPare * 10) + 1;

        //Profile Pare
        $profilePare = (($tedadPare * $toolePare) / 100);

        //Profile Sotoon
        $profileSotoon = (2 * (($tedadPare * 10) + 1)) / 100;

        //Profile Bala Payin
        if ($toolePare <= 120) {
            $profileBalaPayin = ((($toolePare + 6) * 2) / 100);
        } else {
            $profileBalaPayin = ((($toolePare + 9) * 2) / 100);
        }

        //Profile Sotoon Vasat
        if ($toolePare <= 120) {
            $profileSotoonVasat = 0;
        } else {
            $profileSotoonVasat = ((($tedadPare * 10) + 1) / 100);
        }

        //Charkh Dande
        if ($toolePare <= 120) {
            $charkhDande = $tedadPare;
        } else {
            $charkhDande = $tedadPare * 2;
        }

        //Keshoyi Rast & Chap
        $keshoyiRast = $charkhDande;
        $keshoyiChap = $charkhDande;

        //Dastgire Damper
        if ($toolePare <= 120) {
            $dastgireDamper = 1;
        } else {
            $dastgireDamper = 2;
        }

        //PVC Chap & Rast
        $pvcChap = $charkhDande;
        $pvcRast = $charkhDande;

        //Pin 4 Pahloo
        $pin4Pahloo = $charkhDande * 2;

        //Gerdi Damper
        $gerdi = $charkhDande;

        //Navar Havabandi
        $navarHavaBandi = $profilePare + $profileBalaPayin;

        $values = [
            $profilePare,
            $profileSotoon,
            $profileBalaPayin,
            $profileSotoonVasat,
            $charkhDande,
            $dastgireDamper,
            $keshoyiChap,
            $keshoyiRast,
            $pvcChap,
            $pvcRast,
            $navarHavaBandi,
            $gerdi,
            $pin4Pahloo,
        ];

        $name = "ED-OPB-" . $tedadPare . "BL-" . number_format($toolePare, 2) . "L";

        return back()->with(['values' => $values, 'name' => $name, 'inputs' => $inputs, 'toolePare' => $toolePare, 'ertefa' => $ertefaDamper
            , 'sotoonVasat' => $profileSotoonVasat]);
    }

    public function calculateRaft(Request $request)
    {
        $inputs = $request->validate([
            'debi_hava_raft' => 'required',
            'sorat_hava' => 'required',
            'tedad_pare' => 'required',
        ]);

        //Inputs
        $debiHavaRaft = $request['debi_hava_raft'];
        $soratHava = $request['sorat_hava'];
        $tedadPare = $request['tedad_pare'];

        //Tolle Pare
        $toolePare = ((($debiHavaRaft / $soratHava) / 10.7639) / $tedadPare) * 1000;
        $toolePare = round($toolePare);
        $ertefaDamper = ($tedadPare * 10) + 1;

        //Profile Pare
        $profilePare = (($tedadPare * $toolePare) / 100);

        //Profile Sotoon
        $profileSotoon = (2 * (($tedadPare * 10) + 1)) / 100;

        //Profile Bala Payin
        if ($toolePare <= 120) {
            $profileBalaPayin = ((($toolePare + 6) * 2) / 100);
        } else {
            $profileBalaPayin = ((($toolePare + 9) * 2) / 100);
        }

        //Profile Sotoon Vasat
        if ($toolePare <= 120) {
            $profileSotoonVasat = 0;
        } else {
            $profileSotoonVasat = ((($tedadPare * 10) + 1) / 100);
        }

        //Charkh Dande
        if ($toolePare <= 120) {
            $charkhDande = $tedadPare;
        } else {
            $charkhDande = $tedadPare * 2;
        }

        //Keshoyi Rast & Chap
        $keshoyiRast = $charkhDande;
        $keshoyiChap = $charkhDande;

        //Dastgire Damper
        if ($toolePare <= 120) {
            $dastgireDamper = 1;
        } else {
            $dastgireDamper = 2;
        }

        //PVC Chap & Rast
        $pvcChap = $charkhDande;
        $pvcRast = $charkhDande;

        //Pin 4 Pahloo
        $pin4Pahloo = $charkhDande * 2;

        //Gerdi Damper
        $gerdi = $charkhDande;

        //Navar Havabandi
        $navarHavaBandi = $profilePare + $profileBalaPayin;

        $values = [
            $profilePare,
            $profileSotoon,
            $profileBalaPayin,
            $profileSotoonVasat,
            $charkhDande,
            $dastgireDamper,
            $keshoyiChap,
            $keshoyiRast,
            $pvcChap,
            $pvcRast,
            $navarHavaBandi,
            $gerdi,
            $pin4Pahloo,
        ];

        $name = "SD-OPB-" . $tedadPare . "BL-" . number_format($toolePare, 2) . "L";

        return back()->with(['values' => $values, 'name' => $name, 'inputs' => $inputs, 'toolePare' => $toolePare, 'ertefa' => $ertefaDamper
            , 'sotoonVasat' => $profileSotoonVasat]);
    }

    public function calculateBargasht(Request $request)
    {
        $inputs = $request->validate([
            'debi_hava_bargasht' => 'required',
            'sorat_hava' => 'required',
            'tedad_pare' => 'required',
        ]);

        //Inputs
        $debiHavaBargasht = $request['debi_hava_bargasht'];
        $soratHava = $request['sorat_hava'];
        $tedadPare = $request['tedad_pare'];

        //Tolle Pare
        $toolePare = ((($debiHavaBargasht / $soratHava) / 10.7639) / $tedadPare) * 1000;
        $toolePare = round($toolePare);
        $ertefaDamper = ($tedadPare * 10) + 1;

        //Profile Pare
        $profilePare = (($tedadPare * $toolePare) / 100);

        //Profile Sotoon
        $profileSotoon = (2 * (($tedadPare * 10) + 1)) / 100;

        //Profile Bala Payin
        if ($toolePare <= 120) {
            $profileBalaPayin = ((($toolePare + 6) * 2) / 100);
        } else {
            $profileBalaPayin = ((($toolePare + 9) * 2) / 100);
        }

        //Profile Sotoon Vasat
        if ($toolePare <= 120) {
            $profileSotoonVasat = 0;
        } else {
            $profileSotoonVasat = ((($tedadPare * 10) + 1) / 100);
        }

        //Charkh Dande
        if ($toolePare <= 120) {
            $charkhDande = $tedadPare;
        } else {
            $charkhDande = $tedadPare * 2;
        }

        //Keshoyi Rast & Chap
        $keshoyiRast = $charkhDande;
        $keshoyiChap = $charkhDande;

        //Dastgire Damper
        if ($toolePare <= 120) {
            $dastgireDamper = 1;
        } else {
            $dastgireDamper = 2;
        }

        //PVC Chap & Rast
        $pvcChap = $charkhDande;
        $pvcRast = $charkhDande;

        //Pin 4 Pahloo
        $pin4Pahloo = $charkhDande * 2;

        //Gerdi Damper
        $gerdi = $charkhDande;

        //Navar Havabandi
        $navarHavaBandi = $profilePare + $profileBalaPayin;

        $values = [
            $profilePare,
            $profileSotoon,
            $profileBalaPayin,
            $profileSotoonVasat,
            $charkhDande,
            $dastgireDamper,
            $keshoyiChap,
            $keshoyiRast,
            $pvcChap,
            $pvcRast,
            $navarHavaBandi,
            $gerdi,
            $pin4Pahloo,
        ];

        $name = "RD-OPB-" . $tedadPare . "BL-" . number_format($toolePare, 2) . "L";

        return back()->with(['values' => $values, 'name' => $name, 'inputs' => $inputs, 'toolePare' => $toolePare, 'ertefa' => $ertefaDamper
            , 'sotoonVasat' => $profileSotoonVasat]);
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
