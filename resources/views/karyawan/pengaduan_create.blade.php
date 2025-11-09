<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Pengaduan Baru
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700 mb-2">Judul Pengaduan</label>
                        <input type="text" name="judul" class="w-full border-gray-300 rounded-lg p-2 shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700 mb-2">Deskripsi Pengaduan</label>
                        <textarea name="deskripsi" rows="4" class="w-full p-2 border-gray-300 rounded-lg shadow-sm" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700 mb-2">Foto Bukti (Opsional)</label>
                        <input type="file" name="bukti_foto" accept=".jpg,.jpeg,.png" class="w-full p-3 border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg">
                        Kirim Pengaduan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
