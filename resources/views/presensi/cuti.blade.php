@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="card">
         <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h4 class="card-title text-capitalize">form Presensi</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('presensi.index') }}" class="btn btn-danger">kembali</a>
                <a href="{{ route('presensi.create') }}" class="btn btn-primary">Presensi</a>
            </div>
         </div>
         <div class="card-body">
            <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group my-3">
               <label for="name" class="text-capitalize">Nama</label>
               <input type="text" name="name" id="name" class="form-control @error('name')
                   is-invalid
               @enderror" value="{{$user->name}}" readonly>
               @error('name')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="form-group my-3">
               <label for="nip" class="text-capitalize">NIP</label>
               <input type="text" name="nip" id="nip" class="form-control @error('nip')
                   is-invalid
               @enderror" value="{{ $user->nip }}" readonly>
               @error('nip')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="form-group my-3">
               <label for="shift" class="text-capitalize">Shift</label>
               <input type="text" name="shift" id="shift" class="form-control @error('shift')
                   is-invalid
               @enderror" value="Cuti"  readonly>
               @error('shift')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="form-group my-3">
                <label for="keterangan" class="text-capitalize">Keterangan</label>
                <select name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                    <option selected> -- Pilih durasi --</option>
                    <option value="1 Hari">1 Hari</option>
                    <option value="2 Hari">2 Hari</option>
                    <option value="3 Hari">3 Hari</option>
                    <option value="4 Hari">4 Hari</option>
                    <option value="5 Hari">5 Hari</option>
                    <option value="6 Hari">6 Hari</option>
                    <option value="7 Hari">7 Hari</option>
                </select>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group my-3">
               <label for="keterangan2" class="text-capitalize">Keterangan Lanjutan</label>
               <input type="text" name="keterangan2" id="keterangan2" class="form-control @error('keterangan2')
                   is-invalid
               @enderror">
               @error('keterangan2')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="form-group my-3">
               <label for="bukti" class="text-capitalize">Bukti Perizinan cuti</label>
               <input type="file" name="bukti" id="bukti" class="form-control @error('bukti')
                   is-invalid
               @enderror">
               @error('bukti')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="my-3">
                <button type="submit" id="shiftButton" class="btn btn-primary btn-sm text-capitalize float-end">simpan</button>
            </div>
         </form>
         </div>
      </div>
    </div>
@endsection