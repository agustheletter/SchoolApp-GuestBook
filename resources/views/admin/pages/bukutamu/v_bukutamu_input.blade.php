<!--awal konten dinamis-->
@extends('admin.v_admin')
@section('judulhalaman', 'Input Buku Tamu')
@section('title', 'Input Buku Tamu')

<!--awal isi konten dinamis-->
@section('konten')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row d-flex justify-content-center p-4">
            <div class="col-lg-6 col-md-8 col-sm-10 col-12 mb-3">
                <a href="{{ route('bukutamu.orangtua') }}">
                    <div class="small-box bg-info text-center pt-4">
                        <h1><i class="fas fa-user-friends"></i></h1>
                        <h3 class="fs-3 fw-bold">Masuk Sebagai Orang Tua</h3>
                        <div class="small-box-footer w-100 py-2 bg-dark text-white rounded">Orang Tua <i class="fas fa-arrow-circle-right"></i></div>
                    </div>
                </a>
            </div>

            <div class="col-lg-6 col-md-8 col-sm-10 col-12 mb-3">
                <a href="{{ route('bukutamu.umum') }}">
                    <div class="small-box bg-success text-center pt-4">
                        <h1><i class="fas fa-user-tie"></i></h1>
                        <h3 class="fs-3 fw-bold">Masuk Sebagai Tamu Umum</h3>
                        <div class="small-box-footer w-100 py-2 bg-dark text-white rounded">Tamu Umum <i class="fas fa-arrow-circle-right"></i></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
<!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->
