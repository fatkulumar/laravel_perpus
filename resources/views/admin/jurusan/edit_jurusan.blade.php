@extends('admin.index_admin')

@section('content')
    
<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Edit Jurusan</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

        <form class="mt-3" action="/admin/jurusan/update/{{ $jurusans->id_jurusan }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <label for="nama_jurusan">Nama Jurusan</label>
            <input class="form-control" type="text" name="nama_jurusan" value="{{ $jurusans->nama_jurusan }}" required>
            </div>
            <div>
                <button class="btn btn-primary" type="submit" name="editJurusan">Edit Jurusan</button>
            </div>
        </form>

        </div>
    </div>

</div>

@endsection