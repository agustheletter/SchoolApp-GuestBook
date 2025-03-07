<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_jabatan';
    protected $fillable = ['nama_jabatan'];

    public function pegawai()
    {
        return $this->hasMany(PegawaiModel::class, 'id_jabatan', 'id');
    }

    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'id_jabatan', 'id');
    }
}
