<?php

namespace App\Http\Controllers;

use App\Models\FileSurvey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class FileSurveyController extends Controller
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
            'file_upload' => 'required|max:5120',
            'time_upload' => 'required',
        ]);

        if ($request->hasFile('file_upload')) {
            $files = $request->file('file_upload');
            foreach ($files as $file) {
                $name = date('dmYHis')  . '-' . $file->getClientOriginalName();
                $filename = 'files/file-survey/' . $name;

                if (in_array($file->extension(), ['jpeg', 'jpg', 'png'])) {
                    \Image::make($file)->fit(600, null)->save(\public_path('storage/files/file-survey/' . $name), 90);
                } else {
                    $file->storeAs('files/file-survey/', $name);
                }

                FileSurvey::create([
                    'case_list_id' => $request->case_list_id,
                    'file_upload' => $filename,
                    'time_upload' => Carbon::now()
                ]);
            }
        }

        return back()->with('success', 'File survey has been uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileSurvey  $fileSurvey
     * @return \Illuminate\Http\Response
     */
    public function show(FileSurvey $fileSurvey)
    {
        return Storage::download($fileSurvey->file_upload);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileSurvey  $fileSurvey
     * @return \Illuminate\Http\Response
     */
    public function edit(FileSurvey $fileSurvey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileSurvey  $fileSurvey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileSurvey $fileSurvey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileSurvey  $fileSurvey
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileSurvey $fileSurvey)
    {
        //
    }
}
