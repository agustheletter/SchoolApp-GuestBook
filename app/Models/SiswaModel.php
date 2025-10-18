<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_siswa";
    protected $primaryKey   = 'idsiswa';
    // protected $keyType      = 'string';
    public $incrementing    = false;

    protected $fillable     = [
                                    'idsiswa',
                                    'namasiswa',
                                    'nis',
                                    'nisn',
                                    'nik',
                                    'tmplahir',
                                    'tgllahir',
                                    'jk',
                                    'idagama',
                                    'photosiswa',
                                    'idthnmasuk',
                                    'asalsekolah',
                                    'jalan',
                                    'rt',
                                    'rw',
                                    'dusun',
                                    'desa',
                                    'kecamatan',
                                    'kabupaten',
                                    'kodepos',
                                    'tlprumah',
                                    'hpsiswa',
                                    'email',
                                    'jenistinggal',
                                    'kepemilikan',
                                    'transportasi',
                                    'jarak',
                                    'lintang',
                                    'bujur',
                                    'nomorkk',
                                    'nomoraktalahir',
                                    'anakke',
                                    'jumlahsaudara',
                                    'penerimakps',
                                    'nomorkps',
                                    'nomorun',
                                    'nomorijazah',
                                    'penerimakip',
                                    'nomorkip',
                                    'namakip',
                                    'nomorkks',
                                    'bank',
                                    'nomorrekening',
                                    'atasnamarekening',
                                    'layakpip',
                                    'alasanlayakpip',
                                    'abk',
                                    'beratbadan',
                                    'tinggibadan',
                                    'lingkarkepala',
                                ];



    public function agama()
    {
        return $this->belongsTo('App\Models\AgamaModel','idagama');
    }

    public function ortu()
    {
        return $this->hasOne(OrtuModel::class,'idsiswa');
    }

    public function thnajaran()
    {
        // return $this->belongsTo('App\Models\TahunAjaranModel','idthnmasuk');

        return $this->belongsTo(TahunAjaranModel::class, 'idthnmasuk', 'idthnajaran');
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
