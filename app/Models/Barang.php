<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Izinkan Laravel mengisi data ke kolom ini
    protected $fillable = [
        'nama_barang',
        'stok',
    ];

    // Relasi: Satu barang bisa dipinjam berkali-kali
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}