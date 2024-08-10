<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Presensi;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Cek apakah pengguna adalah admin (id_role = 1)
        if ($user->role_id == 1) {
            // Admin: Ambil semua data pengguna
            $data = Presensi::all();
            $presensiHariIni = Presensi::where('nip', $user->nip)
                                ->whereDate('created_at', Carbon::today())
                                ->get();
        } 
        // Cek apakah pengguna adalah user biasa (id_role = 2)
        else if ($user->role_id == 2) {
            // User: Ambil data absen untuk pengguna ini saja
            $data = Presensi::where('nip', $user->nip)->get();
            $presensiHariIni = Presensi::where('nip', $user->nip)
                                ->whereDate('created_at', Carbon::today())
                                ->get();
        }

        // Kirim data ke view (misalnya ke 'dashboard')
        return view('presensi.index', compact('data', 'user', 'presensiHariIni'));
    }
    public function cuti(){
        $user = Auth::user();
        return view('presensi.cuti', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('presensi.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menyimpan file gambar
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('photos', 'public');
        }
    
        // Menggabungkan data dari request dengan path file
        $data = array_merge($request->all(), ['bukti' => $path]);
    
        // Menyimpan data ke model Presensi
        Presensi::create($data);
    
        // Redirect ke route index
        return redirect()->route('presensi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $presensi = Presensi::findOrFail($id);
        return view('presensi.edit', compact('presensi'));
    }

    public function pulang(string $id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->update(['keterangan2' => 'Pulang']);
        return view('presensi.index', compact('presensi'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $path = $request->file('bukti')->store('photos', 'public');

        // Temukan data Pembelian berdasarkan ID
        $data = Presensi::findOrFail($id);

        // Perbarui semua data yang di-submit, termasuk path dari file yang diunggah
        $data->update(array_merge($request->all(), ['bukti' => $path]));

        // Redirect ke route pembelian.index setelah update berhasil
        return redirect()->route('presensi.index')->with('success', 'Data Presensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Presensi::findOrFail($id);
        $data->delete();
        return redirect()->route('presensi.index');
    }
}
