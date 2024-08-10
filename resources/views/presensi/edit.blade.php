@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                <h4 class="card-title text-capitalize">Edit Presensi</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('presensi.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('presensi.update', $presensi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group my-3">
                        <label for="name" class="text-capitalize">Nama</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $presensi->name }}" readonly>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="nip" class="text-capitalize">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ $presensi->nip }}" readonly>
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="shift" class="text-capitalize">Shift</label>
                        <input type="text" name="shift" id="shift" class="form-control @error('shift') is-invalid @enderror" value="{{ $presensi->shift }}" readonly>
                        @error('shift')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="keterangan" class="text-capitalize">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ $presensi->keterangan }}">
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="keterangan2" class="text-capitalize">Keterangan Lanjutan</label>
                        <input type="text" name="keterangan2" id="keterangan2" class="form-control @error('keterangan2') is-invalid @enderror" value="{{ $presensi->keterangan2 }}">
                        @error('keterangan2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="bukti" class="text-capitalize">Bukti</label>
                        <input type="file" name="bukti" id="bukti" class="form-control @error('bukti') is-invalid @enderror">
                        @if($presensi->bukti)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $presensi->bukti) }}" target="_blank">Lihat Bukti</a>
                            </div>
                        @endif
                        @error('bukti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <button type="submit" class="btn btn-primary btn-sm text-capitalize float-end">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
