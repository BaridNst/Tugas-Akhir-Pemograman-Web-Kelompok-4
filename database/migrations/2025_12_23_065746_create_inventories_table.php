<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique(); // Kode Inventaris [cite: 45]
            $table->string('name');                // Nama Barang [cite: 45]
            $table->string('category');            // Kategori [cite: 45]
            $table->enum('condition', ['baik', 'rusak'])->default('baik'); // Kondisi [cite: 53]
            $table->enum('status', ['tersedia', 'dipinjam'])->default('tersedia'); // Status [cite: 45, 49]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};