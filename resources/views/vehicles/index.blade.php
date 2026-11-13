<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4">
    <h1 class="text-2xl font-bold mb-5">Tabel Kendaraan {{ config('app.name') }}</h1>
    <button onclick="toggle_modal()" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">+ Tambah Kendaraan</button>

    <table class="table-auto w-full mt-5">
        <thead>
            <tr class="bg-gray-300">
                <th class="border p-2">Nama Kendaraan</th>
                <th class="border p-2">Merk</th>
                <th class="border p-2">Jenis</th>
                <th class="border p-2">Tahun</th>
                <th class="border p-2">Harga</th>
                <th class="border p-2">Stok</th>
                <th class="border p-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vehicles as $vehicle)
                <tr>
                    <td class="border p-2">{{ $vehicle->nama_kendaraan }}</td>
                    <td class="border p-2">{{ $vehicle->merk }}</td>
                    <td class="border p-2">{{ $vehicle->jenis }}</td>
                    <td class="border p-2">{{ $vehicle->tahun }}</td>
                    <td class="border p-2">Rp. {{ number_format($vehicle->harga, 0, ',', '.') }}</td>
                    <td class="border p-2">{{ $vehicle->stok }}</td>
                    <td class="border p-2">{{ $vehicle->deskripsi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border p-2 text-center">Belum ada data kendaraan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div id="modal-tambah-kendaraan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-lg w-96 max-h-[90vh] overflow-y-auto">
            <h2 class="text-lg font-bold mb-4">Tambah Kendaraan Baru</h2>
            <form action="{{ route('vehicles.store') }}" method="post">
                @csrf
                <label for="nama_kendaraan" class="text-sm">Nama Kendaraan</label>
                <input type="text" name="nama_kendaraan" id="nama_kendaraan" class="w-full border p-2 mb-3 rounded" required>
                <label for="merk" class="text-sm">Merk</label>
                <input type="text" name="merk" id="merk" class="w-full border p-2 mb-3 rounded" required>
                <label for="jenis" class="text-sm">Jenis</label>
                <input type="text" name="jenis" id="jenis" class="w-full border p-2 mb-3 rounded" required>
                <label for="tahun" class="text-sm">Tahun</label>
                <input type="number" name="tahun" id="tahun" class="w-full border p-2 mb-3 rounded" required>
                <label for="harga" class="text-sm">Harga</label>
                <input type="number" name="harga" id="harga" class="w-full border p-2 mb-3 rounded" required>
                <label for="stok" class="text-sm">Stok</label>
                <input type="number" name="stok" id="stok" class="w-full border p-2 mb-3 rounded" required>
                <label for="deskripsi" class="text-sm">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full border p-2 mb-3 rounded" required></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggle_modal()" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggle_modal() {
            const modal = document.getElementById('modal-tambah-kendaraan');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</body>
</html>
