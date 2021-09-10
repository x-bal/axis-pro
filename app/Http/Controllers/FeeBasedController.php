<?php

namespace App\Http\Controllers;

use App\Models\FeeBased;
use Illuminate\Http\Request;

class FeeBasedController extends Controller
{
    public function index()
    {
        return view('feebased.index', [
            'feebased' => FeeBased::get()
        ]);
    }

    public function create()
    {
        return view('feebased.create', [
            'feebased' => new FeeBased()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'adjusted_idr' => 'required',
            'adjusted_usd' => 'required',
            'fee_idr' => 'required',
            'fee_usd' => 'required',
            'category_fee' => 'required'
        ]);

        FeeBased::create($attr);
        return redirect()->route('fee-based.index')->with('success', 'Fee based has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeBased $feeBased)
    {
        return view('feebased.edit', [
            'feebased' => $feeBased
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeBased $feeBased)
    {
        $attr =  $this->validate($request, [
            'adjusted_idr' => 'required',
            'adjusted_usd' => 'required',
            'fee_idr' => 'required',
            'fee_usd' => 'required',
            'category_fee' => 'required'
        ]);

        $feeBased->update($attr);
        return redirect()->route('fee-based.index')->with('success', 'Fee based has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeBased $feeBased)
    {
        $feeBased->delete();
        return redirect()->route('fee-based.index')->with('success', 'Fee based has been created');
    }
}
