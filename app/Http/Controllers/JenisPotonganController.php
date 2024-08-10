<?php

namespace App\Http\Controllers;

use App\Models\JenisPotongan;
use Illuminate\Http\Request;

class JenisPotonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potongans = JenisPotongan::all();
        $data = [
            "potongans" => $potongans
        ];
        return view('potongan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('potongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "jenisPotongan"     => ['required','unique:jenis_potongans,jenisPotongan'],
            "nilaiPotongan"     => ['required','numeric','min:0']
        ]);

        JenisPotongan::create($request->all());
        return redirect()->route('potongan.index')->with('success',"Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPotongan $jenisPotongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data = [
            "potongan"  => JenisPotongan::find($id)
        ];
        return view('potongan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            "jenisPotongan"     => ['required','unique:jenis_potongans,jenisPotongan,'. $id],
            "nilaiPotongan"     => ['required','numeric','min:0']
        ]);

        JenisPotongan::where('id', $id)->update($request->only('jenisPotongan','nilaiPotongan'));
        return redirect()->route('potongan.index')->with('success',"Data berhasil dirubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $jenisPotongan = JenisPotongan::find($id);
        $jenisPotongan->delete();
        return redirect()->route('potongan.index')->with('success',"Data berhasil dihapus");
    }
}
