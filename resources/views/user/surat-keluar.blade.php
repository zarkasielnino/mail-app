@extends('layouts.user')

@section('title', 'Surat Keluar')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Surat Keluar</h5>
            <div>
                <a href="{{ route('user.buat-surat') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Surat Baru
                </a>
                <button class="btn btn-info ms-2" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="semua-tab" data-bs-toggle="tab" data-bs-target="#semua" type="button" role="tab" aria-controls="semua" aria-selected="true">Semua</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">Draft</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="diproses-tab" data-bs-toggle="tab" data-bs-target="#diproses" type="button" role="tab" aria-controls="diproses" aria-selected="false">Diproses</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="disetujui-tab" data-bs-toggle="tab" data-bs-target="#disetujui" type="button" role="tab" aria-controls="disetujui" aria-selected="false">Disetujui</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ditolak-tab" data-bs-toggle="tab" data-bs-target="#ditolak" type="button" role="tab" aria-controls="ditolak" aria-selected="false">Ditolak</button>
            </li>
        </ul>
        
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Perihal</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SK/2025/001</td>
                                <td>Permohonan Magang</td>
                                <td>Fakultas Ilmu Komputer</td>
                                <td>04 Apr 2025</td>
                                <td><span class="badge bg-warning">Diproses</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>SK/2025/002</td>
                                <td>Undangan Rapat Organisasi</td>
                                <td>Ketua Jurusan</td>
                                <td>01 Apr 2025</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>-</td>
                                <td>Permohonan Beasiswa</td>
                                <td>Bagian Kemahasiswaan</td>
                                <td>29 Mar 2025</td>
                                <td><span class="badge bg-secondary">Draft</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Perihal</th>
                                <th>Tujuan</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Permohonan Beasiswa</td>
                                <td>Bagian Kemahasiswaan</td>
                                <td>29 Mar 2025</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Perihal</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SK/2025/001</td>
                                <td>Permohonan Magang</td>
                                <td>Fakultas Ilmu Komputer</td>
                                <td>04 Apr 2025</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tab-pane fade" id="disetujui" role="tabpanel" aria-labelledby="disetujui-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Perihal</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SK/2025/002</td>
                                <td>Undangan Rapat Organisasi</td>
                                <td>Ketua Jurusan</td>
                                <td>01 Apr 2025</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-download"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak-tab">
                <div class="alert alert-info">
                    Tidak ada surat yang ditolak.
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan 1-3 dari 3 surat
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item disabled">
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
                <h5 class="modal-title" id="filterModalLabel">Filter Surat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="filter-tujuan" class="form-label">Tujuan</label>
                        <select class="form-select" id="filter-tujuan">
                            <option value="">Semua Tujuan</option>
                            <option value="fakultas">Fakultas</option>
                            <option value="rektorat">Rektorat</option>
                            <option value="kemahasiswaan">Bagian Kemahasiswaan</option>
                            <option value="jurusan">Jurusan</option>
                            <option value="perpustakaan">Perpustakaan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="filter-status" class="form-label">Status</label>
                        <select class="form-select" id="filter-status">
                            <option value="">Semua Status</option>
                            <option value="draft">Draft</option>
                            <option value="diproses">Diproses</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
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
                        <input type="text" class="form-control" id="filter-keyword" placeholder="Cari berdasarkan perihal atau nomor surat...">
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