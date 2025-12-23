<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 overflow-hidden shadow-xl sm:rounded-2xl mb-8">
                <div class="p-10 text-white flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-extrabold tracking-tight">Halo, {{ Auth::user()->name }}!</h1>
                        <p class="mt-3 text-lg opacity-90">Selamat datang di <span class="font-bold">LOADSYSTEM</span>. Kelola inventaris prodi Anda dengan standar profesional.</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="bg-orange-100 p-3 rounded-xl text-orange-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Manajemen Barang</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Tambah, lihat, dan hapus data inventaris prodi secara terpusat.</p>
                    <a href="{{ route('inventories.index') }}" class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-semibold rounded-xl hover:bg-orange-700 transition">
                        Buka Inventaris
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="bg-blue-100 p-3 rounded-xl text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Sistem Terproteksi</h3>
                    </div>
                    <p class="text-gray-600">Hanya Anda dan staf yang terdaftar di database yang dapat mengelola data ini.</p>
                    <div class="mt-6 flex items-center text-sm font-medium text-green-600 bg-green-50 px-4 py-2 rounded-lg inline-block">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Database Terkoneksi
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>