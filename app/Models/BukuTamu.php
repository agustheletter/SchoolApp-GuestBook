<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuTamu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_bukutamu';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama', 'role', 'jenis_kelamin', 'idagama', 'idsiswa', 'instansi',
        'alamat', 'kontak', 'id_jabatan', 'id_pegawai', 'keperluan'
    ];

    public function agama()
    {
        return $this->belongsTo(AgamaModel::class, 'idagama', 'idagama');
    }

    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class, 'idsiswa', 'idsiswa');
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'id_jabatan', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(PegawaiModel::class, 'id_pegawai', 'id');
    }
}
