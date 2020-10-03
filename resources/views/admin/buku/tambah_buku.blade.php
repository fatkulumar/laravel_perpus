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
                    <strong>Tambah Buku</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

            <form class="mt-3 mb-3" action="/admin/buku/insert" method="POST">
                @csrf

                @if($errors->has('kode_buku'))
                    <div class="text-danger">
                        {{ $errors->first('kode_buku')}}
                    </div>
                @endif

                <div class="form-group">
                    <label for="kode_buku">Kode Buku</label>
                    <input class="form-control @error('kode_buku') is-invalid @enderror" type="text" name="kode_buku" required>
                </div>

                @error('kode_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="judul_buku">Judul Buku</label>
                    <input class="form-control" type="text" name="judul_buku" required>
                </div>

                <div class="form-group">
                    <label for="id_lokasi_buku">Lokasi Buku</label>
                    <select class="form-control" name="id_lokasi_buku" id="">
                        <option value="">-Pilih Lokasi-</option>
                        @foreach ($lokasi_bukus as $item)
                            <option value="{{ $item->id_lokasi_buku }}">{{ $item->lokasi_buku }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="pengarang">Pengarang</label>
                    <input class="form-control" type="text" name="pengarang_buku" required>
                </div>

                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input class="form-control" type="text" name="penerbit_buku" required>
                </div>

                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input class="form-control" type="text" name="tahun_terbit"  required>
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input class="form-control" type="text" name="stok"  required>
                </div>

                <div>
                    <button class="btn btn-primary" type="submit" name="tambah_buku">Tambah Buku</button>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>

@endsection