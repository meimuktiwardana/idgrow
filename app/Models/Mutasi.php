<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produk_id',
        'lokasi_id',
        'tanggal',
        'jenis_mutasi',
        'jumlah',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($mutasi) {
            $mutasi->updateStok();
        });

        static::updated(function ($mutasi) {
            $mutasi->updateStok();
        });
    }

    public function updateStok()
    {
        $pivot = $this->produk->lokasis()->wherePivot('lokasi_id', $this->lokasi_id)->first();
        
        if ($pivot) {
            $currentStok = $pivot->pivot->stok;
            $newStok = $this->jenis_mutasi === 'masuk' 
                ? $currentStok + $this->jumlah 
                : $currentStok - $this->jumlah;
            
            $this->produk->lokasis()->updateExistingPivot($this->lokasi_id, ['stok' => $newStok]);
        }
    }
}