@extends('layouts.user')

@section('title', 'Surat Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Surat Masuk</h5>
            <div>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
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
                        <th>Status</th>
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
                        <td><span class="badge bg-warning">Belum Dibaca</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-reply"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>SM/2025/002</td>
                        <td>Rektorat</td>
                        <td>Pengumuman Libur</td>
                        <td>01 Apr 2025</td>
                        <td><span class="badge bg-warning">Belum Dibaca</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-reply"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>SM/2025/003</td>
                        <td>Bagian Kemahasiswaan</td>
                        <td>Permohonan Data</td>
                        <td>30 Mar 2025</td>
                        <td><span class="badge bg-warning">Belum Dibaca</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-reply"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>SM/2025/004</td>
                        <td>Perpustakaan</td>
                        <td>Pemberitahuan Denda</td>
                        <td>25 Mar 2025</td>
                        <td><span class="badge bg-success">Dibaca</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-reply"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>SM/2025/005</td>
                        <td>Jurusan Teknik Informatika</td>
                        <td>Jadwal Kuliah Semester Genap</td>
                        <td>20 Mar 2025</td>
                        <td><span class="badge bg-success">Dibaca</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-reply"></i></a>
                            <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan 1-5 dari 20 surat
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
                <h5 class="modal-title" id="filterModalLabel">Filter Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="filter-pengirim" class="form-label">Pengirim</label>
                        <select class="form-select" id="filter-pengirim">
                            <option value="">Semua Pengirim</option>
                            <option value="fakultas">Fakultas</option>
                            <option value="rektorat">Rektorat</option>
                            <option value="kemahasiswaan">Bagian Kemahasiswaan</option>
                            <option value="perpustakaan">Perpustakaan</option>
                            <option value="jurusan">Jurusan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="filter-status" class="form-label">Status</label>
                        <select class="form-select" id="filter-status">
                            <option value="">Semua Status</option>
                            <option value="read">Dibaca</option>
                            <option value="unread">Belum Dibaca</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="filter-tanggal-awal" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="filter-tanggal-awal">
                    </div>
                    <div class="mb-3">
                        <label for="filter-tanggal-akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="filter-tanggal-akhir">
                    </div>
                    <div class="mb-3">
                        <label for="filter-keyword" class="form-label">Kata Kunci</label>
                        <input type="text" class="form-control" id="filter-keyword" placeholder="Cari berdasarkan subjek atau nomor surat...">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Terapkan Filter</button>
            </div>
        </div>
    </div>
</div>
@endsection