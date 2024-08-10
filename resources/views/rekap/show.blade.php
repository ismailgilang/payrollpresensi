<table class="table table-sm">
   <thead>
      <tr>
         <th class="text-capitalize">no</th>
         <th class="text-capitalize">nama</th>
         <th class="text-capitalize">jabatan</th>
         <th class="text-capitalize">izin</th>
         <th class="text-capitalize">alfa</th>
         <th class="text-capitalize">sakit</th>
         <th class="text-capitalize">cuti</th>
         <th class="text-capitalize">aksi</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($karyawans as $index => $karyawan)
      <tr>
         <td>{{ $index + 1 }}</td>
         <td>{{ $karyawan->namakaryawan->name }}</td>
         <td>{{ $karyawan->namakaryawan->jabatan->jabatan }}</td>
         <td>{{ $karyawan->izin }}</td>
         <td>{{ $karyawan->alfa }}</td>
         <td>{{ $karyawan->sakit }}</td>
         <td>{{ $karyawan->cuti }}</td>
         <td>
            <button onclick="deleteData({{ $karyawan->id }})" class="btn btn-danger btn-sm text-capitalize rounded-0">hapus</button>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>