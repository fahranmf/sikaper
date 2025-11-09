<nav x-data="{ open: true }" class="flex min-h-screen bg-white shadow-md">
    @php
        $user = Auth::user();
        $dashboardRoute = $user && in_array($user->role, ['hr', 'manager'])
            ? route('dashboard.hr')
            : route('dashboard.karyawan');
    @endphp

    <!-- Sidebar -->
    <aside :class="open ? 'w-64' : 'w-20'"
        class="transition-all duration-300 border-r border-gray-200 flex flex-col justify-between overflow-hidden">
        <div class="p-4">
            <!-- Logo -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ $dashboardRoute }}" x-show="open" x-transition>
                    <x-application-logo class="block h-9 w-auto text-gray-800" />
                </a>
                <h1 class="text-gray-900 font-bold" x-show="open" x-transition>SIKAPer</h1>
                <button @click="open = !open" class="p-2 text-gray-600 hover:bg-gray-100 rounded-md transition">
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>



            <!-- Navigation -->
            <nav class="space-y-2">
                @if ($user)
                    @if (in_array($user->role, ['hr', 'manager']))
                        <!-- Dashboard HR -->
                        <a href="{{ route('dashboard.hr') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                                {{ request()->routeIs('dashboard.hr') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-12l2 2m0 0l-2 2m2-2H5" />
                            </svg>
                            <span x-show="open">Dashboard HR</span>
                        </a>

                        <!-- List Pengaduan -->
                        <a href="{{ url('/pengaduan/list') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                {{ request()->is('pengaduan/list') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                            <span x-show="open">List Pengaduan</span>
                        </a>

                        <!-- List Karyawan -->
                        <a href="{{ url('/data-karyawan') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                {{ request()->is('data-karyawan') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-3-3h-2m-4 5h-4v-2a3 3 0 013-3h2m-6 5H4v-2a3 3 0 013-3h2m3-4a4 4 0 110-8 4 4 0 010 8zm6 0a4 4 0 110-8 4 4 0 010 8z" />
                            </svg>
                            <span x-show="open">List Karyawan</span>
                        </a>

                        <!-- Tambah HR/Manager -->
                        <a href="{{ url('/user/create') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                {{ request()->is('user/create') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-4 6a4 4 0 110-8 4 4 0 010 8zm6 4v-1a2 2 0 00-2-2H8a2 2 0 00-2 2v1" />
                            </svg>
                            <span x-show="open">Add User</span>
                        </a>

                        <!-- List HR/Manager -->
                        <a href="{{ url('/data-admin') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                {{ request()->is('data-admin') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 2a2 2 0 00-2 2v2H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2h-4V4a2 2 0 00-2-2h-4zM8 10h8" />
                            </svg>
                            <span x-show="open">List HR/Manager</span>
                        </a>


                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                                {{ request()->routeIs('profile.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.21.804 5.879 2.139M12 15a3 3 0 100-6 3 3 0 000 6z" />
                            </svg>
                            <span x-show="open">Profile</span>
                        </a>
                    @else
                        <!-- Dashboard Karyawan -->
                        <a href="{{ route('dashboard.karyawan') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                                        {{ request()->routeIs('dashboard.karyawan') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-12l2 2m0 0l-2 2m2-2H5" />
                            </svg>
                            <span x-show="open">Dashboard Karyawan</span>
                        </a>

                        <!-- Buat Pengaduan -->
                        <a href="{{ url('/pengaduan/buat') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                            {{ request()->is('pengaduan/buat') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span x-show="open">Buat Pengaduan</span>
                        </a>

                        <!-- Pengaduan Saya -->
                        <a href="{{ url('/pengaduan/saya') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                {{ request()->is('pengaduan/saya') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                            <span x-show="open">Pengaduan Saya</span>
                        </a>

                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 transition
                                                                                        {{ request()->routeIs('profile.edit') ? 'bg-gray-100 font-semibold' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.21.804 5.879 2.139M12 15a3 3 0 100-6 3 3 0 000 6z" />
                            </svg>
                            <span x-show="open">Profile</span>
                        </a>
                    @endif
                @endif
            </nav>
        </div>

        <!-- Footer / Logout -->
        <div class="p-4 border-t border-gray-200">
            <div class="mb-3 px-4" x-show="open">
                <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full px-4 py-2 text-left text-gray-600 hover:bg-gray-100 rounded-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                    <span x-show="open">Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 bg-gray-100">
        <!-- Topbar -->
        <header class="bg-white shadow-sm h-16 flex items-center px-6">
            <h1 class="text-xl font-semibold text-gray-800">
                {{ $header ?? 'Dashboard' }}
            </h1>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</nav>