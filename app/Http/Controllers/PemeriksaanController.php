<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeriksaans = Pemeriksaan::all();
        return view('pemeriksaan.index', compact('pemeriksaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasiens = Pasien::all();
        return view('pemeriksaan.create', compact('pasiens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'berat_badan' => 'required|numeric',
            'tekanan_darah' => 'required|string',
        ]);

        Pemeriksaan::create($request->all());

        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        //
    }
}
