<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Sistem Surat Menyurat Kampus</title>
    <!-- Menggunakan Bootstrap dan Font Awesome untuk tampilan yang lebih baik -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        .sidebar {
            background-color: #343a40;
            min-height: 100vh;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
        }
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background-color: #007bff;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .header {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        .main-content {
            padding: 20px;
        }
        .badge-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        .card-stats {
            border-left: 4px solid;
        }
        .card-stats-blue {
            border-left-color: #4e73df;
        }
        .card-stats-green {
            border-left-color: #1cc88a;
        }
        .card-stats-yellow {
            border-left-color: #f6c23e;
        }
        .card-stats-red {
            border-left-color: #e74a3b;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

    </style>
    @yield('css')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar d-flex flex-column p-0">
                <div class="py-3 text-center">
                    <h4>SISUKAT</h4>
                    <small>Sistem Surat Kampus Terpadu</small>
                </div>
                <hr class="mx-3">
                <div class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.surat-masuk') }}" class="nav-link {{ Request::routeIs('admin.surat-masuk*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i> Surat Masuk
                    </a>
                    <a href="{{ route('admin.surat-keluar') }}" class="nav-link {{ Request::routeIs('admin.surat-keluar*') ? 'active' : '' }}">
                        <i class="fas fa-paper-plane"></i> Surat Keluar
                    </a>
                    <a href="{{ route('admin.disposisi') }}" class="nav-link {{ Request::routeIs('admin.disposisi*') ? 'active' : '' }}">
                        <i class="fas fa-paper-plane"></i> Disposisi
                    </a>
                    <a href="{{ route('admin.arsip') }}" class="nav-link {{ Request::routeIs('admin.arsip*') ? 'active' : '' }}">
                        <i class="fas fa-archive"></i> Arsip Surat
                    </a>
                    <a href="{{ route('manage.index') }}" class="nav-link {{ Request::routeIs('admin.manage*') ? 'active' : '' }}">
                        <i class="fas fa-archive"></i> Manajemen Anggota
                    </a>
                    <a href="{{ route('admin.template') }}" class="nav-link {{ Request::routeIs('admin.template*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i> Template Surat
                    </a>
                    <a href="{{ route('admin.pengaturan') }}" class="nav-link {{ Request::routeIs('admin.pengaturan*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                </div>
                <div class="mt-auto mb-3">
                    <hr class="mx-3">
                    <a href="{{ route('logout') }}" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-0">
                <!-- Header -->
                <div class="header d-flex justify-content-between align-items-center px-4">
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-bars"></i>
                        </button>
                        <span class="d-none d-md-inline">@yield('page-title', 'Dashboard Admin')</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-sm d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('img/user.jpg') }}" class="rounded-circle me-2" width="30">
                                <span>Admin Sistem</span>
                                <i class="fas fa-chevron-down ms-2"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user fa-sm me-2"></i> Profil Saya
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.pengaturan') }}">
                                    <i class="fas fa-cog fa-sm me-2"></i> Pengaturan
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm me-2"></i> Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="main-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    @yield('scripts')
</body>
</html>