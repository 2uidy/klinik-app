<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Semua Resep
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
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

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">
                        Total: {{ $reseps->total() }} Resep
                    </h3>
                    <div class="flex gap-3">
                        <a href="{{ route('inputobat.index') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            Input Resep Baru
                        </a>
                        <a href="{{ route('dashboard') }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            Dashboard
                        </a>
                    </div>
                </div>

                @if($reseps->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="text-left p-3 font-medium text-gray-700">No</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Nomor Resep</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Nama Pasien</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Diagnosa</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Jumlah Obat</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Tanggal</th>
                                    <th class="text-left p-3 font-medium text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reseps as $index => $resep)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="p-3">{{ $reseps->firstItem() + $index }}</td>
                                        <td class="p-3">
                                            <span class="font-medium text-blue-600">
                                                {{ $resep->nomor_resep ?? 'Tidak ada nomor' }}
                                            </span>
                                        </td>
                                        <td class="p-3">
                                            <div>
                                                <div class="font-medium text-gray-900">
                                                    {{ $resep->pasien->nama ?? 'Data pasien tidak ditemukan' }}
                                                </div>
                                                @if($resep->pasien)
                                                    <div class="text-sm text-gray-500">
                                                        {{ $resep->pasien->jenis_kelamin ?? '' }}
                                                        @if($resep->pasien->tanggal_lahir)
                                                            - {{ \Carbon\Carbon::parse($resep->pasien->tanggal_lahir)->age }} tahun
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="p-3">
                                            <div class="text-sm">
                                                {{ Str::limit($resep->pemeriksaan->diagnosa ?? 'Tidak ada diagnosa', 50) }}
                                            </div>
                                        </td>
                                        <td class="p-3">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">
                                                {{ $resep->obats->count() }} obat
                                            </span>
                                            @if($resep->obats->sum('quantity') > 0)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Total: {{ $resep->obats->sum('quantity') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            <div class="text-sm text-gray-900">
                                                {{ $resep->created_at ? $resep->created_at->format('d M Y') : '-' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $resep->created_at ? $resep->created_at->format('H:i') : '' }} WIB
                                            </div>
                                        </td>
                                        <td class="p-3">
                                            <div class="flex flex-col gap-1">
                                                <!-- Detail -->
                                                <a href="{{ route('reseps.show', $resep) }}" 
                                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200 text-center">
                                                    Detail
                                                </a>
                                                
                                                <!-- Edit -->
                                                <a href="{{ route('reseps.edit', $resep) }}" 
                                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-200 text-center">
                                                    Edit
                                                </a>
                                                
                                                <!-- Delete -->
                                                <form action="{{ route('reseps.destroy', $resep) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus resep {{ $resep->nomor_resep }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $reseps->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada resep</h3>
                        <p class="text-gray-500 mb-4">Mulai dengan membuat resep pertama untuk pasien.</p>
                        <a href="{{ route('inputobat.index') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                            Buat Resep Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
