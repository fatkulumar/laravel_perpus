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
                    <strong>Data Jurusan</strong>
                </h1>
            </div>
            <div class="col-md-6">
                <form action="../../../proses/proses.php" method="post" class="float-right">
                    <a class="btn btn-danger float-right btn-sm" href="/admin/jurusan/create">(+) Tambah Jurusan</a>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">
    
            <table id="table_jurusan" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($jurusans as $jurusan)
                    @method('DELETE')
                        
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $jurusan->nama_jurusan }}</td>
                            <td>
                            <a onclick="return confirm('Yakin Hapus {{ $jurusan->nama_jurusan }}?')" class="btn btn-danger btn-sm" href="/admin/jurusan/delete/{{ $jurusan->id_jurusan }}">Hapus</a> <a class="btn btn-success btn-sm" href="/admin/jurusan/edit/{{ $jurusan->id_jurusan }}">Edit</a>
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
        $('#table_jurusan').DataTable();
    } );

</script>

@endsection