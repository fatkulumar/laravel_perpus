<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 

        $fotoku = Auth::user()->fotoku;
        $name = Auth::user()->name;
        $request->session()->put('fotoku', $fotoku);
        return view('admin.index_admin', ['name' => $name]);
    }

    public function log()
    {
        $admin = Auth::user()->role;
        if ($admin === "admin") {
            return redirect('/admin');
        }else{
            return redirect('/user');
        }
    }

    public function profil()
    {
        $name = Auth::user()->name;
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $profils = Admin::all();
        return view('admin.profil.index', ['name' => $name, 'email' => $email, 'profils' => $profils, 'id' => $id]);

    }

    public function editProfil($id)
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $profils = Admin::all()->first();
        return view('admin.profil.edit_profil', ['name' => $name, 'email' => $email, 'profils' => $profils, 'id' => $id]);
    }

    public function updateProfil(Request $request ,$id)
    {
        $rules = [
            'nama_instansi' => 'required',
            'name' => 'required',
            'nama_logo' => 'image|nullable'
        ];

        $validator = Validator::make($request->all(),$rules);

        $email = Auth::user()->email;
        $profils = Admin::all()->first();

        // $coba = Storage::url('public/fotoku/03-10-2020 10-32-43');
        //         dd($coba);

        if($validator->fails()) {
            return redirect('/admin/buku')->withInput()->withErrors($validator);
        }else {

            try {
                // upload file
                $file = $request->file('nama_logo');
                $nama_file= $file->getClientOriginalName();
                $extension = $request->file('nama_logo')->extension();
                $imgname = $nama_file .' '. Carbon::now()->format('d-m-yy H-i-s').'.'.$extension;
                $tujuan_upload = Storage::putFileAs('public/fotoku', $file, $imgname);

                

                $admins = Admin::where('id_admin', $id)->update([
                    'nama_instansi' => $request->nama_instansi,
                    'nama_logo' => $nama_file
                ]);

                $users = User::where('id', $id)->update([
                    'name' => $request->name
                ]);

                return redirect('/admin/profil')->with('status', 'Profil Berhasil Diubah');
            } catch (Exception $e) {
                return redirect('/admin/profil')->with('failed', 'Operation Failed');
            }
        }
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

    public function logout()
    {
        Auth::logout();
        redirect('/coba');
    }
}
