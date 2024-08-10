@extends('layouts.app')
@section('content')
    <div class="container">
      <x-alert></x-alert>
      <div class="card">
         <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="card-title text-capitalize">data jabatan</h4>
            <a href="{{ route('jabatan.create') }}" class="btn btn-sm btn-primary rounded-0 text-capitalize">tambah data</a>
         </div>
         <div class="card-body">
            <table class="table table-sm">
               <thead>
                  <tr>
                     <th class="text-capitalize">no</th>
                     <th class="text-capitalize">jabatan</th>
                     <th class="text-capitalize">gaji pokok</th>
                     <th class="text-capitalize">aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($jabatans as $index => $jabatan)
                  <tr>
                     <td>{{ $index + 1 }}</td>
                     <td>{{ ucwords($jabatan->jabatan) }}</td>
                     <td>Rp. {{ number_format($jabatan->gajiPokok) }}</td>
                     <td class="d-flex align-items-center gap-2">
                        <a href="{{ route('jabatan.edit',$jabatan->id) }}" class="btn btn-success btn-sm text-capitalize">edit</a>
                        <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"  onclick="return confirm('Hapus data ini ?')" class="btn btn-sm btn-danger text-capitalize">delete</button>
                        </form>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
    </div>
@endsection