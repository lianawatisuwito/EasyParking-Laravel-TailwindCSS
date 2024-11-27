<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Karcis Parkir</title>
</head>

<body class="h-full bg-gray-100">
    <!-- Navbar Component -->
    <x-navbar></x-navbar>

    <!-- Page Header -->
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Karcis Parkir</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="mx-auto max-w-4xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Detail Karcis</h2>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Nomor Karcis</th>
                            <th class="border px-4 py-2">Waktu Masuk</th>
                            <th class="border px-4 py-2">Jenis Kendaraan</th>
                            <th class="border px-4 py-2">Tarif</th>
                            <th class="border px-4 py-2">Plat Nomor</th>
                            <th class="border px-4 py-2">Tipe Mesin</th>
                            <th class="border px-4 py-2">Warna</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">{{ $data->nomor_karcis }}</td>
                            <td class="border px-4 py-2">{{ $data->waktu_masuk }}</td>
                            <td class="border px-4 py-2">{{ $data->jenis_kendaraan }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($data->tarif, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2">{{ $data->plat_nomor }}</td>
                            <td class="border px-4 py-2">{{ $data->tipe_mesin }}</td>
                            <td class="border px-4 py-2">{{ $data->warna }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="window.print()">Print</button>
                    <a href="{{ route('parkir.masuk.index') }}"
                        class="bg-gray-300 text-black px-4 py-2 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>