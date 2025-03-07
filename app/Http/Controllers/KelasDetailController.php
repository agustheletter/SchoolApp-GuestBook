<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasDetailModel;
use App\Models\KelasModel;
use App\Models\RuanganModel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;


class KelasDetailController extends Controller
{
    use ValidatesRequests;

    //====================AWAL METHODE UNTUK TAMPIL kelasdetail=================
    //tampil dengan eloquent
    public function kelasdetail()
    {
        //ambil idtahun ajaran aktif
        $idthnajaran = Session::get('idthnajaran');

        //ambil data detail kelas berdasarkan tahun ajaran aktif
        $datakelasdetail = KelasDetailModel::where('tbl_kelasdetail.idthnajaran',$idthnajaran)
        ->get();

        //ambil data kelas untuk select data
        $datakelas=KelasModel::all();

        //ambil data guru untuk select data
        $dataguru=GuruModel::all();

        //ambil data ruangan untuk select data
        $dataruangan=RuanganModel::all();

        // mengirim data guru ke view guru
        return view('admin.pages.master.v_kelasdetail',
            [
                'kelasdetail' => $datakelasdetail,
                // 'thnajaran' => $datathnajaran,
                'kelas' => $datakelas,
                'guru' => $dataguru,
                'ruangan' => $dataruangan,
            ]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL kelasdetail================



    //====================AWAL METHODE UNTUK TAMBAH kelasdetail=================
    //method tambah data kelasdetail dengan eloquent
    public function kelasdetailtambah(Request $request)
    {
        // dd($request->all());
        //ambil idtahun ajaran aktif
        $idthnajaran = Session::get('idthnajaran');

        $this->validate($request, [
            // 'idkelasdetail' => 'required',
            'idkelas' => 'required',
            'idguru' => 'required',
            'idruangan' => 'required'
        ]);

        //kelasdetailModel::create([
        KelasDetailModel::create([
            // 'idkelasdetail' => $request->idkelasdetail,
            'idkelas' => $request->idkelas,
            'idthnajaran' => $idthnajaran,
            'idguru' => $request->idguru,
            'idruangan' => $request->idruangan,
        ]);

        return redirect('/kelasdetail');
    }
    //====================AKHIR METHODE UNTUK TAMBAH kelasdetail=================



    //====================AWAL METHODE UNTUK HAPUS kelasdetail=================
    public function kelasdetailhapus($idkelasdetail)
    {
        $kelasdetail = KelasDetailModel::find($idkelasdetail);
        $kelasdetail->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS kelasdetail=================



    //====================AWAL METHODE UNTUK EDIT kelasdetail=================
    public function kelasdetailedit($idkelasdetail, Request $request)
    {
        $this->validate($request, [
            // 'idkelasdetail' => 'required',
            'idkelas' => 'required',
            'idguru' => 'required',
            'idruangan' => 'required'
        ]);

        //ambil idtahun ajaran aktif
        $idthnajaran = Session::get('idthnajaran');

        $kelasdetail = KelasDetailModel::find($idkelasdetail);
        // dd($kelasdetail);
        // $kelasdetail->idkelasdetail = $request->idkelasdetail;
        $kelasdetail->idkelas = $request->idkelas;
        $kelasdetail->idthnajaran = $idthnajaran;
        $kelasdetail->idguru = $request->idguru;
        $kelasdetail->idruangan = $request->idruangan;
        $kelasdetail->save();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT kelasdetail=================
}
