@extends('user.index_user')

@section('content')
    
<div class="card">   
    <div class="card-header bg-primary mb-3">
        <div class="row">
            <div class="col-md-6">
                <h1 class="m-0 text-white">
                    <strong>Home</strong>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span data-toggle="modal" data-target="#denda" class="info-box-icon bg-danger elevation-1"><i class="fas fa-lock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" data-toggle="modal" data-target="#denda">Denda</span>
                <span class="info-box-number">{{ $dendas }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span data-toggle="modal" data-target="#buku" class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" data-toggle="modal" data-target="#buku">Buku</span>
                <span class="info-box-number">{{ $bukus }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span data-toggle="modal" data-target="#lunas" class="info-box-icon bg-danger elevation-1"><i class="fas fa-lock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" data-toggle="modal" data-target="#lunas">Lunas</span>
                <span class="info-box-number">{{ $lunas }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          
        </div>
      </div>
    </div>
</div>

{{-- modal denda --}}
<div class="modal fade" id="denda" tabindex="-1" role="dialog" aria-labelledby="dendaTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="dendaTitle"><strong>Denda</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <table id="table_denda" style="text-align: center" class='table table-striped'>
          <thead>
              <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Buku</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tanggal Pinjam</th>
                  <th>Harus Kembali</th>
                  <th>Tanggal Kembali</th>
                  <th>Denda</th>
                  <th>Status Denda</th>
                  <th>Aksi</th>
              </tr>
          <thead>
      <tbody>
          <?php $no = 1 ?>
          @foreach ($dendaku as $denda)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $denda->nis }}</td>
                  <td>{{ $denda->name }}</td>
                  <td>{{ $denda->judul_buku }}</td>
                  <td>{{ $denda->pengarang_buku }}</td>
                  <td>{{ $denda->penerbit_buku }}</td>
                  <td>{{ $denda->tgl_pinjam }}</td>
                  <td>{{ $denda->tgl_harus_kembali }}</td>
                  <td>{{ $denda->tgl_kembali }}</td>
                  <td>{{ $denda->denda }}</td>
                  <td>
                      @if ($denda->denda > 0 && $denda->status_denda == null)
                          <a onclick="return confirm('{{ $denda->name }} Apakah Mau Melunasi ?')" class="btn btn-warning btn-sm" href="/admin/pinjam/status_denda/ {{ $denda->id_kembali }}">Melunasi?</a>
                      @endif

                      @if ($denda->status_denda == 1)
                          <button disabled class="btn btn-success btn-sm">Lunas</button> 
                      @endif

                  </td>
                  <td>
                      @if ($denda->tgl_kembali == null)
                          <a onclick="return confirm('{{ $denda->judul_buku }} Apakah Mau Di Kembalikan?')" class="btn btn-danger btn-sm" href="/admin/pinjam/kembali/{{ $denda->id_kembali }}">Menggembalikan?</a>
                      @else
                          <button disabled class="btn btn-primary btn-sm">Dikembalikan</button>
                      @endif
                  </td>

              </tr>
          @endforeach
          </tbody>
      </table>

      <script>
        $(document).ready( function () {
            $('#table_denda').DataTable();
        });
    </script>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

{{-- modal lunas --}}
<div class="modal fade" id="lunas" tabindex="-1" role="dialog" aria-labelledby="lunasTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="lunasTitle"><strong>Lunas</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <table id="table_lunas" style="text-align: center" class='table table-striped'>
          <thead>
              <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Buku</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tanggal Pinjam</th>
                  <th>Harus Kembali</th>
                  <th>Tanggal Kembali</th>
                  <th>Denda</th>
                  <th>Status Denda</th>
                  <th>Aksi</th>
              </tr>
          <thead>
      <tbody>
          <?php $no = 1 ?>
          @foreach ($denda_lunas as $denda)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $denda->nis }}</td>
                  <td>{{ $denda->name }}</td>
                  <td>{{ $denda->judul_buku }}</td>
                  <td>{{ $denda->pengarang_buku }}</td>
                  <td>{{ $denda->penerbit_buku }}</td>
                  <td>{{ $denda->tgl_pinjam }}</td>
                  <td>{{ $denda->tgl_harus_kembali }}</td>
                  <td>{{ $denda->tgl_kembali }}</td>
                  <td>{{ $denda->denda }}</td>
                  <td>
                      @if ($denda->denda > 0 && $denda->status_denda == null)
                          <a onclick="return confirm('{{ $denda->name }} Apakah Mau Melunasi ?')" class="btn btn-warning btn-sm" href="/admin/pinjam/status_denda/ {{ $denda->id_kembali }}">Melunasi?</a>
                      @endif

                      @if ($denda->status_denda == 1)
                          <button disabled class="btn btn-success btn-sm">Lunas</button> 
                      @endif

                  </td>
                  <td>
                      @if ($denda->tgl_kembali == null)
                          <a onclick="return confirm('{{ $denda->judul_buku }} Apakah Mau Di Kembalikan?')" class="btn btn-danger btn-sm" href="/admin/pinjam/kembali/{{ $denda->id_kembali }}">Menggembalikan?</a>
                      @else
                          <button disabled class="btn btn-primary btn-sm">Dikembalikan</button>
                      @endif
                  </td>

              </tr>
          @endforeach
          </tbody>
      </table>

      <script>
        $(document).ready( function () {
            $('#table_lunas').DataTable();
        });
    </script>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="buku" tabindex="-1" role="dialog" aria-labelledby="bukuTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="bukuTitle"><strong>Buku</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <table id="table_buku" style="text-align: center" class='table table-striped'>
          <thead>
              <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Buku</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tanggal Pinjam</th>
                  <th>Harus Kembali</th>
                  <th>Tanggal Kembali</th>
                  <th>Denda</th>
                  <th>Status Denda</th>
                  <th>Aksi</th>
                  <!-- <th><input id="pilihsemua" onchange="checkAll(this)" name="chk[]" type="checkbox"></th> -->
              </tr>
          <thead>
      <tbody>
          <?php $no = 1 ?>
          @foreach ($buku_pinjams as $pinjam)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $pinjam->nis }}</td>
                  <td>{{ $pinjam->name }}</td>
                  <td>{{ $pinjam->judul_buku }}</td>
                  <td>{{ $pinjam->pengarang_buku }}</td>
                  <td>{{ $pinjam->penerbit_buku }}</td>
                  <td>{{ $pinjam->tgl_pinjam }}</td>
                  <td>{{ $pinjam->tgl_harus_kembali }}</td>
                  <td>{{ $pinjam->tgl_kembali }}</td>
                  <td>{{ $pinjam->denda }}</td>
                  <td>
                      @if ($pinjam->denda > 0 && $pinjam->status_denda == null)
                          <a onclick="return confirm('{{ $pinjam->name }} Apakah Mau Melunasi ?')" class="btn btn-warning btn-sm" href="/admin/pinjam/status_denda/ {{ $pinjam->id_kembali }}">Melunasi?</a>
                      @endif

                      @if ($pinjam->status_denda == 1)
                          <button disabled class="btn btn-success btn-sm">Lunas</button> 
                      @endif

                  </td>
                  <td>
                      @if ($pinjam->tgl_kembali == null)
                          <a onclick="return confirm('{{ $pinjam->judul_buku }} Apakah Mau Di Kembalikan?')" class="btn btn-danger btn-sm" href="/admin/pinjam/kembali/{{ $pinjam->id_kembali }}">Menggembalikan?</a>
                      @else
                          <button disabled class="btn btn-primary btn-sm">Dikembalikan</button>
                      @endif
                  </td>

              </tr>
          @endforeach
          </tbody>
      </table>

      <script>
        $(document).ready( function () {
            $('#table_buku').DataTable();
        });
      </script>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  
@endsection