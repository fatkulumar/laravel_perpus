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
                        <strong>Batas Pinjam</strong>
                    </h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-danger float-right btn-sm" href="/admin/pinjam/batas/edit/{{ $foto_instansi->id_admin }}">Edit Batas Pinjam</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">

                <table id="table_batas" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Batas Pinjam</td>
                            <td>Keterangan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                            
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $foto_instansi->batas_pinjam_buku }}</td>
                                <td>Hari</td>
                            </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

<script>

    $(document).ready( function () {
        $('#table_batas').DataTable();
    } );

</script>


@endsection