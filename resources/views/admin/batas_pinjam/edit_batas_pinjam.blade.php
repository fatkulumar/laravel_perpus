@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="m-0 text-white">
                        <strong>Batas Pinjam</strong>
                    </h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">

                <form action="/admin/pinjam/batas/update/{{ $foto_instansi->id_admin }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="batas_pinjam_buku">Stok</label>
                        <input class="form-control" type="text" name="batas_pinjam_buku" value="{{ $foto_instansi->batas_pinjam_buku }}" required>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit" name="editBatasPinjamBuku">Edit Batas Pinjam</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

    
@endsection