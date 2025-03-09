<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_pegawai';
    protected $fillable = ['nama_pegawai', 'jenis_kelamin', 'id_jabatan', 'id_agama', 'kontak'];

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'id_jabatan', 'id');
    }

    public function agama()
    {
        return $this->belongsTo(AgamaModel::class, 'id_agama', 'idagama');
    }

    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'id_pegawai', 'id');
    }
}
