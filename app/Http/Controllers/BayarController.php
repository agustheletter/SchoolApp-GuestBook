<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// panggil model SPP
use App\Models\SppModel;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BayarController extends Controller
{
    use ValidatesRequests;
    //====================AWAL METHODE UNTUK TAMPIL spp=================
    //tampil dengan eloquent
    public function spp()
    {
        // mengambil data spp
        $spp = SppModel::orderby('idbayar', 'DESC')
        ->paginate(10);

        // mengirim data guru ke view guru
        return view('admin.pages.v_spp',['spp' => $spp]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL spp================

    //====================AWAL METHODE UNTUK TAMBAH spp=================
    //method tambah data spp dengan eloquent
    public function spptambah(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'idspp' => 'required',
            'spp' => 'required'
        ]);

        //sppModel::create([
        sppModel::create([
            'idspp' => $request->idspp,
            'spp' => $request->spp
        ]);

        return redirect('/spp');
    }
    //====================AKHIR METHODE UNTUK TAMBAH spp=================



    //====================AWAL METHODE UNTUK HAPUS spp=================
    public function spphapus($idspp)
    {
        $spp = sppModel::find($idspp);
        $spp->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS spp=================



    //====================AWAL METHODE UNTUK CARI spp=================
    public function sppcari2(Request $request)
    {
        // menangkap data pencarian
        $sppcari = $request->sppcari;

        // mengambil data dari table spp sesuai pencarian data
        $spp = DB::table('tbl_spp')
        ->where('spp','like',"%".$sppcari."%")
        ->paginate();

        // mengirim data spp ke view v_spp
        return view('admin.pages.v_spp',['spp' => $spp]);
    }



    public function sppcari(Request $request)
    {
        $katakunci = $request->sppcari;
        $spp = sppModel::where('spp', 'like', "%" . $katakunci . "%")
        ->paginate(10);

        //return view('admin.pages.v_spp', compact('spp'))
        //->with('i', (request()->input('page', 1) - 1) * 10);

        // mengirim data spp ke view v_spp
        return view('admin.pages.v_spp',['spp' => $spp]);
    }
    //====================AKHIR METHODE UNTUK CARI spp=================




    //====================AWAL METHODE UNTUK EDIT spp=================
    public function sppedit($idspp, Request $request)
    {
        $this->validate($request,[
            'idspp' => 'required',
            'spp' => 'required'
        ]);

        $spp = sppModel::find($idspp);
        $spp->idspp = $request->idspp;
        $spp->spp = $request->spp;
        $spp->save();

        //return redirect('/jurursan');
        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT spp=================
}
