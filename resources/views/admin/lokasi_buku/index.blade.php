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
                    <strong>Data Lokasi Buku</strong>
                </h1>
            </div>
            <div class="col-md-6">
                <form action="../../../proses/proses.php" method="post" class="float-right">
                    <a class="btn btn-danger float-right btn-sm" href="/admin/lokasi_buku/create">(+) Tambah Lokasi Buku</a>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

            <table id="table_lokasi_buku" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lokasi Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($lokasi_bukus as $lokasi_buku)
                        
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $lokasi_buku->lokasi_buku }}</td>
                            <td>
                            <a onclick="return confirm('Yakin Menghapus {{ $lokasi_buku->lokasi_buku }}?')" class="btn btn-danger btn-sm" href="/admin/lokasi_buku/delete/{{ $lokasi_buku->id_lokasi_buku }}">Hapus</a> <a class="btn btn-primary btn-sm" href="/admin/lokasi_buku/edit/{{ $lokasi_buku->id_lokasi_buku }}">Edit</a>
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
        $('#table_lokasi_buku').DataTable();
    });
</script>

@endsection