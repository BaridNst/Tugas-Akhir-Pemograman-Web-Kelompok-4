<?php

namespace App\Http\Controllers;

use App\Models\Inventory; // Ini wajib ada agar controller kenal modelnya
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        // Mengambil semua data barang dari database
        $items = Inventory::latest()->get(); 
        return view('inventories.index', compact('items'));
    }

    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'item_code' => 'required|unique:inventories',
            'name' => 'required',
            'category' => 'required',
        ]);

        // Proses Create (Simpan ke database)
        Inventory::create([
            'item_code' => $request->item_code,
            'name' => $request->name,
            'category' => $request->category,
            'condition' => 'baik', // Default kondisi
            'status' => 'tersedia' // Default status
        ]);

        return redirect()->route('inventories.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function destroy(Inventory $inventory)
    {
        // Proses Delete (Hapus dari database)
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success', 'Barang berhasil dihapus!');
    }
}