@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Edit Offering</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">

            <form action="/admin/offering/update/{{$offerings->id_offering}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="offering">Offering</label>
                    <input class="form-control" type="text" name="nama_offering" value="{{$offerings->nama_offering}}" required>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit" name="editOffering">Edit Offering</button>
                </div>
            </form>

        </div>
    </div>

</div>
    
@endsection