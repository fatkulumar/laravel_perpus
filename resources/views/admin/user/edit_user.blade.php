@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="m-0 text-white">
                        <strong>Edit User</strong>
                    </h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">

            <form class="mt-3" action="/admin/user/update/{{ $users->id }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input class="form-control" type="text" name="nis" value="{{ $users->nis }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="email">E Mail</label>
                    <input class="form-control" type="email" name="email" value="{{ $users->email }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input class="form-control" type="text" name="nama" value="{{ $users->name }}" required>
                </div>

                <div class="form-group">
                    <label for="id_kelas">Kelas</label>
                    <select class="form-control" name="id_kelas" id="" required>
                        <option value="">-Pilih Kelas</option>
                        @foreach ($kelass as $kelas)
                        <option value="{{ $kelas->id_kelas }}" <?php if ($kelas->id_kelas == $users->id_kelas){echo "selected";} ?>>{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div>

                <div class="form-group">
                    <label for="id_jurusan">jurusan</label>
                    <select class="form-control" name="id_jurusan" id="jurusan" required>
                        <option value="">-Pilih Jurusan-</option>
                        @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id_jurusan }}" <?php if($jurusan->id_jurusan == $users->id_jurusan){echo "selected";} ?>>{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_offering">Offering</label>
                    <select class="form-control" name="id_offering" id="" required>
                        <option value="">-Pilih Offering-</option>
                        @foreach ($offerings as $offering)
                        <option value="{{ $offering->id_offering }}" <?php if($offering->id_offering == $users->id_offering){echo "selected";} ?>>{{ $offering->nama_offering }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="edithUsers">Edit User</button>
                </div>
            </form>

        </div>
    </div>

</div>
    
@endsection