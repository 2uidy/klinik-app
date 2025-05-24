<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Tanggal Lahir</th>
                            <th class="px-4 py-2 border">Jenis Kelamin</th>
                            <th class="px-4 py-2 border">No HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $pasien)
                            <tr>
                                <td class="border px-4 py-2">{{ $pasien->nama }}</td>
                                <td class="border px-4 py-2">{{ $pasien->tanggal_lahir }}</td>
                                <td class="border px-4 py-2">{{ $pasien->jenis_kelamin }}</td>
                                <td class="border px-4 py-2">{{ $pasien->no_hp }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
