<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::query();

        // Tangkap parameter kategori dari footer
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Tangkap juga kalau ada pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%'.$request->search.'%');
        }

        // UBAH ->get() MENJADI ->paginate(6) atau angka berapapun yang Bos mau per halamannya.
        // Tambahkan ->withQueryString() supaya pas pindah ke halaman 2, filternya nggak hilang!
        $artikels = $query->latest('tanggal_publikasi')->paginate(6)->withQueryString();

        return view('artikel', compact('artikels'));
    }
}
