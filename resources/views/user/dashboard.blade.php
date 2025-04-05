@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Selamat Datang, {{ Auth::user()->name ?? 'Pengguna' }}!</h5>
                <p class="card-text">Sistem Surat Menyurat Kampus membantu Anda mengelola surat masuk dan keluar secara efisien.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Surat Masuk</h5>
                        <h2 class="card-text">5</h2>
                    </div>
                    <i class="fas fa-envelope fa-3x"></i>
                </div>
                <a href="{{ route('user.surat-masuk') }}" class="btn btn-outline-light mt-3">Lihat Semua</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Surat Keluar</h5>
                        <h2 class="card-text">3</h2>
                    </div>
                    <i class="fas fa-paper-plane fa-3x"></i>
                </div>
                <a href="{{ route('user.surat-keluar') }}" class="btn btn-outline-light mt-3">Lihat Semua</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Menunggu Persetujuan</h5>
                        <h2 class="card-text">2</h2>
                    </div>
                    <i class="fas fa-clock fa-3x"></i>
                </div>
                <a href="{{ route('user.surat-keluar', ['status' => 'pending']) }}" class="btn btn-outline-light mt-3">Lihat Semua</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Surat Masuk Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Pengirim</th>
                                <th>Subjek</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SM/2025/001</td>
                                <td>Fakultas Ilmu Komputer</td>
                                <td>Undangan Seminar</td>
                                <td>03 Apr 2025</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>SM/2025/002</td>
                                <td>Rektorat</td>
                                <td>Pengumuman Libur</td>
                                <td>01 Apr 2025</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>SM/2025/003</td>
                                <td>Bagian Kemahasiswaan</td>
                                <td>Permohonan Data</td>
                                <td>30 Mar 2025</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Status Surat</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Tindakan Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('user.buat-surat') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Buat Surat Baru
                    </a>
                    <a href="{{ route('user.surat-masuk') }}" class="btn btn-info">
                        <i class="fas fa-envelope"></i> Lihat Surat Masuk
                    </a>
                    <a href="{{ route('user.arsip') }}" class="btn btn-secondary">
                        <i class="fas fa-archive"></i> Kelola Arsip
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('statusChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Disetujui', 'Menunggu', 'Ditolak'],
                datasets: [{
                    data: [5, 2, 1],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endsection
