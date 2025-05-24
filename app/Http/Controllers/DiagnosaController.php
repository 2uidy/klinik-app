<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function create($id)
    {
        $pemeriksaan = Pemeriksaan::with('pasien')->findOrFail($id);

        return view('diagnosa.create', compact('pemeriksaan'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'diagnosa' => 'required',
            'keluhan' => 'required',
        ]);

        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->diagnosa = $request->diagnosa;
        $pemeriksaan->keluhan = $request->keluhan;
        $pemeriksaan->save();

        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa berhasil disimpan.');
    }


    public function index()
    {
        $pemeriksaans = Pemeriksaan::with('pasien')
                        ->get();

        return view('diagnosa.index', compact('pemeriksaans'));
    }

}
