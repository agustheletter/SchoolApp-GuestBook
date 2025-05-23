<?php

namespace App\Providers;

use App\Models\BukuTamu;
use App\Models\PegawaiModel;
use App\Models\SiswaModel;
use App\Models\Orangtua;
use App\Models\JabatanModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengirimkan total pegawai & total buku tamu ke semua view yang menggunakan 'layouts.admin'
        // View::composer('admin.v_admin', function ($view) {
        //     $view->with([
        //         'totalPegawai' => PegawaiModel::count(),
        //         'totalBukuTamu' => BukuTamu::count(),
        //     ]);
        // });

        // Mengirimkan total pegawai & total buku tamu ke seluruh view yang ada di projek ini
        // View::share('totalPegawai', PegawaiModel::count());
        // View::share('totalBukuTamu', BukuTamu::count());
        // View::share('totalSiswa', SiswaModel::count());
        // View::share('totalOrangtua', Orangtua::count());
        // View::share('totalJabatan', JabatanModel::count());

            if (Schema::hasTable('pegawai')) {
            View::share('totalPegawai', PegawaiModel::count());
        }

        if (Schema::hasTable('buku_tamu')) {
            View::share('totalBukuTamu', BukuTamu::count());
        }

        if (Schema::hasTable('siswa')) {
            View::share('totalSiswa', SiswaModel::count());
        }

        if (Schema::hasTable('tbl_orangtua')) {
            View::share('totalOrangtua', Orangtua::count());
        }

        if (Schema::hasTable('jabatan')) {
            View::share('totalJabatan', JabatanModel::count());
        }
    }
}
