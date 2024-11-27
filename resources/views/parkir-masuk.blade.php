<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-qrcode/1.0/jquery.qrcode.min.js"></script>
    <title>Parkir Masuk</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-100">
    <x-navbar></x-navbar>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Parkir Masuk</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex">
                <!-- Left Side -->
                <div class="w-1/2 pr-4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Input Kendaraan Masuk Parkir</h2>
                        <form id="parkirForm">
                            @csrf
                            <table class="min-w-full bg-white border border-gray-300">
                                <tbody>
                                    <tr>
                                        <td class="border px-4 py-2">Nomor Karcis</td>
                                        <td class="border px-4 py-2">
                                            <input type="text" name="nomor_karcis" class="border rounded w-full"
                                                value="{{ uniqid('karcis_') }}" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2">Waktu Masuk</td>
                                        <td class="border px-4 py-2">
                                            <span id="waktuMasukPrint"></span>
                                            <input type="hidden" name="waktu_masuk">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="border px-4 py-2">Jenis Kendaraan</td>
                                        <td class="border px-4 py-2">
                                            <select name="jenis_kendaraan" class="border rounded" required
                                                onchange="updateTarif()">
                                                <option value="mobil">Mobil</option>
                                                <option value="motor">Motor</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2">Tarif</td>
                                        <td class="border px-4 py-2">
                                            <input type="number" name="tarif" id="tarif" class="border rounded w-full"
                                                value="5000" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2">Plat Nomor</td>
                                        <td class="border px-4 py-2">
                                            <input type="text" name="plat_nomor" class="border rounded w-full"
                                                required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2">Tipe/Mesin</td>
                                        <td class="border px-4 py-2">
                                            <select name="tipe_mesin" class="border rounded" required>
                                                <option value="toyota">Toyota</option>
                                                <option value="suzuki">Suzuki</option>
                                                <option value="daihatsu">Daihatsu</option>
                                                <option value="honda">Honda</option>
                                                <option value="yamaha">Yamaha</option>
                                                <option value="wuiling">Wuiling</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2">Warna</td>
                                        <td class="border px-4 py-2">
                                            <select name="warna" class="border rounded" required>
                                                <option value="merah">Merah</option>
                                                <option value="hitam">Hitam</option>
                                                <option value="kuning">Kuning</option>
                                                <option value="putih">Putih</option>
                                                <option value="silver">Silver</option>
                                                <option value="biru">Biru</option>
                                                <option value="warna_lain">Warna Lain</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
                                <button type="button" id="saveButton"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                                <button type="reset" class="bg-red-500 text-white px-4 py-2 rounded">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="w-1/2 pl-4">
                    <div class="bg-white rounded-lg shadow-md p-6" id="printable">
                        <p class="text-xl font-semibold mb-4">Struk Parkir</p>
                        <p>Nomor Karcis: <span id="nomorKarcisStruk">{{ uniqid('karcis_') }}</span></p>
                        <p>Waktu Masuk: <span id="waktuMasukPrint">{{ now() }}</span></p>
                        <p>Jenis Kendaraan: <span id="jenisKendaraanStruk"></span></p>
                        <p>Tarif: <span id="tarifStruk"></span></p>
                        <div id="qrcode" style="margin-top: 10px;"></div>
                        <button onclick="printDiv('printable')"
                            class="bg-green-500 text-white px-4 py-2 rounded mt-4">Print</button>
                    </div>
                </div>
            </div>
            <!-- New Preview Table -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-4">
                <h2 class="text-xl font-semibold mb-4">Daftar Kendaraan Masuk</h2>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-200 border-b border-gray-300">
                        <tr>
                            <th class="border px-4 py-2">Nomor Karcis</th>
                            <th class="border px-4 py-2">Plat Nomor</th>
                            <th class="border px-4 py-2">Jenis Kendaraan</th>
                            <th class="border px-4 py-2">Waktu Masuk</th>
                            <th class="border px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataMasuk as $data)
                            <tr>
                                <td class="border px-4 py-2">{{ $data->nomor_karcis }}</td>
                                <td class="border px-4 py-2">{{ $data->plat_nomor }}</td>
                                <td class="border px-4 py-2">{{ $data->jenis_kendaraan }}</td>
                                <td class="border px-4 py-2">{{ $data->waktu_masuk }}</td>
                                <td class="border px-4 py-2">
                                    <span
                                        class="px-2 py-1 rounded-full text-white 
                                                                                        {{ $data->status == 'masuk' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ ucfirst($data->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pop-Up Success -->
        <div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md">
                <h2 class="text-xl font-semibold mb-4">Data Berhasil Disimpan</h2>
                <p>Data kendaraan masuk telah berhasil disimpan!</p>
                <button onclick="closePopup()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>

    </main>
    <script>
        function printDiv(divId) {
            const printContents = document.getElementById(divId).innerHTML;
            const originalContents = document.body.innerHTML;

            // Ganti konten body dengan konten yang ingin dicetak
            document.body.innerHTML = printContents;

            // Jalankan perintah cetak
            window.print();

            // Kembalikan konten asli halaman
            document.body.innerHTML = originalContents;
        }

        function updateWaktuMasuk() {
            const now = new Date();
            const formattedTime = now.toLocaleString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('waktuMasukPrint').textContent = formattedTime;
            document.querySelector('input[name="waktu_masuk"]').value = formattedTime;
        }

        $(document).ready(function () {
            updateWaktuMasuk();
        });

        function updateTarif() {
            const jenisKendaraan = document.querySelector('select[name="jenis_kendaraan"]').value;
            document.getElementById('tarif').value = jenisKendaraan === 'mobil' ? 5000 : 2000;
        }

        $(document).ready(function () {
            $('#saveButton').click(function (e) {
                e.preventDefault();
                const formData = $('#parkirForm').serialize();

                $.ajax({
                    url: '{{ route('parkir.masuk.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            // Update the printable section with the response data
                            $('#printable').html(`
                            <p class="text-xl font-semibold mb-4">Struk Parkir</p>
                            <p>Nomor Karcis: <span>${response.data.nomor_karcis}</span></p>
                            <p>Waktu Masuk: <span>${response.data.waktu_masuk}</span></p>
                            <p>Jenis Kendaraan: <span>${response.data.jenis_kendaraan}</span></p>
                            <p>Tarif: <span>Rp ${response.data.tarif}</span></p>
                            <div id="qrcode"></div>
                            <button onclick="printDiv('printable')" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Print</button>
                        `);
                            $('#qrcode').empty();
                            $('#qrcode').qrcode(response.data.nomor_karcis);

                            // Show the success popup message
                            showPopup('Data berhasil disimpan');
                        } else {
                            alert('Gagal menyimpan data.');
                        }
                    },
                    error: function () {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        });

        // Function to show the success popup
        function showPopup(message) {
            const popup = document.createElement('div');
            popup.className = 'fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50';
            popup.innerHTML = `
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <p class="text-lg font-semibold">${message}</p>
                <button onclick="closePopup()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        `;
            document.body.appendChild(popup);
        }

        // Function to close the popup
        function closePopup() {
            const popup = document.querySelector('.fixed');
            if (popup) {
                popup.remove();
            }
        }
    </script>

</body>

</html>