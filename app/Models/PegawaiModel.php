<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_pegawai';
    protected $fillable = ['nama_pegawai', 'id_jabatan', 'kontak'];

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'id_jabatan', 'id');
    }

    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'id_pegawai', 'id');
    }
}
