<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Diagnosa Pasien
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <form action="{{ route('diagnosa.store', $pemeriksaan->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium">Keluhan:</label>
                         <textarea name="keluhan" rows="4" class="w-full border rounded p-2"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="diagnosa" class="block font-medium">Diagnosa:</label>
                        <textarea name="diagnosa" rows="4" class="w-full border rounded p-2"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Diagnosa</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
