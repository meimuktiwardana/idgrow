<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Produk;
use App\Models\Lokasi;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'nama' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        // Create sample products
        Produk::create([
            'kode_produk' => 'PRD001',
            'nama_produk' => 'Laptop Dell',
            'kategori' => 'Electronics',
            'satuan' => 'pcs',
        ]);

        Produk::create([
            'kode_produk' => 'PRD002',
            'nama_produk' => 'Mouse Wireless',
            'kategori' => 'Electronics',
            'satuan' => 'pcs',
        ]);

        // Create sample locations
        Lokasi::create([
            'kode_lokasi' => 'WH001',
            'nama_lokasi' => 'Warehouse Jakarta',
        ]);

        Lokasi::create([
            'kode_lokasi' => 'WH002',
            'nama_lokasi' => 'Warehouse Surabaya',
        ]);
    }
}
