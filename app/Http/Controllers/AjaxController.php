<?php

namespace App\Http\Controllers;

use App\Models\CaseList;
use App\Models\Client;
use App\Models\FeeBased;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Exception;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function TheAutoCompleteFunc(Request $request)
    {
        $data = [];
        $caseList = CaseList::where('file_no', 'like','%'.$request->q.'%')->get();
        foreach($caseList as $row){
            $data[] = ['id' => $row->id, 'text' => $row->file_no];
        }
        return response()->json($data);
    }
    public function insurance($id)
    {
        return response()->json(Client::findOrFail($id));
    }
    public function currency()
    {
        $response = Currency::first();
        return response()->json($response);
    }
    public function caselist($id)
    {
        try {
            $caselist = CaseList::find($id);

            if ($caselist->category == 1) {
                $feebased = FeeBased::where('category_fee', 1)->get();
                if ($caselist->currency == 'RP') {
                    foreach ($feebased as $data) {
                        if ($caselist->claim_amount <= $data->adjusted_idr) {
                            $array = [
                                'adjusted' => $data->adjusted_idr,
                                'claim_amount' => $caselist->claim_amount,
                                'fee' => $data->fee_idr
                            ];
                            break;
                        }
                    }
                }
                if ($caselist->currency == 'USD') {
                    foreach ($feebased as $data) {
                        if ($caselist->claim_amount <= $data->adjusted_idr) {
                            $array = [
                                'adjusted' => $data->adjusted_usd,
                                'claim_amount' => $caselist->claim_amount,
                                'fee' => $data->fee_usd
                            ];
                            break;
                        }
                    }
                }
            }
            if ($caselist->category == 2) {
                $feebased = FeeBased::where('category_fee', 2)->get();
                if ($caselist->currency == 'RP') {
                    foreach ($feebased as $data) {
                        if ($caselist->claim_amount <= $data->adjusted_idr) {
                            $array = [
                                'adjusted' => $data->adjusted_idr,
                                'claim_amount' => $caselist->claim_amount,
                                'fee' => $data->fee_idr
                            ];
                            break;
                        }
                    }
                }
                if ($caselist->currency == 'USD') {
                    foreach ($feebased as $data) {
                        if ($caselist->claim_amount <= $data->adjusted_idr) {
                            $array = [
                                'adjusted' => $data->adjusted_usd,
                                'claim_amount' => $caselist->claim_amount,
                                'fee' => $data->fee_usd
                            ];
                            break;
                        }
                    }
                }
            }
            $response = [
                'caselist' => CaseList::with('member', 'expense', 'insurance')->where('id', $id)->firstOrFail(),
                'expense' => $caselist->expense()->sum('amount'),
                'sum' => $array
            ];

            return response()->json($response);
        } catch (Exception $err) {
            return response()->json($err->getMessage());
        }
    }
}
