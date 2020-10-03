@extends('admin.index_admin')

@section('content')
    
<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Tambah Kelas</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

            <form class="mt-3" action="/admin/kelas/insert" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_kelas">Kelas</label>
                    <input class="form-control" type="text" name="nama_kelas" placeholder="10, 11, 12" required>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="tambahKelas">Tambah Kelas</button>
                </div>
            </form>

        </div>
    </div>

</div>


@endsection