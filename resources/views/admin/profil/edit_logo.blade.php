@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="card">
    
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="m-0 text-white">
                        <strong>Edit Profil Logo</strong>
                    </h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">

                <form action="/admin/profil/logo/update/{{ $id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group">
                        <label for="nama_instansi">Nama Instantsi</label>
                        <input class="form-control" type="text" name="nama_instansi" value="{{ $foto_instansi->nama_instansi }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_logo">Logo</label>
                        <input class="form-control" accept="image/" onchange="loadFileLogo(event)" type="file" name="nama_logo" value="">
                    </div>

                    <!-- image preview -->
                    <div class="form-group">
                        <img src="{{ Storage::url('fotoku/') }}{{ $foto_instansi->nama_logo }}" class="from-control" id="output_logo" height="150" width="150">
                    </div>

                        <!-- Javascript -->
                    <script type="text/javascript">
                        var loadFileLogo = function(event) {
                        var output_logo = document.getElementById('output_logo');
                        output_logo.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>

                    <div>
                        <button class="btn btn-primary" type="submit" name="editProfilLogo">Edit Offering</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

    
@endsection