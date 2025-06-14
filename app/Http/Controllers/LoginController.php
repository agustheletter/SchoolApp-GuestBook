<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//panggil model Tahun Ajaran
use App\Models\TahunAjaranModel;

//panggil model Login
use App\Models\LoginModel;

use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //Fungsi menampilkan halaman Login
    public function login()
    {
        if (Auth::check())
        {
            return redirect('home');
        }
        else
        {
            $datathnajaran = TahunAjaranModel::all();
            return view('admin/login',['thnajaran' => $datathnajaran]);
        }
    }


    //Fungsi untuk AKSI Login
    public function loginaksi(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            // 'thnajaran' => $request->input('text')
        ];


        if (Auth::Attempt($data))
        {
            // menangkap data ID tahun ajaran
            $katakunci = $request->thnajaran;
            $request->session()->put('idthnajaran', $katakunci);

            //ambil seluruh data nama tahun ajaran
            $tahunajaran = TahunAjaranModel::select("*")
            ->where('tbl_thnajaran.idthnajaran',$katakunci)
            ->first();

            $namatahun = $tahunajaran->thnajaran;
            $request->session()->put('namatahunajaran', $namatahun);


            //insert data ke table tbl_login untuk mengatahui siapa saja yang melakukan login
            LoginModel::create([
                'email' => $request->email,
                'idthnajaran' => $request->thnajaran
            ]);

            return redirect()->intended('/home');
            // return redirect('/home');
        }
        else
        {
            Session::flash('error', 'Email atau Password Salah');

            // return redirect('login')->withInput();
            return redirect()->back()->withInput();
        }
    }


    //Fungsi untuk LOGOUT
    public function logoutaksi()
    {
        Auth::logout();
        return redirect('/');
    }

}
