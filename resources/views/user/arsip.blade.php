@extends('layouts.user')

@section('title', 'Arsip Surat')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Arsip Surat</h5>
            <div>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari arsip surat..." aria-label="Cari">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active">Semua</button>
                    <button type="button" class="btn btn-outline-primary">Surat Masuk</button>
                    <button type="button" class="btn btn-outline-primary">Surat Keluar</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Jenis</th>
                        <th>Perihal</th>
                        <th>Pengirim/Tujuan</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>SM/2024/050</td>
                        <td>Surat Masuk</td>
                        <td>Undangan Workshop</td>
                        <td>Fakultas Ilmu Komputer</td>
                        <td>15 Des 2024</td>
                        <td><span class="badge bg-info">Akademik</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>SK/2024/045</td>
                        <td>Surat Keluar</td>
                        <td>Permohonan Izin Penelitian</td>
                        <td>Fakultas Teknik</td>
                        <td>10 Des 2024</td>
                        <td><span class="badge bg-primary">Penelitian</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>SM/2024/042</td>
                        <td>Surat Masuk</td>
                        <td>Pemberitahuan Kegiatan</td>
                        <td>Rektorat</td>
                        <td>05 Des 2024</td>
                        <td><span class="badge bg-success">Kegiatan</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>SK/2024/038</td>
                        <td>Surat Keluar</td>
                        <td>Permohonan Beasiswa</td>
                        <td>Bagian Kemahasiswaan</td>
                        <td>28 Nov 2024</td>
                        <td><span class="badge bg-warning">Beasiswa</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>SM/2024/035</td>
                        <td>Surat Masuk</td>
                        <td>Undangan Seminar</td>
                        <td>Fakultas Ekonomi</td>
                        <td>20 Nov 2024</td>
                        <td><span class="badge bg-info">Akademik</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan 1-5 dari 25 arsip
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Selanjutnya</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Arsip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="filter-jenis" class="form-label">Jenis Surat</label>
                        <select class="form-select" id="filter-jenis">
                            <option value="">Semua</option>
                            <option value="masuk">Surat Masuk</option>
                            <option value="keluar">Surat Keluar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="filter-kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="filter-kategori">
                            <option value="">Semua Kategori</option>
                            <option value="akademik">Akademik</option>
                            <option value="penelitian">Penelitian</option>
                            <option value="kegiatan
