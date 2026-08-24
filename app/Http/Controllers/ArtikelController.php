<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::query();

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }

        $artikels = $query->latest('tanggal_publikasi')->paginate(6)->withQueryString();

        return view('artikel', compact('artikels'));
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('artikel-detail', compact('artikel'));
    }

    // --- Admin CMS Methods (Otorisasi via 'role:admin' middleware) ---

    private function validateArtikel(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'gambar' => ['required', 'url', 'max:2048'],
            'penulis' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
        ]);
    }

    public function create()
    {
        return view('artikel-create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateArtikel($request);

        Artikel::create($validated + [
            'tanggal_publikasi' => now(),
        ]);

        return redirect('/dashboard');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('artikel-edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateArtikel($request);

        $artikel = Artikel::findOrFail($id);
        $artikel->update($validated);

        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        Artikel::destroy($id);

        return redirect('/dashboard');
    }
}
