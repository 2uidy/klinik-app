<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pemeriksaan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header Form -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Form Pemeriksaan Pasien</h3>
                        <p class="text-sm text-gray-600">Silakan isi data pemeriksaan dengan lengkap dan akurat.</p>
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

                    <!-- Form -->
                    <form action="{{ route('pemeriksaan.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Pilih Pasien -->
                        <div>
                            <label for="pasien_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Pilih Pasien <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <select name="pasien_id" id="pasien_id" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="">-- Pilih Pasien --</option>
                                @foreach ($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                                        {{ $pasien->nama }} - {{ $pasien->no_hp }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pasien_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Berat Badan -->
                        <div>
                            <label for="berat_badan" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-1m-3 1l-3-1"></path>
                                    </svg>
                                    Berat Badan <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       step="0.1" 
                                       min="0" 
                                       max="300"
                                       name="berat_badan" 
                                       id="berat_badan"
                                       value="{{ old('berat_badan') }}"
                                       placeholder="Contoh: 65.5"
                                       required
                                       class="block w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">kg</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Masukkan berat badan dalam kilogram (kg)</p>
                            @error('berat_badan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tekanan Darah -->
                        <div>
                            <label for="tekanan_darah" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    Tekanan Darah <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="tekanan_darah" 
                                       id="tekanan_darah"
                                       value="{{ old('tekanan_darah') }}"
                                       placeholder="Contoh: 120/80"
                                       pattern="[0-9]{2,3}/[0-9]{2,3}"
                                       required
                                       class="block w-full px-3 py-2 pr-16 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">mmHg</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Format: sistol/diastol (contoh: 120/80)</p>
                            @error('tekanan_darah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tinggi Badan (Optional) -->
                        <div>
                            <label for="tinggi_badan" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                    Tinggi Badan (Opsional)
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       min="50" 
                                       max="250"
                                       name="tinggi_badan" 
                                       id="tinggi_badan"
                                       value="{{ old('tinggi_badan') }}"
                                       placeholder="Contoh: 170"
                                       class="block w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">cm</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Masukkan tinggi badan dalam centimeter (cm)</p>
                            @error('tinggi_badan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keluhan (Optional) -->
                        <div>
                            <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Keluhan Pasien (Opsional)
                                </span>
                            </label>
                            <textarea name="keluhan" 
                                      id="keluhan" 
                                      rows="3"
                                      placeholder="Tuliskan keluhan atau gejala yang dialami pasien..."
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 resize-none">{{ old('keluhan') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Catatan tambahan mengenai kondisi pasien</p>
                            @error('keluhan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Pemeriksaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>
