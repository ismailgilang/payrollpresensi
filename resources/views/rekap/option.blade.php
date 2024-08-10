<div class="col-12">
   <div class="form-group">
      <label for="karyawan" class="text-capitalize">nama karyawan</label>
      <select name="karyawan" id="karyawan" class="form-control" onchange="getValue(this)" required>
         <option value="">Pilih Karyawan</option>
         @foreach ($karyawans as $karyawan)
         <option value="{{ $karyawan->id }}">{{ ucwords($karyawan->name) }}</option>
         @endforeach
      </select>
   </div>
</div>