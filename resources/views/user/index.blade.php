@extends('layouts.app')
@section('content')
   <div class="container">
      <x-alert></x-alert>
      <div class="card">
         <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h4 class="text-capitalize card-title">data karyawan</h4>
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm text-capitalize rounded-0">create data</a>
         </div>
         <div class="card-body">
            <table class="table table-sm">
               <thead>
                  <tr>
                     <th class="text-capitalize">no</th>
                     <th class="text-capitalize">name</th>
                     <th class="text-capitalize">email</th>
                     <th class="text-capitalize">role</th>
                     <th class="text-capitalize">jabatan</th>
                     <th class="text-capitalize">aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $index => $user)
                  <tr>
                     <td>{{ $index + 1 }}</td>
                     <td>{{ ucwords($user->name) }}</td>
                     <td>{{ $user->email }}</td>
                     <td>{{ $user->role->role }}</td>
                     <td>{{ $user->jabatan_id }}</td>
                     <td class="d-flex align-items-center gap-2">
                        <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success btn-sm text-capitalize">edit</a>
                        <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Hapus data ini ?')" class="btn btn-danger text-capitalize btn-sm">delete</button>
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