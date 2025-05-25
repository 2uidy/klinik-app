<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Input Resep Obat
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Patient Info Card -->
            @if(isset($pemeriksaan))
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">{{ substr($pemeriksaan->pasien->nama, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $pemeriksaan->pasien->nama }}</h3>
                            <p class="text-sm text-gray-600">{{ $pemeriksaan->pasien->jenis_kelamin }} • {{ \Carbon\Carbon::parse($pemeriksaan->pasien->tanggal_lahir)->age }} tahun</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-medium text-green-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Diagnosa
                            </h4>
                            <p class="text-sm text-green-900">{{ $pemeriksaan->diagnosa ?? 'Belum ada diagnosa' }}</p>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-medium text-blue-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Tanggal Pemeriksaan
                            </h4>
                            <p class="text-sm text-blue-900">{{ $pemeriksaan->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white shadow rounded-lg">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Form Input Resep</h3>
                            <p class="text-sm text-gray-600">Masukkan detail resep obat untuk pasien</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('reseps.store') }}" method="POST" id="resepForm" class="p-6">
                    @csrf
                    <input type="hidden" name="pemeriksaan_id" value="{{ $pemeriksaanId }}">
                    
                    <!-- Nomor Resep -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"></path>
                            </svg>
                            Nomor Resep <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nomor_resep" 
                                   id="nomor_resep"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" 
                                   placeholder="Contoh: RSP-{{ date('Ymd') }}-001"
                                   required>
                            <button type="button" 
                                    id="generateBtn"
                                    class="absolute right-2 top-2 bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1 rounded text-sm transition duration-200">
                                Generate
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Nomor resep harus unik untuk setiap pasien</p>
                    </div>

                    <!-- Daftar Obat -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                                Daftar Obat <span class="text-red-500">*</span>
                            </label>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full" id="obatCounter">1 Obat</span>
                        </div>

                        <div id="obatContainer">
                            <!-- Obat 1 (Default) -->
                            <div class="obat-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50" data-index="0">
                                <div class="flex items-center justify-between mb-3">
                                                                        <h4 class="font-medium text-gray-800 flex items-center">
                                        <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs mr-2">1</span>
                                        Obat #1
                                    </h4>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Nama Obat</label>
                                        <input type="text" 
                                               name="obat[0][nama_obat]" 
                                               placeholder="Contoh: Paracetamol"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" 
                                               required>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Obat</label>
                                        <select name="obat[0][jenis]" 
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                                            <option value="">Pilih Jenis</option>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Kapsul">Kapsul</option>
                                            <option value="Sirup">Sirup</option>
                                            <option value="Salep">Salep</option>
                                            <option value="Tetes">Tetes</option>
                                            <option value="Injeksi">Injeksi</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Quantity</label>
                                        <div class="relative">
                                            <input type="number" 
                                                   name="obat[0][quantity]" 
                                                   value="1"
                                                   min="1" 
                                                   max="999"
                                                   placeholder="1"
                                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" 
                                                   required>
                                            <div class="absolute inset-y-0 right-0 flex flex-col">
                                                <button type="button" class="quantity-up px-2 py-1 text-xs text-gray-500 hover:text-green-600">▲</button>
                                                <button type="button" class="quantity-down px-2 py-1 text-xs text-gray-500 hover:text-green-600">▼</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Dosis & Aturan</label>
                                        <input type="text" 
                                               name="obat[0][dosis]" 
                                               placeholder="Contoh: 3x1 sehari"
                                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add More Button -->
                        <button type="button" 
                                id="addObatBtn"
                                class="w-full border-2 border-dashed border-gray-300 rounded-lg py-3 text-gray-600 hover:border-green-400 hover:text-green-600 transition duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Obat Lain
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Resep
                        </button>
                        
                        <a href="{{ route('inputobat.index') }}" 
                           class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 flex items-center justify-center">
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

    <!-- JavaScript untuk Dynamic Form -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let obatIndex = 1;

            // Generate nomor resep otomatis
            document.getElementById('generateBtn').addEventListener('click', function() {
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                const time = String(today.getHours()).padStart(2, '0') + String(today.getMinutes()).padStart(2, '0');
                
                const nomorResep = `RSP-${year}${month}${day}-${time}`;
                document.getElementById('nomor_resep').value = nomorResep;
                
                // Show success feedback
                const button = this;
                const originalText = button.textContent;
                button.textContent = '✓';
                button.classList.add('bg-green-100', 'text-green-600');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('bg-green-100', 'text-green-600');
                }, 1000);
            });

            // Tambah obat baru
            document.getElementById('addObatBtn').addEventListener('click', function() {
                const container = document.getElementById('obatContainer');
                const newObatHtml = `
                    <div class="obat-item border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50 animate-fadeIn" data-index="${obatIndex}">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-gray-800 flex items-center">
                                <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs mr-2">${obatIndex + 1}</span>
                                Obat #${obatIndex + 1}
                            </h4>
                            <button type="button" 
                                    class="remove-obat text-red-500 hover:text-red-700 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Nama Obat</label>
                                <input type="text" 
                                       name="obat[${obatIndex}][nama_obat]" 
                                       placeholder="Contoh: Amoxicillin"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" 
                                       required>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Obat</label>
                                <select name="obat[${obatIndex}][jenis]" 
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                                    <option value="">Pilih Jenis</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Sirup">Sirup</option>
                                    <option value="Salep">Salep</option>
                                    <option value="Tetes">Tetes</option>
                                    <option value="Injeksi">Injeksi</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Quantity</label>
                                <div class="relative">
                                    <input type="number" 
                                           name="obat[${obatIndex}][quantity]" 
                                           value="1"
                                           min="1" 
                                           max="999"
                                           placeholder="1"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" 
                                           required>
                                    <div class="absolute inset-y-0 right-0 flex flex-col">
                                        <button type="button" class="quantity-up px-2 py-1 text-xs text-gray-500 hover:text-green-600">▲</button>
                                        <button type="button" class="quantity-down px-2 py-1 text-xs text-gray-500 hover:text-green-600">▼</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Dosis & Aturan</label>
                                <input type="text" 
                                       name="obat[${obatIndex}][dosis]" 
                                       placeholder="Contoh: 2x1 sehari"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                            </div>
                        </div>
                    </div>
                `;
                
                container.insertAdjacentHTML('beforeend', newObatHtml);
                obatIndex++;
                updateObatCounter();
                
                // Focus on new input
                const newInputs = container.querySelectorAll('.obat-item:last-child input[type="text"]');
                if (newInputs.length > 0) {
                    newInputs[0].focus();
                }
            });

            // Event delegation untuk remove obat
            document.getElementById('obatContainer').addEventListener('click', function(e) {
                if (e.target.closest('.remove-obat')) {
                    const obatItem = e.target.closest('.obat-item');
                    const obatItems = document.querySelectorAll('.obat-item');
                    
                    if (obatItems.length > 1) {
                        obatItem.style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(() => {
                            obatItem.remove();
                            updateObatCounter();
                            reorderObatNumbers();
                        }, 300);
                    } else {
                        alert('Minimal harus ada 1 obat dalam resep');
                    }
                }

                // Handle quantity up/down buttons
                if (e.target.classList.contains('quantity-up')) {
                    const input = e.target.closest('.relative').querySelector('input[type="number"]');
                    const currentValue = parseInt(input.value) || 1;
                    if (currentValue < 999) {
                        input.value = currentValue + 1;
                        input.dispatchEvent(new Event('change'));
                    }
                }

                if (e.target.classList.contains('quantity-down')) {
                    const input = e.target.closest('.relative').querySelector('input[type="number"]');
                    const currentValue = parseInt(input.value) || 1;
                    if (currentValue > 1) {
                        input.value = currentValue - 1;
                        input.dispatchEvent(new Event('change'));
                    }
                }
            });

                       // Update counter obat
            function updateObatCounter() {
                const count = document.querySelectorAll('.obat-item').length;
                const totalQuantity = Array.from(document.querySelectorAll('input[name*="[quantity]"]'))
                    .reduce((sum, input) => sum + (parseInt(input.value) || 0), 0);
                
                document.getElementById('obatCounter').textContent = `${count} Obat (${totalQuantity} Total)`;
            }

            // Reorder nomor obat setelah ada yang dihapus
            function reorderObatNumbers() {
                const obatItems = document.querySelectorAll('.obat-item');
                obatItems.forEach((item, index) => {
                    const numberSpan = item.querySelector('span');
                    const title = item.querySelector('h4');
                    
                    numberSpan.textContent = index + 1;
                    title.innerHTML = `
                        <span class="w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs mr-2">${index + 1}</span>
                        Obat #${index + 1}
                    `;
                    
                    // Update name attributes
                    const inputs = item.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            const newName = name.replace(/\[\d+\]/, `[${index}]`);
                            input.setAttribute('name', newName);
                        }
                    });
                });
            }

            // Update counter saat quantity berubah
            document.addEventListener('change', function(e) {
                if (e.target.name && e.target.name.includes('[quantity]')) {
                    updateObatCounter();
                }
            });

            // Form validation
            document.getElementById('resepForm').addEventListener('submit', function(e) {
                const nomorResep = document.getElementById('nomor_resep').value.trim();
                const obatInputs = document.querySelectorAll('input[name*="[nama_obat]"]');
                const quantityInputs = document.querySelectorAll('input[name*="[quantity]"]');
                
                if (!nomorResep) {
                    e.preventDefault();
                    alert('Nomor resep harus diisi!');
                    document.getElementById('nomor_resep').focus();
                    return;
                }
                
                let hasEmptyObat = false;
                obatInputs.forEach(input => {
                    if (!input.value.trim()) {
                        hasEmptyObat = true;
                        input.focus();
                    }
                });
                
                if (hasEmptyObat) {
                    e.preventDefault();
                    alert('Semua nama obat harus diisi!');
                    return;
                }

                let hasInvalidQuantity = false;
                quantityInputs.forEach(input => {
                    const value = parseInt(input.value);
                    if (!value || value < 1 || value > 999) {
                        hasInvalidQuantity = true;
                        input.focus();
                    }
                });

                if (hasInvalidQuantity) {
                    e.preventDefault();
                    alert('Quantity harus diisi dengan angka 1-999!');
                    return;
                }
                
                // Show loading state
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = `
                    <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 0120.001 8a8.003 8.003 0 01-6.918 7.928A9.953 9.953 0 0112 17C9.417 17 7.053 15.914 5.293 14.207l-.707.707A1 1 0 013.172 13.5L2 12.328a1 1 0 011.414-1.414l1.328 1.328"></path>
                    </svg>
                    Menyimpan...
                `;
                submitButton.disabled = true;
            });

            // Initialize counter
            updateObatCounter();
        });
    </script>

    <!-- Custom CSS untuk animasi -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        /* Custom styling untuk quantity buttons */
        .quantity-up, .quantity-down {
            line-height: 1;
            font-size: 10px;
            width: 20px;
            height: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-up:hover, .quantity-down:hover {
            background-color: #f3f4f6;
        }

        /* Hide default number input arrows */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</x-app-layout>

