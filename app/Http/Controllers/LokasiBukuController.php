<?php

namespace App\Http\Controllers;

use App\Models\LokasiBuku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LokasiBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi_bukus = LokasiBuku::all();
        $name = Auth::User()->name;
        return view('admin.lokasi_buku.index', ['lokasi_bukus' => $lokasi_bukus, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = Auth::User()->name;
        return view('admin.lokasi_buku.tambah_lokasi_buku', ['name' => $name]);
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
            'lokasi_buku' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/lokasi_buku/create')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $insert = new LokasiBuku;
                // $insert->lokasi_buku = $data['lokasi_buku'];
                $insert->lokasi_buku = $data['lokasi_buku'];
                $insert->save();
                return redirect('/admin/lokasi_buku')->with('status', 'Tambah Lokasi Buku Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/lokasi_buku')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LokasiBuku  $lokasiBuku
     * @return \Illuminate\Http\Response
     */
    public function show(LokasiBuku $lokasiBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LokasiBuku  $lokasiBuku
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiBuku $lokasiBuku, $id)
    {
        $lokasi_bukus = LokasiBuku::find($id);
        $name = Auth::User()->name;
        return view('admin.lokasi_buku.edit_lokasi_buku', ['lokasi_bukus' =>$lokasi_bukus,'name' => $name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LokasiBuku  $lokasiBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LokasiBuku $lokasiBuku, $id)
    {
        $rules = [
            'lokasi_buku' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/lokasi_buku')->withInput()->withErrors($validator);
        }else {
            try {
                $update = LokasiBuku::find($id);
                $update->lokasi_buku = $request->lokasi_buku;
                $update->save();
                return redirect('/admin/lokasi_buku')->with('status', 'Edit Lokasi Buku Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/lokasi_buku')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LokasiBuku  $lokasiBuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(LokasiBuku $lokasiBuku, $id)
    {
        try {
            $lokasi_bukus = LokasiBuku::find($id);
            $lokasi_bukus->delete();
            return redirect('/admin/lokasi_buku')->with('status', 'Hapus Lokasi Buku Berhasil');
        } catch (Exception $e) {
            return redirect('/admin/lokasi_buku')->with('failed', 'Operation Failed');
        }
    }
}
