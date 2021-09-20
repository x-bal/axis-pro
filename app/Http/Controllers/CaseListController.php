<?php

namespace App\Http\Controllers;

use App\Models\{CaseList, User, Broker, Incident, Policy, Client, Currency, Expense, FileStatus, MemberInsurance,};
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseListController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = CaseList::with('member', 'insurance', 'adjuster', 'broker', 'incident', 'policy', 'status')->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('fileno', function ($row) {
                    return '<a href="' . route('case-list.show', $row->id) . '">' . $row->file_no . '</a>';
                })
                ->editColumn('initial', function ($row) {
                    return $row->adjuster->kode_adjuster;
                })
                ->editColumn('name', function ($row) {
                    return $row->insurance->name;
                })
                ->editColumn('share', function ($row) {
                    foreach ($row->member as $member) {
                        return $member->share . '%';
                    }
                })
                ->editColumn('is_leader', function ($row) {
                    foreach ($row->member as $member) {
                        return $member->is_leader == 1 ? 'Leader' : 'Member';
                    }
                })
                ->editColumn('leader', function ($row) {
                    return $row->insurance->name;
                })
                ->editColumn('cause', function ($row) {
                    return $row->incident->type_incident;
                })
                ->editColumn('status', function ($row) {
                    return $row->status->nama_status;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="/case-list/' . $row->id . '/edit" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>';
                    //     $btn .= "<form action='' method='post' style='display: inline;'>
                    //     <button type='submit' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                    // </form>";

                    return $btn;
                })
                ->rawColumns(['action', 'fileno'])
                ->make(true);
        }

        return view('case-list.index');
    }

    public function create()
    {
        return view('case-list.create', [
            'caseList' => new Caselist(),
            'client' => Client::get(),
            'user' => User::role('adjuster')->get(),
            'broker' => Broker::get(),
            'incident' => Incident::get(),
            'policy' => Policy::get(),
            'file_no' => Caselist::pluck('file_no')
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file_no' => 'required',
            'risk_location' => 'required',
            // 'leader' => 'required',
            'begin' => 'required',
            'end' => 'required',
            'dol' => 'required',
            'insured' => 'required',
            'insurance' => 'required',
            'adjuster' => 'required',
            'category' => 'required',
            'currency' => 'required',
            'broker' => 'required',
            'incident' => 'required',
            'policy' => 'required',
            'no_leader_policy' => 'required',
            'instruction_date' => 'required',
            'leader_claim_no' => 'required',
        ]);
        // $amount = str_replace(',', '', $request->amount);
        // $claim_amount = str_replace(',', '', $request->claim_amount);
        try {
            DB::beginTransaction();
            $caselist = Caselist::create([
                'file_no' => $request->file_no,
                'insurance_id' => $request->insurance,
                'adjuster_id' => $request->adjuster,
                'broker_id' => $request->broker,
                'incident_id' => $request->incident,
                'policy_id' => $request->policy,
                'insured' => $request->insured,
                'risk_location' => $request->risk_location,
                'currency' => $request->currency,
                'leader' => $request->insurance,
                'begin' => $request->begin,
                'end' => $request->end,
                'dol' => $request->dol,
                'category' => $request->category,
                'no_leader_policy' => $request->no_leader_policy,
                'instruction_date' => $request->instruction_date,
                'leader_claim_no' => $request->leader_claim_no,
                'file_status_id' => 1
            ]);
            for ($i = 1; $i <= count($request->member); $i++) {
                MemberInsurance::create([
                    'file_no_outstanding' => $caselist->id,
                    'member_insurance' => $request->member[$i],
                    'share' => $request->percent[$i],
                    'is_leader' => $request->status[$i] == 'LEADER' ? 1 : 0,
                    'invoice_leader' => 1
                ]);
            }
            DB::commit();
            return back()->with('success', 'Berhasil Membuat Data');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(CaseList $caseList)
    {
        $status = FileStatus::get();
        return view('case-list.show', compact('caseList', 'status'));
    }

    public function getcase(CaseList $caseList)
    {
        $caseList = CaseList::with('');
    }

    public function edit(CaseList $caseList)
    {
        return view('case-list.edit', [
            'caseList' => $caseList,
            'client' => Client::get(),
            'user' => User::role('adjuster')->get(),
            'broker' => Broker::get(),
            'incident' => Incident::get(),
            'policy' => Policy::get(),
            'file_no' => Caselist::pluck('file_no')
        ]);
    }
    public function update(Request $request, CaseList $caseList)
    {

        if ($request->currency != $caseList->currency) {

            $currency = Currency::get()->firstOrFail();
            try {
                DB::beginTransaction();
                if ($request->currency == 'RP') {
                    CaseList::where('id', $caseList->id)->update([
                        'ia_amount' => strval(round($caseList->ia_amount * $currency->kurs)),
                        'pr_amount' => strval(round($caseList->pr_amount * $currency->kurs)),
                        'pa_amount' => strval(round($caseList->pa_amount * $currency->kurs)),
                        'fr_amount' => strval(round($caseList->fr_amount * $currency->kurs)),
                        'claim_amount' => strval(round($caseList->claim_amount * $currency->kurs))
                    ]);
                    foreach ($caseList->expense as $data) {
                        Expense::where('case_list_id', $caseList->id)->update([
                            'amount' => strval(round($data->amount * $currency->kurs))
                        ]);
                    }
                }
                if ($request->currency == 'USD') {
                    CaseList::where('id', $caseList->id)->update([
                        'ia_amount' => strval(round($caseList->ia_amount / $currency->kurs, 2)),
                        'pr_amount' => strval(round($caseList->pr_amount / $currency->kurs, 2)),
                        'pa_amount' => strval(round($caseList->pa_amount / $currency->kurs, 2)),
                        'fr_amount' => strval(round($caseList->fr_amount / $currency->kurs, 2)),
                        'claim_amount' => strval(round($caseList->claim_amount / $currency->kurs, 2))
                    ]);
                    foreach ($caseList->expense as $data) {
                        Expense::where('case_list_id', $caseList->id)->update([
                            'amount' => strval(round($data->amount / $currency->kurs, 2))
                        ]);
                    }
                }
                DB::commit();
            } catch (Exception $err) {
                DB::rollBack();
                return back()->with('error', $err->getMessage());
            }
        }
        try {
            $member = array_values($request->member);
            $share = array_values($request->percent);
            $status = array_values($request->status);
            // $amount = str_replace(',', '', $request->amount);
            // $claim_amount = str_replace(',', '', $request->claim_amount);
            DB::beginTransaction();
            $caseList->update([
                'file_no' => $request->file_no,
                'insurance_id' => $request->insurance,
                'adjuster_id' => $request->adjuster,
                'broker_id' => $request->broker,
                'incident_id' => $request->incident,
                'policy_id' => $request->policy,
                'insured' => $request->insured,
                'risk_location' => $request->risk_location,
                'currency' => $request->currency,
                'leader' => $request->insurance,
                'begin' => $request->begin,
                'end' => $request->end,
                'dol' => $request->dol,
                'category' => $request->category,
            ]);
            MemberInsurance::where('file_no_outstanding', $caseList->id)->delete();
            for ($i = 0; $i < count($request->member); $i++) {
                MemberInsurance::create([
                    'file_no_outstanding' => $caseList->id,
                    'member_insurance' => $member[$i],
                    'share' => $share[$i],
                    'is_leader' => $status[$i] == 'LEADER' ? 1 : 0,
                    'invoice_leader' => 1
                ]);
            }
            DB::commit();
            return redirect()->route('case-list.index')->with('success', 'Case list has been updated');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(CaseList $caseList)
    {
        //
    }

    public function status()
    {
        $caseList = CaseList::find(request('id'));
        $caseList->update([
            'file_status_id' => request('status'),
            'now_update' => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Case list current status has been updated'
        ], 200);
    }

    public function irstatus()
    {
        $caseList = CaseList::find(request('id'));

        $caseList->update([
            'ir_status' => request('status'),
        ]);

        return response()->json([
            'status' => true,
            'message' => $caseList->ir_status == 1 ? 'Interim report has been used' : 'Interim report has been removed',
            'case_list' => $caseList
        ], 200);
    }
}
