<?php

namespace App\Http\Controllers;

use App\Models\ReportEmpat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportEmpatController extends Controller
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
                $filename = 'files/report-empat/' . $name;

                if (in_array($file->extension(), ['jpeg', 'jpg', 'png'])) {
                    \Image::make($file)->fit(600, null)->save(\public_path('storage/files/report-empat/' . $name), 90);
                } else {
                    $file->storeAs('files/report-empat/', $name);
                }

                ReportEmpat::create([
                    'case_list_id' => $request->case_list_id,
                    'file_upload' => $filename,
                    'time_upload' => Carbon::now()
                ]);
            }
        }

        return back()->with('success', 'Report empat has been uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportEmpat  $reportEmpat
     * @return \Illuminate\Http\Response
     */
    public function show(ReportEmpat $reportEmpat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportEmpat  $reportEmpat
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportEmpat $reportEmpat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportEmpat  $reportEmpat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportEmpat $reportEmpat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportEmpat  $reportEmpat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportEmpat $reportEmpat)
    {
        //
    }
}
