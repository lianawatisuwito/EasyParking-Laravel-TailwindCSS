<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard</title>
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Custom color for blue */
        .bg-blue {
            background-color: #3B82F6;
        }

        /* Resize pie chart */
        .pie-chart {
            width: 300px;
            height: 300px;
        }
    </style>
</head>

<body class="h-full bg-gray-100">
    <!-- Navbar Component -->
    <x-navbar></x-navbar>

    <!-- Page Header -->
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mt-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-4">
                <!-- Div Kiri: Data Mobil -->
                <div class="bg-white rounded-lg shadow-md p-6 w-1/2">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <img src="/images/car-icon.svg" alt="Mobil Icon" class="h-8 w-8">
                        <h2 class="text-xl font-semibold text-center">Mobil</h2>
                    </div>

                    <div class="flex justify-between">
                        <!-- Kiri: Available -->
                        <div class="flex flex-col items-center w-1/3">
                            <div class="bg-blue-500 text-white text-xs font-semibold py-1 px-3 rounded-full mb-2">
                                Available
                            </div>
                            <h1 class="text-3xl font-bold">{{ $sisaMobil }}</h1>
                            <p class="text-gray-500 text-sm">Parkir Tersedia</p>
                        </div>

                        <!-- Tengah: In -->
                        <div class="flex flex-col items-center w-1/3">
                            <div class="bg-green-500 text-white text-xs font-semibold py-1 px-3 rounded-full mb-2">IN
                            </div>
                            <h1 class="text-3xl font-bold">{{ $totalMobilMasuk }}</h1>
                            <p class="text-gray-500 text-sm">Mobil Masuk</p>
                        </div>

                        <!-- Kanan: Out -->
                        <div class="flex flex-col items-center w-1/3">
                            <div class="bg-red-500 text-white text-xs font-semibold py-1 px-3 rounded-full mb-2">OUT
                            </div>
                            <h1 class="text-3xl font-bold">{{ $totalMobilKeluar }}</h1>
                            <p class="text-gray-500 text-sm">Mobil Keluar</p>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="flex justify-center mt-6">
                        <div class="pie-chart">
                            <canvas id="pieChartMobil"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Div Kanan: Data Motor -->
                <div class="bg-white rounded-lg shadow-md p-6 w-1/2">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <img src="/images/motor-icon.svg" alt="Motor Icon" class="h-8 w-8">
                        <h2 class="text-xl font-semibold text-center">Motor</h2>
                    </div>

                    <div class="flex justify-between">
                        <!-- Kiri: Available -->
                        <div class="flex flex-col items-center w-1/3">
                            <div class="bg-blue-500 text-white text-xs font-semibold py-1 px-3 rounded-full mb-2">
                                Available
                            </div>
                            <h1 class="text-3xl font-bold">{{ $sisaMotor }}</h1>
                            <p class="text-gray-500 text-sm">Parkir Tersedia</p>
                        </div>

                        <!-- Tengah: In -->
                        <div class="flex flex-col items-center w-1/3">
                            <div class="bg-green-500 text-white text-xs font-semibold py-1 px-3 rounded-full mb-2">IN
                            </div>
                            <h1 class="text-3xl font-bold">{{ $totalMotorMasuk }}</h1>
                            <p class="text-gray-500 text-sm">Motor Masuk</p>
                        </div>

                        <!-- Kanan: Out -->
                        <div class="flex flex-col items-center w-1/3">
                            <div class="bg-red-500 text-white text-xs font-semibold py-1 px-3 rounded-full mb-2">OUT
                            </div>
                            <h1 class="text-3xl font-bold">{{ $totalMotorKeluar }}</h1>
                            <p class="text-gray-500 text-sm">Motor Keluar</p>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="flex justify-center mt-6">
                        <div class="pie-chart">
                            <canvas id="pieChartMotor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie chart for Mobil
        const ctxMobil = document.getElementById('pieChartMobil').getContext('2d');
        new Chart(ctxMobil, {
            type: 'pie',
            data: {
                labels: ['Parkir Tersedia', 'Parkir Masuk'],
                datasets: [{
                    label: 'Mobil Parkir',
                    data: [{{ $sisaMobil }}, {{ $totalMobilMasuk }}],
                    backgroundColor: ['#3B82F6', '#FB923C'], // Blue and Orange
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Pie chart for Motor
        const ctxMotor = document.getElementById('pieChartMotor').getContext('2d');
        new Chart(ctxMotor, {
            type: 'pie',
            data: {
                labels: ['Parkir Tersedia', 'Parkir Masuk'],
                datasets: [{
                    label: 'Motor Parkir',
                    data: [{{ $sisaMotor }}, {{ $totalMotorMasuk }}],
                    backgroundColor: ['#3B82F6', '#FB923C'], // Blue and Orange
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</body>

</html>