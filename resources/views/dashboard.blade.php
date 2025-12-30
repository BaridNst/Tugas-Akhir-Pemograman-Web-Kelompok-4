<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Alert Notifikasi --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 overflow-hidden shadow-xl sm:rounded-2xl mb-8">
                <div class="p-10 text-white flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-extrabold tracking-tight">Halo, {{ Auth::user()->name }}!</h1>
                        <p class="mt-3 text-lg opacity-90">Selamat datang di <span class="font-bold">LOADSYSTEM</span>. Kelola inventaris prodi Anda dengan standar profesional.</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 000.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 000.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-0.553-.894l-4-2z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                
                {{-- Tabel Inventaris --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Daftar Inventaris Tersedia</h3>
                        <span class="px-3 py-1 bg-orange-100 text-orange-600 text-xs font-bold rounded-full">LIVE DATA</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">Nama Barang</th>
                                    <th class="px-6 py-4 font-semibold text-sm">Lokasi</th>
                                    <th class="px-6 py-4 font-semibold text-center">Stok</th>
                                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700">
                                @foreach($barangs as $b)
                                <tr class="hover:bg-orange-50 transition duration-150">
                                    <td class="px-6 py-4 font-medium">{{ $b->nama_barang }}</td>
                                    
                                    {{-- Kolom Lokasi --}}
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <span class="inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $b->nama_tempat }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 {{ $b->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-full text-xs font-bold">
                                            {{ $b->stok }} Unit
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($b->stok > 0)
                                            <form action="{{ route('pinjam.barang', $b->id) }}" method="POST" onsubmit="return confirm('Pinjam barang ini?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white text-xs font-bold rounded-lg hover:bg-orange-700 transition shadow-sm">
                                                    PINJAM
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="px-4 py-2 bg-gray-300 text-white text-xs font-bold rounded-lg cursor-not-allowed">
                                                HABIS
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tabel Riwayat --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Riwayat Terakhir</h3>
                        
                        {{-- Tombol Bersihkan --}}
                        @if($histories->where('user_id', Auth::id())->count() > 0)
                            <form action="{{ route('riwayat.bersihkan') }}" method="POST" onsubmit="return confirm('Bersihkan semua riwayat Anda?')">
                                @csrf
                                <button type="submit" class="text-[10px] bg-red-50 text-red-600 px-2 py-1 rounded-md hover:bg-red-100 transition font-bold uppercase tracking-wider border border-red-200">
                                    Bersihkan
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="p-0">
                        <div class="divide-y divide-gray-100">
                            @forelse($histories as $h)
                                <div class="p-4 hover:bg-gray-50 transition">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="text-sm font-bold text-gray-800">{{ $h->user->name }}</span>
                                        <span class="text-[10px] text-gray-400 uppercase">{{ $h->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mb-2">Meminjam: <span class="font-semibold">{{ $h->barang->nama_barang }}</span></p>
                                    
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="px-2 py-1 {{ $h->status == 'dipinjam' ? 'bg-blue-50 text-blue-600' : ($h->status == 'dikembalikan' ? 'bg-green-50 text-green-600' : 'bg-gray-50 text-gray-600') }} text-[10px] font-bold rounded uppercase tracking-wider">
                                            {{ $h->status }}
                                        </span>

                                        @if($h->status == 'dipinjam')
                                            <form action="{{ route('kembali.barang', $h->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Kembalikan barang ini?')" class="text-[10px] font-extrabold text-orange-600 hover:text-orange-800 underline uppercase tracking-tighter">
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-10 text-center text-gray-400">
                                    <p class="text-sm italic">Belum ada riwayat peminjaman.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Status Sistem --}}
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-blue-100 p-3 rounded-xl text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Sistem Terproteksi</h3>
                </div>
                <p class="text-gray-600">Hanya Staf dan Admin yang dapat mengelola sistem ini.</p>
                
                {{-- Update Lokasi Di Sini --}}
                <div class="mt-6 flex items-center text-sm font-medium text-green-600 bg-green-50 px-4 py-2 rounded-lg inline-block">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Koneksi Database Aman (Lokasi: Ruangan Program Studi)
                </div>
            </div>
        </div>
    </div>
</x-app-layout>