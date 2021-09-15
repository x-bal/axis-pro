<?php

namespace App\Http\Controllers;

use App\Models\{CaseList, User, Broker, Incident, Policy, Client, FileStatus, MemberInsurance};
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

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

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
            'policy' => Policy::get()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file_no' => 'required',
            'risk_location' => 'required',
            'leader' => 'required',
            'begin' => 'required',
            'end' => 'required',
            'dol' => 'required',
            'insured' => 'required'
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
                'leader' => $request->leader,
                'begin' => $request->begin,
                'end' => $request->end,
                'dol' => $request->dol,
                'category' => $request->category,
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
            dd($th->getMessage());
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
        //
    }

    public function update(Request $request, CaseList $caseList)
    {
        //
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
