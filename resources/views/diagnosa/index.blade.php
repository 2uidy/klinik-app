<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pemeriksaan Belum Didiagnosa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                @if($pemeriksaans->isEmpty())
                    <p>Tidak ada pemeriksaan yang menunggu diagnosa.</p>
                @else
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="text-left p-2">Nama Pasien</th>
                                <th class="text-left p-2">Keluhan</th>
                                <th class="text-left p-2">Diagnosa</th>
                                <th class="text-left p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemeriksaans as $pemeriksaan)
                                <tr class="border-b">
                                    <td class="p-2">{{ $pemeriksaan->pasien->nama }}</td>
                                    <td class="p-2">{{ $pemeriksaan->keluhan }}</td>
                                    <td class="p-2">{{ $pemeriksaan->diagnosa }}</td>
                                    <td class="p-2">
                                        <a href="{{ route('diagnosa.create', $pemeriksaan->id) }}"
                                           class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded">
                                            Isi Diagnosa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
