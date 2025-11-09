<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserHrController extends Controller
{
    // Tampilkan form tambah user HR/Manager
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

        return redirect()->route('hr.user.create')->with('success', 'User HR/Manager berhasil ditambahkan!');
    }
}
