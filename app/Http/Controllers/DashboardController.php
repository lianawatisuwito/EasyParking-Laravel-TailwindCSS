<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkirMasuk; // Import model ParkirMasuk
use Illuminate\Support\Facades\DB; // Import untuk query langsung

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil kapasitas awal untuk mobil dan motor
        $mobilSlot = DB::table('parkir_slot')->where('jenis_kendaraan', 'mobil')->first();
        $motorSlot = DB::table('parkir_slot')->where('jenis_kendaraan', 'motor')->first();

        // Hitung total kendaraan masuk dan keluar untuk mobil
        $totalMobilMasuk = ParkirMasuk::where('jenis_kendaraan', 'mobil')->where('status', 'masuk')->count();
        $totalMobilKeluar = ParkirMasuk::where('jenis_kendaraan', 'mobil')->where('status', 'keluar')->count();

        // Hitung total kendaraan masuk dan keluar untuk motor
        $totalMotorMasuk = ParkirMasuk::where('jenis_kendaraan', 'motor')->where('status', 'masuk')->count();
        $totalMotorKeluar = ParkirMasuk::where('jenis_kendaraan', 'motor')->where('status', 'keluar')->count();

        // Hitung sisa slot untuk mobil dan motor
        $sisaMobil = $mobilSlot->kapasitas - $totalMobilMasuk + $totalMobilKeluar;
        $sisaMotor = $motorSlot->kapasitas - $totalMotorMasuk + $totalMotorKeluar;

        return view('dashboard', compact(
            'totalMobilMasuk',
            'totalMobilKeluar',
            'totalMotorMasuk',
            'totalMotorKeluar',
            'sisaMobil',
            'sisaMotor'
        ));
    }
}
