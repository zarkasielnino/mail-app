@extends('layouts.user')

@section('title', 'Buat Surat Baru')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Pembuatan Surat</h5>
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card-body">
                <form action="{{ route('user.surat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_surat" class="form-label">Jenis Surat</label>
                            <select class="form-select" id="jenis_surat" name="jenis_surat" required>
                                <option value="">Pilih Jenis Surat</option>
                                <option value="surat_keterangan">Surat Keterangan</option>
                                <option value="surat_permohonan">Surat Permohonan</option>
                                <option value="surat_undangan">Surat Undangan</option>
                                <option value="surat_pengumuman">Surat Pengumuman</option>
                                <option value="surat_tugas">Surat Tugas</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="prioritas" class="form-label">Prioritas</label>
                            <select class="form-select" id="prioritas" name="prioritas" required>
                                <option value="normal">Normal</option>
                                <option value="penting">Penting</option>
                                <option value="sangat_penting">Sangat Penting</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <select class="form-select" id="tujuan" name="tujuan" required>
                            <option value="">Pilih Tujuan</option>
                            <option value="fakultas">Fakultas</option>
                            <option value="rektorat">Rektorat</option>
                            <option value="kemahasiswaan">Bagian Kemahasiswaan</option>
                            <option value="jurusan">Jurusan</option>
                            <option value="perpustakaan">Perpustakaan</option>
                            <option value="admin">Admin</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3" id="tujuan_lainnya_div" style="display: none;">
                        <label for="tujuan_lainnya" class="form-label">Tujuan Lainnya</label>
                        <input type="text" class="form-control" id="tujuan_lainnya" name="tujuan_lainnya" placeholder="Masukkan tujuan lainnya">
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Masukkan perihal surat" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi_surat" class="form-label">Isi Surat</label>
                        <textarea class="form-control" id="isi_surat" name="isi_surat" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran</label>
                        <input type="file" class="form-control" id="lampiran" name="lampiran[]" multiple>
                        <small class="text-muted">Format: PDF, JPG, PNG, DOC, DOCX (Maks. 5MB per file)</small>
                    </div>
                    <div class="mb-3">
                        <label for="template" class="form-label">Template</label>
                        <select class="form-select" id="template" name="template">
                            <option value="">Tanpa Template</option>
                            <option value="template_1">Template Surat Keterangan</option>
                            <option value="template_2">Template Surat Permohonan</option>
                            <option value="template_3">Template Surat Undangan</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <!-- Tombol Simpan Draft -->
                        <button type="submit" class="btn btn-secondary" name="draft" value="1">Simpan Draft</button>

                        <div>
                            <button type="button" class="btn btn-info" id="pratinjau">Pratinjau</button>
                            <button type="submit" class="btn btn-primary">Kirim Surat</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Text editor initialization - Menggunakan CKEditor
        if (document.getElementById('isi_surat')) {
            ClassicEditor
                .create(document.getElementById('isi_surat'))
                .catch(error => {
                    console.error(error);
                });
        }

        // Menampilkan form tujuan lainnya jika "Lainnya" dipilih
        const tujuanSelect = document.getElementById('tujuan');
        const tujuanLainnyaDiv = document.getElementById('tujuan_lainnya_div');

        tujuanSelect.addEventListener('change', function() {
            if (this.value === 'lainnya') {
                tujuanLainnyaDiv.style.display = 'block';
            } else {
                tujuanLainnyaDiv.style.display = 'none';
            }
        });

        // Tombol Pratinjau
        document.getElementById('pratinjau').addEventListener('click', function() {
            // Mendapatkan data form
            const jenisSurat = document.getElementById('jenis_surat').value;
            const perihal = document.getElementById('perihal').value;
            const tujuan = document.getElementById('tujuan').value;
            const isiSurat = document.querySelector('.ck-editor__editable').ckeditorInstance.getData();

            // Validasi data minimal
            if (!jenisSurat || !perihal || !tujuan || !isiSurat) {
                alert('Mohon lengkapi data surat (jenis, perihal, tujuan, dan isi) sebelum pratinjau.');
                return;
            }

            // Menampilkan pratinjau di modal
            const modalHtml = `
                <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="previewModalLabel">Pratinjau Surat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="preview-surat p-4">
                                    <div class="text-center mb-4">
                                        <h4>UNIVERSITAS CONTOH</h4>
                                        <p>Jalan Pendidikan No. 123, Kota Ilmu</p>
                                        <p>Email: info@universitascontoh.ac.id | Telepon: (021) 12345678</p>
                                        <hr style="border-top: 3px solid black;">
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <p>Nomor: <span class="nomor-surat">DRAFT-${new Date().getTime()}</span></p>
                                            <p>Lampiran: -</p>
                                            <p>Perihal: ${perihal}</p>
                                        </div>
                                        <div>
                                            <p>Kota Ilmu, ${new Date().toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})}</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <p>Kepada Yth.</p>
                                        <p>${tujuan === 'lainnya' ? document.getElementById('tujuan_lainnya').value : tujuan}</p>
                                        <p>di Tempat</p>
                                    </div>
                                    <div class="mb-4">
                                        <div>${isiSurat}</div>
                                    </div>
                                    <div class="text-end mt-5">
                                        <p>Hormat kami,</p>
                                        <p class="mt-5">____________________</p>
                                        <p>${document.querySelector('button[id="profileDropdown"]').textContent.trim()}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Tambahkan modal ke body
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            // Tampilkan modal
            const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
            previewModal.show();

            // Hapus modal setelah ditutup
            document.getElementById('previewModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('previewModal').remove();
            });
        });

        document.getElementById('simpanDraft').addEventListener('click', function() {
            console.log('Tombol Simpan Draft Diklik');
            const perihal = document.getElementById('perihal').value;

            if (!perihal) {
                alert('Minimal masukkan perihal surat untuk menyimpan draft.');
                return;
            }

            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            this.disabled = true;

            // Simulasi pengiriman request ke server (AJAX)
            fetch("{{ route('user.surat.store') }}", {
                    method: 'POST',
                    body: new FormData(document.querySelector('form')),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Draft surat berhasil disimpan!');
                    } else {
                        alert('Terjadi kesalahan.');
                    }
                    this.innerHTML = 'Simpan Draft';
                    this.disabled = false;
                })
                .catch(error => {
                    alert('Terjadi kesalahan.');
                    console.log(error);
                    this.innerHTML = 'Simpan Draft';
                    this.disabled = false;
                });
        });
        // Mengisi template saat dipilih
        document.getElementById('template').addEventListener('change', function() {
            if (!this.value) return;

            let templateContent = '';

            switch (this.value) {
                case 'template_1':
                    templateContent = '<p>Yang bertanda tangan di bawah ini:</p><p>Nama: [Nama Pejabat]</p><p>Jabatan: [Jabatan]</p><p>Dengan ini menerangkan bahwa:</p><p>Nama: [Nama Mahasiswa]</p><p>NIM: [NIM Mahasiswa]</p><p>Fakultas/Jurusan: [Fakultas/Jurusan]</p><p>Adalah benar mahasiswa aktif Universitas Contoh yang sedang menempuh pendidikan pada semester [Semester] tahun akademik [Tahun Akademik].</p><p>Surat keterangan ini dibuat untuk keperluan [Keperluan].</p>';
                    break;
                case 'template_2':
                    templateContent = '<p>Dengan hormat,</p><p>Yang bertanda tangan di bawah ini:</p><p>Nama: [Nama Pemohon]</p><p>NIM/NIP: [NIM/NIP]</p><p>Fakultas/Jurusan: [Fakultas/Jurusan]</p><p>Dengan ini mengajukan permohonan [Jenis Permohonan] dengan alasan sebagai berikut:</p><p>[Alasan Permohonan]</p><p>Demikian surat permohonan ini saya buat dengan sebenar-benarnya. Atas perhatian dan pertimbangan Bapak/Ibu, saya ucapkan terima kasih.</p>';
                    break;
                case 'template_3':
                    templateContent = '<p>Dengan hormat,</p><p>Sehubungan dengan akan diadakannya [Nama Kegiatan], maka kami mengundang Bapak/Ibu/Saudara untuk hadir pada:</p><p>Hari/Tanggal: [Hari/Tanggal]</p><p>Waktu: [Waktu]</p><p>Tempat: [Tempat]</p><p>Acara: [Acara]</p><p>Demikian undangan ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu/Saudara, kami ucapkan terima kasih.</p>';
                    break;
            }

            // Mengisi CKEditor dengan template
            if (templateContent) {
                document.querySelector('.ck-editor__editable').ckeditorInstance.setData(templateContent);
            }
        });
    });
</script>
@endsection