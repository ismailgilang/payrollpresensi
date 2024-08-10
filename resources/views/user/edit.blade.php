@extends('layouts.app')
@section('content')
   <div class="container">
      <div class="card">
         <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h4 class="card-title text-capitalize">form user</h4>
            <a href="{{ route('user.index') }}" class="nav-link text-capitalize text-muted">kembali</a>
         </div>
         <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
               <div class="form-group my-3">
                  <label for="name" class="text-capitalize">nama lengkap</label>
                  <input type="text" name="name" id="name" class="form-control @error('name')
                     is-invalid
                  @enderror" value="{{ $user->name }}" placeholder="Masukan nama lengkap" >
                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>

               <div class="form-group my-3">
                  <label for="email" class="text-capitalize">email</label>
                  <input type="text" name="email" id="email" class="form-control @error('email')
                      is-invalid
                  @enderror" placeholder="Masukan email anda" value="{{ $user->email }}">
                  @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>

               <div class="form-group my-3">
                  <label for="role_id" class="text-capitalize">role</label>
                  <select name="role_id" id="role_id" class="form-control @error('role_id')
                      is-invalid
                  @enderror">
                     <option value="">Pilih Role</option>
                     @foreach ($roles as $role)
                     <option value="{{ $role->id }}" {{ ($user->role_id == $role->id ) ? 'selected' : '' }} >{{ ucwords($role->role) }}</option>
                     @endforeach
                  </select>
                  @error('role_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>

               <div class="form-group my-3">
                  <label for="jabatan_id" class="text-capitalize">jabatan</label>
                  <select name="jabatan_id" id="jabatan_id" class="form-control @error('jabatan_id')
                      is-invalid
                  @enderror">
                     <option value="">Pilih Jabatan</option>
                     @foreach ($jabatans as $jabatan)
                     <option value="{{ $jabatan->id }}" {{ ($user->jabatan_id == $jabatan->id ) ? 'selected' : '' }} >{{ ucwords($jabatan->jabatan) }}</option>
                     @endforeach
                  </select>
                  @error('jabatan_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>

               <div class="my-3">
                  <button type="submit" class="btn btn-primary text-capitalize rounded-0 btn-sm float-end">simpan</button>
               </div>
               
            </form>
         </div>
      </div>
   </div>
@endsection