<?php

namespace App\Http\Controllers;

use App\Models\PilihanSehat;
use Illuminate\Http\Request;

class PilihanSehatController extends Controller
{
    public function index($kategori = null)
    {
        $query = PilihanSehat::where('aktif', 1);

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $items = $query->orderBy('urutan')->get();

        return view('dashboard.pilihansehat.index', compact('items', 'kategori'));
    }

  public function adminIndex(Request $request)
{
    $query = PilihanSehat::query();

    if ($request->filled('kategori')) {
        $kategori = strtolower($request->kategori);
        $query->where('kategori', $kategori);
    }

    $items = $query->get();

    // Return JSON if requested
    if ($request->wantsJson() || $request->ajax()) {
        return response()->json(['items' => $items]);
    }

    return view('admin.pilihansehat.index', compact('items'));
}

    public function create()
    {
        return view('admin.pilihansehat.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'gambar_path' => 'required|image',
            'nama' => 'required',
            'deskripsi' => 'required',
            'urutan' => 'required|integer',
            'aktif' => 'required|boolean',
        ]);

        if ($request->hasFile('gambar_path')) {
            $file = $request->file('gambar_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['gambar_path'] = 'images/' . $filename;
        }

        PilihanSehat::create($data);

        return redirect()->route('admin.pilihan-sehat.index')->with('success', 'Data berhasil ditambahkan.');
    }
public function edit(PilihanSehat $pilihanSehat)
{
    if (request()->wantsJson()) {
        return response()->json($pilihanSehat);
    }

    return view('admin.pilihansehat.edit', compact('pilihanSehat'));
}


public function update(Request $request, PilihanSehat $pilihanSehat)
{
    $data = $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'urutan' => 'required|integer',
        'aktif' => 'required|boolean',
        'gambar_path' => 'nullable|image',
    ]);

    if ($request->hasFile('gambar_path')) {
        $file = $request->file('gambar_path');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $data['gambar_path'] = 'images/' . $filename;
    }

    $pilihanSehat->update($data);

    if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.'
        ]);
    }

    return redirect()->route('admin.pilihan-sehat.index')->with('success', 'Data berhasil diperbarui.');
}
    public function destroy(PilihanSehat $pilihanSehat)
    {
        try {
            // Simpan informasi file gambar sebelum menghapus
            $gambarPath = $pilihanSehat->gambar_path;
            
            // Hapus dari database
            $pilihanSehat->delete();
            
            // Jika request minta JSON, berikan response JSON
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil dihapus.'
                ]);
            }
            
            // Response normal untuk non-AJAX
            return back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error menghapus pilihan sehat: ' . $e->getMessage());
            
            // Response JSON jika diperlukan
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data: ' . $e->getMessage()
                ], 500);
            }
            
            // Response normal
            return back()->with('error', 'Gagal menghapus data.');
        }
    }
}
