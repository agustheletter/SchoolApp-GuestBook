<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Home</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
          {{-- @foreach ($tahunajaran as $ta) --}}
            <a href="" class="nav-link">Tahun Ajaran Aktif : <b><font size="4" class="text-danger">{{Session::get('namatahunajaran')}}</font></b></a>
          {{-- @endforeach --}}

      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!--awal tampilan user-->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">

          Anda Login sebagai :
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{  Auth::user()->name }}
              <span class="caret"></span>
            </a> <ul class="dropdown-menu">
              <li>
                <a>ID User: {{ Auth::user()->id }}</a>
              </li>
              <li>
                {{-- <a>Level: {{ Auth::user()->level->level }}</a> --}}
                <a>Level: {{ Auth::user()->role}}</a>
              </li>
              <li role="separator" class="divider"></li>
              <li>
                <a href="{{ route('logoutaksi') }}">
                  <i class="fa fa-power-off"></i>
                  Log Out
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!--akhir tampilan user-->

      <!-- Awal Tombol Full Screen -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Akhir Tombol Full Screen -->

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
