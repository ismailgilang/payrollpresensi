<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function generateGaji($data)
    {
        foreach ($data as $item) {
            $nilaiIzin = JenisPotongan::where('jenisPotongan', 'izin')->select('nilaiPotongan')->first();
            $nilaiCuti =  JenisPotongan::where('jenisPotongan', 'cuti')->select('nilaiPotongan')->first();
            $nilaiAlfa = JenisPotongan::where('jenisPotongan', 'alfa')->select('nilaiPotongan')->first();
            $nilaiSakit = JenisPotongan::where('jenisPotongan', 'sakit')->select('nilaiPotongan')->first();
            $potonganIzin =  $item->izin * $nilaiIzin->nilaiPotongan;
            $potonganCuti =  $item->cuti * $nilaiCuti->nilaiPotongan;
            $potonganAlfa =  $item->alfa * $nilaiAlfa->nilaiPotongan;
            $potonganSakit =  $item->sakit * $nilaiSakit->nilaiPotongan;
            $totalPotongan = collect([$potonganAlfa, $potonganCuti, $potonganIzin, $potonganSakit])->sum();
            $gapok = $item->namaKaryawan->jabatan->gajiPokok ?? null;
            $thp = $gapok - $totalPotongan;
    
            Gaji::create([
                "rekap_id"  => 1,
                "karyawan"  => $item->namaKaryawan->name,
                "jabatan"   => $item->namaKaryawan->jabatan->jabatan ?? null,
                "gapok"     => $gapok,
                "periode"   => $item->periode,
                "tgl_awal"  => $item->tgl_awal,
                "tgl_akhir" => $item->tgl_akhir,
                "masuk"  => $item->masuk,
                "jmlIzin"   => $item->izin,
                "potonganIzin"  => $potonganIzin,
                "jmlSakit"  => $item->sakit,
                "potonganSakit"  => $potonganSakit,
                "jmlAlfa"   => $item->alfa,
                "potonganAlfa"  => $potonganAlfa,
                "jmlCuti"   => $item->cuti,
                "potonganCuti"  => $potonganCuti,
                "thp"  => $thp,
            ]);
        }

    }
}
