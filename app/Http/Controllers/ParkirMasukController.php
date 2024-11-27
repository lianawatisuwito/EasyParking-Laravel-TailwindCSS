<?php

namespace App\Http\Controllers;

use App\Models\ParkirMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  // Tambahkan ini untuk menggunakan DB query builder

class ParkirMasukController extends Controller
{
    /**
     * Menyimpan data parkir masuk
     */
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'jenis_kendaraan' => 'required|in:mobil,motor',
            'plat_nomor' => 'required|string',
            'tipe_mesin' => 'required|string',
            'warna' => 'required|string',
        ]);

        // Tentukan tarif berdasarkan jenis kendaraan
        $tarif = $request->jenis_kendaraan === 'motor' ? 2000 : 5000;

        // Simpan data parkir masuk
        $parkirMasuk = new ParkirMasuk();
        $parkirMasuk->nomor_karcis = uniqid('karcis_');
        $parkirMasuk->jenis_kendaraan = $request->jenis_kendaraan;
        $parkirMasuk->plat_nomor = $request->plat_nomor;
        $parkirMasuk->tipe_mesin = $request->tipe_mesin;
        $parkirMasuk->warna = $request->warna;
        $parkirMasuk->tarif = $tarif;
        $parkirMasuk->waktu_masuk = now();

        $parkirMasuk->save();

        // Mengembalikan data yang baru disimpan sebagai respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data parkir berhasil disimpan.',
            'data' => [
                'nomor_karcis' => $parkirMasuk->nomor_karcis,
                'jenis_kendaraan' => $parkirMasuk->jenis_kendaraan,
                'tarif' => $parkirMasuk->tarif,
                'waktu_masuk' => $parkirMasuk->waktu_masuk->format('d-m-Y H:i:s'),
            ],
        ]);
    }

    /**
     * Memperbarui waktu keluar
     */
    public function updateWaktuKeluar($nomor_karcis)
    {
        $parkirMasuk = ParkirMasuk::where('nomor_karcis', $nomor_karcis)->firstOrFail();
        $parkirMasuk->waktu_keluar = now(); // Menetapkan waktu keluar saat ini
        $parkirMasuk->save();

        return redirect()->route('parkir.masuk.index')->with('success', 'Waktu keluar berhasil diperbarui.');
    }

    /**
     * Menampilkan semua data parkir masuk
     */
    public function index()
    {
        // Ambil data kendaraan dengan status 'masuk'
        $dataMasuk = ParkirMasuk::where('status', 'masuk')->get();

        // Kirimkan data ke view
        return view('parkir-masuk', compact('dataMasuk'));
    }

    /**
     * Menampilkan detail data parkir berdasarkan nomor karcis
     */
    public function show($nomorKarcis)
    {
        // Fetch the data from the database based on the nomor_karcis
        $data = ParkirMasuk::where('nomor_karcis', $nomorKarcis)->firstOrFail();

        // Pass the data to the view
        return view('karcis', compact('data'));

    }

}
