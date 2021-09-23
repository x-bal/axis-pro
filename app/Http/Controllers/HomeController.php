<?php

namespace App\Http\Controllers;

use App\Models\CaseList;
use App\Models\Currency;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $satu = CaseList::where('ia_status', 0)->count();
            $dua = CaseList::where('pr_status', 0)->count();
            $tiga = CaseList::where('pa_status', 0)->count();
            $empat = CaseList::where('fr_status', 0)->count();
        } else {
            $satu = CaseList::where('ia_status', 0)->where('adjuster_id', auth()->user()->id)->count();
            $dua = CaseList::where('pr_status', 0)->where('adjuster_id', auth()->user()->id)->count();
            $tiga = CaseList::where('pa_status', 0)->where('adjuster_id', auth()->user()->id)->count();
            $empat = CaseList::where('fr_status', 0)->where('adjuster_id', auth()->user()->id)->count();
        }

        return view('dashboard.index', compact('satu', 'dua', 'tiga', 'empat'));
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        $kurs = Currency::first();
        return view('dashboard.profile', compact('user','kurs'));
    }

    public function update(Request $request, User $user)
    {
        $attr = $request->validate([
            'nama_lengkap' => 'required',
            'no_telepon' => 'required',
        ]);

        if ($request->password != null) {
            $attr['password'] = Hash::make($request->password);
        } else {
            $attr['password'] = $user->password;
        }

        $user->update($attr);
        if(Currency::first() == null)
        {
            Currency::create([
                'kurs' => $request->kurs
            ]);
        }else{
            Currency::first()->update([
                'kurs' => $request->kurs
            ]);
        }

        return back()->with('success', 'Your profile has been updated');
    }

    public function report($report)
    {
        if ($report == 1) {
            if (auth()->user()->hasRole('admin')) {
                $cases = CaseList::where('ia_status', 0)->get();
            } else {
                $cases = CaseList::where('ia_status', 0)->where('adjuster_id', auth()->user()->id)->get();
            }
        }

        if ($report == 2) {
            if (auth()->user()->hasRole('admin')) {
                $cases = CaseList::where('pr_status', 0)->get();
            } else {
                $cases = CaseList::where('pr_status', 0)->where('adjuster_id', auth()->user()->id)->get();
            }
        }

        if ($report == 3) {
            if (auth()->user()->hasRole('admin')) {
                $cases = CaseList::where('pa_status', 0)->get();
            } else {
                $cases = CaseList::where('pa_status', 0)->where('adjuster_id', auth()->user()->id)->get();
            }
        }

        if ($report == 4) {
            if (auth()->user()->hasRole('admin')) {
                $cases = CaseList::where('fr_status', 0)->get();
            } else {
                $cases = CaseList::where('fr_status', 0)->where('adjuster_id', auth()->user()->id)->get();
            }
        }

        return view('dashboard.report', compact('cases'));
    }
}
