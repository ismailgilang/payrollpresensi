@extends('layouts.app')
@section('content')
    <div class="container">
      <x-alert></x-alert>
      <div class="card">
         <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="card-title text-capitalize">data presensi</h4>
            @if($user->role_id == 2 || $user->role_id == 1)
            @if($presensiHariIni->isNotEmpty())
                <p>Anda sudah melakukan presensi</p>
            @else
                <a href="{{ route('presensi.create') }}" class="btn btn-primary btn-sm text-capitalize rounded-0">Mulai absen</a>
            @endif
            @endif
         </div>
         <div class="card-body">
            <table class="table table-sm">
               <thead>
                  <tr>
                     <th class="text-capitalize">no</th>
                     <th class="text-capitalize">Nama</th>
                     <th class="text-capitalize">NIP</th>
                     <th class="text-capitalize">Shift</th>
                     <th class="text-capitalize">Keterangan</th>
                     <th class="text-capitalize">Keterangan Lanjutan</th>
                     <th class="text-capitalize">Bukti</th>
                     <th class="text-capitalize">aksi</th>
                  </tr>
               </thead>
               <tbody>
               @foreach ($data as $index => $presensi)
               <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{$presensi->name}}</td>
                  <td>{{$presensi->nip}}</td>
                  <td>{{$presensi->shift}}</td>
                  <td>{{$presensi->keterangan}}</td>
                  <td>
                    @if(!empty($presensi->keterangan2))
                        {{ $presensi->keterangan2 }}
                    @else
                        <a href="{{ route('pulang', $presensi->id) }}" class="btn btn-success">Presensi Pulang</a>
                    @endif
                  </td>
                  <td>
                    @if(isset($presensi->bukti))
                    <img src="{{asset('storage/'. $presensi->bukti)}}" alt="foto" style="width:100px">
                    @else
                    <p>Tidak Perlu ada lampiran</p>
                    @endif
                </td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('presensi.edit',$presensi->id) }}" class="btn btn-success btn-sm text-capitalize">edit</a>
                     <form action="{{ route('presensi.destroy',$presensi->id) }}" method="POST">
                     @csrf
                     @method('delete')
                     <button onclick="return confirm('Hapus data ini ?')" type="submit" class="btn btn-danger btn-sm text-capitalize">delete</button>
                     </form>
                    </div>
                  </td>
               </tr>
               @endforeach
               </tbody>
            </table>
         </div>
      </div>
    </div>
@endsection