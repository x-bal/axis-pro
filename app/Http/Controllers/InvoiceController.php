<?php

namespace App\Http\Controllers;

use App\Models\CaseList;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\MemberInsurance;
use App\Models\NoInvoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index', [
            'invoice' => Invoice::get(),
            'member' => MemberInsurance::get(),
            'caselist' => CaseList::get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach (CaseList::find($request->no_case)->member as $data) {
                NoInvoice::create([
                    'no_invoice' => $data->caselist->file_no,
                    'due_date' => $data->caselist->end,
                    'date_invoice' => Carbon::now()->format('Y-m-d'),
                    'status_paid' => 1,
                    'created_by' => auth()->user()->id,
                    'is_active' => 1
                ]);
            }
            DB::commit();
        } catch (Exception $err) {
            DB::rollBack();
            dd($err->getMessage());
        }
        return back()->with('success', 'Berhasil');
    }

    public function show(Invoice $invoice)
    {
        //
    }

    public function edit(Invoice $invoice)
    {
        //
    }

    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
