<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    public function index(Request $request): View
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

    public function show(int|string $id): View
    {
        $artikel = Artikel::findOrFail($id);

        return view('artikel-detail', compact('artikel'));
    }

    // --- Admin CMS Methods (Otorisasi via 'role:admin' middleware) ---

    /**
     * @return array<string, mixed>
     */
    private function validateArtikel(Request $request): array
    {
        return $request->validate([
            'judul'    => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'gambar'   => ['required', 'url', 'max:2048'],
            'penulis'  => ['required', 'string', 'max:255'],
            'konten'   => ['required', 'string'],
        ]);
    }

    public function create(): View
    {
        return view('artikel-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateArtikel($request);

        $validated['tanggal_publikasi'] = now();
        // @phpstan-ignore-next-line — keys are validated above and match $fillable exactly
        Artikel::create($validated);

        return redirect('/dashboard');
    }

    public function edit(int|string $id): View
    {
        $artikel = Artikel::findOrFail($id);

        return view('artikel-edit', compact('artikel'));
    }

    public function update(Request $request, int|string $id): RedirectResponse
    {
        $validated = $this->validateArtikel($request);

        $artikel = Artikel::findOrFail($id);
        $artikel->update($validated);

        return redirect('/dashboard');
    }

    public function destroy(int|string $id): RedirectResponse
    {
        Artikel::destroy($id);

        return redirect('/dashboard');
    }
}
