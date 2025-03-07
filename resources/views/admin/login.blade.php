<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Aplikasi SPP | SMK Negeri 1 Cimahi</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('TemplateAdminLTE') }}/dist/css/adminlte.min.css">

        <link href="{{ asset('TemplateAdminLTE') }}/dist/select2/css/select2.min.css" rel="stylesheet" />
        <script src="{{ asset('TemplateAdminLTE') }}/plugins/jquery/jquery.min.js"></script>
        <script src="{{ asset('TemplateAdminLTE') }}/dist/select2/js/select2.full.min.js"></script>
    </head>

    <body>

        <div class="container">
            <br>
            {{-- <center>
                <img src="{{ asset('gambar/logo.png') }}" width="150px" height="150px" class="text-center">
            </center> --}}

            <div  class="col-lg-6 offset-lg-3">
                {{-- <h2 class="text-center">
                    Aplikasi Keuangan
                    <p>SMK TI Pembangunan
                </h2> --}}
                <hr>
                @if (session('error'))
                    <div class="alert alert-danger">
                        <b>Opps!</b>
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('loginaksi') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select type="text" class="form-control" id="thnajaran" name="thnajaran" required="">
                            <option></option>
                            @foreach ($thnajaran as $t)
                                <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block">
                        Log In
                    </button>

                    <hr>
                    {{-- <p class="text-center">
                        Belum punya akun?
                        <a href="#">
                            Register
                        </a>
                        sekarang!
                    </p> --}}
                </form>
            </div>
        </div>
    </body>
</html>
