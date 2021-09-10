<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index()
    {
        return view('insurance.index', [
            'clients' => Client::get()
        ]);
    }

    public function create()
    {
        return view('insurance.create', [
            'client' => new Client()
        ]);
    }

    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'brand' => 'required',
            'name' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'ppn' => 'required',
            'type' => 'required',
            'picture' => 'required'
        ]);

        try {
            $picture = $request->file('picture');
            $pictureUrl = $picture->storeAs('public/images/insurance', $request->name . '_' . \Str::random(15) . '.' . $picture->extension());
            // Client::create($request->all());
            $attr['picture'] = $pictureUrl;
            $attr['is_active'] = 1;

            Client::create($attr);
            return redirect()->route('insurance.index')->with('success', 'Insurance has been created');
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function show(Client $insurance)
    {
        //
    }

    public function edit(Client $insurance)
    {
        return view('insurance.edit', [
            'client' => $insurance
        ]);
    }

    public function update(Request $request, Client $insurance)
    {
        $attr = $this->validate($request, [
            'brand' => 'required',
            'name' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'ppn' => 'required',
            'type' => 'required',
            'picture' => 'required'
        ]);

        try {
            if ($request->picture) {
                $picture = $request->file('picture');
                \Storage::delete($insurance->picture);
                $pictureUrl = $picture->storeAs('public/images/insurance', \Str::random(15) . '.' . $picture->extension());
                $attr['picture'] = $pictureUrl;
                $insurance->update($attr);
                return back();
            } else {
                $insurance->update($attr);
                return redirect()->route('insurance.index')->with('success', 'Insurance has been updated');
            }
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function destroy(Client $insurance)
    {
        \Storage::delete($insurance->picture);
        $insurance->delete();
        return redirect()->route('insurance.index')->with('success', 'Insurance has been deleted');
    }
}
