<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'satuan',
    ];

    public function lokasis()
    {
        return $this->belongsToMany(Lokasi::class, 'lokasi_produk')
                    ->withPivot('stok')
                    ->withTimestamps();
    }

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class);
    }
}