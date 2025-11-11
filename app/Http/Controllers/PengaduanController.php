<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * 📋 Menampilkan daftar pengaduan milik karyawan yang sedang login
     */
    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('karyawan.pengaduan_index', compact('pengaduans'));
    }

    /**
     * 📝 Halaman form buat pengaduan baru
     */
    public function create()
    {
        return view('karyawan.pengaduan_create');
    }

    /**
     * 💾 Simpan pengaduan baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🖼️ Upload foto jika ada
        if ($request->hasFile('bukti_foto')) {
            $validated['bukti_foto'] = $request->file('bukti_foto')->store('bukti_pengaduan', 'public');
        }

        // 🔐 Tambah user_id dan status default
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'menunggu';

        Pengaduan::create($validated);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    /**
     * 🗑️ (Opsional) Hapus pengaduan milik user
     */
    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak punya izin menghapus pengaduan ini.');
        }

        // hapus file bukti jika ada
        if ($pengaduan->bukti_foto && Storage::disk('public')->exists($pengaduan->bukti_foto)) {
            Storage::disk('public')->delete($pengaduan->bukti_foto);
        }

        $pengaduan->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}
