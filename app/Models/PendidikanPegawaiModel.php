<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendidikanPegawaiModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_pendidikanpegawai";
    protected $primaryKey   = 'idpendidikanpegawai';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = [
                                'idpendidikanpegawai',
                                'idpegawai',
                                'pendidikan',
                                'nama_sekolah',
                                'jurusan',
                                'kota_sekolah',
                                'nama_ttd_ijazah',
                                'nomor_ijazah',
                                'tgl_ijazah',
                            ];


    public function pegawai()
    {
        return $this->belongsTo(PegawaiModel::class,'idpegawai');
    }
}
