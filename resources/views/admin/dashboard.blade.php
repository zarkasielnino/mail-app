<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Laporan
    </a>
</div>

<!-- Statistik Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow h-100 py-2 card-stats card-stats-blue">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Surat Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">215</div>
                        <small class="text-muted">7 hari terakhir</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow h-100 py-2 card-stats card-stats-green">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Surat Keluar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">198</div>
                        <small class="text-muted">7 hari terakhir</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow h-100 py-2 card-stats card-stats-yellow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Disposisi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">43</div>
                        <small class="text-muted">Menunggu tindak lanjut</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-share fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow h-100 py-2 card-stats card-stats-red">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Template Surat</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">24</div>
                        <small class="text-muted">Tersedia</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Surat Masuk Terbaru -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Surat Masuk Terbaru</h6>
                <a href="{{ route('admin.surat-masuk') }}" class="btn btn-sm btn-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Pengirim</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SM/2025/IV/001</td>
                                <td>Kementerian Pendidikan</td>
                                <td>12/04/2025</td>
                                <td><span class="badge bg-success">Diproses</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>SM/2025/IV/002</td>
                                <td>Dinas Pendidikan Kota</td>
                                <td>11/04/2025</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>SM/2025/IV/003</td>
                                <td>Universitas Mitra</td>
                                <td>10/04/2025</td>
                                <td><span class="badge bg-primary">Disposisi</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>SM/2025/IV/004</td>
                                <td>Bank Pendidikan</td>
                                <td>09/04/2025</td>
                                <td><span class="badge bg-success">Diproses</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>SM/2025/IV/005</td>
                                <td>Badan Akreditasi</td>
                                <td>08/04/2025</td>
                                <td><span class="badge bg-danger">Penting</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Surat Keluar Terbaru -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-success">Surat Keluar Terbaru</h6>
                <a href="{{ route('admin.surat-keluar') }}" class="btn btn-sm btn-success">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SK/2025/IV/045</td>
                                <td>Fakultas Teknik</td>
                                <td>13/04/2025</td>
                                <td><span class="badge bg-success">Terkirim</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>SK/2025/IV/044</td>
                                <td>Kementerian Riset</td>
                                <td>12/04/2025</td>
                                <td><span class="badge bg-warning">Draft</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>SK/2025/IV/043</td>
                                <td>BEM Universitas</td>
                                <td>11/04/2025</td>
                                <td><span class="badge bg-success">Terkirim</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>SK/2025/IV/042</td>
                                <td>Perpustakaan</td>
                                <td>10/04/2025</td>
                                <td><span class="badge bg-info">Menunggu TTD</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>SK/2025/IV/041</td>
                                <td>Fakultas Ekonomi</td>
                                <td>09/04/2025</td>
                                <td><span class="badge bg-success">Terkirim</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection