<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserHrController extends Controller
{
    // Tampilkan form tambah user HR/Manager
    public function index()
    {
        // Ambil semua user dengan role karyawan
        $karyawans = User::whereIn('role', ['hr', 'manager'])
            ->orderBy('name')
            ->get();

        return view('hr.admin_index', compact('karyawans'));
    }

    public function create()
    {
        return view('hr.user_create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_telp' => 'nullable|string|max:15',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:hr,manager',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('hr.user.index')->with('success', 'User HR/Manager berhasil ditambahkan!');
    }

    public function destroy(User $user)
    {
        // pastikan hanya bisa hapus user HR/Manager, bukan karyawan atau admin lain
        if (!in_array($user->role, ['hr', 'manager'])) {
            return redirect()->back()->with('error', 'Kamu hanya bisa menghapus akun HR/Manager!');
        }

        $user->delete();

        return redirect()->route('hr.user.index')->with('success', 'Akun HR/Manager berhasil dihapus.');
    }
}
