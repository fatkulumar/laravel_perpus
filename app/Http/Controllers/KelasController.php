<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kelas;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
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
        $kelass = Kelas::all();
        $name = Auth::User()->name;
        return view('admin.kelas.index', ['kelass' => $kelass, 'name' => $name, 'profils' => $profils, 'foto_instansi' => $foto_instansi]);
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
        return view('admin.kelas.tambah_kelas', ['name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
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
            'nama_kelas' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/kelas/tambah')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $insert = new Kelas;
                $insert->nama_kelas = $data['nama_kelas'];
                $insert->save();
                return redirect('/admin/kelas')->with('status', 'Tambah Kelas Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/kelas')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas, $id)
    {
        $profils = User::all()->first();
        $foto_instansi = Admin::all()->first();
        $name = Auth::User()->name;
        $kelass = Kelas::find($id);
        return view('admin.kelas.edit_kelas', ['kelass' => $kelass, 'name' => $name, 'profils' => $profils, 'foto_instansi' =>$foto_instansi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas, $id)
    {
        $rules = [
            'nama_kelas' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/kelas/create')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $update = Kelas::find($id);
                $update->nama_kelas = $data['nama_kelas'];
                $update->save();
                return redirect('/admin/kelas')->with('status', 'Edit Kelas Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/kelas')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas, $id)
    {
        try {
            $kelass = Kelas::find($id);
            $kelass->delete();
            return redirect('/admin/kelas')->with('status', 'Hapus Kelas Berhasil');
        } catch (Exception $e) {
            return redirect('/admin/kelas')->with('failed', 'Operation Failed');
        }
    }
}
