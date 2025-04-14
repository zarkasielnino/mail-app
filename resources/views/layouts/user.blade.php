<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Sistem Surat Menyurat Kampus</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            background-color: #343a40;
            min-height: 100vh;
            color: white;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, .75);
            padding: 1rem;
        }

        .sidebar .nav-link:hover {
            color: rgba(255, 255, 255, 1);
            background-color: rgba(255, 255, 255, .1);
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, .2);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .content {
            padding: 20px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .badge-notif {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="my-4 text-center">
                        <i class="fas fa-envelope-open-text me-2"></i>
                        SISUKAT
                        <p>Universitas KH.Bahaudin Mudhary Madura</p>
                    </div>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('surat-masuk*') ? 'active' : '' }}" href="{{ route('user.surat-masuk') }}">
                                <i class="fas fa-envelope"></i> Surat Masuk
                                <span class="badge bg-danger rounded-pill">3</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('surat-keluar*') ? 'active' : '' }}" href="{{ route('user.surat.index') }}">
                                <i class="fas fa-paper-plane"></i> Surat Keluar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('buat-surat*') ? 'active' : '' }}" href="{{ route('user.buat-surat') }}">
                                <i class="fas fa-plus-circle"></i> Buat Surat
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('arsip*') ? 'active' : '' }}" href="{{ route('user.arsip') }}">
                                <i class="fas fa-archive"></i> Arsip Surat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('profil*') ? 'active' : '' }}" href="{{ route('user.profil') }}">
                                <i class="fas fa-user"></i> Profil
                            </a>
                        </li> -->
                    </ul>
                    <hr>
                    <div class="px-3 py-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm rounded">
                    <div class="container-fluid">
                        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <span class="navbar-brand mb-0 h1">@yield('title')</span>
                        <div class="d-flex">
                            <div class="dropdown">
                                <button class="btn btn-light position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        3
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                    <li>
                                        <h6 class="dropdown-header">Notifikasi</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Surat dari Fakultas telah diterima</a></li>
                                    <li><a class="dropdown-item" href="#">Surat permohonan Anda telah disetujui</a></li>
                                    <li><a class="dropdown-item" href="#">Surat keterangan mahasiswa Anda siap diambil</a></li>
                                </ul>
                            </div>
                            <div class="dropdown ms-2">
                                <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name ?? 'Nama Pengguna' }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Keluar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Content Area -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>