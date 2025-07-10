<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('lokasis')->get();
        return response()->json([
            'status' => 'success',
            'data' => $produks
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|string|unique:produks',
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
        ]);

        $produk = Produk::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk created successfully',
            'data' => $produk
        ], 201);
    }

    public function show($id)
    {
        $produk = Produk::with('lokasis')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $produk
        ]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        
        $request->validate([
            'kode_produk' => 'sometimes|string|unique:produks,kode_produk,' . $id,
            'nama_produk' => 'sometimes|string|max:255',
            'kategori' => 'sometimes|string|max:255',
            'satuan' => 'sometimes|string|max:255',
        ]);

        $produk->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk updated successfully',
            'data' => $produk
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk deleted successfully'
        ]);
    }

    public function mutasiHistory($id)
    {
        $produk = Produk::with(['mutasis.user', 'mutasis.lokasi'])->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'produk' => $produk->only(['id', 'kode_produk', 'nama_produk', 'kategori', 'satuan']),
                'mutasis' => $produk->mutasis
            ]
        ]);
    }
}