@extends('user.index_user')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('failed') }}
</div>
@endif

<div class="container">
    <div class="card">
    
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="m-0 text-white">
                        <strong>Profil</strong>
                    </h1>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-danger float-right btn-sm mt-2" href="/user/profil/edit/{{ $id }}">Edit</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">
            
            <div class="card">
                <div class="card-body">
                    
            <div class="row">
                <div class="col-md-6"> 
                    <img style="margin-left: 60px" width="70%" class="" src="{{ Storage::url('fotoku/') }}{{$profils->fotoku}}" class="elevation-1" alt="User Image"></div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $name }}</td>
                                </tr>
                                
                                <tr>
                                    <td>E Mail</td>
                                    <td>{{ $email }}</td>
                                </tr>

                                <tr>
                                    <td>Kelas</td>
                                    <td>{{ $data_users->nama_kelas }}</td>
                                </tr>

                                <tr>
                                    <td>Jurusan</td>
                                    <td>{{ $data_users->nama_jurusan }}</td>
                                </tr>

                                <tr>
                                    <td>Offering</td>
                                    <td>{{ $data_users->nama_offering }}</td>
                                </tr>

                                {{-- <tr>
                                    <td>Offering</td>
                                    <td>{{ $data_users->fotoku }}</td>
                                </tr> --}}
                                
                            </table>
                        </div>
                </div>
            </div>

            </div>
            </div>
        </div>
        </div>

    </div>
</div>

    
@endsection