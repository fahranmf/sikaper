<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pengaduan Karyawan
        </h2>
    </x-slot>

    <div class="mx-auto">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABEL PENGADUAN --}}
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-100 text-gray-700">
                        <th class="py-2 px-3">#</th>
                        <th class="py-2 px-3">Nama Karyawan</th>
                        <th class="py-2 px-3">Judul</th>
                        <th class="py-2 px-3">Deskripsi</th>
                        <th class="py-2 px-3">Bukti Foto</th>
                        <th class="py-2 px-3">Status</th>
                        <th class="py-2 px-3">Tanggapan HR</th>
                        <th class="py-2 px-3">Aksi</th>
                        <th class="py-2 px-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduans as $p)
                        <tr class="border-b hover:bg-gray-50 align-top">
                            <td class="py-2 px-3">{{ $loop->iteration }}</td>
                            <td class="py-2 px-3 font-semibold">{{ $p->user->name }}</td>
                            <td class="py-2 px-3">{{ $p->judul }}</td>
                            <td class="py-2 px-3 text-gray-700">{{ $p->deskripsi }}</td>

                            {{-- Bukti Foto --}}
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

                            {{-- Status --}}
                            <td class="py-2 px-3">
                                @if ($p->status === 'menunggu')
                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>
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

                            {{-- Aksi --}}
                            <td class="py-2 px-3">
                                <button data-id="{{ $p->id }}" data-status="{{ $p->status }}"
                                    data-tanggapan="{{ e($p->tanggapan) }}" onclick="openTanggapanModal(this)"
                                    class="flex items-center gap-1 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs rounded-md transition">
                                    ✎ Ubah
                                </button>
                            </td>

                            {{-- Tanggal --}}
                            <td class="py-2 px-3 text-sm text-gray-500 whitespace-nowrap">
                                {{ $p->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Belum ada pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Preview Foto --}}
    <div id="fotoModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full relative p-4">
            <button onclick="closeModal()"
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-xl font-bold">✕</button>
            <img id="modalImage" src="" alt="Bukti Pengaduan" class="rounded-md w-full max-h-[80vh] object-contain">
            <div class="text-right mt-3">
                <button onclick="closeModal()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
    </div>

    {{-- Modal Tanggapan HR --}}
    <div id="tanggapanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <button onclick="closeTanggapanModal()"
                class="absolute top-2 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">✕</button>

            <h3 class="text-lg font-semibold mb-4 text-gray-800">Tanggapan HR / Manager</h3>

            <form id="tanggapanForm" method="POST">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pengaduan</label>
                    <select name="status" id="statusSelect"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggapan</label>
                    <textarea name="tanggapan" id="tanggapanText"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500 resize-none"
                        rows="4" placeholder="Tulis tanggapan HR di sini..."></textarea>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold text-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script Modal --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            // 🖼️ Modal Foto
            const fotoModal = document.getElementById('fotoModal');
            const modalImg = document.getElementById('modalImage');

            window.openModal = (src) => {
                fotoModal.classList.remove('hidden');
                fotoModal.classList.add('flex');
                modalImg.src = src;
            };

            window.closeModal = () => {
                fotoModal.classList.remove('flex');
                fotoModal.classList.add('hidden');
                modalImg.src = '';
            };

            fotoModal?.addEventListener('click', (e) => {
                if (e.target === fotoModal) window.closeModal();
            });


            // 💬 Modal Tanggapan HR
            const tanggapanModal = document.getElementById('tanggapanModal');
            const tanggapanForm = document.getElementById('tanggapanForm');
            const tanggapanText = document.getElementById('tanggapanText');
            const statusSelect = document.getElementById('statusSelect');

            // Biar bisa dipanggil dari inline onclick
            window.openTanggapanModal = (btn) => {
                const id = btn.dataset.id;
                const status = btn.dataset.status;
                const tanggapan = btn.dataset.tanggapan;

                tanggapanForm.action = "{{ route('pengaduan.updateStatus', ['pengaduan' => '__ID__']) }}"
                    .replace('__ID__', id);

                statusSelect.value = status ?? 'menunggu';
                tanggapanText.value = tanggapan || '';
                tanggapanModal.classList.remove('hidden');
                tanggapanModal.classList.add('flex');
                setTimeout(() => tanggapanText.focus(), 150);
            };



            window.closeTanggapanModal = () => {
                tanggapanModal.classList.remove('flex');
                tanggapanModal.classList.add('hidden');
                tanggapanText.value = '';
            };

            tanggapanModal?.addEventListener('click', (e) => {
                if (e.target === tanggapanModal) window.closeTanggapanModal();
            });

        });
    </script>

</x-app-layout>