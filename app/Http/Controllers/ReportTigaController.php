<?php

namespace App\Http\Controllers;

use App\Models\ReportTiga;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportTigaController extends Controller
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
                $name = date('dmYHis')  . '-' . $file->getClientOriginalName();
                $filename = 'files/report-tiga/' . $name;

                if (in_array($file->extension(), ['jpeg', 'jpg', 'png'])) {
                    \Image::make($file)->fit(600, null)->save(\public_path('storage/files/report-tiga/' . $name), 90);
                } else {
                    $file->storeAs('files/report-tiga/', $name);
                }

                ReportTiga::create([
                    'case_list_id' => $request->case_list_id,
                    'file_upload' => $filename,
                    'time_upload' => Carbon::now()
                ]);
            }
        }

        return back()->with('success', 'Report tiga has been uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportTiga  $reportTiga
     * @return \Illuminate\Http\Response
     */
    public function show(ReportTiga $reportTiga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportTiga  $reportTiga
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportTiga $reportTiga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportTiga  $reportTiga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportTiga $reportTiga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportTiga  $reportTiga
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportTiga $reportTiga)
    {
        //
    }
}
