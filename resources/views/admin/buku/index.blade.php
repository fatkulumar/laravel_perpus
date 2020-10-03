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
    <div class="content">
        <div class="row mb-2">
            <div class="col-sm-6">
              
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <div style="margin-bottom: 5px;">
       
    </div>

    <div class="card">
        
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Data Buku</strong>
                </h1>
            </div>
            <div class="col-md-6">
                <form action="../../../proses/proses.php" method="post" class="float-right">
                    <a class="btn btn-danger float-right btn-sm" href="/admin/buku/create">(+) Tambah Buku</a>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <!-- <input class="form-control" style="float: right" type="text" name="search_buku" id="search_buku" placeholder="Cari Buku" autocomplete="off"> -->
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success btn-sm" type="submit" name="bukuReport">Laporan Buku</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">
            <table id="table_buku" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lokasi Buku</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Stok</th>
                        <th width="90" style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tampil">
                    <?php $no = 1 ?>
                    @foreach ($bukus as $buku)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $buku->id_lokasi_buku }}</td>
                            <td>{{ $buku->kode_buku }}</td>
                            <td>{{ $buku->judul_buku }}</td>
                            <td>{{ $buku->pengarang_buku }}</td>
                            <td>{{ $buku->penerbit_buku }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ $buku->stok }}</td>
                            <td>
                            <a class="btn btn-success btn-sm" href="/admin/buku/edit/{{ $buku->id_buku }}">Edit</a> <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah Ingin Menghapus {{ $buku->judul_buku }} ?')" href="/admin/buku/delete/{{ $buku->id_buku }}">Hapus</a>
                            </td>
                            
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

    $(document).ready( function () {
        $('#table_buku').DataTable();
    } );

</script>

@endsection