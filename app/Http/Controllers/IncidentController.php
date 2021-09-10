<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        return view('causeofloss.index', [
            'incidents' => Incident::get()
        ]);
    }

    public function create()
    {
        return view('causeofloss.create');
    }

    public function store(Request $request)
    {
        $form = $this->validate($request, [
            'type_incident' => 'required',
            'description' => 'required'
        ]);
        $form['is_active'] = 1;

        Incident::create($form);
        return redirect()->route('cause-of-loss.index')->with('success', 'Cause of loss has been created');
    }

    public function show(Incident $incident)
    {
        //
    }

    public function edit(Incident $causeOfLoss)
    {
        return view('causeofloss.edit', [
            'incident' => $causeOfLoss
        ]);
    }

    public function update(Request $request, Incident $causeOfLoss)
    {
        $form = $this->validate($request, [
            'type_incident' => 'required',
            'description' => 'required'
        ]);

        $causeOfLoss->update($form);
        return redirect()->route('cause-of-loss.index')->with('success', 'Cause of loss has been updated');
    }

    public function destroy(Incident $causeOfLoss)
    {
        $causeOfLoss->delete();
        return redirect()->route('cause-of-loss.index')->with('success', 'Cause of loss has been deleted');
    }
}
