                        <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Pemeriksaan') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <!-- Header Section -->
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Data Pemeriksaan Pasien</h3>
                        <p class="text-sm text-gray-600">Vital signs dan data pemeriksaan terbaru</p>
                    </div>
                    <a href="{{ route('pemeriksaan.create') }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        Tambah Pemeriksaan
                    </a>
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

                @if($pemeriksaans->count() > 0)
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Nama Pasien
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                            Tekanan Darah
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-1m-3 1l-3-1"></path>
                                            </svg>
                                            Berat Badan
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-300 text-left text-sm font-semibold text-gray-700">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Tanggal Pemeriksaan
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-300 text-center text-sm font-semibold text-gray-700">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemeriksaans as $index => $pemeriksaan)
                                    <tr class="hover:bg-gray-50 transition duration-200">
                                        <td class="border border-gray-300 px-4 py-3">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-blue-600 font-semibold text-sm">{{ substr($pemeriksaan->pasien->nama, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">{{ $pemeriksaan->pasien->nama }}</div>
                                                    <div class="text-sm text-gray-500">{{ $pemeriksaan->pasien->no_hp }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @php
                                                    $tekanan = explode('/', $pemeriksaan->tekanan_darah);
                                                    $sistol = isset($tekanan[0]) ? (int)$tekanan[0] : 0;
                                                    $diastol = isset($tekanan[1]) ? (int)$tekanan[1] : 0;
                                                    
                                                    if ($sistol >= 140 || $diastol >= 90) {
                                                        echo 'bg-red-100 text-red-800';
                                                    } elseif ($sistol >= 130 || $diastol >= 80) {
                                                        echo 'bg-yellow-100 text-yellow-800';
                                                    } else {
                                                        echo 'bg-green-100 text-green-800';
                                                    }
                                                @endphp
                                            ">
                                                {{ $pemeriksaan->tekanan_darah }} mmHg
                                            </span>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-3">
                                            <span class="text-gray-900">{{ $pemeriksaan->berat_badan }}</span>
                                            <span class="text-gray-500 text-sm">kg</span>
                                            @if($pemeriksaan->tinggi_badan && $pemeriksaan->berat_badan)
                                                @php
                                                    $tinggi_m = $pemeriksaan->tinggi_badan / 100;
                                                    $bmi = $pemeriksaan->berat_badan / ($tinggi_m * $tinggi_m);
                                                @endphp
                                                <div class="text-xs text-gray-500 mt-1">
                                                    BMI: {{ number_format($bmi, 1) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 px-4 py-3">
                                            <div class="text-gray-900">{{ $pemeriksaan->created_at->format('d/m/Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ $pemeriksaan->created_at->format('H:i') }}</div>
                                        </td>
                                        <td class="border border-gray-300 px-4 py-3 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('pasien.show', $pemeriksaan->pasien->id) }}" 
                                                   class="bg-green-500 hover:bg-green-700 text-white text-xs px-2 py-1 rounded transition duration-200">
                                                    Detail
                                                </a>
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

                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data pemeriksaan</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat pemeriksaan pertama.</p>
                        <div class="mt-6">
                            <a href="{{ route('pemeriksaan.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Buat Pemeriksaan
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan keluhan -->
    <div id="keluhanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Keluhan Pasien</h3>
                    <button onclick="closeKeluhan()" class="text-gray-400 hover:text-gray-600">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 px-7 py-3">
                    <p id="keluhanText" class="text-sm text-gray-500"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button onclick="closeKeluhan()" 
                            class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
