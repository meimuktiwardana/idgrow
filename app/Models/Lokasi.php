<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
    ];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'lokasi_produk')
                    ->withPivot('stok')
                    ->withTimestamps();
    }

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class);
    }
}