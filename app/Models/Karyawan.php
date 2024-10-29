<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';

    // Daftar atribut yang boleh diisi
    protected $fillable = [
        'nama',
        'email',
        'posisi',
        'alamat',
        'telepon',
        'tanggal_masuk',
        'tanggal_lahir',
    ];

    // Relasi ke model Gaji (One-to-Many)
    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }

    // Relasi ke model Absensi (One-to-Many)
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
