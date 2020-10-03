@extends('admin.index_admin')
@section('content')

<div class="container">
    <div class="content">
        <div class="row mb-2">
            <div class="col-sm-6">
              
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <div style="margin-bottom: 5px;">
       
    </div>

    <div class="card">
        
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Edit Buku</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

        <form class="mt-3" action="/admin/buku/update/{{ $bukus->id_buku }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id_buku" value="{{ $bukus->id_buku }}">
                <div class="form-group">
                    <label for="kd_buku">Kode Buku</label>
                    <input class="form-control" type="text" name="kode_buku" value="{{ $bukus->kode_buku }}" required>
                </div>

                <div class="form-group">
                    <label for="id_lokasi_buku">Lokasi Buku</label>
                    <select class="form-control" name="id_lokasi_buku" id="">
                        @foreach ($buku_all as $item)
                        <option value="{{ $bukus->id_lokasi_buku }}" <?php if($bukus->id_lokasi_buku == $item->id_lokasi_buku) { echo "selected"; } ?>>{{ $item->id_lokasi_buku }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="judul_buku">Judul Buku</label>
                    <input class="form-control" type="text" name="judul_buku" value="{{ $bukus->judul_buku }}" required>
                </div>
                <div class="form-group">
                    <label for="pengarang_buku">Pengarang</label>
                    <input class="form-control" type="text" name="pengarang_buku" value="{{ $bukus->pengarang_buku }}" required>
                </div>
                <div class="form-group">
                    <label for="penerbit_buku">Penerbit</label>
                    <input class="form-control" type="text" name="penerbit_buku" value="{{ $bukus->penerbit_buku }}" required>
                </div>
                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input class="form-control" type="text" name="tahun_terbit" value="{{ $bukus->tahun_terbit }}" required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input class="form-control" type="text" name="stok" value="{{ $bukus->stok }}" required>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="editBuku">Edit Buku</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
    
@endsection