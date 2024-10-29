<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    // Daftar atribut yang boleh diisi
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'status',
        'jam_masuk',
        'jam_keluar',
        'keterangan',
    ];

    // Relasi ke model Karyawan (Many-to-One)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
