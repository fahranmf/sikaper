<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah User HR / Manager
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto bg-white shadow sm:rounded-lg p-6">
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('hr.user.store') }}">
                @csrf
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm p-2"
                        value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm p-2"
                        value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">No. Telepon (opsional)</label>
                    <input type="text" name="no_telp" class="w-full border-gray-300 rounded-lg shadow-sm p-2"
                        value="{{ old('no_telp') }}">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm p-2"
                            required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border-gray-300 rounded-lg shadow-sm p-2" required>
                    </div>
                </div>

                <div class="mt-4 mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">Role</label>
                    <select name="role" class="w-full border-gray-300 rounded-lg shadow-sm p-2" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="hr">HR</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded-lg">
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>