<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pemeriksaan Belum Didiagnosa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header Section -->
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Antrian Diagnosa</h3>
                            <p class="text-sm text-gray-600">
                                Daftar pasien yang telah diperiksa dan menunggu diagnosa dari dokter
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-50 px-3 py-2 rounded-lg">
                                <span class="text-blue-700 font-medium text-sm">
                                    Total: {{ $pemeriksaans->count() }} pasien
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if($pemeriksaans->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada antrian diagnosa</h3>
                            <p class="text-gray-500 mb-6">Semua pemeriksaan telah selesai didiagnosa atau belum ada pemeriksaan baru.</p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('dashboard') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    </svg>
                                    Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto border-collapse border border-gray-300">
                                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                    <tr>
                                        <th class="px-6 py-4 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                Informasi Pasien
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                                Vital Signs
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Keluhan
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Diagnosa
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Waktu Pemeriksaan
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 border border-gray-300 text-center text-sm font-semibold text-gray-700">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemeriksaans as $index => $pemeriksaan)
                                        <tr class="hover:bg-blue-50 transition duration-200 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                                            <!-- Informasi Pasien -->
                                            <td class="border border-gray-300 px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-4">
                                                        <span class="text-white font-bold text-sm">{{ substr($pemeriksaan->pasien->nama, 0, 1) }}</span>
                                                    </div>
                                                    <div>
                                                        <div class="font-semibold text-gray-900">{{ $pemeriksaan->pasien->nama }}</div>
                                                        <div class="text-sm text-gray-500">{{ $pemeriksaan->pasien->jenis_kelamin }}</div>
                                                        <div class="text-sm text-gray-500">{{ $pemeriksaan->pasien->no_hp }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Vital Signs -->
                                            <td class="border border-gray-300 px-6 py-4">
                                                <div class="space-y-1">
                                                    <div class="flex items-center text-sm">
                                                        <span class="w-16 text-gray-600">TD:</span>
                                                        <span class="font-medium text-gray-900">{{ $pemeriksaan->tekanan_darah }} mmHg</span>
                                                    </div>
                                                    <div class="flex items-center text-sm">
                                                        <span class="w-16 text-gray-600">BB:</span>
                                                        <span class="font-medium text-gray-900">{{ $pemeriksaan->berat_badan }} kg</span>
                                                    </div>
                                                    @if($pemeriksaan->tinggi_badan)
                                                        <div class="flex items-center text-sm">
                                                            <span class="w-16 text-gray-600">TB:</span>
                                                            <span class="font-medium text-gray-900">{{ $pemeriksaan->tinggi_badan }} cm</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Keluhan -->
                                            <td class="border border-gray-300 px-6 py-4">
                                                @if($pemeriksaan->keluhan)
                                                    <div class="max-w-xs">
                                                        <p class="text-sm text-gray-900 line-clamp-3">{{ $pemeriksaan->keluhan }}</p>
                                                        @if(strlen($pemeriksaan->keluhan) > 100)
                                                            <button onclick="showFullKeluhan('{{ addslashes($pemeriksaan->keluhan) }}')" 
                                                                    class="text-blue-600 hover:text-blue-800 text-xs mt-1">
                                                                Lihat selengkapnya...
                                                            </button>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 italic text-sm">Tidak ada keluhan</span>
                                                @endif
                                            </td>

                                            <!-- Diagnosa -->
                                            <td class="border border-gray-300 px-6 py-4">
                                                @if($pemeriksaan->diagnosa)
                                                    <div class="max-w-xs">
                                                        <p class="text-sm text-gray-900 line-clamp-3">{{ $pemeriksaan->diagnosa }}</p>
                                                        @if(strlen($pemeriksaan->diagnosa) > 100)
                                                            <button onclick="showFullDiagnosa('{{ addslashes($pemeriksaan->diagnosa) }}')" 
                                                                    class="text-blue-600 hover:text-blue-800 text-xs mt-1">
                                                                Lihat selengkapnya...
                                                            </button>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 italic text-sm">Tidak ada keluhan</span>
                                                @endif
                                            </td>

                                            <!-- Waktu Pemeriksaan -->
                                            <td class="border border-gray-300 px-6 py-4">
                                                <div class="text-sm">
                                                    <div class="font-medium text-gray-900">{{ $pemeriksaan->created_at->format('d/m/Y') }}</div>
                                                    <div class="text-gray-500">{{ $pemeriksaan->created_at->format('H:i') }} WIB</div>
                                                    <div class="text-xs text-gray-400 mt-1">
                                                        {{ $pemeriksaan->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Aksi -->
                                            <td class="border border-gray-300 px-6 py-4">
                                                <div class="flex flex-col space-y-2">
                                                    <a href="{{ route('diagnosa.create', $pemeriksaan->id) }}"
                                                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-200 transform hover:scale-105">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Isi Diagnosa
                                                    </a>
                                                    
                                                    @if (in_array(auth()->user()->role, ['dokter', 'perawat', 'apoteker']))
                                                        <a href="{{ route('pasien.show', $pemeriksaan->pasien->id) }}" 
                                                           class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium rounde
                                                                                                                      class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-200 transform hover:scale-105">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            Detail Pasien
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination jika ada -->
                        @if(method_exists($pemeriksaans, 'links'))
                            <div class="mt-6">
                                {{ $pemeriksaans->links() }}
                            </div>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="keluhanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Keluhan Lengkap
                    </h3>
                    <button onclick="closeKeluhan()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 px-2 py-3">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p id="keluhanText" class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap"></p>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button onclick="closeKeluhan()" 
                            class="px-6 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS untuk line-clamp -->
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Hover effects */
        .transform:hover {
            transform: translateY(-1px);
        }
        
        /* Loading animation untuk tombol */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</x-app-layout>

