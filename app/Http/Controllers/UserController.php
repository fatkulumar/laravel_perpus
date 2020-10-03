<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Kembali;
use App\Models\Offering;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->leftjoin('jurusans', 'users.id_jurusan','=', 'jurusans.id_jurusan')
            ->leftjoin('kelas','users.id_kelas', '=', 'kelas.id_kelas')
            ->leftjoin('offerings', 'users.id_offering', '=', 'offerings.id_offering')
            ->select('users.*', 'jurusans.*', 'kelas.*', 'offerings.*')
            ->get();
        $name = Auth::User()->name;
        return view('admin.user.index', ['users' => $users, 'name' => $name]);
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
        $fotoku = Auth::user()->fotoku;
        $request->session()->put('fotoku', $fotoku);
        $name = Auth::user()->name;
        return view('user.index_user', ['name' => $name]);
    }

    public function bukuUser()
    {
        $bukus = Buku::all();
        $name = Auth::user()->name;
        return view('user.buku.index', ['bukus' => $bukus, 'name' => $name]);
    }

    public function pinjamUser()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $pinjams = DB::table('kembalis')
            // ->join('pinjams', 'kembalis.id_pinjam', '=', 'pinjams.id_pinjam')
            ->join('bukus', 'kembalis.id_buku', '=', 'bukus.id_buku')
            ->join('users', 'users.nis', '=', 'kembalis.nis')
            ->select('kembalis.*', 'bukus.*', 'users.*')
            ->where('users.email', '=', $email)
            ->get();
        
        return view('user.pinjam.index', ['name' => $name, 'pinjams' => $pinjams]);
    }
}
