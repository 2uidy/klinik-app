<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">Selamat Datang, {{ auth()->user()->name }}!</div>

                @if (auth()->user()->role === 'perawat')
                    <a href="{{ route('pemeriksaan.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
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
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Pemeriksaan Menunggu Diagnosa
                    </a>
                @endif

                @if (auth()->user()->role === 'apoteker')
                    <div class="flex flex-wrap gap-3">
                       Selamat Datang, {{ auth()->user()->name }}!<br>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
