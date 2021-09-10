<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    public function index()
    {
        return view('broker.index', [
            'brokers' => Broker::get()
        ]);
    }

    public function create()
    {

        return view('broker.create', [
            'broker' => new Broker()
        ]);
    }

    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'nama_broker' => 'required',
            'telepon_broker' => 'required',
            'email_broker' => 'required|email',
            'alamat_broker' => 'required'
        ]);

        $attr['is_active'] = 1;

        Broker::create($attr);
        return redirect()->route('broker.index')->with('success', 'Broker has been created');
    }

    public function show($id)
    {
        //
    }

    public function edit(Broker $broker)
    {
        return view('broker.edit', [
            'broker' => $broker
        ]);
    }

    public function update(Request $request, Broker $broker)
    {
        $attr = $this->validate($request, [
            'nama_broker' => 'required',
            'telepon_broker' => 'required',
            'email_broker' => 'required|email',
            'alamat_broker' => 'required'
        ]);

        $broker->update($attr);
        return redirect()->route('broker.index')->with('success', 'Broker has been updated');
    }

    public function destroy(Broker $broker)
    {
        $broker->delete();
        return redirect()->route('broker.index')->with('success', 'Broker has been created');
    }
}
