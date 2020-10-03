@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="content">
        <div class="row mb-2">
            <div class="col-sm-6">
              
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <div class="card">
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Tambah Lokasi Buku</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

            <form class="mt-3" action="/admin/lokasi_buku/insert" method="POST">
                @csrf
                <div class="form-group">
                    <label for="lokasi_buku">Lokasi Buku</label>
                    <input class="form-control" type="text" name="lokasi_buku" required>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="tambahLokasiBuku">Tambah Lokasi Buku</button>
                </div>
            </form>

        </div>
    </div>
    </div>
</div>

@endsection