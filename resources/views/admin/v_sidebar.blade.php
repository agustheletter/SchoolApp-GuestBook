<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('TemplateAdminLTE') }}/index3.html" class="brand-link">
        <img src="{{ asset('TemplateAdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Aplikasi Keuangan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ asset('template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
                <img src="{{ asset('gambar/photoprofile.jpg') }}" class="img-circle elevation-2" width="160px" height="160px" class="text-center">
            </div>
            <div class="info">
                {{-- <a href="#" class="d-block">{{ Auth::user()->name }}</a> --}}
                <a href="/about" class="d-block">Tentang Aplikasi</a>
            </div>
        </div>

        {{-- <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <!--Awal Dashboard-->
                <li class="nav-item">
                    <a href="{{url('/')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!--Akhir Dashboard-->


                <!--Awal MASTER DATA-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">4</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!--Awal Tahun AJaran-->
                        <li class="nav-item">
                            <a href="/thnajaran" class="nav-link">
                                {{-- <i class="nav-icon far fa-calendar-alt"></i> --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Tahun Ajaran
                                </p>
                            </a>
                        </li>
                        <!--Akhir Tahun AJaran-->

                        <!--Awal Ruangan-->
                        <li class="nav-item">
                            <a href="/ruangan" class="nav-link">
                                {{-- <i class="nav-icon far fa-calendar-alt"></i> --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Ruangan
                                </p>
                            </a>
                        </li>
                        <!--Akhir Ruangan-->


                        <!--Awal Program Keahlian-->
                        <li class="nav-item">
                            <a href="/programkeahlian" class="nav-link">
                                {{-- <i class="nav-icon fas fa-table"></i> --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Program Keahlian
                                </p>
                            </a>
                        </li>
                        <!--Akhir Program Keahlian-->


                        <!--Awal Jurusan-->
                        <li class="nav-item">
                            <a href="/jurusan" class="nav-link">
                                {{-- <i class="nav-icon fas fa-table"></i> --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Jurusan
                                </p>
                            </a>
                        </li>
                        <!--Akhir Jurusan-->


                        <!--Awal Kelas-->
                        <li class="nav-item">
                            <a href="/kelas" class="nav-link">
                                {{-- <i class="fas fa-restroom"></i> --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kelas
                                </p>
                            </a>
                        </li>
                        <!--Akhir Kelas-->

                        <!--Awal Kelas Detail-->
                        <li class="nav-item">
                            <a href="/kelasdetail" class="nav-link">
                                {{-- <i class="fas fa-restroom"></i> --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Kelas Detail
                                </p>
                            </a>
                        </li>
                        <!--Akhir Kelas Detail-->


                    </ul>
                </li>
                <!--Akhir MASTER DATA-->


                <!--Awal Siswa-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <p>
                            Siswa
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--Awal Master Siswa-->
                        <li class="nav-item">
                            <a href="{{url('siswa')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Master Siswa</p>
                            </a>
                        </li>
                        <!--Akhir Master Siswa-->

                        <!--Awal Cari Siswa-->
                        <li class="nav-item">
                            <a href="/siswadetail" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cari Siswa</p>
                            </a>
                        </li>
                        <!--Akhir Cari Siswa-->

                        <!--Awal Kelas Siswa-->
                        <li class="nav-item">
                            <a href="/siswakelas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelas Siswa</p>
                            </a>
                        </li>
                        <!--Akhir Kelas Siswa-->

                        <!--Awal Kelas Siswa-->
                        <li class="nav-item">
                            <a href="/mutasikelas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mutasi/Naik/Pindah Kelas</p>
                            </a>
                        </li>
                        <!--Akhir Kelas Siswa-->
                    </ul>
                </li>
                <!--Akhir Siswa-->



                <!--Awal Guru-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        {{-- <i class="fa fa-graduation-cap" aria-hidden="true"></i> --}}
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p>
                            Guru
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--Awal Master Guru-->
                        <li class="nav-item">
                            <a href="{{url('guru')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Master Guru</p>
                            </a>
                        </li>
                        <!--Akhir Master Guru-->

                        <!--Awal Mengajar Guru-->
                        <li class="nav-item">
                            <a href="/gurumengajar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mengajar Guru</p>
                            </a>
                        </li>
                        <!--Akhir Mengajar Guru-->
                    </ul>
                </li>
                <!--Akhir Guru-->



                <!--Awal Pembayaran-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-dollar-sign"></i>
                        <p>
                            Pembayaran
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">4</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('spp')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SPP</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/dsp" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DSP</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/daftarulang" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Ulang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/laporan" class="nav-link">
                                {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Pembayaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/jenisbayardetail" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Pembayaran</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <!--Akhir Pembayaran-->

                <!--Awal Pegawai-->
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        <p>
                            Pegawai
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('pegawai') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pegawai</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pegawai.input') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Input Pegawai</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!--Akhir Pegawai-->

                <!--Awal Buku Tamu-->
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fas fa-book-open"></i>
                        <p>
                            Buku Tamu
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('bukutamu') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Buku Tamu</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('bukutamu.input') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Input Buku Tamu</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!--Akhir Buku Tamu-->















{{--
                <li class="nav-item">
                    <a href="../gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../examples/invoice.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/profile.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/e-commerce.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>E-commerce</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/projects.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/project-add.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/project-edit.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Edit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/project-detail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Detail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/contacts.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/faq.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>FAQ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../examples/contact-us.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact us</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Search
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../search/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../search/enhanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enhanced</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
