<?php

namespace App\Http\Controllers;

use App\Models\Asupan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsupanController extends Controller
{   
     public function create()
    {
        return view('dashboard.asupan');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'kadar_gula' => 'required|string',
            'kadar_kalori' => 'required|string',
            'tanggal_konsumsi' => 'required|date',
            'waktu_konsumsi' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $asupan = Asupan::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'kadar_gula' => $request->kadar_gula,
            'kadar_kalori' => $request->kadar_kalori,
            'tanggal_konsumsi' => $request->tanggal_konsumsi,
            'waktu_konsumsi' => $request->waktu_konsumsi,
            'catatan' => $request->catatan,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Asupan berhasil disimpan',
                'asupan' => $asupan
            ], 201);
        }

        return redirect()->back()->with('success', 'Asupan berhasil disimpan');
    }
}
