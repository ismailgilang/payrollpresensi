<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "jabatans"  => Jabatan::all()
        ];
        return view('jabatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "jabatan"       => ['required', 'unique:jabatans,jabatan'],
            "gajiPokok"     => ['required', 'numeric','min:1']
        ]);

        Jabatan::create($request->all());
        return redirect()->route('jabatan.index')->with('success', "Jabatan baru berhasil disimpan");
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
        $jabatan = Jabatan::find($id);
        $data = [
            "jabatan"  => $jabatan
        ];
        return view('jabatan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "jabatan"       => ['required', 'unique:jabatans,jabatan,' . $id],
            "gajiPokok"     => ['required', 'numeric','min:1']
        ]);

        Jabatan::where('id', $id)->update($request->only('jabatan', 'gajiPokok'));
        return redirect()->route('jabatan.index')->with('success', "Data jabatan diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jabatan = Jabatan::find($id);
        if (count($jabatan->karyawan) > 0) {
            return redirect()->route('jabatan.index')->with('fail', "Gagal !  Jabatan ini masih memiliki karyawan");
        }
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('success', "Data jabatan terhapus");
    }
}
