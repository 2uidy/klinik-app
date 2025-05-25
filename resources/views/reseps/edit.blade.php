<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Resep: {{ $resep->nomor_resep }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Patient Info (Read Only) -->
            <div class="bg-gray-50 shadow rounded-lg mb-6 p-6">
                <h3 class="text-lg font-bold mb-4">Informasi Pasien</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama Pasien</p>
                        <p class="font-medium">{{ $resep->pasien->nama ?? 'Data pasien tidak ditemukan' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nomor Resep</p>
                        <p class="font-medium">{{ $resep->nomor_resep }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Diagnosa</p>
                        <p class="font-medium">{{ $resep->pemeriksaan->diagnosa ?? 'Tidak ada diagnosa' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Resep</p>
                        <p class="font-medium">{{ $resep->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- Form Edit Obat -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Edit Daftar Obat</h3>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('reseps.update', $resep) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div id="obat-container">
                        @foreach($resep->obats as $index => $obat)
                            <div class="obat-item border border-gray-300 rounded-lg p-4 mb-4">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="font-medium text-gray-700">Obat {{ $index + 1 }}</h4>
                                    @if($loop->count > 1)
                                        <button type="button" onclick="removeObat(this)" 
                                                class="text-red-600 hover:text-red-800 text-sm">
                                            Hapus Obat
                                        </button>
                                    @endif
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Nama Obat <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="obat[{{ $index }}][nama_obat]" 
                                               value="{{ old('obat.'.$index.'.nama_obat', $obat->nama_obat) }}"
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                               required>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                                        <select name="obat[{{ $index }}][jenis]" 
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Jenis</option>
                                            <option value="Tablet" {{ old('obat.'.$index.'.jenis', $obat->jenis) == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                            <option value="Kapsul" {{ old('obat.'.$index.'.jenis', $obat->jenis) == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                                                                                        <option value="Salep" {{ old('obat.'.$index.'.jenis', $obat->jenis) == 'Salep' ? 'selected' : '' }}>Salep</option>
                                            <option value="Injeksi" {{ old('obat.'.$index.'.jenis', $obat->jenis) == 'Injeksi' ? 'selected' : '' }}>Injeksi</option>
                                            <option value="Lainnya" {{ old('obat.'.$index.'.jenis', $obat->jenis) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Quantity <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" 
                                               name="obat[{{ $index }}][quantity]" 
                                               value="{{ old('obat.'.$index.'.quantity', $obat->quantity) }}"
                                               min="1" max="999"
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                               required>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Dosis & Aturan</label>
                                        <input type="text" 
                                               name="obat[{{ $index }}][dosis]" 
                                               value="{{ old('obat.'.$index.'.dosis', $obat->dosis) }}"
                                               placeholder="3x1 sehari sesudah makan"
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Button Tambah Obat -->
                    <div class="mb-6">
                        <button type="button" onclick="addObat()" 
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            + Tambah Obat
                        </button>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-3">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                            Update Resep
                        </button>
                        <a href="{{ route('reseps.show', $resep) }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Dynamic Form -->
    <script>
        let obatIndex = {{ $resep->obats->count() }};

        function addObat() {
            const container = document.getElementById('obat-container');
            const newObatItem = document.createElement('div');
            newObatItem.className = 'obat-item border border-gray-300 rounded-lg p-4 mb-4';
            
            newObatItem.innerHTML = `
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-medium text-gray-700">Obat ${obatIndex + 1}</h4>
                    <button type="button" onclick="removeObat(this)" 
                            class="text-red-600 hover:text-red-800 text-sm">
                        Hapus Obat
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Obat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="obat[${obatIndex}][nama_obat]" 
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                        <select name="obat[${obatIndex}][jenis]" 
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Jenis</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Sirup">Sirup</option>
                            <option value="Salep">Salep</option>
                            <option value="Injeksi">Injeksi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="obat[${obatIndex}][quantity]" 
                               min="1" max="999" value="1"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dosis & Aturan</label>
                        <input type="text" 
                               name="obat[${obatIndex}][dosis]" 
                               placeholder="3x1 sehari sesudah makan"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            `;
            
            container.appendChild(newObatItem);
            obatIndex++;
        }

        function removeObat(button) {
            const obatItem = button.closest('.obat-item');
            const container = document.getElementById('obat-container');
            
            // Pastikan minimal ada 1 obat
            if (container.children.length > 1) {
                obatItem.remove();
                updateObatNumbers();
            } else {
                alert('Minimal harus ada 1 obat dalam resep.');
            }
        }

        function updateObatNumbers() {
            const obatItems = document.querySelectorAll('.obat-item');
            obatItems.forEach((item, index) => {
                const title = item.querySelector('h4');
                title.textContent = `Obat ${index + 1}`;
            });
        }
    </script>
</x-app-layout>

