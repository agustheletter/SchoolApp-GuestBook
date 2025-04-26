<?php

namespace App\Providers;

use App\Models\BukuTamu;
use App\Models\PegawaiModel;
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
        View::share('totalPegawai', PegawaiModel::count());
        View::share('totalBukuTamu', BukuTamu::count());
    }
}
