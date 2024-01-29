<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('can:phonebooks')->only(['index']);
//        $this->middleware('can:create-phonebook')->only(['create', 'store']);
//        $this->middleware('can:edit-phonebook')->only(['edit', 'update']);
//        $this->middleware('can:delete-phonebook')->only(['destroy']);
//    }

    public function index()
    {
        $phonebooks = Phonebook::query();

        if ($keyword = request('search')) {
            $phonebooks = $phonebooks->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('phone1', 'LIKE', "%{$keyword}%")
                ->orWhere('phone2', 'LIKE', "%{$keyword}%")
                ->orWhere('mobile1', 'LIKE', "%{$keyword}%")
                ->orWhere('mobile2', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('address', 'LIKE', "%{$keyword}%")
                ->orWhere('activity', 'LIKE', "%{$keyword}%")
                ->orWhere('postal', 'LIKE', "%{$keyword}%");
        }

        if (request()->has('category')) {
            $phonebooks = $phonebooks->where('category', 'LIKE', request('category'));
        }

        $phonebooks = $phonebooks->latest()->paginate(20);
        return view('systems.phonebook.index', compact('phonebooks'));
    }

    public function create()
    {
        return view('systems.phonebook.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Phonebook::create($data);

        alert()->success('ثبت موفق', 'دفترچه تلفن جدید با موفقیت ثبت شد');

        return redirect()->route('phonebook.index');
    }

    public function edit(Phonebook $phonebook)
    {
        return view('systems.phonebook.edit', compact('phonebook'));
    }

    public function update(Request $request, Phonebook $phonebook)
    {
        $data = $this->validateData($request);

        $phonebook->update($data);

        alert()->success('بروزرسانی موفق', 'دفترچه تلفن با موفقیت بروزرسانی شد');

        return redirect()->route('phonebook.index');
    }

    public function destroy(Phonebook $phonebook)
    {
        $phonebook->delete();

        alert()->success('حذف موفق', 'دفترچه تلفن با موفقیت حذف شد');

        return back();
    }

    public function validateData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone1' => 'nullable|string|max:255',
            'phone2' => 'nullable|string|max:255',
            'person1' => 'nullable|string|max:255',
            'mobile1' => 'nullable|string|max:255',
            'person2' => 'nullable|string|max:255',
            'mobile2' => 'nullable|string|max:255',
            'address' => 'nullable',
            'postal' => 'nullable|string|max:255',
            'description' => 'nullable',
        ]);
    }
}
