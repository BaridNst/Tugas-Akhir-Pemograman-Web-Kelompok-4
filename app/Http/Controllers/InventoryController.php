<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    // 1. Tampilan Dashboard Utama
    public function index()
    {
        $barangs = Barang::all();
        // Mengambil riwayat dengan relasi user dan barang
        $histories = Peminjaman::with(['user', 'barang'])->latest()->get();
        return view('dashboard', compact('barangs', 'histories'));
    }

    // 2. Fungsi Pinjam Barang
    public function pinjam(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // Validasi jika stok habis
        if ($barang->stok < 1) {
            return redirect()->back()->with('error', 'Maaf, stok barang sedang habis!');
        }

        // Simpan data ke tabel peminjaman
        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'jumlah' => 1,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam', 
        ]);

        // Kurangi stok barang
        $barang->decrement('stok');

        return redirect()->back()->with('success', 'Berhasil meminjam ' . $barang->nama_barang);
    }

    // 3. Fungsi Kembalikan Barang
    public function kembali($id)
    {
        $history = Peminjaman::findOrFail($id);
        
        // Pastikan hanya barang dengan status 'dipinjam' yang bisa dikembalikan
        if ($history->status !== 'dipinjam') {
            return redirect()->back()->with('error', 'Barang ini tidak dalam status dipinjam.');
        }

        // Update status di tabel peminjaman
        $history->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        // Tambah stok barang kembali ke jumlah semula
        $barang = Barang::find($history->barang_id);
        if ($barang) {
            $barang->increment('stok');
        }

        return redirect()->back()->with('success', 'Barang ' . $barang->nama_barang . ' telah dikembalikan.');
    }

    // 4. Fungsi Bersihkan Riwayat (Hanya menghapus yang sudah dikembalikan)
    public function bersihkanRiwayat()
    {
        // Hanya hapus baris yang statusnya sudah 'dikembalikan'
        // Ini mencegah hilangnya tombol "Kembalikan" untuk barang yang masih dibawa user
        Peminjaman::where('user_id', Auth::id())
                  ->where('status', 'dikembalikan')
                  ->delete();

        return redirect()->back()->with('success', 'Riwayat yang telah selesai berhasil dibersihkan.');
    }
}