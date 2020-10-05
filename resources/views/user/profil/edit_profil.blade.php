@extends('user.index_user')

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

            <form action="/user/profil/update/{{ $data_users->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Nama</label>
                    <input class="form-control" type="text" name="name" value="{{ $name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E Mail</label>
                        <input class="form-control" type="text" name="email" value="{{ $email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control" name="id_kelas" id="">
                            <option value="">-Pilih Kelas-</option>
                            @foreach ($kelass as $kelas)
                                <option value="{{ $kelas->id_kelas }}" <?php if ($kelas->id_kelas == $data_users->id_kelas) {
                                    echo "selected";
                                } ?>>{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_jurusan">Jurusan</label>
                        <select class="form-control" name="id_jurusan" id="">
                            <option value="">-Pilih Jurusan-</option>
                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id_jurusan }}" <?php if ($jurusan->id_jurusan == $data_users->id_jurusan) {
                                    echo "selected";
                                } ?>>{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_offering">Offering</label>
                        <select class="form-control" name="id_offering" id="">
                            <option value="">-Pilih Offering-</option>
                            @foreach ($offerings as $offering)
                                <option value="{{ $offering->id_offering }}" <?php if ($offering->id_offering == $data_users->id_offering) {
                                    echo "selected";
                                } ?>>{{ $offering->nama_offering }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fotoku">Fotoku</label>
                        <input class="form-control" accept="image/" onchange="loadFile(event)" type="file" name="fotoku" value="" required>
                    </div>

                    <!-- image preview -->
                    <div class="form-group">
                        <img src="{{ Storage::url('fotoku/') }}{{ $fotoku }}" class="from-control" id="output" height="150" width="150">
                    </div>

                    	<!-- Javascript -->
                    <script type="text/javascript">
                        var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>

                    <div>
                        <button class="btn btn-primary" type="submit" name="editProfil">Edit Offering</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

    
@endsection