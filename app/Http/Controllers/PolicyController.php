<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        return view('typeofbusiness.index', [
            'policies' => Policy::get()
        ]);
    }

    public function create()
    {
        return view('typeofbusiness.create', [
            'policy' => new Policy
        ]);
    }

    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'type_policy' => 'required',
            'abbreviation' => 'required'
        ]);
        $attr['is_active'] = 1;

        Policy::create($attr);
        return redirect()->route('type-of-business.index')->with('success', 'Type of business has been created');
    }

    public function show(Policy $policy)
    {
        //
    }

    public function edit(Policy $typeOfBusiness)
    {
        return view('typeofbusiness.edit', [
            'policy' => $typeOfBusiness
        ]);
    }

    public function update(Request $request, Policy $typeOfBusiness)
    {
        $attr = $this->validate($request, [
            'type_policy' => 'required',
            'abbreviation' => 'required'
        ]);

        $typeOfBusiness->update($attr);
        return redirect()->route('type-of-business.index')->with('success', 'Type of business has been updated');
    }

    public function destroy(Policy $typeOfBusines)
    {
        $typeOfBusines->delete();
        return redirect()->route('type-of-business.index')->with('success', 'Type of business has been deleted');
    }
}
