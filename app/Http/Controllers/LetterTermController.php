<?php

namespace App\Http\Controllers;

use App\Models\LetterTerm;
use Illuminate\Http\Request;

class LetterTermController extends Controller
{
    public function index()
    {
        $terms = LetterTerm::latest()->paginate(20);
        return view('settings.letter-terms.index', compact('terms'));
    }

    public function create()
    {
        return view('settings.letter-terms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        LetterTerm::create($data);

        alert()->success('ثبت موفق', 'نامه روتین جدید با موفقیت ثبت شد');

        return redirect()->route('letter-terms.index');
    }

    public function edit(LetterTerm $letter_term)
    {
        return view('settings.letter-terms.edit', compact('letter_term'));
    }

    public function update(Request $request, LetterTerm $letter_term)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        $letter_term->update($data);

        alert()->success('بروزرسانی موفق', 'نامه روتین با موفقیت بروزرسانی شد');

        return redirect()->route('letter-terms.index');
    }

    public function destroy(LetterTerm $letter_term)
    {
        $letter_term->delete();

        alert()->success('حذف موفق', 'نامه روتین با موفقیت حذف شد');

        return back();
    }
}
