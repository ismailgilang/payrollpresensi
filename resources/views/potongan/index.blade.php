@extends('layouts.app')
@section('content')
    <div class="container">
      <x-alert></x-alert>
      <div class="card">
         <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="card-title text-capitalize">data potongan</h4>
            <a href="{{ route('potongan.create') }}" class="btn btn-primary btn-sm text-capitalize rounded-0">tambah data</a>
         </div>
         <div class="card-body">
            <table class="table table-sm">
               <thead>
                  <tr>
                     <th class="text-capitalize">no</th>
                     <th class="text-capitalize">jenis potongan</th>
                     <th class="text-capitalize">nilai potongan</th>
                     <th class="text-capitalize">aksi</th>
                  </tr>
               </thead>
               <tbody>
               @foreach ($potongans as $index => $potongan)
               <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ ucwords($potongan->jenisPotongan) }}</td>
                  <td>Rp. {{ number_format($potongan->nilaiPotongan) }}</td>
                  <td class="d-flex align-items-center gap-2">
                     <a href="{{ route('potongan.edit',$potongan->id) }}" class="btn btn-success btn-sm text-capitalize">edit</a>
                     <form action="{{ route('potongan.destroy',$potongan->id) }}" method="POST">
                     @csrf
                     @method('delete')
                     <button onclick="return confirm('Hapus data ini ?')" type="submit" class="btn btn-danger btn-sm text-capitalize">delete</button>
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