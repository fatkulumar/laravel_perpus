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
                <strong>Data Offering</strong>
            </h1>
        </div>
        <div class="col-md-6">
            <a class="btn btn-danger float-right btn-sm" href="/admin/offering/create">(+) Tambah Offering</a>
        </div>
    </div>
</div>

<div class="card-body">
    <div class="table table-responsive">
        <table id="table_offering" class="table table-striped mb-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Offering</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1  ?>
                @foreach ($offerings as $offering)
                    
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{$offering->nama_offering}}</td>
                        <td>
                            <a onclick="return confirm('Yakin Hapus {{$offering->nama_offering}}?')" class="btn btn-danger btn-sm" href="/admin/offering/delete/{{$offering->id_offering}}">Hapus</a> <a class="btn btn-success btn-sm" href="/admin/offering/edit/{{$offering->id_offering}}">Edit</a>
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
        $('#table_offering').DataTable();
    });
</script>
@endsection