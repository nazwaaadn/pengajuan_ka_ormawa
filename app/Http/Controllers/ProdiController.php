<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function getProdi($jurusan_id)
    {
        $prodis = Prodi::where('jurusan_id', $jurusan_id)->get(); 
        return response()->json($prodis);
    }

    public function index()
    {
        $prodis = Prodi::with('jurusan')->get();
        $jurusans = Jurusan::all(); // Ambil data ormawa untuk dropdown
        return view('TambahJurusan', compact('prodis','jurusans'));
    }

    // Menyimpan data ketua ormawa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|unique:prodis|max:255',
            'jurusan_id' => 'required|exists:jurusans,id_jurusan'
        ]);

        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
            'jurusan_id' => $request->jurusan_id
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $prodis = Prodi::findOrFail($id);
        $prodis->delete();

        return redirect()->route('prodi.index')->with('success', 'Ketua Ormawa berhasil dihapus');
    }

    public function storeJurusan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_jurusan' => 'required|string|unique:jurusans|max:255',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan');
    }

    public function destroyJurusan($id)
    {
        $jurusans = Jurusan::findOrFail($id);
        $jurusans->delete();

        return redirect()->route('prodi.index')->with('success', 'Ketua Ormawa berhasil dihapus');
    }

}
