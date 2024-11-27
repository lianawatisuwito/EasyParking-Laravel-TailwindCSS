<?php

namespace App\Exports;

use App\Models\ParkirMasuk;  // Sesuaikan dengan model Anda jika berbeda
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParkirExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ParkirMasuk::all(); // Mengambil semua data dari model ParkirMasuk
    }

    /**
     * Menentukan header kolom untuk file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No. Karcis',
            'Plat Nomor',
            'Jenis Kendaraan',
            'Tipe Mesin',
            'Warna',
            'Waktu Masuk',
            'Waktu Keluar',
            'Status',
        ];
    }
}
