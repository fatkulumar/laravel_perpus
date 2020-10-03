<?php

namespace App\Http\Controllers;

use App\Models\Kembali;
use App\Models\Pinjam;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjams = DB::table('bukus')
            ->join('kembalis', 'bukus.id_buku', '=', 'kembalis.id_buku')
            ->join('users', 'kembalis.nis', '=', 'users.nis')
            ->select('users.*', 'bukus.*', 'kembalis.*')
            ->get();
        $name = Auth::User()->name;
        return view('admin.pinjam.index', ['name' => $name, 'pinjams' => $pinjams]);
    }

    /**
     * return book.
     * mengembalikan buku peminjaman
     * 
     */
    public function kembali($id)
    {
        try {
            $tgl_harus_kembali = Kembali::find($id)->tgl_harus_kembali;
            $selisih_tgl_kembali = (Carbon::now())->diffInDays($tgl_harus_kembali);
            $tgl_kembali = Carbon::now()->format('d-m-yy');

            $batas_selisih = 3;
            $atur_denda = 1000;
            if($selisih_tgl_kembali > $batas_selisih){
                $denda = ($selisih_tgl_kembali - $batas_selisih ) * $atur_denda;
            }else{
                $denda = 0;
            }

            $update = Kembali::find($id);
            $update->tgl_kembali = $tgl_kembali;
            $update->denda = $denda;
            $update->save();
            return redirect('/admin/pinjam')->with('status', 'Buku DiKembalikan');
        } catch (Exception $e) {
            return redirect('admin/pinjam')->with('failed', 'Operation Failed');
        }
    }

    public function statusDenda($id)
    {
        try {
            $kembalis = Kembali::find($id)->status_denda;
            $update = Kembali::find($id);
            $update->status_denda = 1;
            $update->save();
            return redirect('admin/pinjam')->with('status', 'Denda Lunas');
        } catch (Exception $e) {
            return redirect('admin/pinjam')->with('failed', 'Failed Operation');
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
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjam $pinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjam $pinjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjam $pinjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjam $pinjam)
    {
        //
    }
}
