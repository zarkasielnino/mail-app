@extends('layouts.user')

@section('title', 'Edit Surat')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Edit Surat</h5>
            <a href="{{ route('user.surat.show', $surat->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('user.surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" value="{{ old('perihal', $surat->perihal) }}" required>
                        @error('perihal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan <span class="text-danger">*</span></label>
                        <select class="form-select @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" required>
                            <option value="">-- Pilih Tujuan --</option>
                            <option value="Fakultas" {{ old('tujuan', $surat->tujuan) == 'Fakultas' ? 'selected' : '' }}>Fakultas</option>
                            <option value="Rektorat" {{ old('tujuan', $surat->tujuan) == 'Rektorat' ? 'selected' : '' }}>Rektorat</option>
                            <option value="Bagian Kemahasiswaan" {{ old('tujuan', $surat->tujuan) == 'Bagian Kemahasiswaan' ? 'selected' : '' }}>Bagian Kemahasiswaan</option>
                            <option value="Jurusan" {{ old('tujuan', $surat->tujuan) == 'Jurusan' ? 'selected' : '' }}>Jurusan</option>
                            <option value="Perpustakaan" {{ old('tujuan', $surat->tujuan) == 'Perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                            <option value="Lainnya" {{ old('tujuan', $surat->tujuan) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('tujuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="isi_surat" class="form-label">Isi Surat <span class="text-danger">*</span></label>
                <textarea class="form-control summernote @error('isi_surat') is-invalid @enderror" id="isi_surat" name="isi_surat" rows="10" required>{{ old('isi_surat', $surat->isi_surat) }}</textarea>
                @error('isi_surat')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lampiran" class="form-label">Lampiran (PDF, DOC, DOCX, Maks. 5MB)</label>
                @if($surat->lampiran)
                <div class="mb-2">
                    <small>File saat ini: <a href="{{ Storage::url('public/lampiran/' . $surat->lampiran) }}" target="_blank">{{ $surat->lampiran }}</a></small>
                </div>
                @endif
                <input type="file" class="form-control @error('lampiran') is-invalid @enderror" id="lampiran" name="lampiran">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah lampiran</small>
                @error('lampiran')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" name="submit_action" value="draft" class="btn btn-secondary">
                    <i class="fas fa-save"></i> Simpan sebagai Draft
                </button>
                <button type="submit" name="submit_action" value="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin mengajukan surat ini? Surat yang sudah diajukan tidak dapat diedit kembali.')">
                    <i class="fas fa-paper-plane"></i> Ajukan Surat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection