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
                <strong>Data User</strong>
            </h1>
        </div>
        {{-- <div class="col-md-6">
            <a class="btn btn-danger float-right btn-sm" href="/admin/user/create">(+) Tambah User</a>
        </div> --}}
    </div>
</div>

<div class="card-body">
    <div class="table table-responsive">

        <table id="table_user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>E Mail</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Offering</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                @foreach ($users as $user)
                    
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $user->nis }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->nama_kelas }}</td>
                    <td>{{ $user->nama_jurusan }}</td>
                    <td>{{ $user->nama_offering }}</td>
                    {{-- <td>
                        <a class="btn btn-danger btn-sm" href="/admin/user/delete/{{ $user->id }}">Hapus</a> <a class="btn btn-primary btn-sm" href="/admin/user/edit/{{ $user->id }}">Edit</a>
                    </td> --}}

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
        $('#table_user').DataTable();
    });
</script>


@endsection