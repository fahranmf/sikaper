<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data HR/Manager
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Daftar Seluruh HR/Manager</h3>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100 text-gray-700">
                            <th class="py-2 px-3">#</th>
                            <th class="py-2 px-3">Nama</th>
                            <th class="py-2 px-3">Email</th>
                            <th class="py-2 px-3">No. Telp</th>
                            <th class="py-2 px-3">Role</th>
                            <th class="py-2 px-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($karyawans as $k)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-3">{{ $loop->iteration }}</td>
                                <td class="py-2 px-3 font-semibold">{{ $k->name }}</td>
                                <td class="py-2 px-3 text-gray-700">{{ $k->email }}</td>
                                <td class="py-2 px-3 text-gray-700">{{ $k->no_telp ?? '-' }}</td>
                                <td class="py-2 px-3 font-semibold">{{ $k->role }}</td>
                                <td class="py-2 px-3">
                                    <form method="POST" action="{{ route('hr.user.destroy', $k->id) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus akun {{ $k->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-3 py-1 rounded-md">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada HR/Manager.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="text-left">
                    <a href="{{ route('hr.user.create') }}"
                        class="inline-block mt-4 bg-gray-800 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg">
                        + Buat User HR/Manager Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>