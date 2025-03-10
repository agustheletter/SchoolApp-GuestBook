<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_siswa";
    protected $primaryKey   = 'idsiswa';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idsiswa','nis', 'nisn','namasiswa','tempatlahir','tgllahir','jk','alamat','idagama','tlprumah','hpsiswa','photosiswa','idthnmasuk'];

    public function agama()
    {
        return $this->belongsTo('App\Models\AgamaModel','idagama');
    }

    public function thnajaran()
    {
        return $this->belongsTo('App\Models\TahunAjaranModel','idthnmasuk');
    }

    public function siswakelas()
    {
        return $this->hasMany('App\Models\SiswaKelasModel','idsiswa');
    }

    public function bayar()
    {
        return $this->hasMany('App\Models\BayarModel','idsiswa');
    }

    // public function jenisbayardetail()
    // {
    //     return $this->hasMany('App\Models\JenisBayarDetailModel','idthnajaran');
    // }
}
