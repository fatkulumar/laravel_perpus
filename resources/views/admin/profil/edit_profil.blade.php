@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="card">
    
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="m-0 text-white">
                        <strong>Edit Profil</strong>
                    </h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">

            <form action="/admin/profil/update/{{ $id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Nama</label>
                    <input class="form-control" type="text" name="name" value="{{ $name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fotoku">Fotoku</label>
                        <input class="form-control" accept="image/" onchange="loadFile(event)" type="file" name="fotoku">
                    </div>

                    <!-- image preview -->
                    <div class="form-group">
                        <img src="{{ Storage::url('fotoku/') }}{{ $profils->fotoku }}" class="from-control" id="output" height="150" width="150">
                    </div>

                    	<!-- Javascript -->
                    <script type="text/javascript">
                        var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>

                    <div>
                        <button class="btn btn-primary" type="submit" name="editProfil">Edit Profil</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

    
@endsection