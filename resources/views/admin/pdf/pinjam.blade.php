<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Berdasarkan Kembali</title>

    <style>
        td {
            text-align: center;
        }
    </style>
</head>
<body>

    <div>
        <div style="float: left; width: 100px; position: relative">
            <img width="100px" src="{{ ("storage/fotoku/{$foto_instansi->nama_logo}") }}" alt="GRISA">
        </div>
        <div style="">
            <h1 style="text-align: center; line-height: 0.1%">LAPORAN PERPUSTAKAAN GRISA</h1>
            <h2 style="text-align: center; line-height: 5px">SMK PGRI 1 NGAWI</h2>
            <h5 style="text-align: center; line-height: 0.1%">Telp & fax (0351)746081 | Email : tatausahasmkpgri1ngawi@gmail.com</h5>
            <h5 style="text-align: center; line-height: 0.1%; margin-left: 15%">Homepage : www.smkpgri1ngawi.sch.id</h5>
        </div>
        <hr>
        <h3 style="text-align: center; line-height: 0.1%; margin-left: 16%">LAPORAN BERDASARKAN TANGGAL PINJAM</h3>

        <table border="1" class='table table-striped'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tanggal Pinjam</th>
                    <th>Harus Kembali</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Status Denda</th>
                    <th>Aksi</th>
                </tr>
            <thead>
        <tbody>
            <?php $no = 1 ?>
            @foreach ($kembalis as $kembali)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $kembali->nis }}</td>
                    <td>{{ $kembali->name }}</td>
                    <td>{{ $kembali->judul_buku }}</td>
                    <td>{{ $kembali->pengarang_buku }}</td>
                    <td>{{ $kembali->penerbit_buku }}</td>
                    <td>{{ $kembali->tgl_pinjam }}</td>
                    <td>{{ $kembali->tgl_harus_kembali }}</td>
                    <td>{{ $kembali->tgl_kembali }}</td>
                    <td>{{ $kembali->denda }}</td>
                    <td>
                        @if ($kembali->denda > 0 && $kembali->status_denda == null)
                            <span>Melunasi?</span>
                        @endif

                        @if ($kembali->status_denda == 1)
                            <span>Lunas</span> 
                        @endif

                    </td>
                    <td>
                        @if ($kembali->tgl_kembali == null)
                            <span>Menggembalikan?</span>
                        @else
                            <span>Dikembalikan</span>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</body>
</html>