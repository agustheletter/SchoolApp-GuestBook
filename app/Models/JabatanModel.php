<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_jabatan';
    protected $primaryKey = 'idjabatan'; // Primary key adalah idjabatan
    protected $fillable = ['idjabatan', 'jabatan'];
    public $incrementing    = false;

    // Relasi ke tabel pivot jabatan_pegawai
    public function jabatanPegawai()
    {
        return $this->hasMany(JabatanPegawaiModel::class, 'idjabatan', 'idjabatan');
    }

    // Relasi ke pegawai melalui pivot
    public function pegawai()
    {
        return $this->belongsToMany(
            PegawaiModel::class,
            'tbl_jabatanpegawai', // tabel pivot
            'idjabatan',          // foreign key di pivot yang merujuk ke jabatan
            'idpegawai',          // foreign key di pivot yang merujuk ke pegawai
            'idjabatan',          // local key di tabel jabatan (primary key)
            'idpegawai'           // local key di tabel pegawai
        );
    }

    // Jangan ubah function yang sudah ada
    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'idjabatan', 'idjabatan');
    }
}
