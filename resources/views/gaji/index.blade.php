@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="card">
         <div class="card-header bg-white d-flex align-item-center justify-content-between">
            <h4 class="card-title text-capitalize">menu absensi</h4>
            @can('is_admin')
            <a href="{{ route('gaji.create') }}" class="btn btn-primary btn-sm text-capitalize rounded-0">rekap absensi</a>
            @endcan
         </div>
         <div class="card-body">
            <div class="row my-3">
               <form action="{{ route('gaji.index') }}" method="GET" class="d-flex gap-2">
                  <div class="col-3">
                     <select name="periode" id="periode" class="form-control">
                        <option value="">Pilih Periode</option>
                        @foreach ($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-3">
                     <button type="submit" class="btn btn-dark text-capitalize">filter</button>
                  </div>
               </form>
            </div>
            <div class="table-responsive">
               <h4 class="text-capitalize">data rekap </h4>
               <button class="btn btn-primary btn-sm text-capitalize" onclick="window.print()" >print laporan</button>
            <table class="table table-light table-striped mt-3">
               <thead class="table-primary">
                  <tr class="align-middle">
                     <th class="text-capitalize">no</th>
                     <th class="text-capitalize">karyawan</th>
                     <th class="text-capitalize">gaji pokok</th>
                     <th class="text-capitalize">periode</th>
                     <th class="text-capitalize">jml masuk</th>
                     <th class="text-capitalize">jml izin</th>
                     <th class="text-capitalize">potongan izin</th>
                     <th class="text-capitalize">jml sakit</th>
                     <th class="text-capitalize">potongan sakit</th>
                     <th class="text-capitalize">jml alfa</th>
                     <th class="text-capitalize">potongan alfa</th>
                     <th class="text-capitalize">jml cuti</th>
                     <th class="text-capitalize">potongan cuti</th>
                     <th class="text-uppercase">THP</th>
                     <th class="text-capitalize">Payslip</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($rekaps as $index => $rekap)
                  <tr>
                     <td>{{ $index + 1 }}</td>
                     <td>
                        <p class="m-0 p-0">{{ ucwords($rekap->karyawan) }}</p>
                        <p class="m-0 p-0 fst-italic text-muted">{{ ucwords($rekap->jabatan) }}</p>
                     </td>
                     <td>Rp. {{ number_format($rekap->gapok) }}</td>
                     <td>{{ ucwords($rekap->periode) }}</td>
                     <td>{{ number_format($rekap->masuk) }} Hari</td>
                     <td>{{ number_format($rekap->jmlIzin) }} Hari</td>
                     <td>Rp. {{ number_format($rekap->potonganIzin) }}</td>
                     <td>{{ number_format($rekap->jmlSakit) }} Hari</td>
                     <td>Rp. {{ $rekap->potonganSakit }}</td>
                     <td>{{ number_format($rekap->jmlAlfa) }} Hari</td>
                     <td>Rp. {{ number_format($rekap->potonganAlfa) }}</td>
                     <td>{{ number_format($rekap->jmlCuti) }} Hari</td>
                     <td>Rp. {{ number_format($rekap->potonganCuti) }}</td>
                     <td>Rp . {{ number_format($rekap->thp) }}</td>
                     <td>
                        <a href="{{ route('gaji.show', $rekap->id) }}" target="_blank" class="btn btn-success btn-sm text-capitalize">print</a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         </div>
       </div>
    </div>
@endsection