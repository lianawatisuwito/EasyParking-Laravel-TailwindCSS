<?php
namespace App\Http\Controllers;

use App\Models\ParkirMasuk;
use Illuminate\Http\Request;

class ParkirKeluarController extends Controller
{
    // Menampilkan data parkir keluar (untuk halaman parkir keluar)
    public function index()
    {
        // Ambil semua data parkir yang statusnya 'keluar'
        $parkirKeluar = ParkirMasuk::where('status', 'keluar')->get();

        // Kirim data ke view parkir-keluar
        return view('parkir-keluar', compact('parkirKeluar'));
    }

    // Proses untuk parkir keluar (update status dan waktu keluar)
    public function proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_karcis' => 'required|string|exists:parkir,nomor_karcis', // pastikan nama tabelnya benar
        ]);

        // Ambil data berdasarkan nomor karcis
        $parkir = ParkirMasuk::where('nomor_karcis', $request->nomor_karcis)->first();

        if (!$parkir) {
            return redirect()->back()->withErrors(['nomor_karcis' => 'Nomor karcis tidak ditemukan']);
        }

        // Update waktu keluar dan status
        $parkir->waktu_keluar = now();
        $parkir->status = 'keluar';
        $parkir->save();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('parkir.keluar')->with('success', 'Parkir keluar berhasil diproses.');
    }

    // Menampilkan data parkir masuk dan keluar secara keseluruhan (untuk halaman dataparkir)
    public function dataparkir()
    {
        // Ambil data parkir dengan status 'masuk' dan 'keluar'
        $parkir = ParkirMasuk::whereIn('status', ['masuk', 'keluar'])->get();

        // Kirim data ke view dataparkir
        return view('dataparkir', compact('parkir'));
    }

}
