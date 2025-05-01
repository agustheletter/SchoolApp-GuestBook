<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Tentang Aplikasi')
@section('title','About')

    <!--awal isi konten dinamis-->
    @section('konten')
        {{-- <img src="{{ asset('template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        <img src="{{ asset('gambar/icon.png') }}" class="img-circle elevation-2" width="160px" height="160px" class="text-center">
        <br>
        <br>
        Aplikasi dibuat oleh
        <p>

        <h2>Adrenalin Muhammad Dewangga</h2>
        <h2>Evliya Satari Nurarifah</h2>

        <h2>Pembimbing : Agus Suratna Permadi, S.Pd.</h2>

    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->
