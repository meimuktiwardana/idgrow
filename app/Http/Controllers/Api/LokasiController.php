<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::with('produks')->get();
        return response()->json([
            'status' => 'success',
            'data' => $lokasis
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_lokasi' => 'required|string|unique:lokasis',
            'nama_lokasi' => 'required|string|max:255',
        ]);

        $lokasi = Lokasi::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi created successfully',
            'data' => $lokasi
        ], 201);
    }

    public function show($id)
    {
        $lokasi = Lokasi::with('produks')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $lokasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        
        $request->validate([
            'kode_lokasi' => 'sometimes|string|unique:lokasis,kode_lokasi,' . $id,
            'nama_lokasi' => 'sometimes|string|max:255',
        ]);

        $lokasi->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi updated successfully',
            'data' => $lokasi
        ]);
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Lokasi deleted successfully'
        ]);
    }
}