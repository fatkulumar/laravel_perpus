@extends('admin.index_admin')

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
                <span class="info-box-text">Denda</span>
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
                <span class="info-box-text">Buku</span>
                <span class="info-box-number">{{ $bukus }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span data-toggle="modal" data-target="#users" class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
              <span class="info-box-number">{{ $users }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
      </div>
    </div>
</div>

  
  <!-- Modal user -->
  <div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title" id="exampleModalLongTitle"><strong>Data User</strong></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <table id="table_user">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>E Mail</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Offering</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    @foreach ($us as $user)
                        
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->nis }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nama_kelas }}</td>
                        <td>{{ $user->nama_jurusan }}</td>
                        <td>{{ $user->nama_offering }}</td>
    
                    </td>
                        
                    </tr>
    
                    @endforeach
                </tbody>
            </table>

            <script>
                $(document).ready( function () {
                    $('#table_user').DataTable();
                });
            </script>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- modal buku --}}
  <div class="modal fade" id="buku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title" id="exampleModalLongTitle"><strong>Data Buku</strong></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
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
                        <th width="90" style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tampil">
                    <?php $no = 1 ?>
                    @foreach ($bu as $buku)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $buku->id_lokasi_buku }}</td>
                            <td>{{ $buku->kode_buku }}</td>
                            <td>{{ $buku->judul_buku }}</td>
                            <td>{{ $buku->pengarang_buku }}</td>
                            <td>{{ $buku->penerbit_buku }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ $buku->stok }}</td>
                            <td>
                            <a class="btn btn-success btn-sm" href="/admin/buku/edit/{{ $buku->id_buku }}">Edit</a> <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah Ingin Menghapus {{ $buku->judul_buku }} ?')" href="/admin/buku/delete/{{ $buku->id_buku }}">Hapus</a>
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
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- modal denda --}}
  <div class="modal fade" id="denda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h3 class="modal-title" id="exampleModalLongTitle"><strong>Data Denda</strong></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <table id="table_pinjam_kembali" style="text-align: center" class='table table-striped'>
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
                @foreach ($pinjams as $pinjam)
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

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  


@endsection