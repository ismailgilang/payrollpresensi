@extends('layouts.app')
@section('content')
    <div class="container">
      <x-alert></x-alert>
      <div class="card px-3">
         <form action="{{ route('rekap.store') }}" method="POST">
         @csrf
         <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h4 class="card-title text-capitalize">rekap absensi</h4>
            <button type="submit" class="btn btn-primary btn-sm text-capitalize rounded-0">simpan</button>
         </div>
         <div class="card-body">
            <div class="row align-items-end justify-content-between">
               <h4 class="text-capitalize mb-3">periode</h4>
               <div class="col-12 col-lg-3">
                  <div class="form-group">
                     <label for="tgl_awal" class="text-capitalize">tanggal awal</label>
                     <input type="date" name="tgl_awal" id="tgl_awal" class="form-control @error('tgl_awal')
                         is-invalid
                     @enderror" value="{{ old('tgl_awal') }}">
                     @error('tgl_awal')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
               <div class="col-12 col-lg-3">
                  <div class="form-group">
                     <label for="tgl_akhir" class="text-capitalize">tanggal akhir</label>
                     <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control @error('tgl_akhir')
                         is-invalid
                     @enderror" value="{{ old('tgl_akhir') }}">
                     @error('tgl_akhir')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
               <div class="col-12 col-lg-3">
                  <div class="form-group">
                     <label for="periode" class="text-capitalize">periode</label>
                     <select name="periode" id="periode" onchange="getPeriode(this)" class="form-control @error('periode')
                         is-invalid
                     @enderror">
                        <option value="">Pilih Periode</option>
                        @foreach ($months as $month)
                        <option value="{{ $month }}" {{ (old('periode') == $month ) ? 'selected' : '' }} >{{ $month }}</option>
                        @endforeach
                     </select>
                     @error('periode')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
         </div>
         </form>
            <div class="row mt-4 align-items-end py-2">
               <h4 class="text-capitalize mb-3">data karyawan</h4>
               <form id="rekapform" action="{{ route('rekap.add') }}" method="POST" class="d-flex w-100 align-items-end justify-content-between">
                  <div id="karyawan" class="col-2"></div>
                  <input type="hidden" name="karyawanId" id="karyawanId">
                  <div class="col-1">
                     <label for="izin" class="text-capitalize">izin</label>
                     <input type="number" name="izin" id="izin" class="form-control" placeholder="izin" required min="0">
                  </div>
                  <div class="col-1">
                     <label for="alfa" class="text-capitalize">alfa</label>
                     <input type="number" name="alfa" id="alfa" class="form-control" placeholder="alfa" required min="0">
                  </div>
                  <div class="col-1">
                     <label for="sakit" class="text-capitalize">sakit</label>
                     <input type="number" name="sakit" id="sakit" class="form-control" placeholder="sakit" required min="0">
                  </div>
                  <div class="col-1">
                     <label for="cuti" class="text-capitalize">cuti</label>
                     <input type="number" name="cuti" id="cuti" class="form-control" placeholder="cuti" required min="0">
                  </div>
                  <div class="col-2">
                     <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
                     <button type="submit" class="btn btn-dark btn-sm text-capitalize rounded-0 col-12">add</button>
                  </div>
               </form>
            </div>

            <div class="row mt-5">
               <h4 class="text-capitalize mb-3">data absensi</h4>
               <div id="data"></div>
            </div>

         </div>
      </div>
    </div>
@endsection
@push('js')
<script>
   function showRekap(periode){
      $.ajax({
         type: "GET",
         url: "{{ route('rekap.show') }}",
         success: function(html, response) {
            $("#data").html(html);
         }
      });
   }

   function deleteData (id) {
      $.ajax({
         type: "GET",
         url: "{{ route('rekap.delete') }}",
         data: {
            id:id
         },
         success: function (response) {
            showRekap()
            dataKaryawan()

         }
      });
   }

   function dataKaryawan(periode){
      $.ajax({
         type: "GET",
         url: "{{ route('rekap.datakaryawan') }}",
         data:{
            periode : periode
         },
         success: function (response) {
            $("#karyawan").html(response);
         },
      });
   }

   function getValue(select){
      let karyawan = select.value
      let karyawanId = $("#karyawanId").val(karyawan);
   }

   function getPeriode(select) {
      let periode = select.value
      dataKaryawan(periode)
      // dataKaryawan(periode)
   }


   $(document).ready(function () {

      showRekap()
      dataKaryawan()
      $("#rekapform").submit(function (e) { 
         e.preventDefault();
         console.log($("#karyawan").val());
         let token = $("#token").val();
         let karyawan = $("#karyawanId").val();
         let izin = $("#izin").val();
         let alfa = $("#alfa").val();
         let sakit = $("#sakit").val();
         let cuti = $("#cuti").val();
         $.ajax({
            type: "POST",
            url: "{{ route('rekap.add') }}",
            data: {
               _token: token,
               karyawan : karyawan,
               izin : izin,
               alfa : alfa,
               sakit : sakit,
               cuti : cuti,
            },
            success: function (response) {
               showRekap()
               dataKaryawan()
               $("#karyawan").val("");
               $("#izin").val("");
               $("#alfa").val("");
               $("#sakit").val("");
               $("#cuti").val("");
            }
         });
      });
   });
</script>
@endpush