<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelasDetailModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_kelasdetail";
    protected $primaryKey   = 'idkelasdetail';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = [
                                'idkelasdetail',
                                'idkelas',
                                'idthnajaran',
                                'idpegawai',
                                'idruangan'
                            ];

    //relasi ke kelas
    public function kelas()
    {
        return $this->belongsTo('App\Models\KelasModel', 'idkelas');
        //return $this->belongsTo(JurusanModel::class, 'idjurusan');
    }

    //relasi ke tahun ajaran
    public function thnajaran()
    {
        return $this->belongsTo('App\Models\TahunAjaranModel','idthnajaran');
    }

    //relasi ke pegawai
    public function pegawai()
    {
        return $this->belongsTo('App\Models\PegawaiModel','idpegawai');
    }

    //relasi ke ruang
    public function ruangan()
    {
        return $this->belongsTo('App\Models\RuanganModel','idruangan');
    }

    // //relasi ke siswa kelas
    // public function siswakelas()
    // {
    //     return $this->hasMany('App\Models\SiswaKelasModel','idkelasdetail');
    // }
}
