<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id', 2)->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $jabatans = Jabatan::all();
        $data = [
            "roles" => $roles,
            "jabatans"  => $jabatans
        ];
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"      => ['required'],
            "email"     => ['required','unique:users,email'],
            "role_id"   => ['required'],
            "jabatan_id" => ['required'],
            "password"  => ['required','confirmed','min:8']
        ]);

        User::create($request->all());
        return redirect()->route('user.index')->with('success','User Baru berhasil disimpan');
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
        $user = User::find($id);
        $roles = Role::all();
        $jabatans = Jabatan::all();
        $data = [
            "roles" => $roles,
            "jabatans"  => $jabatans,
            "user"  => $user
        ];
        return view('user.edit', $data);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"      => ['required'],
            "email"     => ['required','unique:users,email,'. $id],
            "role_id"   => ['required'],
            "jabatan_id" => ['required'],
        ]);

        User::where('id', $id)->update($request->only('name','email','role_id','jabatan_id'));
        return redirect()->route('user.index')->with('success','User Baru berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')->with('success','User Baru berhasil disimpan');
    }
}
