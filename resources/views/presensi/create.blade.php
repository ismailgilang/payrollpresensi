@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="card">
         <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h4 class="card-title text-capitalize">form Presensi</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('presensi.index') }}" class="btn btn-danger">kembali</a>
                <a href="{{ route('cuti') }}" class="btn btn-primary">Cuti</a>
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
               @enderror"  readonly>
               @error('shift')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="form-group my-3">
               <label for="keterangan" class="text-capitalize">Keterangan</label>
               <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan')
                   is-invalid
               @enderror" value="Masuk"  readonly>
               @error('keterangan')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
            </div>

            <div class="form-group my-3" id="buktiSakitGroup" >
                <label for="bukti" class="text-capitalize">Bukti</label>
                <input type="file" name="bukti" id="bukti" class="form-control @error('bukti') is-invalid @enderror" require>
                @error('bukti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <p>Pilih Salah satu</p>
            <div class="form-group my-3">
                <label for="sakitCheckbox">
                    <input type="checkbox" id="sakitCheckbox"> Sakit
                </label>
            </div>
            <div class="form-group my-3">
                <label for="izinCheckbox">
                    <input type="checkbox" id="izinCheckbox"> Izin
                </label>
            </div>
            <div class="my-3">
                <button type="submit" id="shiftButton" class="btn btn-primary btn-sm text-capitalize float-end" style="display: none;">simpan</button>
            </div>
         </form>
         </div>
      </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var now = new Date();
            var currentHour = now.getHours();
            var shift = 'telat';

            if (currentHour >= 7 && currentHour < 9) {
                shift = 'pagi';
            } else if (currentHour >= 11 && currentHour < 13) {
                shift = 'siang';
            } else if (currentHour >= 17 && currentHour < 19) {
                shift = 'malam';
            }

            // Masukkan nilai shift ke dalam input
            document.getElementById('shift').value = shift;
        });

        document.addEventListener('DOMContentLoaded', function() {
            var now = new Date();
            var currentHour = now.getHours();
            var shiftButton = document.getElementById('shiftButton');

            // Cek apakah waktu saat ini berada dalam jam shift
            if ((currentHour >= 7 && currentHour < 9) || 
                (currentHour >= 11 && currentHour < 13) || 
                (currentHour >= 17 && currentHour < 19)) {
                // Tampilkan tombol
                shiftButton.style.display = 'block';
            } else {
                // Sembunyikan tombol
                shiftButton.style.display = 'none';
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('sakitCheckbox');
            var keteranganInput = document.getElementById('keterangan');
            var submitButton = document.getElementById('shiftButton');

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    keteranganInput.value = 'Sakit'; // Mengisi keterangan dengan 'sakit'
                    submitButton.style.display = 'block'; 
                } else {
                    keteranganInput.value = 'Masuk'; // Kosongkan keterangan jika checkbox tidak dicentang
                    submitButton.style.display = 'none';      // Menyembunyikan tombol submit
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('izinCheckbox');
            var keteranganInput = document.getElementById('keterangan');
            var submitButton = document.getElementById('shiftButton');

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    keteranganInput.value = 'Izin'; // Mengisi keterangan dengan 'sakit'
                    submitButton.style.display = 'block'; 
                } else {
                    keteranganInput.value = 'Masuk'; // Kosongkan keterangan jika checkbox tidak dicentang
                    submitButton.style.display = 'none';      // Menyembunyikan tombol submit
                }
            });
        });
    </script>
@endsection