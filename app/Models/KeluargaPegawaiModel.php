<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeluargaPegawaiModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_keluargapegawai";
    protected $primaryKey   = 'idkeluargapegawai';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = [
                                'idkeluargapegawai',
                                'idpegawai',
                                'nama_anggota_keluarga',
                                'tmp_lahir',
                                'tgl_lahir',
                                'jk',
                                'pendidikan',
                                'nama_sekolah',
                            ];


    public function pegawai()
    {
        return $this->belongsTo(PegawaiModel::class,'idpegawai');
    }
}
