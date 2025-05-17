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
        <h2>Aplikasi ini dibuat oleh</h2>
        <p>

        <h4>Adrenalin Muhammad Dewangga - <a href="https://adre.my.id">adre.my.id</a></h4>
        <h4>Evliya Satari Nurarifah - <a href="https://evliya.my.id">evliya.my.id</a></h4>

        <br>

        <h4>Pembimbing :</h4>
        <h4>Agus Suratna Permadi, S.Pd. - <a href="https://agussuratna.net">agussuratna.net</a></h4>

    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->
