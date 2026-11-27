<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::query()
            ->active()
            ->orderBy('berakhir_pada')
            ->get();

        return view('promo.index', compact('promos'));
    }

    public function adminIndex()
    {
        $promos = Promo::query()
            ->latest()
            ->paginate(12);

        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.form', ['promo' => null]);
    }

    public function store(Request $request)
    {
        $request->merge(['kode' => Str::upper(trim((string) $request->input('kode')))]);

        $data = $request->validate([
            'judul' => 'required|string|max:120',
            'kode' => 'required|string|max:30|unique:promos,kode',
            'deskripsi' => 'required|string|max:1000',
            'diskon_persen' => 'required|numeric|min:0.01|max:100',
            'mulai_pada' => 'required|date_format:Y-m-d',
            'berakhir_pada' => 'required|date_format:Y-m-d|after_or_equal:mulai_pada',
            'aktif' => 'required|boolean',
        ]);

        Promo::create($data);

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil ditambahkan.');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.form', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->merge(['kode' => Str::upper(trim((string) $request->input('kode')))]);

        $data = $request->validate([
            'judul' => 'required|string|max:120',
            'kode' => ['required', 'string', 'max:30', Rule::unique('promos', 'kode')->ignore($promo->id)],
            'deskripsi' => 'required|string|max:1000',
            'diskon_persen' => 'required|numeric|min:0.01|max:100',
            'mulai_pada' => 'required|date_format:Y-m-d',
            'berakhir_pada' => 'required|date_format:Y-m-d|after_or_equal:mulai_pada',
            'aktif' => 'required|boolean',
        ]);

        $promo->update($data);

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil dihapus.');
    }
}
