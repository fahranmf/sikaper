<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pengaduan Saya
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

                <a href="{{ route('pengaduan.create') }}"
                    class="inline-block mb-4 bg-gray-800 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg">
                    + Buat Pengaduan Baru
                </a>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-3">#</th>
                            <th class="py-2 px-3">Judul</th>
                            <th class="py-2 px-3">Deskripsi</th>
                            <th class="py-2 px-3">Bukti Foto</th>
                            <th class="py-2 px-3">Status</th>
                            <th class="py-2 px-3">Tanggapan HR</th>
                            <th class="py-2 px-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengaduans as $p)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-3">{{ $loop->iteration }}</td>
                                <td class="py-2 px-3 font-semibold">{{ $p->judul }}</td>
                                <td class="py-2 px-3 text-gray-700">{{ $p->deskripsi }}</td>
                                <td class="py-2 px-3">
                                    @if ($p->bukti_foto)
                                        <button onclick="openModal('{{ asset('storage/' . $p->bukti_foto) }}')"
                                            class="flex items-center gap-1 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs rounded-md transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 10l4.553-4.553a1.5 1.5 0 00-2.121-2.121L10 8l-2 2m0 0l-4 4m6-6v10m0 0h10" />
                                            </svg>
                                            <span>Lihat Foto</span>
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>

                                <td class="py-2 px-3">
                                    @if ($p->status === 'menunggu')
                                        <span
                                            class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>
                                    @elseif ($p->status === 'diproses')
                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Diproses</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Selesai</span>
                                    @endif
                                </td>

                                {{-- Tanggapan HR --}}
                                <td class="py-2 px-3 text-sm">
                                    @if ($p->tanggapan)
                                        <p class="text-gray-700">{{ Str::limit($p->tanggapan, 40) }}</p>
                                    @else
                                        <span class="text-gray-400 italic">Belum ada tanggapan</span>
                                    @endif
                                </td>
                                <td class="py-2 px-3 text-sm text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada pengaduan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>

    <!-- Modal Preview Foto -->
    <div id="fotoModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full relative p-4">
            <button onclick="closeModal()"
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-xl font-bold">
                ✕
            </button>
            <img id="modalImage" src="" alt="Bukti Pengaduan" class="rounded-md w-full max-h-[80vh] object-contain">
            <div class="text-right mt-3">
                <button onclick="closeModal()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    const modal = document.getElementById('fotoModal');
    const modalImg = document.getElementById('modalImage');

    function openModal(src) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modalImg.src = src;
    }

    function closeModal() {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        modalImg.src = '';
    }

    // Tutup modal kalau klik di luar gambar
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });
</script>