<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buku;
use App\Models\Kembali;
use App\Models\LokasiBuku;
use App\Models\Pinjam;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        $buku = Buku::all();
        $name = Auth::User()->name;
        return view('admin.buku.index',['bukus' => $buku, 'name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
    }

    //index anggota

    public function indexAnggota()
    {
        $name = Auth::User()->name;
        return view('anggota.buku.index', ['name' => $name]);
    }

    public function userBukuAjax($id)
    {
        //mencari buku berdasarkan id
        $bukus = Buku::find($id);
        $name = Auth::User()->name;
        $nis = Auth::User()->nis;
        $tambah_hari = 3;
        $tanggal_sekarang = Carbon::now()->format('d-m-yy');
        $tanggal_harus_kembali = (Carbon::now())->addDays($tambah_hari)->format('d-m-yy');
        // $selisih_tanggal = date_diff($tanggal_sekarang, $tanggal_harus_kembali);

        $data = [
            'bukus'=> $bukus,
            'name' => $name,
            'nis' => $nis,
            'tanggal_sekarang' => $tanggal_sekarang,
            'tanggal_kembali' => $tanggal_harus_kembali,
            // 'selisih_tanggal' => $selisih_tanggal
        ];
        return response()->json($data);
    }

    public function userBukuAjaxPinjam(Request $request, $id)
    {
        // $name = Auth::User()->name;
        $nis = Auth::User()->nis;
        $tambah_hari = 3;
        $tanggal_sekarang = Carbon::now()->format('d-m-yy');
        $tanggal_harus_kembali = (Carbon::now())->addDays($tambah_hari)->format('d-m-yy');

        try {
            $bukus = Buku::find($id)->stok;
            $stok = $bukus - 1;
            $update = Buku::find($id);
            $update->stok = $stok;
            $update->save();
            //insert tb kembalis
            $kembalis = new Kembali;
            $kembalis->id_buku = $id;
            $kembalis->nis = $nis;
            $kembalis->tgl_pinjam = $tanggal_sekarang;
            $kembalis->tgl_harus_kembali = $tanggal_harus_kembali;
            $kembalis->save();
            $data =[
                'redirect' => '/user/pinjam/response'
            ];
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json('Gagal Pinjam');
        }
    }

    public function responsePinjam()
    {
        return redirect('/user/buku')->with('status', 'Pinjam Berhasil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        $lokasi_bukus = LokasiBuku::all();
        $name = Auth::User()->name;
        return view('admin.buku.tambah_buku',['lokasi_bukus' => $lokasi_bukus,'name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'id_lokasi_buku' => 'required',
            'kode_buku' => 'required',
            'judul_buku' => 'required',
            'penerbit_buku' => 'required',
            'pengarang_buku' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/buku/create')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $insert = new Buku;
                $insert->id_lokasi_buku = $data['id_lokasi_buku'];
                $insert->kode_buku = $data['kode_buku'];
                $insert->judul_buku = $data['judul_buku'];
                $insert->penerbit_buku = $data['penerbit_buku'];
                $insert->pengarang_buku = $data['pengarang_buku'];
                $insert->tahun_terbit = $data['tahun_terbit'];
                $insert->stok = $data['stok'];
                $insert->save();
                return redirect('/admin/buku')->with('status', 'Tambah Buku Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/buku')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku, $id)
    {
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        $bukus = Buku::find($id);
        $buku_all = Buku::all();
        $name = Auth::User()->name;
        return view('admin.buku.edit_buku', ['bukus' => $bukus, 'buku_all' => $buku_all, 'name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku, $id)
    {
        $rules = [
            'id_lokasi_buku' => 'required',
            'kode_buku' => 'required',
            'judul_buku' => 'required',
            'penerbit_buku' => 'required',
            'pengarang_buku' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/buku')->withInput()->withErrors($validator);
        }else {
            try {
                $update = Buku::find($id);
                $update->id_lokasi_buku = $request->id_lokasi_buku;
                $update->kode_buku = $request->kode_buku;
                $update->judul_buku = $request->judul_buku;
                $update->penerbit_buku = $request->penerbit_buku;
                $update->pengarang_buku = $request->pengarang_buku;
                $update->tahun_terbit = $request->tahun_terbit;
                $update->stok = $request->stok;
                $update->save();
                return redirect('/admin/buku')->with('status', 'Edit Buku Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/buku')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku, $id)
    {
        try {
            $bukus = Buku::find($id);
            $bukus->delete();
            return redirect('/admin/buku')->with('status', 'Hapus Jurusan Berhasil');;
        } catch (Exception $e) {
            return redirect('/admin/buku')->with('failed', 'Operation Failed');;
        }
        
    }
}
