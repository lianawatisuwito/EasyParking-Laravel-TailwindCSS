<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Data Parkir</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-100">
    <!-- Navbar Component -->
    <x-navbar></x-navbar>

    <!-- Page Header -->
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Data Parkir</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Export Button -->
        <div class="w-full mb-4">
            <a href="{{ route('export.parkir') }}"
                class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                Export to Excel
            </a>
        </div>

        <!-- Table -->
        <div class="w-full h-2/3 bg-white border rounded-lg p-4">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">
                            <button @click="sortBy = 'nomor_karcis'; sortDesc = !sortDesc">
                                No. Karcis
                            </button>
                        </th>
                        <th class="px-4 py-2 text-left">
                            <button @click="sortBy = 'plat_nomor'; sortDesc = !sortDesc">
                                Plat Nomor
                            </button>
                        </th>
                        <th class="px-4 py-2 text-left">
                            <button @click="sortBy = 'jenis_kendaraan'; sortDesc = !sortDesc">
                                Jenis Kendaraan
                            </button>
                        </th>
                        <th class="px-4 py-2 text-left">
                            <button @click="sortBy = 'status'; sortDesc = !sortDesc">
                                Status
                            </button>
                        </th>
                        <th class="border px-4 py-2 text-left">Tipe Mesin</th>
                        <th class="border px-4 py-2 text-left">Warna</th>
                        <th class="border px-4 py-2 text-left">Waktu Masuk</th>
                        <th class="border px-4 py-2 text-left">Waktu Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parkir as $data)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $data->nomor_karcis }}</td>
                            <td class="border px-4 py-2">{{ $data->plat_nomor }}</td>
                            <td class="border px-4 py-2">{{ $data->jenis_kendaraan }}</td>
                            <td class="border px-4 py-2">
                                <span
                                    class="px-2 py-1 rounded-full {{ $data->status == 'masuk' ? 'bg-blue-500' : 'bg-green-500' }} text-white">
                                    {{ $data->status }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">{{ $data->tipe_mesin }}</td>
                            <td class="border px-4 py-2">{{ $data->warna }}</td>
                            <td class="border px-4 py-2">
                                {{ \Carbon\Carbon::parse($data->waktu_masuk)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $data->waktu_keluar ? \Carbon\Carbon::parse($data->waktu_keluar)->format('d-m-Y H:i:s') : 'Belum Keluar' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>