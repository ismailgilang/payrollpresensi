<!DOCTYPE html>
<html>
<head>
    <title>Payslip</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Payslip Karyawan Hotel Arimbi</h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Nama Karyawan</td>
                            <td>{{ $payslip->karyawan }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>{{ $payslip->jabatan }}</td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>{{ $payslip->periode }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Awal</td>
                            <td>{{ $payslip->tgl_awal }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Akhir</td>
                            <td>{{ $payslip->tgl_akhir }}</td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>Rp {{ number_format($payslip->gapok, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Masuk</td>
                            <td>{{ $payslip->masuk }} Hari</td>
                        </tr>
                        <tr>
                            <td>Jumlah Izin</td>
                            <td>{{ $payslip->jmlIzin }} Hari</td>
                        </tr>
                        <tr>
                            <td>Potongan Izin</td>
                            <td>Rp {{ number_format($payslip->potonganIzin, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Sakit</td>
                            <td>{{ $payslip->jmlSakit }} Hari</td>
                        </tr>
                        <tr>
                            <td>Potongan Sakit</td>
                            <td>Rp {{ number_format($payslip->potonganSakit, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Alfa</td>
                            <td>{{ $payslip->jmlAlfa }} Hari</td>
                        </tr>
                        <tr>
                            <td>Potongan Alfa</td>
                            <td>Rp {{ number_format($payslip->potonganAlfa, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Cuti</td>
                            <td>{{ $payslip->jmlCuti }} Hari</td>
                        </tr>
                        <tr>
                            <td>Potongan Cuti</td>
                            <td>Rp {{ number_format($payslip->potonganCuti, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Total Pendapatan</td>
                            <td>Rp {{ number_format($payslip->gapok + $payslip->masuk, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Total Potongan</td>
                            <td>Rp {{ number_format($payslip->potonganIzin + $payslip->potonganSakit + $payslip->potonganAlfa + $payslip->potonganCuti, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Take Home Pay</td>
                            <td>Rp {{ number_format($payslip->thp, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
<script>
   window.print()
</script>
</body>
</html>