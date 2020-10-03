@extends('admin.index_admin')
@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('failed') }}
</div>
@endif

<div class="container">
<div class="card">
    
    <div class="card-header bg-primary">
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-white">
                <strong>Data Pinjam & Kembali</strong>
            </h1>
        </div>
    </div>
</div>

<div class="card-body">
    <div class="table table-responsive">

        <table id="table_pinjam_kembali" style="text-align: center" class='table table-striped'>
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
                    <!-- <th><input id="pilihsemua" onchange="checkAll(this)" name="chk[]" type="checkbox"></th> -->
                </tr>
            <thead>
        <tbody>
            <?php $no = 1 ?>
            @foreach ($pinjams as $pinjam)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $pinjam->nis }}</td>
                    <td>{{ $pinjam->name }}</td>
                    <td>{{ $pinjam->judul_buku }}</td>
                    <td>{{ $pinjam->pengarang_buku }}</td>
                    <td>{{ $pinjam->penerbit_buku }}</td>
                    <td>{{ $pinjam->tgl_pinjam }}</td>
                    <td>{{ $pinjam->tgl_harus_kembali }}</td>
                    <td>{{ $pinjam->tgl_kembali }}</td>
                    <td>{{ $pinjam->denda }}</td>
                    <td>
                        @if ($pinjam->denda > 0 && $pinjam->status_denda == null)
                            <a onclick="return confirm('{{ $pinjam->name }} Apakah Mau Melunasi ?')" class="btn btn-warning btn-sm" href="/admin/pinjam/status_denda/ {{ $pinjam->id_kembali }}">Melunasi?</a>
                        @endif

                        @if ($pinjam->status_denda == 1)
                            <button disabled class="btn btn-success btn-sm">Lunas</button> 
                        @endif

                    </td>
                    <td>
                        @if ($pinjam->tgl_kembali == null)
                            <a onclick="return confirm('{{ $pinjam->judul_buku }} Apakah Mau Di Kembalikan?')" class="btn btn-danger btn-sm" href="/admin/pinjam/kembali/{{ $pinjam->id_kembali }}">Menggembalikan?</a>
                        @else
                            <button disabled class="btn btn-primary btn-sm">Dikembalikan</button>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    </div>

</div>

<script>
    $(document).ready( function () {
        $('#table_pinjam_kembali').DataTable();
    });
</script>

@endsection