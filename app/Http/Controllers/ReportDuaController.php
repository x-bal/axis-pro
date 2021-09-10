<?php

namespace App\Http\Controllers;

use App\Models\ReportDua;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportDuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'case_list_id' => 'required',
            'file_upload' => 'required',
            'time_upload' => 'required',
        ]);

        if ($request->hasFile('file_upload')) {
            $files = $request->file('file_upload');
            foreach ($files as $file) {
                $name = time() . \Str::random(15) . '.' . $file->extension();
                $filename = 'files/report-dua/' . $name;

                if (in_array($file->extension(), ['jpeg', 'jpg', 'png'])) {
                    \Image::make($file)->fit(600, null)->save(\public_path('storage/files/report-dua/' . $name), 90);
                } else {
                    $file->storeAs('files/report-dua/', $name);
                }

                ReportDua::create([
                    'case_list_id' => $request->case_list_id,
                    'file_upload' => $filename,
                    'time_upload' => Carbon::now()
                ]);
            }
        }

        return back()->with('success', 'Report dua has been uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportDua  $reportDua
     * @return \Illuminate\Http\Response
     */
    public function show(ReportDua $reportDua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportDua  $reportDua
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportDua $reportDua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportDua  $reportDua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportDua $reportDua)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportDua  $reportDua
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportDua $reportDua)
    {
        //
    }
}
