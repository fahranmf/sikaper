<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanHrController extends Controller
{
    // Tampilkan semua pengaduan
    public function index()
    {
        $pengaduans = Pengaduan::with('user')->latest()->get();

        return view('hr.pengaduan_index', compact('pengaduans'));
    }

    // Update status pengaduan
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
            'tanggapan' => 'nullable|string|max:1000',
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->back()->with('success', 'Tanggapan dan status berhasil diperbarui!');
    }

}
