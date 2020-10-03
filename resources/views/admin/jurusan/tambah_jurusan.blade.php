@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Tambah Jurusan</strong>
                </h1>
            </div>
            <div class="col-md-6">
                <a class="btn btn-danger float-right btn-sm" href="/admin/jurusan/tambah">(+) Tambah Jurusan</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

            <form class="mt-3" action="/admin/jurusan/insert" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_jurusan">Nama Jurusan</label>
                    <input class="form-control" type="text" name="nama_jurusan" required>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="tambahJurusan">Tambah Jurusan</button>
                </div>
            </form>

        </div>
    </div>
    </div>

</div>

@endsection