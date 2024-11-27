<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirMasuk extends Model
{
    use HasFactory;

    protected $table = 'parkir';

    protected $fillable = [
        'nomor_karcis',
        'plat_nomor',
        'jenis_kendaraan',
        'tipe_mesin',
        'warna',
        'waktu_masuk',
        'tarif',
        'waktu_keluar',
        'status',
    ];

    public $timestamps = true;

    // Tentukan bahwa primary key adalah nomor_karcis
    protected $primaryKey = 'nomor_karcis';
    public $incrementing = false; // Jika nomor_karcis bukan auto-increment
    protected $keyType = 'string'; // Karena nomor_karcis adalah varcha
}

