<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;

    protected $table = 'tbl_orangtua';

    protected $fillable = [
        'nama_ortu',
        'jenis_kelamin',
        'idsiswa',
        'kontak',
    ];

    public function siswa() {
        return $this->belongsTo(SiswaModel::class, 'idsiswa', 'idsiswa');
    }
}
