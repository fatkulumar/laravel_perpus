<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buku;
use App\Models\Kembali;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        //foto instansi adalah nama logo sekolahan
        $fotoku = Auth::user()->fotoku;
        $foto_instansi = Admin::all()->first();
        $name = Auth::user()->name;
        $request->session()->put('fotoku', $fotoku);
        $profils = User::all()->first();
        return view('admin.index_admin', ['name' => $name, 'foto_instansi' => $foto_instansi, 'profils' => $profils]);
    }

    public function log()
    {
        $admin = Auth::user()->role;
        if ($admin === "admin") {
            return redirect('/admin/grafik');
        }else{
            return redirect('/user');
        }
    }

    public function profil()
    {
        //foto instansi adalah nama logo sekolahan
        $name = Auth::user()->name;
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        return view('admin.profil.index', ['name' => $name, 'email' => $email, 'profils' => $profils, 'id' => $id,'foto_instansi' => $foto_instansi]);

    }

    public function editProfil($id)
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        return view('admin.profil.edit_profil', ['name' => $name, 'email' => $email, 'profils' => $profils, 'id' => $id, 'foto_instansi' => $foto_instansi, 'profils' => $profils]);
    }

    public function updateProfil(Request $request ,$id)
    {
        $rules = [
            'nama_instansi' => 'required',
            'name' => 'required',
            'fotoku' => 'image|nullable|image|mimes:jpg,png,jpeg',
            'nama_logo' => 'image|nullable|image|mimes:jpg,png,jpeg'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/buku')->withInput()->withErrors($validator);
        }else {

            try {
                // upload file fotoku
                $file = $request->file('fotoku');
                $nama_file= $file->getClientOriginalName();
                $extension = $request->file('fotoku')->extension();
                $imgname = $nama_file .' '. Carbon::now()->format('d-m-yy H-i-s').'.'.$extension;
                $tujuan_upload = Storage::putFileAs('public/fotoku', $file, $imgname);

                // upload logo
                $file_logo = $request->file('nama_logo');
                $nama_file_logo = $file_logo->getClientOriginalName();
                $extension_logo = $request->file('nama_logo')->extension();
                $imgname_logo = $nama_file_logo .' '. Carbon::now()->format('d-m-yy H-i-s').'.'.$extension_logo;
                $tujuan_upload_logo = Storage::putFileAs('public/fotoku', $file_logo, $imgname_logo);

                $admins = Admin::where('id_admin', $id)->update([
                    'nama_instansi' => $request->nama_instansi,
                    'nama_logo' => $imgname_logo
                ]);

                $users = User::where('id', $id)->update([
                    'name' => $request->name,
                    'fotoku' => $imgname
                ]);

                return redirect('/admin/profil')->with('status', 'Profil Berhasil Diubah');
            } catch (Exception $e) {
                return redirect('/admin/profil')->with('failed', 'Operation Failed');
            }
        }
    }

    public function setBatasPinjam()
    {
        $name = Auth::user()->name;
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        return view('admin.batas_pinjam.index', ['name' => $name, 'foto_instansi' => $foto_instansi, 'profils' =>$profils]);
    }

    public function setBatasPinjamEdit($id)
    {
        $name = Auth::user()->name;
        $profils = User::find($id);
        $foto_instansi = Admin::all()->first();
        return view('admin.batas_pinjam.edit_batas_pinjam', ['name' => $name, 'foto_instansi' => $foto_instansi, 'profils' =>$profils]);
    }

    public function setBatasPinjamUpdate(Request $request, $id)
    {
        $rules = [
            'batas_pinjam_buku' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return view('/admin/pinjam/batas/')->withInput()->withErrors($validator);
        }else{
            try {
                $admins = Admin::where('id_admin', $id)->update([
                    'batas_pinjam_buku' => $request->batas_pinjam_buku
                ]);

                return redirect('/admin/pinjam/batas')->with('status', 'Edit Batas Pinjam Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/pinjam/batas')->with('failed', 'Operation Failed');
            }
        }
    }

    public function grafik()
    {
        $name = Auth::user()->name;
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        $dendas = DB::table('kembalis')
        ->where('kembalis.status_denda', '=', '')
        ->sum('kembalis.denda');
        $bukus = DB::table('bukus')->sum('bukus.stok');
        $users =  User::count();
        $us = User::all();
        $bu = Buku::all();
        $pinjams = DB::table('bukus')
            ->join('kembalis', 'bukus.id_buku', '=', 'kembalis.id_buku')
            ->join('users', 'kembalis.nis', '=', 'users.nis')
            ->where('kembalis.denda', '>', 0)
            ->where('kembalis.status_denda', '=', '')
            ->select('users.*', 'bukus.*', 'kembalis.*')
            ->get();
        return view('admin.grafik.index', ['name' => $name, 'profils' => $profils, 'foto_instansi' => $foto_instansi,'dendas' =>$dendas, 'bukus' => $bukus,'users' => $users, 'us' => $us,'bu' => $bu, 'pinjams' => $pinjams]);
    }

    public function laporanTanggalPinjam(Request $request)
    {
        $date_pinjam = $request->datePickerPinjam;
        $date1 = substr($date_pinjam, 0, 10);
        $date2 = substr($date_pinjam, 13);
        $tgl1 = date('d-m-yy', strtotime($date1));
        $tgl2 = date('d-m-yy', strtotime($date2));
        $kembalis = DB::table('bukus')
            ->join('kembalis', function($join) {
                $join->on('bukus.id_buku', '=', 'kembalis.id_buku');
            })
            ->join('users', function($join) {
                $join->on('kembalis.nis', '=', 'users.nis');
            })
            ->whereBetween('kembalis.tgl_pinjam',  [$tgl1, $tgl2] )
            ->get();
        $foto_instansi = Admin::all()->first();
        $nama_pdf = Carbon::now()->format('d-m-yy H-i-s');
        $extension = '.pdf';
        $pdf = PDF::loadView('admin.pdf.pinjam', ['kembalis' => $kembalis, 'foto_instansi' => $foto_instansi]);
        return $pdf->stream('Laporan Pinjam' . ' ' . $nama_pdf . $extension);
    }

    public function laporanTanggalKembali(Request $request)
    {
        $date_pinjam = $request->datePickerPinjam;
        $date1 = substr($date_pinjam, 0, 10);
        $date2 = substr($date_pinjam, 13);
        $tgl1 = date('d-m-yy', strtotime($date1));
        $tgl2 = date('d-m-yy', strtotime($date2));
        $kembalis = DB::table('bukus')
        ->join('kembalis', function($join) {
            $join->on('bukus.id_buku', '=', 'kembalis.id_buku');
        })
        ->join('users', function($join) {
            $join->on('kembalis.nis', '=', 'users.nis');
        })
        ->whereBetween('kembalis.tgl_kembali',  [$tgl1, $tgl2] )
        ->get();
        $foto_instansi = Admin::all()->first();
        $nama_pdf = Carbon::now()->format('d-m-yy H-i-s');
        $extension = '.pdf';
        $pdf = PDF::loadView('admin.pdf.kembali', ['kembalis' => $kembalis, 'foto_instansi' => $foto_instansi]);
        return $pdf->stream('Laporan Kembali' . ' ' . $nama_pdf . $extension);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function logout()
    // {
    //     Auth::logout();
    //     redirect('/coba');
    // }
}
