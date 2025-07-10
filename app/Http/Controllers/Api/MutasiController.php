<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mutasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::with(['user', 'produk', 'lokasi'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $mutasis
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        // Check if produk exists in lokasi
        $produk = \App\Models\Produk::findOrFail($request->produk_id);
        $lokasi = \App\Models\Lokasi::findOrFail($request->lokasi_id);
        
        // Create or get pivot record
        $pivot = $produk->lokasis()->wherePivot('lokasi_id', $request->lokasi_id)->first();
        if (!$pivot) {
            $produk->lokasis()->attach($request->lokasi_id, ['stok' => 0]);
        }

        $mutasi = Mutasi::create([
            'user_id' => $request->user()->id,
            'produk_id' => $request->produk_id,
            'lokasi_id' => $request->lokasi_id,
            'tanggal' => $request->tanggal,
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mutasi created successfully',
            'data' => $mutasi->load(['user', 'produk', 'lokasi'])
        ], 201);
    }

    public function show($id)
    {
        $mutasi = Mutasi::with(['user', 'produk', 'lokasi'])->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $mutasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::findOrFail($id);
        
        $request->validate([
            'produk_id' => 'sometimes|exists:produks,id',
            'lokasi_id' => 'sometimes|exists:lokasis,id',
            'tanggal' => 'sometimes|date',
            'jenis_mutasi' => 'sometimes|in:masuk,keluar',
            'jumlah' => 'sometimes|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $mutasi->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Mutasi updated successfully',
            'data' => $mutasi->load(['user', 'produk', 'lokasi'])
        ]);
    }

    public function destroy($id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $mutasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Mutasi deleted successfully'
        ]);
    }
}