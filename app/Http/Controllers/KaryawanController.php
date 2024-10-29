<?php

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans',
            'posisi' => 'required',
            'telepon' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_lahir' => 'required|date',
        ]);

        Karyawan::create($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'posisi' => 'required',
            'telepon' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_lahir' => 'required|date',
        ]);

        $karyawan->update($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
