<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // 📋 Menampilkan daftar pengaduan karyawan yang login
    public function index()
    {
        $pengaduans = Pengaduan::where('user_id', Auth::id())->latest()->get();
        return view('karyawan.pengaduan_index', compact('pengaduans'));
    }

    // 📝 Halaman form pengaduan baru
    public function create()
    {
        return view('karyawan.pengaduan_create');
    }

    // 💾 Simpan data pengaduan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('bukti_foto')) {
            $fotoPath = $request->file('bukti_foto')->store('bukti_pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'bukti_foto' => $fotoPath,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }
}
