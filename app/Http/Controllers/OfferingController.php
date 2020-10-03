<?php

namespace App\Http\Controllers;

use App\Models\Offering;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OfferingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offerings = Offering::all();
        $name = Auth::User()->name;
        return view('admin.offering.index', ['offerings' => $offerings, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = Auth::User()->name;
        return view('admin.offering.tambah_offering', ['name' => $name]);
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
            'nama_offering' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/offering/tambah')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $insert = new Offering;
                $insert->nama_offering = $data['nama_offering'];
                $insert->save();
                return redirect('/admin/offering')->with('status', 'Edit Offering Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/offering')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function show(Offering $offering)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function edit(Offering $offering, $id)
    {
        $name = Auth::User()->name;
        $offerings = Offering::find($id);
        return view('admin.offering.edit_offering', ['offerings' => $offerings, 'name' => $name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offering $offering, $id)
    {
        $rules = [
            'nama_offering' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()) {
            return redirect('/admin/offering/create')->withInput()->withErrors($validator);
        }else {
            $data = $request->input();
            try {
                $update = Offering::find($id);
                $update->nama_offering = $data['nama_offering'];
                $update->save();
                return redirect('/admin/offering')->with('status', 'Edit Offering Berhasil');
            } catch (Exception $e) {
                return redirect('/admin/offering')->with('failed', 'Operation Failed');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offering  $offering
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offering $offering, $id)
    {
        try {
            $offerings = Offering::find($id);
            $offerings->delete();
            return redirect('/admin/offering')->with('status', 'Hapus Offering Berhasil');
        } catch (Exception $e) {
            return redirect('/admin/offering')->with('failed', 'Operation Failed');
        }
    }
}
