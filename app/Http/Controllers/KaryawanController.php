<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Pengaduan;

class KaryawanController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role karyawan
        $karyawans = User::where('role', 'karyawan')
            ->withCount('pengaduan')
            ->orderBy('name')
            ->get();

        return view('hr.karyawan_index', compact('karyawans'));
    }
}