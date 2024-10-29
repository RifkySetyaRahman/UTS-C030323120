<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gajis';

    // Daftar atribut yang boleh diisi
    protected $fillable = [
        'karyawan_id',
        'gaji_pokok',
        'tunjangan',
        'bonus',
        'potongan',
        'total_gaji',
        'bulan',
        'tahun',
    ];

    // Relasi ke model Karyawan (Many-to-One)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
