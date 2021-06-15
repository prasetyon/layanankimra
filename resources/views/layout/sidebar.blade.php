
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Brand Logo -->
    <a href="{{url("/")}}" class="brand-link">
        <img src="{{asset('admin/img/logoAAI-crop.png')}}" alt="App Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SILK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{asset('admin/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name ?? "ADMINISTRATOR"}}</a>
            </div>
        </div>

      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link @if($title=='Dashboard') active @endif">
                        <i class="nav-icon fas fa-home"></i>
                            <p>
                            Dashboard
                            </p>
                        </a>
                    </li>
                {{-- <li class="nav-item">
                    <a href="{{route('resetpass')}}" class="nav-link @if($title=='Reset Password') active @endif">
                    <i class="nav-icon fas fa-key"></i>
                        <p>
                        Reset Password
                        </p>
                    </a>
                </li> --}}

                <li class="nav-header">Advokasi</li>
                <li class="nav-item">
                    <a href="{{route('penangananperkara')}}" class="nav-link @if($title=='Penanganan Perkara') active @endif">
                    <i class="nav-icon fas fa-gavel"></i>
                        <p>
                        Penanganan Perkara
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pendampingan')}}" class="nav-link @if($title=='Pendampingan') active @endif">
                    <i class="nav-icon fas fa-users"></i>
                        <p>
                        Pendampingan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pendapathukum')}}" class="nav-link @if($title=='Pendapat Hukum') active @endif">
                    <i class="nav-icon fas fa-comment"></i>
                        <p>
                        Pendapat Hukum
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('kalenderkegiatan')}}" class="nav-link @if($title=='Kalender Kegiatan') active @endif">
                    <i class="nav-icon fas fa-calendar"></i>
                        <p>
                        Kalender Kegiatan
                        </p>
                    </a>
                </li>
                @if(in_array(Auth::user()->role, ['admin', 'superuser']))
                <li class="nav-item">
                    <a href="{{route('kajianhukum')}}" class="nav-link @if($title=='Kajian Hukum') active @endif">
                    <i class="nav-icon fas fa-book"></i>
                        <p>
                        Kajian Hukum
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('referensiperaturan')}}" class="nav-link @if($title=='Referensi Peraturan') active @endif">
                    <i class="nav-icon fas fa-file"></i>
                        <p>
                        Referensi Peraturan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('jenisperkara')}}" class="nav-link @if($title=='Jenis Perkara') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                        <p>
                        Jenis Perkara
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-header">Pengaduan</li>
                <li class="nav-item">
                    <a href="{{route('pengaduan')}}" class="nav-link @if($title=='Pengaduan') active @endif">
                    <i class="nav-icon fas fa-flag"></i>
                        <p>
                            Pengaduan
                        </p>
                    </a>
                </li>
                @if(in_array(Auth::user()->role, ['admin', 'superuser']))
                <li class="nav-item">
                    <a href="{{route('jenisaduan')}}" class="nav-link @if($title=='Jenis Aduan') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                        <p>
                            Jenis Aduan
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-header">Pengawasan</li>
                <li class="nav-item">
                    <a href="{{route('pengawasan')}}" class="nav-link @if($title=='Pengawasan') active @endif">
                    <i class="nav-icon fas fa-search"></i>
                        <p>
                            Pengawasan
                        </p>
                    </a>
                </li>
                @if(in_array(Auth::user()->role, ['admin', 'superuser']))
                <li class="nav-item">
                    <a href="{{route('aparatpemeriksa')}}" class="nav-link @if($title=='Aparat Pemeriksa') active @endif">
                    <i class="nav-icon fas fa-user-secret"></i>
                        <p>
                            Aparat Pemeriksa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('statustinjut')}}" class="nav-link @if($title=='Status Tinjut') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                        <p>
                            Status Tinjut
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('jenispengawasan')}}" class="nav-link @if($title=='Jenis Pengawasan') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                        <p>
                            Jenis Pengawasan
                        </p>
                    </a>
                </li>
                @endif
                {{-- <li class="nav-item">
                    <a href="{{route('jenispemeriksaantinjut')}}" class="nav-link @if($title=='Jenis Pemeriksaan Tinjut') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                        <p>
                            Jenis Pemeriksaan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('aparat')}}" class="nav-link @if($title=='Aparat Pemeriksa') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                        <p>
                            Aparat Pemeriksa
                        </p>
                    </a>
                </li> --}}

                <li class="nav-header">Pengendalian Internal</li>
                <li class="nav-item">
                    <a href="{{route('epite')}}" class="nav-link @if($title=='EPITE') active @endif">
                    <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            EPITE
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pipk')}}" class="nav-link @if($title=='PIPK') active @endif">
                    <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            PIPK
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('ppita')}}" class="nav-link @if($title=='PPITA') active @endif">
                    <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            PPITA
                        </p>
                    </a>
                </li>


                <li class="nav-header">Manajemen Risiko</li>
                <li class="nav-item">
                    <a href="{{route('piagamrisiko')}}" class="nav-link @if($title=='Piagam Risiko') active @endif">
                    <i class="nav-icon fas fa-book"></i>
                        <p>
                            Piagam Risiko
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profilrisiko')}}" class="nav-link @if($title=='Profil Risiko') active @endif">
                    <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Profil Risiko
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('mitigasirisiko')}}" class="nav-link @if($title=='Mitigasi Risiko') active @endif">
                    <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Mitigasi Risiko
                        </p>
                    </a>
                </li>
                @if(in_array(Auth::user()->role, ['admin', 'superuser']))
                <li class="nav-item">
                    <a href="{{route('sasaranorganisasi')}}" class="nav-link @if($title=='Sasaran Organisasi') active @endif">
                    <i class="nav-icon fas fa-database"></i>
                        <p>
                            Sasaran Organisasi
                        </p>
                    </a>
                </li>
                @endif
                {{-- @if(in_array(Auth::user()->role, ['admin', 'superuser']))
                    <li class="nav-header">File Referensi</li>
                    <li class="nav-item">
                        <a href="{{route('peraturan')}}" class="nav-link @if($title=='Peraturan') active @endif">
                        <i class="nav-icon fas fa-book"></i>
                            <p>
                            Peraturan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('kajianhukum')}}" class="nav-link @if($title=='Kajian Hukum') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                            <p>
                            Kajian Hukum
                            </p>
                        </a>
                    </li>
                @endif --}}

                <li class="nav-header">Referensi</li>
                @if(in_array(Auth::user()->role, ['admin', 'superuser']))
                <li class="nav-item">
                    <a href="{{route('user')}}" class="nav-link @if($title=='User') active @endif">
                    <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('unitdja')}}" class="nav-link @if($title=='Unit DJA') active @endif">
                    <i class="nav-icon fas fa-building"></i>
                        <p>
                            Unit
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('notifikasi')}}" class="nav-link @if($title=='Notifikasi') active @endif">
                    <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notifikasi
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
