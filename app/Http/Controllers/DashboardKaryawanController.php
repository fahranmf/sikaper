<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class DashboardKaryawanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $total = Pengaduan::where('user_id', $userId)->count();
        $menunggu = Pengaduan::where('user_id', $userId)->where('status', 'menunggu')->count();
        $diproses = Pengaduan::where('user_id', $userId)->where('status', 'diproses')->count();
        $selesai = Pengaduan::where('user_id', $userId)->where('status', 'selesai')->count();

        return view('dashboard.karyawan', compact('total', 'menunggu', 'diproses', 'selesai'));
    }
}
