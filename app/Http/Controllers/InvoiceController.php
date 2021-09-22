<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Models\Bank;
use App\Models\CaseList;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\MemberInsurance;
use App\Models\NoInvoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index', [
            'invoice' => Invoice::get(),
            'member' => MemberInsurance::get(),
            'caselist' => CaseList::get(),
            'bank' => Bank::get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'total' => 'required',
            'fee_based' => 'required',
            'date_invoice' => 'required',
            'no_invoice.*' => 'required'
        ]);
        if (CaseList::find($request->no_case)->hasInvoice()) {
            return back()->with('error', 'invoiced is already exists');
        }
        try {
            DB::beginTransaction();
            $fee_based = str_replace(',', '', $request->fee_based);
            $fee_based = intval($fee_based);
            $caselist = CaseList::find($request->no_case);
            if ($caselist->currency == 'RP') {
                $caselist->update([
                    'fee_idr' => $fee_based
                ]);
            }
            if ($caselist->currency == 'USD') {
                $caselist->update([
                    'fee_usd' => $fee_based
                ]);
            }
            $total = str_replace(',', '', $request->total);
            $total = intval($total);
            foreach (CaseList::find($request->no_case)->member as $key => $data) {
                Invoice::create([
                    'case_list_id' => $request->no_case,
                    'member_id' => $data->member_insurance,
                    'no_invoice' => $request->no_invoice[$key],
                    'date_invoice' => $request->date_invoice,
                    'due_date' => Carbon::parse($request->date_invoice)->addDays(30)->format('Y-m-d'),
                    'status_paid' => 0,
                    'is_active' => 1,
                    'grand_total' => $total * $data->share / 100
                ]);
            }
            DB::commit();
        } catch (Exception $err) {
            DB::rollBack();
            return back()->with('error', $err->getMessage());
        }
        return back()->with('success', 'Success create Invoice');
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
    public function laporan(Request $request)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required'
        ]);
        $invoice = Invoice::whereBetween('date_invoice', [$request->from, $request->to])->get();
        return view('invoice.laporan',[
            'from' => $request->from,
            'to' => $request->to,
            'invoice' => $invoice 
        ]);
    }
    public function excel(Request $request)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required'
        ]);
        return Excel::download(new InvoiceExport($request->except(['_token'])), 'Invoice Excel.xlsx');
    }
}
