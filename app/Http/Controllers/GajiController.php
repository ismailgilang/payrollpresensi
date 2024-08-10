<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    public $months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    public function index(Request $request)
    {

        if (Auth::user()->role_id == 1) {
            if ($request->periode) {
                $rekaps = Gaji::where('periode', $request->periode)->orderBy('tgl_awal', 'ASC')->get();
            } else {
                $rekaps = Gaji::orderBy('tgl_awal', 'ASC')->get();
            }
        } else {
            if ($request->periode) {
                $rekaps = Gaji::where('periode', $request->periode)->orderBy('tgl_awal', 'ASC')->get();
            } else {
                $rekaps = Gaji::where('karyawan', Auth::user()->name)->orderBy('tgl_awal', 'ASC')->get();
            }
        }

        $data = [
            "rekaps"  => $rekaps,
            "months"  => $this->months
        ];
        return view('gaji.index', $data);
    }

    public function create()
    {
        if (request()->user()->cannot('is_admin')) {
            abort(403);
        }
        $data = [
            "months"     => $this->months,
            "karyawans"  => User::where('role_id', 2)->get()
        ];
        return view('gaji.create', $data);
    }

    public function show(String $id)
    {
        $rekap = Gaji::find($id);
        $data = [
            "payslip" => $rekap
        ];
        return view('gaji.payslip', $data);
    }
}
