@extends('admin.index_admin')

@section('content')
    
<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Edit Kelas</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

        <form class="mt-3" action="/admin/kelas/update/{{$kelass->id_kelas}}" method="POST">
            @csrf
            @method('PATCH')
        <input type="hidden" name="id" value="{{$kelass->nama_kelas}}">
            <div class="form-group">
                <label for="nama_kelas">Kelas</label>
            <input class="form-control" type="text" name="nama_kelas" value="{{$kelass->nama_kelas}}" required>
            </div>
            <div>
                <button class="btn btn-primary" type="submit" name="editKelas">Edit Kelas</button>
            </div>
        </form>

        </div>
    </div>

</div>

@endsection