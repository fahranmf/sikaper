<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;

class DashboardHrController extends Controller
{
    public function index()
    {
        $totalKaryawan = User::where('role', 'karyawan')->count();
        $totalHrManager = User::whereIn('role', ['hr', 'manager'])->count();

        $totalPengaduan = Pengaduan::count();
        $menunggu = Pengaduan::where('status', 'menunggu')->count();
        $diproses = Pengaduan::where('status', 'diproses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        return view('dashboard.hr', compact(
            'totalKaryawan',
            'totalHrManager',
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai'
        ));
    }
}