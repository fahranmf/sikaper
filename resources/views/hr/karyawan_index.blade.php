<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Karyawan
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Daftar Seluruh Karyawan</h3>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100 text-gray-700">
                            <th class="py-2 px-3">#</th>
                            <th class="py-2 px-3">Nama</th>
                            <th class="py-2 px-3">Email</th>
                            <th class="py-2 px-3">No. Telp</th>
                            <th class="py-2 px-3">Total Pengaduan</th>
                            <!-- <th class="py-2 px-3">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($karyawans as $k)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-3">{{ $loop->iteration }}</td>
                                <td class="py-2 px-3 font-semibold">{{ $k->name }}</td>
                                <td class="py-2 px-3 text-gray-700">{{ $k->email }}</td>
                                <td class="py-2 px-3 text-gray-700">{{ $k->no_telp ?? '-' }}</td>
                                <td class="py-2 px-3 font-medium">
                                    <span class="px-2 py-1 bg-gray-100 rounded-md text-gray-800">
                                        {{ $k->pengaduan_count }}
                                    </span>
                                </td>
                                <!-- <td class="py-2 px-3">
                                    <a href="{{ route('pengaduan.index') }}?user={{ $k->id }}" 
                                       class="text-blue-600 hover:underline text-sm">
                                        Lihat Pengaduan
                                    </a>
                                </td> -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada karyawan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
