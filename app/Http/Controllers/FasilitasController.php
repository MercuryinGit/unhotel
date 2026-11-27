<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();

        return view('fasilitas.index', compact('fasilitas'));
    }

    public function adminIndex()
    {
        $fasilitas = Fasilitas::query()
            ->orderBy('nama')
            ->paginate(12);

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.form', ['fasilitas' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'ikon' => 'required|string|max:20',
            'deskripsi' => 'required|string|max:1000',
            'aktif' => 'required|boolean',
        ]);

        Fasilitas::create($data);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.form', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'ikon' => 'required|string|max:20',
            'deskripsi' => 'required|string|max:1000',
            'aktif' => 'required|boolean',
        ]);

        $fasilitas->update($data);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
