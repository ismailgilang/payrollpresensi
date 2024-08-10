@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="card">
         <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h4 class="card-title text-capitalize">form edit data</h4>
            <a href="{{ route('potongan.index') }}" class="nav-link text-capitalize text-muted">kembali</a>
         </div>
         <div class="card-body">
            <form action="{{ route('potongan.update', $potongan->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group my-3">
               <label for="jenisPotongan" class="text-capitalize">jenis potongan</label>
               <input type="text" name="jenisPotongan" id="jenisPotongan" class="form-control @error('jenisPotongan')
                   is-invalid
               @enderror" value="{{ $potongan->jenisPotongan }}" placeholder="Masukan jenis potongan">
               @error('jenisPotongan')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="form-group my-3">
               <label for="nilaiPotongan" class="text-capitalize">nilai potongan</label>
               <input type="text" name="nilaiPotongan" id="nilaiPotongan" class="form-control @error('nilaiPotongan')
                   is-invalid
               @enderror" value="{{ $potongan->nilaiPotongan }}" placeholder="Masukan nilai potongan">
               @error('nilaiPotongan')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="my-3">
               <button type="submit" class="btn btn-primary btn-sm text-capitalize float-end">simpan</button>
            </div>
         </form>
         </div>
      </div>
    </div>
@endsection