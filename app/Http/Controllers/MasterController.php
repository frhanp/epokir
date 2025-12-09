<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aleg;
use App\Models\Opd;
use App\Models\Kategori;


class MasterController extends Controller
{
    // === INDEX DATA ===
    public function index()
    {
        $alegs = Aleg::all();
        $opds = Opd::all();
        $kategoris = Kategori::all();

        return view('master.index', compact('alegs', 'opds', 'kategoris'));
    }

    // === STORE DATA (SIMPAN) ===
    public function storeAleg(Request $request) {
        Aleg::create($request->only('nama', 'fraksi'));
        return back()->with('success', 'Aleg berhasil ditambah');
    }

    public function storeOpd(Request $request) {
        Opd::create(['nama_dinas' => $request->nama_dinas]);
        return back()->with('success', 'OPD berhasil ditambah');
    }

    public function storeKategori(Request $request) {
        Kategori::create(['nama_kategori' => $request->nama_kategori]);
        return back()->with('success', 'Kategori berhasil ditambah');
    }

    // === DESTROY (HAPUS) ===
    public function destroyAleg(Aleg $aleg) { $aleg->delete(); return back(); }
    public function destroyOpd(Opd $opd) { $opd->delete(); return back(); }
    public function destroyKategori(Kategori $kategori) { $kategori->delete(); return back(); }
}
