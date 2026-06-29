<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC GALLERY (USER)
    |--------------------------------------------------------------------------
    */
    public function publicIndex(Request $request)
    {
        $kategori = $request->kategori ?? 'semua';

        $query = Gallery::where('aktif', true);

        if ($kategori != 'semua') {
            $query->where('kategori', $kategori);
        }

        $galleries = $query->orderBy('urutan')->get();

        $kategoris = Gallery::select('kategori')
            ->distinct()
            ->pluck('kategori');

        return view('gallery', compact('galleries', 'kategori', 'kategoris'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('galleries'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE FORM
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $kategoris = ['hotel', 'room', 'event', 'facility'];
        return view('admin.gallery.create', compact('kategoris'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE DATA
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategori' => 'required',
        ]);

        $path = $request->file('foto')->store('gallery', 'public');

        Gallery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif'),
            'foto' => $path,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT FORM
    |--------------------------------------------------------------------------
    */
    public function edit(Gallery $gallery)
    {
        $kategoris = ['hotel', 'room', 'event', 'facility'];
        return view('admin.gallery.edit', compact('gallery', 'kategoris'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategori' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif'),
        ];

        if ($request->hasFile('foto')) {
            if ($gallery->foto) {
                Storage::disk('public')->delete($gallery->foto);
            }

            $data['foto'] = $request->file('foto')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->foto) {
            Storage::disk('public')->delete($gallery->foto);
        }

        $gallery->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }
}