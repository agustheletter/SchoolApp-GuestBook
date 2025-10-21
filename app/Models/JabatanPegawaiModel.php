<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JabatanPegawaiModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_jabatanpegawai';
    protected $primaryKey = 'idjabatanpegawai';

    protected $fillable = [
        'idjabatanpegawai',
        'idpegawai',
        'idjabatan',
        'idthnajaran'
    ];

    /**
     * Relasi ke model Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(PegawaiModel::class, 'idpegawai', 'idpegawai');
    }

    /**
     * Relasi ke model Jabatan
     */
    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'idjabatan', 'idjabatan');
    }

    /**
     * Relasi ke model TahunAjaran (jika ada)
     */
    public function tahunAjaran()
    {
        // Sesuaikan dengan model TahunAjaran jika ada
        return $this->belongsTo(TahunAjaranModel::class, 'idthnajaran', 'idthnajaran');
    }
}
