<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::query()
            ->latest()
            ->paginate(10);

        return view('kamar.index', compact('kamars'));
    }

    public function create()
    {
        return view('kamar.form', ['kamar' => null]);
    }

    public function store(Request $request)
    {
        $dataKamar = $request->validate([
            'tipe_kamar' => 'required|in:Standar,Deluxe,Suite',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,cleaning,maintenance',
            'deskripsi' => 'nullable|string',
        ]);

        // Nomor kamar adalah angka terbesar yang ada, ditambah satu.
        $nomorKamarTerbesar = Kamar::query()
            ->pluck('nomor_kamar')
            ->filter(fn ($nomor) => ctype_digit((string) $nomor))
            ->map(fn ($nomor) => (int) $nomor)
            ->max() ?? 0;

        $dataKamar['nomor_kamar'] = (string) ($nomorKamarTerbesar + 1);

        Kamar::create($dataKamar);

        return redirect()->route('kamar.index', ['tab' => 'kamar'])
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit(Kamar $kamar)
    {
        return view('kamar.form', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $dataKamar = $request->validate([
            'tipe_kamar' => 'required|in:Standar,Deluxe,Suite',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,cleaning,maintenance',
            'deskripsi' => 'nullable|string',
        ]);

        $kamar->update($dataKamar);

        return redirect()->route('kamar.index', ['tab' => 'kamar'])
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
}
