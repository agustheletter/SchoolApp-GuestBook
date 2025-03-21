</?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//panggil model Tahun Ajaran
use App\Models\TahunAjaranModel;

//panggil model Login
use App\Models\LoginModel;

use Session;

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


        //validasi untuk select tahun ajaran harus terisi
        // $this->validate($request, [
        //     'thnajaran' => 'required'
        // ]);




        // dd($datathnajaran);

        if (Auth::Attempt($data))
        {
             // menangkap data tahun ajaran
            $katakunci = $request->thnajaran;

            // $datathnajaran = TahunAjaranModel::where('idthnajaran', $katakunci)
            //     ->get();

                // dd($datathnajaran);

            //insert data ke table tbl_login untuk mengatahui siapa saja yang melakukan login
            LoginModel::create([
                'email' => $request->email,
                'idthnajaran' => $request->thnajaran
            ]);

            //error terus di sini kirim data tahun jaran ke view home
            // return redirect('/home',['thnajaran' => $datathnajaran]);
            // return redirect('/home',['thnajaran' => $katakunci]);
            return redirect('/home','thnajaran'->$katakunci);
            // return redirect('/home',$katakunci);

            // return redirect('/home');
        }
        else
        {
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }


    //Fungsi untuk LOGOUT
    public function logoutaksi()
    {
        Auth::logout();
        return redirect('/');
    }

}
