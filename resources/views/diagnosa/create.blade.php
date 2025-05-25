<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Diagnosa Pasien
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Patient Info Card -->
            <div class="bg-white p-6 shadow rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Pasien
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama Pasien:</p>
                        <p class="font-semibold text-gray-900">{{ $pemeriksaan->pasien->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Jenis Kelamin:</p>
                        <p class="font-semibold text-gray-900">{{ $pemeriksaan->pasien->jenis_kelamin }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Umur:</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($pemeriksaan->pasien->tanggal_lahir)->age }} tahun</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Waktu Pemeriksaan:</p>
                        <p class="font-semibold text-gray-900">{{ $pemeriksaan->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <!-- Vital Signs -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <h4 class="font-medium text-gray-800 mb-2">Vital Signs:</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                        <div class="bg-gray-50 p-2 rounded">
                            <span class="text-gray-600">Tekanan Darah:</span>
                            <span class="font-medium ml-1">{{ $pemeriksaan->tekanan_darah }}</span>
                        </div>
                        <div class="bg-gray-50 p-2 rounded">
                            <span class="text-gray-600">Berat Badan:</span>
                            <span class="font-medium ml-1">{{ $pemeriksaan->berat_badan }} kg</span>
                        </div>
                        @if($pemeriksaan->tinggi_badan)
                        <div class="bg-gray-50 p-2 rounded">
                            <span class="text-gray-600">Tinggi Badan:</span>
                            <span class="font-medium ml-1">{{ $pemeriksaan->tinggi_badan }} cm</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Diagnosis Form -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Form Diagnosa
                </h3>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('diagnosa.store', $pemeriksaan->id) }}" method="POST" id="diagnosisForm">
                    @csrf
                    
                    <!-- Keluhan -->
                    <div class="mb-6">
                        <label for="keluhan" class="block font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Keluhan Pasien <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="keluhan" 
                            id="keluhan"
                            rows="4" 
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Tuliskan keluhan yang disampaikan pasien..."
                            required>{{ old('keluhan', $pemeriksaan->keluhan) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Deskripsikan gejala dan keluhan yang disampaikan pasien</p>
                    </div>

                    <!-- Diagnosa -->
                    <div class="mb-6">
                        <label for="diagnosa" class="block font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Diagnosa Medis <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="diagnosa" 
                            id="diagnosa"
                            rows="4" 
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                            placeholder="Tuliskan diagnosa medis berdasarkan pemeriksaan..."
                            required>{{ old('diagnosa') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Berikan diagnosa yang akurat berdasarkan hasil pemeriksaan</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span id="submitText">Simpan Diagnosa</span>
                        </button>
                        
                        <a href="{{ route('diagnosa.index') }}" 
                           class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
