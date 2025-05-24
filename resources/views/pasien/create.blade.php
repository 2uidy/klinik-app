<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('pasien.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block">Nama</label>
                        <input type="text" name="nama" class="border rounded w-full p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="border rounded w-full p-2">
                    </div>
                    <div class="mb-4">
                        <label class="block">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="border rounded w-full p-2">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block">Nomor HP</label>
                        <input type="text" name="no_hp" class="border rounded w-full p-2">
                    </div>
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
