@extends('layouts.user')

@section('title', 'Arsip Surat')

@section('css')
<style>
    .card {
        transition: transform 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .search-container {
        margin-bottom: 20px;
    }
    .filter-section {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .badge-category {
        font-size: 0.8rem;
    }
    .table-responsive {
        border-radius: 5px;
    }
    .table th {
        background-color: #f1f1f1;
    }
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }
    .btn-action {
        margin-right: 5px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Arsip Surat</h5>
                <div>
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <div class="search-container">
                    <form action="{{ route('user.arsip') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari nomor surat, perihal, atau pengirim..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Filter Tags (when filters are applied) -->
                @if(request()->has('jenis') || request()->has('tanggal_mulai') || request()->has('tanggal_akhir'))
                <div class="filter-section">
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="me-2"><i class="fas fa-filter"></i> Filter aktif:</span>
                        @if(request('jenis'))
                            <span class="badge bg-info me-2 mb-1">Jenis: {{ request('jenis') }}</span>
                        @endif
                        @if(request('tanggal_mulai'))
                            <span class="badge bg-info me-2 mb-1">Dari: {{ request('tanggal_mulai') }}</span>
                        @endif
                        @if(request('tanggal_akhir'))
                            <span class="badge bg-info me-2 mb-1">Sampai: {{ request('tanggal_akhir') }}</span>
                        @endif
                        <a href="{{ route('user.arsip') }}" class="btn btn-sm btn-outline-danger mb-1">
                            <i class="fas fa-times"></i> Hapus Filter
                        </a>
                    </div>
                </div>
                @endif

                <!-- Table Content -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th width="15%">Nomor Surat</th>
                                <th width="15%">Tanggal</th>
                                <th width="20%">Perihal</th>
                                <th width="15%">Jenis</th>
                                <th width="15%">Pengirim/Tujuan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($arsip ?? [] as $index => $surat)
                            <tr>
                                <td>{{ $index + $arsip->firstItem() }}</td>
                                <td>{{ $surat->nomor_surat }}</td>
                                <td>{{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $surat->perihal }}</td>
                                <td>
                                    @if($surat->jenis == 'masuk')
                                        <span class="badge bg-primary">Surat Masuk</span>
                                    @else
                                        <span class="badge bg-success">Surat Keluar</span>
                                    @endif
                                </td>
                                <td>{{ $surat->jenis == 'masuk' ? $surat->pengirim : $surat->tujuan }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('user.arsip.detail', $surat->id) }}" class="btn btn-sm btn-info btn-action">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('user.arsip.download', $surat->id) }}" class="btn btn-sm btn-success btn-action">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $surat->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $surat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus arsip surat <strong>{{ $surat->perihal }}</strong> dari sistem?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('user.arsip.delete', $surat->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-archive fa-3x text-secondary mb-3"></i>
                                        <h5>Tidak ada arsip surat ditemukan</h5>
                                        <p class="text-muted">Belum ada surat yang diarsipkan atau tidak ada surat yang sesuai dengan filter yang diterapkan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(isset($arsip) && $arsip->hasPages())
                <div>
                    {{ $arsip->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Arsip Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.arsip') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Surat</label>
                        <select class="form-select" id="jenis" name="jenis">
                            <option value="">Semua Jenis</option>
                            <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                    </div>
                    <!-- Add more filter options as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Handle filter reset
        $('#resetFilter').on('click', function(e) {
            e.preventDefault();
            window.location.href = '{{ route("user.arsip") }}';
        });
    });
</script>
@endsection