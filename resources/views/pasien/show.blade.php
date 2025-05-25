<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detail Pasien</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Patient Profile Card -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <!-- Avatar -->
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-xl">{{ substr($pasien->nama, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $pasien->nama }}</h3>
                            <p class="text-sm text-gray-600">{{ $pasien->jenis_kelamin }} • {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} tahun</p>
                        </div>
                    </div>
                </div>

                <!-- Patient Details -->
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Data Pasien
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-600">NIK</span>
                            </div>
                            <p class="font-semibold text-gray-900">{{ $pasien->nik }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-600">Tanggal Lahir</span>
                            </div>
                            <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-600">No. HP</span>
                            </div>
                            <p class="font-semibold text-gray-900">{{ $pasien->no_hp }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Medical History -->
            <div class="bg-white shadow rounded-lg">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Riwayat Pemeriksaan
                        <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $pasien->pemeriksaans->count() }} kali
                        </span>
                    </h3>
                </div>

                <div class="p-6">
                    @if($pasien->pemeriksaans->count() > 0)
                        <div class="space-y-6">
                            @foreach($pasien->pemeriksaans->sortByDesc('created_at') as $periksa)
                                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition duration-200">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">Pemeriksaan</h4>
                                                <p class="text-sm text-gray-600">{{ $periksa->created_at->format('d M Y, H:i') }} WIB</p>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                            {{ $periksa->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <!-- Vital Signs -->
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                        <div class="bg-red-50 p-3 rounded-lg text-center">
                                            <p class="text-xs text-red-600 font-medium">Tekanan Darah</p>
                                            <p class="text-sm font-bold text-red-800">{{ $periksa->tekanan_darah }}</p>
                                        </div>
                                        <div class="bg-yellow-50 p-3 rounded-lg text-center">
                                            <p class="text-xs text-yellow-600 font-medium">Berat Badan</p>
                                            <p class="text-sm font-bold text-yellow-800">{{ $periksa->berat_badan }} kg</p>
                                        </div>
                                        @if($periksa->tinggi_badan)
                                        <div class="bg-purple-50 p-3 rounded-lg text-center">
                                            <p class="text-xs text-purple-600 font-medium">Tinggi Badan</p>
                                            <p class="text-sm font-bold text-purple-800">{{ $periksa->tinggi_badan }} cm</p>
                                        </div>
                                        @endif
                                        @if($periksa->suhu)
                                        <div class="bg-orange-50 p-3 rounded-lg text-center">
                                            <p class="text-xs text-orange-600 font-medium">Suhu</p>
                                            <p class="text-sm font-bold text-orange-800">{{ $periksa->suhu }}°C</p>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Keluhan & Diagnosa -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        @if($periksa->keluhan)
                                        <div class="bg-blue-50 p-4 rounded-lg">
                                            <h5 class="font-medium text-blue-800 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                Keluhan
                                            </h5>
                                            <p class="text-sm text-blue-900">{{ $periksa->keluhan }}</p>
                                        </div>
                                        @endif

                                        @if($periksa->diagnosa)
                                        <div class="bg-green-50 p-4 rounded-lg">
                                            <h5 class="font-medium text-green-800 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Diagnosa
                                            </h5>
                                            <p class="text-sm text-green-900">{{ $periksa->diagnosa }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Resep -->
                                    @if ($periksa->resep)
                                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                            <h5 class="font-medium text-purple-800 mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox
                                                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                                </svg>
                                                Resep Obat ({{ $periksa->resep->nomor_resep }})
                                            </h5>
                                            
                                            @if($periksa->resep->obats->count() > 0)
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                    @foreach ($periksa->resep->obats as $obat)
                                                        <div class="bg-white border border-purple-200 rounded-lg p-3">
                                                            <div class="flex items-start">
                                                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                                                    </svg>
                                                                </div>
                                                                <div class="flex-1">
                                                                    <h6 class="font-semibold text-purple-900 text-sm">{{ $obat->nama_obat }}</h6>
                                                                    <p class="text-xs text-purple-700 mt-1">
                                                                        <span class="inline-block bg-purple-100 px-2 py-0.5 rounded mr-2">{{ $obat->jenis }}</span>
                                                                        <span class="font-medium">{{ $obat->dosis }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-sm text-purple-700 italic">Belum ada obat yang diresepkan</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="text-sm text-gray-600">Belum ada resep untuk pemeriksaan ini</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Riwayat Pemeriksaan</h3>
                            <p class="text-gray-600">Pasien ini belum pernah melakukan pemeriksaan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6 flex justify-center">
                <a href="javascript:history.back()" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Simple JavaScript for smooth interactions -->
    <script>
        // Smooth scroll to top when page loads
        window.addEventListener('load', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Add hover effect to examination cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.border.border-gray-200.rounded-lg');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>

    <!-- Custom CSS for smooth transitions -->
    <style>
        .border.border-gray-200.rounded-lg {
            transition: all 0.2s ease-in-out;
        }
        
        /* Responsive improvements */
        @media (max-width: 640px) {
            .grid.grid-cols-2.md\:grid-cols-4 {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .grid.grid-cols-1.md\:grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-app-layout>

