<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Selamat Datang, {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-10 px-6">
        <!-- Intro -->
        <div class="mb-8">
            <p class="text-gray-700 text-lg">
                Hai <strong>{{ Auth::user()->name }}</strong>, berikut ringkasan pengaduan kamu:
            </p>
            <p class="text-gray-500 text-sm">
                Kamu dapat melihat status pengaduanmu di halaman <a href="{{ route('pengaduan.index') }}" class="text-blue-600 hover:underline">Pengaduan Saya</a>.
            </p>
        </div>

        <!-- Cards Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Pengaduan -->
            <div class="bg-gradient-to-r from-gray-700 to-gray-900 text-white p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-2">Total Pengaduan</h3>
                <p class="text-4xl font-bold">{{ $total }}</p>
            </div>

            <!-- Status Menunggu -->
            <div class="bg-yellow-100 p-6 rounded-xl border border-yellow-200 shadow-sm">
                <h3 class="text-lg font-semibold text-yellow-800 mb-2">Menunggu</h3>
                <p class="text-4xl font-bold text-yellow-600">{{ $menunggu }}</p>
            </div>

            <!-- Status Diproses -->
            <div class="bg-blue-100 p-6 rounded-xl border border-blue-200 shadow-sm">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Diproses</h3>
                <p class="text-4xl font-bold text-blue-600">{{ $diproses }}</p>
            </div>

            <!-- Status Selesai -->
            <div class="bg-green-100 p-6 rounded-xl border border-green-200 shadow-sm">
                <h3 class="text-lg font-semibold text-green-800 mb-2">Selesai</h3>
                <p class="text-4xl font-bold text-green-600">{{ $selesai }}</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-10 text-center">
            <a href="{{ route('pengaduan.create') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200">
                + Buat Pengaduan Baru
            </a>
        </div>
    </div>
</x-app-layout>
