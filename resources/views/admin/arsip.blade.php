<!-- resources/views/admin/arsip.blade.php -->
@extends('layouts.admin')

@section('title', 'Arsip Surat')

@section('page-title', 'Arsip Surat')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Arsip Surat</h1>
        <div>
            <a href="{{ route('admin.arsip.export') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                <i class="fas fa-file-excel fa-sm"></i> Export Excel
            </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cari & Filter Arsip</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.arsip') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                    <select class="form-select" id="jenis_surat" name="jenis_surat">
                        <option value="">Semua Jenis</option>
                        <option value="masuk" {{ request('jenis_surat') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                        <option value="keluar" {{ request('jenis_surat') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select class="form-select" id="tahun" name="tahun">
                        <option value="">Semua Tahun</option>
                        @for($i = date('Y'); $i >= date('Y')-5; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select class="form-select" id="bulan" name="bulan">
                        <option value="">Semua Bulan</option>
                        <option value="1" {{ request('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ request('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ request('bulan') == '4' ? 'selected' : '' }}>April</option>
                        <option value="5" {{ request('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ request('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ request('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ request('bulan') == '9' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="keyword" class="form-label">Kata Kunci</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Cari nomor surat, perihal, dll" value="{{ request('keyword') }}">
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('admin.arsip') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <ul class="nav nav-tabs" id="arsipTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="semua-tab" data-bs-toggle="tab" data-bs-target="#semua" 
                            type="button" role="tab" aria-controls="semua" aria-selected="true">Semua</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk" 
                            type="button" role="tab" aria-controls="masuk" aria-selected="false">Surat Masuk</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar" 
                            type="button" role="tab" aria-controls="keluar" aria-selected="false">Surat Keluar</button>
                </li>
            </ul>
            <div class="tab-content" id="arsipTabContent">
                <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="dataTableSemua" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>No. Surat</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Dari/Kepada</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($arsipSurat ?? [] as $index => $arsip)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if($arsip->jenis_surat == 'masuk')
                                        <span class="badge bg-primary">Masuk</span>
                                        @else
                                        <span class="badge bg-success">Keluar</span>
                                        @endif
                                    </td>
                                    <td>{{ $arsip->nomor_surat }}</td>
                                    <td>{{ $arsip->tanggal_surat }}</td>
                                    <td>{{ $arsip->perihal }}</td>
                                    <td>{{ $arsip->jenis_surat == 'masuk' ? $arsip->pengirim : $arsip->tujuan }}</td>
                                    <td>
                                        @if($arsip->file_path)
                                        <a href="{{ asset('storage/'.$arsip->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-file-pdf"></i> Lihat
                                        </a>
                                        @else
                                        <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.arsip.show', $arsip->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.arsip.download', $arsip->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data arsip</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="masuk" role="tabpanel" aria-labelledby="masuk-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="dataTableMasuk" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Surat</th>
                                    <th>Tanggal</th>
                                    <th>Pengirim</th>
                                    <th>Perihal</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($arsipMasuk ?? [] as $index => $arsip)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $arsip->nomor_surat }}</td>
                                    <td>{{ $arsip->tanggal_surat }}</td>
                                    <td>{{ $arsip->pengirim }}</td>
                                    <td>{{ $arsip->perihal }}</td>
                                    <td>
                                        @if($arsip->file_path)
                                        <a href="{{ asset('storage/'.$arsip->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-file-pdf"></i> Lihat
                                        </a>
                                        @else
                                        <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.arsip.show', $arsip->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.arsip.download', $arsip->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data arsip surat masuk</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="keluar" role="tabpanel" aria-labelledby="keluar-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="dataTableKeluar" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Surat</th>
                                    <th>Tanggal</th>
                                    <th>Tujuan</th>
                                    <th>Perihal</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($arsipKeluar ?? [] as $index => $arsip)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $arsip->nomor_surat }}</td>
                                    <td>{{ $arsip->tanggal_surat }}</td>
                                    <td>{{ $arsip->tujuan }}</td>
                                    <td>{{ $arsip->perihal }}</td>
                                    <td>
                                        @if($arsip->file_path)
                                        <a href="{{ asset('storage/'.$arsip->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-file-pdf"></i> Lihat
                                        </a>
                                        @else
                                        <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.arsip.show', $arsip->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.arsip.download', $arsip->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data arsip surat keluar</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTableSemua').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            }
        });
        
        $('#dataTableMasuk').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            }
        });
        
        $('#dataTableKeluar').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            }
        });
    });
</script>
@endsection