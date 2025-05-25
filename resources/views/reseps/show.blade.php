<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Resep: {{ $resep->nomor_resep ?? 'Tidak ada nomor' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Patient Info -->
            <div class="bg-white shadow rounded-lg mb-6 p-6">
                <h3 class="text-lg font-bold mb-4">Informasi Pasien</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama Pasien</p>
                        <p class="font-medium">{{ $resep->pasien->nama ?? 'Data pasien tidak ditemukan' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nomor Resep</p>
                        <p class="font-medium">{{ $resep->nomor_resep ?? 'Tidak ada nomor' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Diagnosa</p>
                        <p class="font-medium">{{ $resep->pemeriksaan->diagnosa ?? 'Tidak ada diagnosa' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Resep</p>
                        <p class="font-medium">{{ $resep->created_at ? $resep->created_at->format('d M Y, H:i') : 'Tidak ada tanggal' }} WIB</p>
                    </div>
                </div>

                @if($resep->pasien)
                    <div class="grid grid-cols-2 gap-4 mt-4 pt-4 border-t">
                        <div>
                            <p class="text-sm text-gray-600">Jenis Kelamin</p>
                            <p class="font-medium">{{ $resep->pasien->jenis_kelamin ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Umur</p>
                            <p class="font-medium">
                                @if($resep->pasien->tanggal_lahir)
                                    {{ \Carbon\Carbon::parse($resep->pasien->tanggal_lahir)->age }} tahun
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Alamat</p>
                            <p class="font-medium">{{ $resep->pasien->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Telepon</p>
                            <p class="font-medium">{{ $resep->pasien->telepon ?? '-' }}</p>
                        </div>
                    </div>
                @else
                    <div class="mt-4 pt-4 border-t">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong>Peringatan:</strong> Data pasien tidak ditemukan untuk resep ini.
                        </div>
                    </div>
                @endif
            </div>

            <!-- Daftar Obat -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Obat</h3>
                
                @if($resep->obats && $resep->obats->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left p-3 font-medium text-gray-700">No</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Nama Obat</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Jenis</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Quantity</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Dosis & Aturan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resep->obats as $index => $obat)
                                    <tr class="border-b border-gray-200">
                                        <td class="p-3">{{ $index + 1 }}</td>
                                        <td class="p-3 font-medium">{{ $obat->nama_obat ?? 'Nama obat tidak ada' }}</td>
                                        <td class="p-3">
                                            @if($obat->jenis)
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                    {{ $obat->jenis }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">
                                                {{ $obat->quantity ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="p-3">{{ $obat->dosis ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-50">
                                    <td colspan="3" class="p-3 font-medium text-gray-700">Total Obat:</td>
                                    <td class="p-3">
                                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-sm font-bold">
                                            {{ $resep->obats->sum('quantity') }}
                                        </span>
                                    </td>
                                    <td class="p-3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <p class="text-gray-500">Tidak ada obat dalam resep ini.</p>
                    </div>
                @endif

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('inputobat.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        Kembali
                    </a>
                    {{-- <button onclick="window.print()" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        Print Resep
                    </button> --}}
                    @if(auth()->user()->role === 'apoteker')
                        <a href="{{ route('reseps.edit', $resep) }}" 
                           class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            Edit Resep
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                font-size: 12px;
            }
            
            .bg-white {
                background: white !important;
            }
            
            .shadow {
                box-shadow: none !important;
            }
        }
    </style>
</x-app-layout>
