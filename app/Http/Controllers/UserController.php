<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Buku;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Kembali;
use App\Models\Offering;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class UserController extends Controller
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
        $users = DB::table('users')
            ->leftjoin('jurusans', 'users.id_jurusan','=', 'jurusans.id_jurusan')
            ->leftjoin('kelas','users.id_kelas', '=', 'kelas.id_kelas')
            ->leftjoin('offerings', 'users.id_offering', '=', 'offerings.id_offering')
            ->select('users.*', 'jurusans.*', 'kelas.*', 'offerings.*')
            ->get();
        $name = Auth::User()->name;
        return view('admin.user.index', ['users' => $users, 'name' => $name, 'profils' => $profils, 'foto_instansi' => $foto_instansi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelass = Kelas::all();
        $jurusans =Jurusan::all();
        $offerings = Offering::all();
        $users = User::all();
        $name = Auth::User()->name;
        return view('admin.user.tambah_user', ['name' => $name, 'users' => $users, 'kelass' => $kelass, 'jurusans' => $jurusans, 'offerings' => $offerings]);
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
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_jurusan' => 'required',
            'id_offering' => 'required',
            'email' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/user/create')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $insert = new User;
                $insert->nis = $request->nis;
                $insert->id_kelas = $data['id_kelas'];
                $insert->id_jurusan = $data['id_jurusan'];
                $insert->id_offering = $data['id_offering'];
                $insert->name = $data['nama'];
                $insert->email = $data['email'];
                $insert->save();
                return redirect('/admin/user')->with('status', 'Edit User Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/user')->with('failed', 'Operation Failed');
            }
        }
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
        $kelass = Kelas::all();
        $jurusans =Jurusan::all();
        $offerings = Offering::all();
        $users = User::find($id);
        $name = Auth::User()->name;
        return view('admin.user.edit_user', ['name' => $name, 'users' => $users, 'kelass' => $kelass, 'jurusans' => $jurusans, 'offerings' => $offerings]);
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
        $rules = [
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_jurusan' => 'required',
            'id_offering' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/user/create')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $update = User::find($id);
                $update->name = $data['nama'];
                $update->id_kelas = $data['id_kelas'];
                $update->id_jurusan = $data['id_jurusan'];
                $update->id_offering = $data['id_offering'];
                $update->save();
                return redirect('/admin/user')->with('status', 'Edit User Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/user')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return redirect('/admin/user')->with('status', 'Hapus User Berhasil');
        } catch (Exception $e) {
            return redirect('/admin/user')->with('failed', 'Operation Failed');
        }
    }

    public function indexUser(Request $request)
    {
        $id = Auth::user()->id;
        $profils = User::where('id', $id)->first();
        $request->session()->put('fotoku', $profils);
        $name = Auth::user()->name;
        $logos = Admin::all()->first();
        return view('user.index_user', ['name' => $name, 'logos' => $logos, 'profils' =>$profils]);
    }

    public function bukuUser()
    {
        $nis = Auth::user()->nis;
        $logos = Admin::all()->first();
        $profils = User::where('nis', $nis)->first();
        $bukus = Buku::all();
        $name = Auth::user()->name;
        return view('user.buku.index', ['bukus' => $bukus, 'name' => $name, 'logos' => $logos, 'profils' =>$profils]);
    }

    public function pinjamUser()
    {
        $nis = Auth::user()->nis;
        $logos = Admin::all()->first();
        $profils = User::where('nis', $nis)->first();
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $pinjams = DB::table('kembalis')
            ->join('bukus', 'kembalis.id_buku', '=', 'bukus.id_buku')
            ->join('users', 'users.nis', '=', 'kembalis.nis')
            ->select('kembalis.*', 'bukus.*', 'users.*')
            ->where('users.email', '=', $email)
            ->get();
        
        return view('user.pinjam.index', ['name' => $name, 'pinjams' => $pinjams, 'logos' => $logos, 'profils' => $profils]);
    }

    public function userProfil()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $logos = Admin::all()->first();
        $id = Auth::user()->id;
        $profils = User::where('id', $id)->first();

        $id_kelas = User::where('id', $id)->first()->id_kelas;
        $id_jurusan = User::where('id', $id)->first()->id_jurusan;
        $id_offering = User::where('id', $id)->first()->id_offering;

        if(empty($id_kelas) || empty($id_jurusan) || empty($id_offering)){
            $data_users = User::where('id', $id)->first();
        }else{
        
        $data_users = DB::table('users')
            ->join('kelas', 'users.id_kelas', '=', 'kelas.id_kelas')
            ->join('jurusans','users.id_jurusan', '=', 'jurusans.id_jurusan')
            ->join('offerings', 'users.id_offering', '=', 'offerings.id_offering')
            ->select('users.fotoku', 'kelas.nama_kelas', 'offerings.nama_offering', 'jurusans.nama_jurusan')
            ->where('users.id', '=', $id)
            ->first();
        }
        return view('user.profil.index', ['name' => $name, 'profils' => $profils, 'id' => $id, 'email' => $email, 'data_users' => $data_users, 'logos' => $logos]);
    }

    public function userProfilEdit($id)
    {
        $name = Auth::user()->name;
        $fotoku = Auth::user()->fotoku;
        $email = Auth::user()->email;
        $logos = Admin::all()->first();
        $kelass = Kelas::all();
        $jurusans = Jurusan::all();
        $offerings = Offering::all();
        $profils = User::where('id', $id)->first();
        $data_users = DB::table('users')
            ->join('kelas', 'users.id_kelas', '=', 'kelas.id_kelas')
            ->join('jurusans','users.id_jurusan', '=', 'jurusans.id_jurusan')
            ->join('offerings', 'users.id_offering', '=', 'offerings.id_offering')
            ->select('users.id', 'users.fotoku', 'kelas.*', 'offerings.*', 'jurusans.*')
            ->where('users.id', '=', $id)
            ->first();
        return view('user.profil.edit_profil', ['logos' => $logos, 'id' => $id, 'email' => $email, 'profils' => $profils, 'data_users' => $data_users, 'name' => $name, 'kelass' => $kelass, 'jurusans' => $jurusans, 'offerings' => $offerings, 'fotoku' => $fotoku]);
    }

    public function userProfilUpdate(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'id_kelas' => 'required',
            'id_jurusan' => 'required',
            'id_offering' => 'required',
            // 'fotoku' => 'image|nullable|image|mimes:jpg,png,jpeg'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect('user/profil')->withInput()->withErrors($validator)->with('failed', 'Operation Failed');
        } else {
            try {
                //upload gambar
                $fotoku = Auth::user()->fotoku;
                if($request->fotoku == "") {
                    $imgname = $fotoku;
                }else{
                    $file = $request->file('fotoku');
                    $nama_file= $file->getClientOriginalName();
                    $extension = $request->file('fotoku')->extension();
                    $imgname = $nama_file .' '. Carbon::now()->format('d-m-yy H-i-s').'.'.$extension;
                    $tujuan_upload = Storage::putFileAs('public/fotoku', $file, $imgname);
                }

                $users = User::where('id', $id)->update([
                    'name' => $request->name,
                    'id_kelas' => $request->id_kelas,
                    'id_jurusan' => $request->id_jurusan,
                    'id_offering' => $request->id_offering,
                    'fotoku' => $imgname
                ]);
                
                return redirect('/user/profil')->with('status', 'Profil Berhasil Diubah');
            } catch (Exception $e) {
                return redirect('/user/profil')->with('failed', 'Operation Failed');
            }
        }
    }

    public function grafikUser()
    {
        $nis = Auth::user()->nis;
        $name = Auth::user()->name;
        $profils = User::where('nis', $nis)->first();
        $dendas = Kembali::where('nis', $nis)->where('status_denda', '=', null)->sum('denda');
        $dendaku = Kembali::where('nis', $nis)->where('denda', '!=', null)->where('status_denda', '=', null)->get();
        $lunas = Kembali::where('nis', $nis)->where('status_denda', '=', 1)->sum('denda');
        $denda_lunas = Kembali::where('nis', $nis)->where('status_denda', '=', 1)->get();
        $bukus = Kembali::where('nis', $nis)->where('tgl_kembali', '!=' , null)->count('id_buku');
        $buku_pinjams = Kembali::where('nis', $nis)->where('tgl_kembali', '!=', null)->get();
        $logos = Admin::all()->first();

        // $tgl1 = Kembali::all()->where('nis', $nis)->first()->tgl_harus_kembali;
        // $tgl2 = Kembali::all()->where('nis', $nis)->first()->tgl_kembali;
        // $tanggal1 = date_create($tgl1);
        // $tanggal2 = date_create($tgl2);
        // $selisih = date_diff($tanggal1, $tanggal2);
        // $selisih_tanggal = $selisih->d;
        // $c = Carbon::date_diff($tgl1,$tgl2);
        return view('user.grafik.index', ['dendas' => $dendas, 'bukus' => $bukus,'logos' => $logos, 'name' => $name, 'profils' => $profils, 'buku_pinjams' => $buku_pinjams,'dendaku' => $dendaku, 'lunas' => $lunas, 'denda_lunas' => $denda_lunas]);
    }

    public function peminjaman(Request $request)
    {
        $nis = Auth::user()->nis;
        $date_pinjam = $request->datePickerPeminjamanku;
        $date1 = substr($date_pinjam, 0, 10);
        $date2 = substr($date_pinjam, 13);
        $tgl1 = date('d-m-yy', strtotime($date1));
        $tgl2 = date('d-m-yy', strtotime($date2));
        $pinjams = DB::table('bukus')
            ->join('kembalis', function($join) {
                $join->on('bukus.id_buku', '=', 'kembalis.id_buku');
            })
            ->join('users', function($join) {
                $join->on('kembalis.nis', '=', 'users.nis');
            })
            ->where('kembalis.nis', $nis)
            ->where('tgl_kembali', '!=', null)
            ->whereBetween('kembalis.tgl_pinjam',  [$tgl1, $tgl2] )
            ->get();
        // dd($pinjams);
        $foto_instansi = Admin::all()->first();
        $nama_pdf = Carbon::now()->format('d-m-yy H-i-s');
        $extension = '.pdf';
        $pdf = PDF::loadView('user.pdf.pinjam', ['pinjams' => $pinjams, 'foto_instansi' => $foto_instansi]);
        return $pdf->stream('Laporan Peminjamanku' . ' ' . $nama_pdf . $extension);   
    }
}
