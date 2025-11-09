<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👷‍♂️ Dashboard Karyawan
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900">
        Selamat datang, {{ Auth::user()->name }}!
        <br>
        Di sini kamu bisa membuat dan memantau keluhan/saran kamu.
    </div>
</x-app-layout>
