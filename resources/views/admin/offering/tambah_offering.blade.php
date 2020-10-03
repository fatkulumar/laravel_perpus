@extends('admin.index_admin')

@section('content')

<div class="container">
    <div class="card">
        
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="m-0 text-white">
                        <strong>Tambah offering</strong>
                    </h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table table-responsive">
        
                <form action="/admin/offering/insert" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_offering">Offering</label>
                        <input class="form-control" type="text" name="nama_offering" placeholder="A, B, C" required>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit" name="tambahOffering">Tambah Offering</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection