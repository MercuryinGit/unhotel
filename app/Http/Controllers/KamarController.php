<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // 1. Menampilkan semua kamar
    public function index()
    {
        $kamars = Kamar::latest()->paginate(10);

        return view('kamar.index', compact('kamars'));
    }

    // 2. Menampilkan form tambah kamar
    public function create()
    {
        return view('kamar.create');
    }

    // 3. Menyimpan kamar baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_kamar' => 'required|in:Standar,Deluxe,Suite',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,maintenance',
            'deskripsi' => 'nullable|string',
        ]);

        $nomorKamarTerbesar = Kamar::query()
            ->pluck('nomor_kamar')
            ->filter(fn ($nomor) => ctype_digit((string) $nomor))
            ->map(fn ($nomor) => (int) $nomor)
            ->max() ?? 0;

        $validated['nomor_kamar'] = (string) ($nomorKamarTerbesar + 1);

        Kamar::create($validated);

        return redirect()->route('kamar.index', ['tab' => 'kamar'])
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit kamar
    public function edit(Kamar $kamar)
    {
        return view('kamar.edit', compact('kamars'));
    }

    // 5. Memperbarui data kamar
    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:kamars,nomor_kamar,' . $kamar->id,
            'tipe_kamar' => 'required',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,maintenance',
            'deskripsi' => 'nullable|string',
        ]);

        $kamar->update($request->only([
            'nomor_kamar',
            'tipe_kamar',
            'harga_per_malam',
            'kapasitas',
            'status',
            'deskripsi',
        ]));

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    // 6. Menghapus kamar
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
}
