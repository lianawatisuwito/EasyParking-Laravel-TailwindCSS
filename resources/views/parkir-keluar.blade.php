<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Parkir Keluar</title>
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
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Parkir Keluar</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex flex-col space-y-4">
                <!-- Div Atas -->
                <div class="w-full h-1/3 bg-white border rounded-lg p-4">
                    <h2 class="text-xl font-semibold mb-2">Input Nomor Karcis</h2>
                    <form action="{{ route('parkir.keluar.proses') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nomor_karcis" class="block text-sm font-medium text-gray-700">
                                Nomor Karcis
                            </label>
                            <input type="text" name="nomor_karcis" id="nomor_karcis"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Proses
                        </button>
                    </form>
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                            <strong>Error!</strong>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Div Bawah -->
                <div class="w-full h-2/3 bg-white border rounded-lg p-4">
                    <h2 class="text-xl font-semibold mb-2">Preview</h2>
                    @if(isset($parkirKeluar) && $parkirKeluar->isNotEmpty())
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border px-4 py-2">Nomor Karcis</th>
                                    <th class="border px-4 py-2">Plat Nomor</th>
                                    <th class="border px-4 py-2">Jenis Kendaraan</th>
                                    <th class="border px-4 py-2">Waktu Masuk</th>
                                    <th class="border px-4 py-2">Waktu Keluar</th>
                                    <th class="border px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkirKeluar as $parkir)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $parkir->nomor_karcis }}</td>
                                        <td class="border px-4 py-2">{{ $parkir->plat_nomor }}</td>
                                        <td class="border px-4 py-2">{{ $parkir->jenis_kendaraan }}</td>
                                        <td class="border px-4 py-2">{{ $parkir->waktu_masuk }}</td>
                                        <td class="border px-4 py-2">{{ $parkir->waktu_keluar }}</td>
                                        <td class="border px-4 py-2">
                                            <span class="px-2 py-1 rounded-full text-white bg-green-500">
                                                {{ $parkir->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Belum ada kendaraan yang keluar.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>

</body>

</html>