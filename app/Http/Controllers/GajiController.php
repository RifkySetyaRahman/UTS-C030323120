<?php

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $gajis = Gaji::with('karyawan')->get();
        return view('gaji.index', compact('gajis'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('gaji.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'numeric',
            'bonus' => 'numeric',
            'potongan' => 'numeric',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $totalGaji = $request->gaji_pokok + $request->tunjangan + $request->bonus - $request->potongan;

        Gaji::create(array_merge($request->all(), ['total_gaji' => $totalGaji]));
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function show(Gaji $gaji)
    {
        return view('gaji.show', compact('gaji'));
    }

    public function edit(Gaji $gaji)
    {
        $karyawans = Karyawan::all();
        return view('gaji.edit', compact('gaji', 'karyawans'));
    }

    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'numeric',
            'bonus' => 'numeric',
            'potongan' => 'numeric',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $totalGaji = $request->gaji_pokok + $request->tunjangan + $request->bonus - $request->potongan;
        $gaji->update(array_merge($request->all(), ['total_gaji' => $totalGaji]));

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy(Gaji $gaji)
    {
        $gaji->delete();
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus.');
    }
}
