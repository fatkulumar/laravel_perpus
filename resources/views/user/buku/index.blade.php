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
                    <strong>Data Buku</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table table-responsive">
            <table id="table_buku" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lokasi Buku</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($bukus as $buku)
                        <tr onclick="buku({{ $buku->id_buku }})">
                            <td>{{ $no++ }}</td>
                            <td>{{ $buku->id_lokasi_buku }}</td>
                            <td>{{ $buku->kode_buku }}</td>
                            <td>{{ $buku->judul_buku }}</td>
                            <td>{{ $buku->pengarang_buku }}</td>
                            <td>{{ $buku->penerbit_buku }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ $buku->stok }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

  
  <!-- Modal -->
  <div class="modal fade" id="bukuModal" tabindex="-1" role="dialog" aria-labelledby="bukuModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bukuModalTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <input class='form-control' type='hidden' name='id_buku' id='id_buku' value='' readonly>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='nis'>NIS</label>
                            <input class='form-control' type='text' name='nis' id='nis' value='' readonly>
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='kd_buku'>Kode Buku</label>
                            <input class='form-control' type='text' name='kd_buku' id='kode_buku' value='' readonly>
                        </div>
                    </div>
                    
                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='nama_anggota'>Nama</label>
                            <input class='form-control' type='text' name='nama_anggota' id='nama_anggota' value='' readonly>
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='judul_buku'>Judul Buku</label>
                            <input class='form-control' type='text' name='judul_buku' id='judul_buku' value='' readonly>
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='pengarang'>Pengarang</label>
                            <input class='form-control' type='text' name='pengarang' id='pengarang_buku' value='' readonly>
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='tahun_terbit'>Tahun Terbit</label>
                            <input class='form-control' type='text' name='tahun_terbit' id='tahun_terbit' value='' readonly>
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='tgl_pinjam'>Tanggal Pinjam</label>
                            <input class='form-control' type='text' name='tgl_pinjam' id='tgl_pinjam' value='' readonly>
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <div class='form-group'>
                            <label for='tgl_kembali'>Harus Kembali</label>
                            <input class='form-control' type='text' name='tgl_kembali' id='tgl_kembali' value='' readonly>
                        </div>
                    </div>
                    
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button onclick="pinjam()" type="button" class="btn btn-primary">Pinjam</button>
        </div>
      </div>
    </div>
  </div>

<script>

    $(document).ready( function () {
        $('#table_buku').DataTable();
    });

    function buku(id)
    {
        $.ajax({
            url : '/user/buku/ajax/'+id,
            type : 'GET',
            dataType : 'JSON',
            success : function(data) {
                $("#bukuModal").modal()
                $('#nis').val(data.nis)
                $('#nama_anggota').val(data.name)
                $('#id_buku').val(data.bukus.id_buku)
                $('#kode_buku').val(data.bukus.kode_buku)
                $('#judul_buku').val(data.bukus.judul_buku)
                $('#pengarang_buku').val(data.bukus.pengarang_buku)
                $('#penerbit_buku').val(data.bukus.penerbit_buku)
                $('#tahun_terbit').val(data.bukus.tahun_terbit)
                $('#tgl_pinjam').val(data.tanggal_sekarang)
                $('#tgl_kembali').val(data.tanggal_kembali)
                $('#selisih_tanggal').val(data.selsih_tanggal)
            }
        })
    }

    function pinjam()
    {
        var id_buku = $('#id_buku').val()
        var nis = $('#nis').val()
        $.ajax({
            url : 'buku/ajax/pinjam/'+id_buku,
            type : 'GET',
            dataType :'JSON',
            success : function(data) {
                window.location = 'http://127.0.0.1:8000/user/pinjam/response'
                
            }
        });
    }


</script>

@endsection