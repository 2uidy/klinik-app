<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Input Resep Obat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Card -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Daftar Pasien Menunggu Resep</h3>
                                <p class="text-sm text-gray-600">Pasien yang sudah didiagnosa dan menunggu resep obat</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                {{ $pemeriksaans->count() }} Pasien
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow rounded-lg">
                <div class="p-6">
                    @if($pemeriksaans->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Pasien Menunggu Resep</h3>
                            <p class="text-gray-600 mb-4">Saat ini tidak ada pasien yang menunggu input resep obat</p>
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                </svg>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    @else
                        <!-- Patient List -->
                        <div class="space-y-4">
                            @foreach ($pemeriksaans as $index => $pemeriksaan)
                                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition duration-200 hover:border-green-300">
                                    <div class="flex items-center justify-between">
                                        <!-- Patient Info -->
                                        <div class="flex items-center flex-1">
                                            <!-- Avatar -->
                                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                                                <span class="text-white font-bold text-lg">{{ substr($pemeriksaan->pasien->nama, 0, 1) }}</span>
                                            </div>
                                            
                                            <!-- Patient Details -->
                                            <div class="flex-1">
                                                <div class="flex items-center mb-1">
                                                    <h4 class="text-lg font-semibold text-gray-900 mr-3">{{ $pemeriksaan->pasien->nama }}</h4>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Menunggu Resep
                                                    </span>
                                                </div>
                                                
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-sm text-gray-600">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        {{ $pemeriksaan->pasien->jenis_kelamin }} • {{ \Carbon\Carbon::parse($pemeriksaan->pasien->tanggal_lahir)->age }} tahun
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                        </svg>
                                                        {{ $pemeriksaan->created_at->format('d/m/Y H:i') }}
                                                    </div>
                                                    @if($pemeriksaan->diagnosa)
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Sudah Didiagnosa
                                                    </div>
                                                    @endif
                                                </div>

                                                <!-- Diagnosis Preview -->
                                                @if($pemeriksaan->diagnosa)
                                                <div class="mt-3 p-3 bg-green-50 rounded-lg">
                                                    <p class="text-sm font-medium text-green-800 mb-1">Diagnosa:</p>
                                                    <p class="text-sm text-green-700">{{ Str::limit($pemeriksaan->diagnosa, 100) }}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex flex-col sm:flex-row gap-2 ml-4">
                                            <a href="{{ route('reseps.create', ['pemeriksaan_id' => $pemeriksaan->id]) }}"
                                               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                                </svg>
                                                Input Resep
                                            </a>
                                            
                                            @if (in_array(auth()->user()->role, ['dokter', 'perawat', 'apoteker']))
                                                <a href="{{ route('pasien.show', $pemeriksaan->pasien->id) }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Detail Pasien
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination or Load More (if needed) -->
                        @if($pemeriksaans->count() > 5)
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">Menampilkan {{ $pemeriksaans->count() }} pasien yang menunggu resep</p>
                        </div>
                        @endif
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Custom CSS for smooth transitions -->
    <style>
        .border.border-gray-200.rounded-lg {
            transition: all 0.2s ease-in-out;
        }
        
        /* Loading animation */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        /* Responsive improvements */
        @media (max-width: 640px) {
            .grid.grid-cols-1.md\:grid-cols-3 {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
            
            .flex.flex-col.sm\:flex-row {
                flex-direction: column;
            }
            
            .ml-4 {
                margin-left: 0;
                margin-top: 1rem;
            }
        }
        
        /* Hover effects */
        .hover\:border-green-300:hover {
            border-color: #86efac;
        }
        
        /* Focus improvements */
        button:focus, a:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
        }
    </style>
</x-app-layout>

