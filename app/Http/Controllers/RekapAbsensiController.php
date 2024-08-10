<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\RekapAbsensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapAbsensiController extends Controller
{
    public function dataKaryawan(Request $request){
        $periode = $request->periode;

        $karyawans = User::where('role_id',2)->whereNotIn('id', function($query) use ($periode){
            $query->select('karyawan')->from('rekap_absensis')->where('periode', $periode);
        })->orderBy('name','ASC')->get();

        return view('rekap.option')->with('karyawans', $karyawans);
    }

    public function addRekap(Request $request){

        $karyawans = RekapAbsensi::where('periode',NULL)->where('karyawan', $request->karyawan)->get();
        if (count($karyawans) > 0) {
            RekapAbsensi::where('periode',NULL)->where('karyawan', $request->karyawan)->update($request->except('_token'));
        } else {
            RekapAbsensi::create($request->all());
        }

        return response()->json([
            "status"    => 200
        ]);
    }

    public function showRekapData() {
        $karyawans = RekapAbsensi::with('namakaryawan')->where('periode',NULL)->orderBy('id','DESC')->get();
        return view('rekap.show')->with('karyawans', $karyawans);
    }

    public function deleteRekapData(Request $request) {
        $karyawans = RekapAbsensi::where('periode',NULL)->where('id',$request->id)->delete();
        
    }

    public function store(Request $request){

        $request->validate([
            "tgl_awal"      => ['required'],
            "tgl_akhir"     => ['required','after:tgl_awal'],
            "periode"       => ['required']
        ]);

        $jmlKaryawan = User::where('role_id',2)->count();
        $jmlRekap = RekapAbsensi::where('periode',$request->periode);
        $selisih = $jmlKaryawan - $jmlRekap->count();
        
        $tglAwal = Carbon::parse($request->input('tgl_awal'));
        $tglAkhir = Carbon::parse($request->input('tgl_akhir'));
        $selisihHari = $tglAkhir->diff($tglAwal)->days + 1;
        
        $rekapKaryawan = RekapAbsensi::where('periode',NULL)->get();
        foreach ($rekapKaryawan as $index => $item) {
            $totalAbsen = collect($item->izin + $item->alfa + $item->sakit + $item->cuti)->sum();
            $jumlahHadir = $selisihHari - $totalAbsen;
            $item->masuk = $jumlahHadir;
            $item->tgl_awal = $tglAwal;
            $item->tgl_akhir = $tglAkhir;
            $item->periode = $request->periode;
            $item->save();
        }

        $rekapJadi = RekapAbsensi::where('periode', $request->periode)->get();
        Gaji::generateGaji($rekapJadi);

        $alreadyPeriode = $jmlRekap->first();
        if ($alreadyPeriode->periode == $request->periode && $selisih == 0) {
            return redirect()->back()->with('fail', "Periode " . $request->periode . " Sudah tersimpan, tidak bisa mengedit periode ini");
        }

        return redirect()->route('gaji.create')->with('success','Rekap Absensi Berhasil');
        
    }
}
