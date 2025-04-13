<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Overview Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats card-stats-blue shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Surat Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuratMasuk ?? 0 }}</div>
                            <div class="text-xs mt-2">{{ $suratMasukBaru ?? 0 }} surat baru hari ini</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats card-stats-green shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Surat Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuratKeluar ?? 0 }}</div>
                            <div class="text-xs mt-2">{{ $suratKeluarBaru ?? 0 }} surat baru hari ini</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats card-stats-yellow shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Disposisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDisposisi ?? 0 }}</div>
                            <div class="text-xs mt-2">{{ $disposisiBaru ?? 0 }} disposisi baru</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats card-stats-red shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Arsip</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalArsip ?? 0 }}</div>
                            <div class="text-xs mt-2">{{ $arsipBaru ?? 0 }} arsip baru</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Surat Masuk Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Masuk Terbaru</h6>
                    <a href="{{ route('admin.surat-masuk') }}" class="btn btn-sm btn-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No. Surat</th>
                                    <th>Pengirim</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suratMasukTerbaru ?? [] as $surat)
                                <tr>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->tanggal_surat }}</td>
                                    <td>
                                        @if($surat->status == 'baru')
                                        <span class="badge bg-primary">Baru</span>
                                        @elseif($surat->status == 'diproses')
                                        <span class="badge bg-warning">Diproses</span>
                                        @elseif($surat->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada surat masuk terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Surat Keluar Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Surat Keluar Terbaru</h6>
                    <a href="{{ route('admin.surat-keluar') }}" class="btn btn-sm btn-success">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No. Surat</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suratKeluarTerbaru ?? [] as $surat)
                                <tr>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->tujuan }}</td>
                                    <td>{{ $surat->tanggal_surat }}</td>
                                    <td>
                                        @if($surat->status == 'draft')
                                        <span class="badge bg-secondary">Draft</span>
                                        @elseif($surat->status == 'ditandatangani')
                                        <span class="badge bg-info">Ditandatangani</span>
                                        @elseif($surat->status == 'dikirim')
                                        <span class="badge bg-success">Dikirim</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada surat keluar terbaru</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik & Statistik -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Surat Bulanan</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse($aktivitasTerbaru ?? [] as $aktivitas)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $aktivitas->judul }}</h6>
                                <small>{{ $aktivitas->waktu_relatif }}</small>
                            </div>
                            <p class="mb-1">{{ $aktivitas->deskripsi }}</p>
                            <small>{{ $aktivitas->pengguna }}</small>
                        </a>
                        @empty
                        <p class="text-center">Tidak ada aktivitas terbaru</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk grafik bulanan
    const monthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [
            {
                label: 'Surat Masuk',
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                data: [{{ implode(',', $statistikBulanan['suratMasuk'] ?? array_fill(0, 12, 0)) }}],
            },
            {
                label: 'Surat Keluar',
                backgroundColor: 'rgba(28, 200, 138, 0.5)',
                borderColor: 'rgba(28, 200, 138, 1)',
                data: [{{ implode(',', $statistikBulanan['suratKeluar'] ?? array_fill(0, 12, 0)) }}],
            }
        ]
    };

    // Konfigurasi grafik
    window.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: monthlyData,
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection