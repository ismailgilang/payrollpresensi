@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="card">
         <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h4 class="card-title text-capitalize">form jabatan</h4>
            <a href="{{ route('jabatan.index') }}" class="nav-link text-capitalize text-muted">kembali</a>
         </div>
         <div class="card-body">
            <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
            @csrf
               @method('put')
            <div class="form-group my-3">
               <label for="jabatan" class="text-capitalize">nama jabatan</label>
               <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan')
                   is-invalid
               @enderror" value="{{ $jabatan->jabatan }}" placeholder="Masukan nama jabatan">
               @error('jabatan')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>
               
            <div class="form-group my-3">
               <label for="gajiPokok" class="text-capitalize">Gaji Pokok</label>
               <input type="text" name="gajiPokok" id="gajiPokok" class="form-control @error('gajiPokok')
                   is-invalid
               @enderror" value="{{ $jabatan->gajiPokok }}" placeholder="Masukan besaran Gaji Pokok">
               @error('gajiPokok')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="my-3">
               <button type="submit" class="btn btn-primary btn-sm text-capitalize rounded-0 float-end">simpan</button>
            </div>

            </form>
         </div>
      </div>
    </div>
@endsection