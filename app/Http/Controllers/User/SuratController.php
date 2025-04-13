<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::where('user_id', auth()->id());

        // Filter opsional (bisa dikembangkan)
        if ($request->has('tujuan') && $request->tujuan != '') {
            $query->where('tujuan', $request->tujuan);
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        }
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where(function ($q) use ($request) {
                $q->where('perihal', 'like', '%' . $request->keyword . '%')
                    ->orWhere('nomor_surat', 'like', '%' . $request->keyword . '%');
            });
        }

        $semua = $query->latest()->get();
        $draft = $semua->where('status', 'draft');
        $diproses = $semua->where('status', 'diajukan');
        $disetujui = $semua->where('status', 'disetujui');
        $ditolak = $semua->where('status', 'ditolak');

        return view('user.surat-keluar', compact('semua', 'draft', 'diproses', 'disetujui', 'ditolak'));
    }



    public function create()
    {
        return view('user.surat.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'jenis_surat' => 'required',
            'prioritas' => 'required',
            'tujuan' => 'required',
            'tujuan_lainnya' => 'nullable',
            'perihal' => 'required',
            'isi_surat' => 'required',
            'lampiran.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);
    
        $tujuanFinal = $request->tujuan === 'lainnya' ? $request->tujuan_lainnya : $request->tujuan;
    
        // Simpan surat
        $lampiranPaths = [];
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $lampiranPaths[] = $file->store('lampiran_surat', 'public');
            }
        }
    
        // Cek apakah draft atau kirim surat
        $status = $request->has('draft') ? 'draft' : 'diajukan';
    
        Surat::create([
            'user_id' => auth()->id(),
            'jenis_surat' => $request->jenis_surat,
            'prioritas' => $request->prioritas,
            'tujuan' => $tujuanFinal,
            'perihal' => $request->perihal,
            'isi_surat' => $request->isi_surat,
            'lampiran' => $lampiranPaths,
            'template' => $request->template,
            'status' => $status, // Menambahkan status
        ]);
    
        // Flash session berhasil simpan draft
        if ($status === 'draft') {
            session()->flash('success', 'Draft surat berhasil disimpan!');
        } else {
            session()->flash('success', 'Surat berhasil dikirim!');
        }
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Surat berhasil dikirim.',
            ]);
        }
    
        return redirect()->route('user.surat.index')->with('success', 'Surat berhasil dikirim.');
    }
    
    public function show($id)
    {
        $surat = Surat::findOrFail($id);

        // Check if user is authorized to view this letter
        if ($surat->user_id != auth()->id()) {
            return redirect()->route('user.surat-keluar')
                ->with('error', 'Anda tidak memiliki akses untuk melihat surat ini.');
        }

        return view('user.surat.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);

        // Check if user is authorized to edit this letter and it's still a draft
        if ($surat->user_id != auth()->id()) {
            return redirect()->route('user.surat-keluar')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit surat ini.');
        }

        if ($surat->status != 'draft') {
            return redirect()->route('user.surat-keluar')
                ->with('error', 'Hanya surat dengan status draft yang dapat diedit.');
        }

        return view('user.surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        // Check if user is authorized to update this letter and it's still a draft
        if ($surat->user_id != auth()->id()) {
            return redirect()->route('user.surat.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit surat ini.');
        }

        if ($surat->status != 'draft') {
            return redirect()->route('user.surat.index')
                ->with('error', 'Hanya surat dengan status draft yang dapat diedit.');
        }

        // Validate the request
        $request->validate([
            'perihal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'isi_surat' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Update the letter
        $surat->perihal = $request->perihal;
        $surat->tujuan = $request->tujuan;
        $surat->isi_surat = $request->isi_surat;


       
        // Handle attachment if provided
        if ($request->hasFile('lampiran')) {
            // Delete the old file if exists
            if ($surat->lampiran) {
                Storage::delete('public/lampiran/' . $surat->lampiran);
            }

            // Store the new file
            $lampiran = $request->file('lampiran');
            $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
            $lampiran->storeAs('public/lampiran', $lampiranName);
            $surat->lampiran = $lampiranName;
        }

        // Update status if needed
        if ($request->has('submit_action')) {
            if ($request->submit_action == 'draft') {
                $surat->status = 'draft';
            } elseif ($request->submit_action == 'submit') {
                $surat->status = 'diajukan';
            }
        }

        $surat->save();
        
        return redirect()->route('user.surat.index')
            ->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy(Surat $surat)
    {
        $this->authorizeSurat($surat);

        if ($surat->lampiran) {
            foreach ($surat->lampiran as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $surat->delete();
        return redirect()->route('user.surat.index')->with('success', 'Surat berhasil dihapus.');
    }
    public function ajukan($id)
    {
        $surat = Surat::findOrFail($id);
    
        if ($surat->user_id != auth()->id()) {
            return redirect()->route('user.surat.index')->with('error', 'Anda tidak memiliki akses.');
        }
    
        if ($surat->status != 'draft') {
            return redirect()->route('user.surat.index')->with('error', 'Hanya surat draft yang dapat diajukan.');
        }
    
        $surat->status = 'diajukan';
        $surat->save();
    
        return redirect()->route('user.surat.index')->with('success', 'Surat berhasil diajukan.');
    }
    
    private function authorizeSurat($surat)
    {
        if ($surat->user_id !== auth()->id()) {
            abort(403);
        }
    }
    public function latestSurat()
    {
        $latest = Surat::where('user_id', auth()->id())->latest()->first();

        return response()->json([
            'success' => true,
            'surat' => $latest
        ]);
    }
    public function download($id)
    {
        $surat = Surat::findOrFail($id);
        
        // Check if user is authorized to download this letter
        if ($surat->user_id != auth()->id()) {
            return redirect()->route('user.surat-keluar')
                ->with('error', 'Anda tidak memiliki akses untuk mengunduh surat ini.');
        }
        
        // Check if the letter status allows downloading
        if ($surat->status == 'draft') {
            return redirect()->route('user.surat-keluar')
                ->with('error', 'Surat draft tidak dapat diunduh.');
        }
        
        // Generate PDF
        $pdf = PDF::loadView('user.surat.pdf', compact('surat'));
        
        // Return the PDF for download
        return $pdf->download('Surat_' . $surat->nomor_surat . '.pdf');
    }
}
