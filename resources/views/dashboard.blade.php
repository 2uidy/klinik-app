<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div>You're logged in!</div>

                @if (auth()->user()->role === 'perawat')
                    <a href="{{ route('pemeriksaan.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Buat Pemeriksaan
                    </a>
                @endif

                @if (auth()->user()->role === 'pendaftaran')
                    <a href="{{ route('pasien.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Pasien
                    </a>
                @endif

                @if (auth()->user()->role === 'dokter')
                    <a href="{{ route('diagnosa.index') }}"
                    class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded mt-4 inline-block">
                        Pemeriksaan Menunggu Diagnosa
                    </a>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>
