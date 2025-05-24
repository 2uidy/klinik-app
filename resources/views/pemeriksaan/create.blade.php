<form action="{{ route('pemeriksaan.store') }}" method="POST">
    @csrf

    <label>Pasien:</label>
    <select name="pasien_id">
        @foreach ($pasiens as $pasien)
            <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
        @endforeach
    </select>

    <label>Berat Badan (kg):</label>
    <input type="number" step="0.1" name="berat_badan" required>

    <label>Tekanan Darah:</label>
    <input type="text" name="tekanan_darah" required>

    <button type="submit">Simpan Pemeriksaan</button>
</form>
