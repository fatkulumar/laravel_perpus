<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Jurusan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
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
        $jurusans = Jurusan::all();
        $name = Auth::User()->name;
        return view('admin.jurusan.index', ['jurusans' =>$jurusans, 'name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
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
        $name = Auth::User()->name;
        return view('admin.jurusan.tambah_jurusan', ['name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
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
            'nama_jurusan' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/jurusan/tambah')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $insert = new Jurusan;
                $insert->nama_jurusan = $data['nama_jurusan'];
                $insert->save();
                return redirect('/admin/jurusan')->with('status', 'Tambah Jurusan Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/jurusan')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan, $id)
    {
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        $jurusans = Jurusan::find($id);
        $name = Auth::User()->name;
        return view('admin.jurusan.edit_jurusan', ['jurusans' => $jurusans, 'name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan, $id)
    {
        $rules = [
            'nama_jurusan' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/jurusan/create')->withInput()->withErrors($validator);
        }else {
            try {
                $insert = Jurusan::find($id);
                $insert->nama_jurusan = $request->nama_jurusan;
                $insert->save();
                return redirect('/admin/jurusan')->with('status', 'Edit Jurusan Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/jurusan')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan, $id)
    {
        try {
            $jurusans = Jurusan::find($id);
            $jurusans->delete();
            return redirect('/admin/jurusan')->with('status', 'Hapus Jurusan Berhasil');
        } catch (Exception $e) {
            return redirect('/admin/jurusan')->with('failed', 'Operation Failed');
        }
    }
}
