@extends('layouts.user')

@section('title', 'Detail Surat')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Detail Surat</h5>
            <div>
                <a href="{{ route('user.surat.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                @if($surat->status == 'draft')
                <a href="{{ route('user.surat.edit', $surat->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                @endif
                @if($surat->status != 'draft')
                <a href="{{ route('user.surat.pdf', $surat->id) }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Unduh PDF
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 150px;">Nomor Surat</th>
                        <td>: {{ $surat->nomor_surat ?? 'Belum ditetapkan' }}</td>
                    </tr>
                    <tr>
                        <th>Perihal</th>
                        <td>: {{ $surat->perihal }}</td>
                    </tr>
                    <tr>
                        <th>Tujuan</th>
                        <td>: {{ $surat->tujuan }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 150px;">Tanggal Dibuat</th>
                        <td>: {{ $surat->created_at->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($surat->status == 'draft')
                            <span class="badge bg-secondary">Draft</span>
                            @elseif($surat->status == 'diajukan')
                            <span class="badge bg-warning">Diproses</span>
                            @elseif($surat->status == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                            @elseif($surat->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Diajukan Oleh</th>
                        <td>: {{ $surat->user->name ?? auth()->user()->name }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mb-4">
            <h6 class="fw-bold">Isi Surat:</h6>
            <div class="border p-3" style="min-height: 200px;">
                {!! $surat->isi_surat !!}
            </div>
        </div>

        @if($surat->lampiran)
        <div class="mb-4">
            <h6 class="fw-bold">Lampiran:</h6>
            <div class="border p-3">
                <a href="{{ Storage::url('public/lampiran/' . $surat->lampiran) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-paperclip"></i> {{ $surat->lampiran }}
                </a>
            </div>
        </div>
        @endif

        @if($surat->catatan)
        <div class="mb-4">
            <h6 class="fw-bold">Catatan Admin:</h6>
            <div class="border p-3 {{ $surat->status == 'ditolak' ? 'border-danger' : '' }}">
                {{ $surat->catatan }}
            </div>
        </div>
        @endif

        @if($surat->status == 'draft')
        <div class="mt-4">
            <form action="{{ route('user.surat.update', $surat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="submit_action" value="submit">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin mengajukan surat ini? Surat yang sudah diajukan tidak dapat diedit kembali.')">
                    <i class="fas fa-paper-plane"></i> Ajukan Surat
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection