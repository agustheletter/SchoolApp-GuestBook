<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JenisBayarDetailModel;
use App\Models\JenisBayarModel;
use App\Models\TahunAjaranModel;
use App\Models\TingkatModel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Session;

class JenisBayarDetailController extends Controller
{
    use ValidatesRequests;
    //====================AWAL METHODE UNTUK TAMPIL DetailJenisBayar=================
    public function tampil()
    {
        // // mengambil data guru
        // $DetailJenisBayar = DetailJenisBayarModel::orderby('idDetailJenisBayar', 'ASC')
        // ->paginate(10);

        $DetailJenisBayar = JenisBayarDetailModel::
        join('tbl_jenisbayar','tbl_jenisbayar.idjenisbayar','=','tbl_jenisbayardetail.idjenisbayar')
        ->join('tbl_tingkat','tbl_tingkat.idtingkat','=','tbl_jenisbayardetail.idtingkat')
        ->join('tbl_thnajaran','tbl_thnajaran.idthnajaran','=','tbl_jenisbayardetail.idthnajaran')
        // ->where('tbl_thnajaran.idthnajaran',Session::get('idthnajaran'))
        ->get();


        $datajenisbayar = JenisBayarModel::all();
        $datatingkat    = TingkatModel::all();
        $datathnajaran  = TahunAjaranModel::all();

        // mengirim data guru ke view guru v_detailjenisbayar
        return view('admin.pages.master.v_jenisbayardetail', ['detailjenisbayar' => $DetailJenisBayar, 'jenisbayar' => $datajenisbayar, 'tingkat' => $datatingkat, 'thnajaran' => $datathnajaran]);

    }
    //===================AKHIR METHODE UNTUK TAMPIL DetailJenisBayar================



    //====================AWAL METHODE UNTUK TAMBAH DetailJenisBayar=================
    //method tambah data DetailJenisBayar dengan eloquent
    public function tambah(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            // 'idjenisbayardetail' => 'required',
            'idjenisbayar' => 'required',
            'idtingkat' => 'required',
            'idthnajaran' => 'required',
            'nominaljenisbayar' => 'required'
        ]);

        //DetailJenisBayarModel::create([
        JenisBayarDetailModel::create([
            // 'idjenisbayardetail' => $request->idDetailJenisBayar,
            'idjenisbayar' => $request->idjenisbayar,
            'idtingkat' => $request->idtingkat,
            'idthnajaran' => $request->idthnajaran,
            // 'idthnajaran' => Session::get('idthnajaran'),
            'nominaljenisbayar' => $request->nominaljenisbayar
        ]);

        //dd($x);
        // return redirect('/jenisbayardetail');
        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK TAMBAH DetailJenisBayar=================



    //====================AWAL METHODE UNTUK HAPUS DetailJenisBayar=================
    public function hapus($idjenisbayardetail)
    {
        $DetailJenisBayar = JenisBayarDetailModel::find($idjenisbayardetail);
        $DetailJenisBayar->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS DetailJenisBayar=================



    //====================AWAL METHODE UNTUK EDIT DetailJenisBayar=================
    public function edit($idjenisbayardetail, Request $request)
    {
        $this->validate($request, [
            // 'idjenisbayardetail' => 'required',
            'idjenisbayar' => 'required',
            'idtingkat' => 'required',
            'idthnajaran' => 'required',
            'nominaljenisbayar' => 'required'
        ]);

        $datajenisbayardetail = JenisBayarDetailModel::find($idjenisbayardetail);
        // $datajenisbayardetail->idjenisbayardetail = $request->idjenisbayardetail;
        $datajenisbayardetail->idjenisbayar = $request->idjenisbayar;
        $datajenisbayardetail->idtingkat = $request->idtingkat;
        $datajenisbayardetail->idthnajaran = $request->idthnajaran;
        $datajenisbayardetail->nominaljenisbayar = $request->nominaljenisbayar;
        $datajenisbayardetail->save();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT DetailJenisBayar=================
}
