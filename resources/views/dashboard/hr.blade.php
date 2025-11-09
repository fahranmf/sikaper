<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧑‍💼 Dashboard HR / Manager
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900">
        Selamat datang, {{ Auth::user()->name }}!
        <br>
        Di sini kamu bisa melihat daftar keluhan karyawan dan memberi tindak lanjut.
    </div>
</x-app-layout>
