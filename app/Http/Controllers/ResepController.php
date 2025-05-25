<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\Log;

class ResepController extends Controller
{
    /**
     * Tampilkan daftar pemeriksaan yang butuh resep
     */
    public function index()
    {
        $pemeriksaans = Pemeriksaan::with('pasien')
                        ->whereNotNull('diagnosa')
                        ->whereDoesntHave('resep')
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('inputobat.index', compact('pemeriksaans'));
    }

    /**
     * Tampilkan daftar semua resep yang sudah dibuat
     */
    public function indexReseps()
    {
        $reseps = Resep::with(['pasien', 'pemeriksaan', 'obats'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);
                       
        return view('reseps.index', compact('reseps'));
    }

    /**
     * Form untuk membuat resep baru
     */
    public function create(Request $request)
    {
        $pemeriksaanId = $request->get('pemeriksaan_id');
        $pemeriksaan = Pemeriksaan::with('pasien')->find($pemeriksaanId);
        
        if (!$pemeriksaan) {
            return redirect()->route('inputobat.index')
                           ->with('error', 'Pemeriksaan tidak ditemukan');
        }
        
        return view('reseps.create', compact('pemeriksaanId', 'pemeriksaan'));
    }

    /**
     * Simpan resep baru
     */
    public function store(Request $request)
    {
        // Debug: Log semua data yang masuk
        Log::info('Data resep yang masuk:', $request->all());
        
        $request->validate([
            'nomor_resep' => 'required|string|max:255|unique:reseps,nomor_resep',
            'obat' => 'required|array|min:1',
            'obat.*.nama_obat' => 'required|string|max:255',
            'obat.*.jenis' => 'nullable|string|max:100',
            'obat.*.dosis' => 'nullable|string|max:255',
            'obat.*.quantity' => 'required|integer|min:1|max:999',
            'pemeriksaan_id' => 'required|exists:pemeriksaans,id',
        ], [
            'nomor_resep.unique' => 'Nomor resep sudah digunakan, silakan gunakan nomor lain.',
            'obat.required' => 'Minimal harus ada 1 obat dalam resep.',
            'obat.*.nama_obat.required' => 'Nama obat harus diisi.',
            'obat.*.quantity.required' => 'Quantity obat harus diisi.',
            'obat.*.quantity.min' => 'Quantity minimal 1.',
            'obat.*.quantity.max' => 'Quantity maksimal 999.',
        ]);

        try {
            // Ambil pemeriksaan untuk pasien_id
            $pemeriksaan = Pemeriksaan::findOrFail($request->pemeriksaan_id);

            // Buat resep baru
            $resep = Resep::create([
                'nomor_resep' => $request->nomor_resep,
                'pemeriksaan_id' => $request->pemeriksaan_id,
                'pasien_id' => $pemeriksaan->pasien_id,
            ]);

            // Simpan masing-masing obat
            foreach ($request->obat as $index => $item) {
                // Debug: Log setiap item obat
                Log::info("Obat ke-{$index}:", $item);
                
                // Pastikan nama_obat ada dan tidak kosong
                if (!empty($item['nama_obat'])) {
                    $obat = Obat::create([
                        'nama_obat' => $item['nama_obat'],
                        'jenis' => $item['jenis'] ?? null,
                        'dosis' => $item['dosis'] ?? null,
                        'quantity' => $item['quantity'] ?? 1,
                        'resep_id' => $resep->id,
                    ]);
                    
                    // Debug: Log obat yang berhasil dibuat
                    Log::info("Obat berhasil dibuat:", $obat->toArray());
                }
            }

            return redirect()->route('inputobat.index')
                           ->with('success', 'Resep berhasil ditambahkan dengan nomor: ' . $request->nomor_resep);
                           
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan resep:', ['error' => $e->getMessage()]);
            
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat menyimpan resep: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail resep
     */
   /**
 * Tampilkan detail resep
 */
public function show(Resep $resep)
{
    // Load semua relasi yang dibutuhkan
    $resep->load(['obats', 'pasien', 'pemeriksaan']);
    
    // Debug: Cek apakah data ter-load
    \Log::info('Resep data:', [
        'resep_id' => $resep->id,
        'nomor_resep' => $resep->nomor_resep,
        'pasien_id' => $resep->pasien_id,
        'pemeriksaan_id' => $resep->pemeriksaan_id,
        'pasien' => $resep->pasien ? $resep->pasien->toArray() : null,
        'pemeriksaan' => $resep->pemeriksaan ? $resep->pemeriksaan->toArray() : null,
        'obats_count' => $resep->obats->count(),
    ]);
    
    return view('reseps.show', compact('resep'));
}

/**
 * Form edit resep
 */
public function edit(Resep $resep)
{
    $resep->load(['obats', 'pasien', 'pemeriksaan']);
    return view('reseps.edit', compact('resep'));
}

    /**
     * Update resep
     */
    public function update(Request $request, Resep $resep)
    {
        $request->validate([
            'obat' => 'required|array|min:1',
            'obat.*.nama_obat' => 'required|string|max:255',
            'obat.*.jenis' => 'nullable|string|max:100',
            'obat.*.dosis' => 'nullable|string|max:255',
            'obat.*.quantity' => 'required|integer|min:1|max:999',
        ]);

        try {
            // Hapus obat lama
            $resep->obats()->delete();

            // Simpan obat baru
            foreach ($request->obat as $item) {
                if (!empty($item['nama_obat'])) {
                    Obat::create([
                        'nama_obat' => $item['nama_obat'],
                        'jenis' => $item['jenis'] ?? null,
                        'dosis' => $item['dosis'] ?? null,
                        'quantity' => $item['quantity'] ?? 1,
                        'resep_id' => $resep->id,
                    ]);
                }
            }

            return redirect()->route('reseps.show', $resep)
                           ->with('success', 'Resep berhasil diperbarui');
                           
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat memperbarui resep: ' . $e->getMessage());
        }
    }

    /**
 * Hapus resep
 */
    public function destroy(Resep $resep)
    {
        try {
            // Hapus semua obat terkait
            $resep->obats()->delete();
            
            // Hapus resep
            $resep->delete();
            
            return redirect()->route('reseps.index')
                        ->with('success', 'Resep berhasil dihapus');
                        
        } catch (\Exception $e) {
            return redirect()->back()
                        ->with('error', 'Terjadi kesalahan saat menghapus resep: ' . $e->getMessage());
        }
    }

}
