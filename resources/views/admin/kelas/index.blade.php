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
                    <strong>Data Kelas</strong>
                </h1>
            </div>
            <div class="col-md-6">
                <form action="../../../proses/proses.php" method="post" class="float-right">
                    <a class="btn btn-danger float-right btn-sm" href="/admin/kelas/create">(+) Tambah Kelas</a>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">
    
        <table id="table_kelas" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                @foreach ($kelass as $kelas)
                    
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>
                            <a onclick="return confirm('Yakin Hapus {{$kelas->nama_kelas}}?')" class="btn btn-danger btn-sm" href="/admin/kelas/delete/{{$kelas->id_kelas}}">Hapus</a> <a class="btn btn-success btn-sm" href="/admin/kelas/edit/{{$kelas->id_kelas}}">Edit</a>
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
        $('#table_kelas').DataTable();
    } );

</script>

@endsection