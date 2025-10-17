<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaranModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_thnajaran";
    protected $primaryKey   = 'idthnajaran';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = [
                                'idthnajaran',
                                'thnajaran',
                                'tglmulai',
                                'tglakhir',
                                'statusaktif'
                            ];

    public function siswa()
    {
        // return $this->hasMany('App\Models\SiswaModel','idsiswa','idthnajaran');
        return $this->hasMany('App\Models\SiswaModel','idthnajaran');
    }

    public function bayar()
    {
        return $this->hasMany('App\Models\BayarModel','idthnajaran');
    }

    public function jenisbayardetail()
    {
        return $this->hasMany('App\Models\JenisBayarDetailModel','idthnajaran');
    }

    public function kelasdetail()
    {
        return $this->hasMany('App\Models\KelasDetailModel','idthnajaran');
    }

    public function mengajar()
    {
        return $this->hasMany('App\Models\MengajarModel','idthnajaran');
    }




    // public function siswakelas()
    // {
    //     return $this->hasMany('App\Models\SiswaKelasModel','idthnajaran');
    // }

    // public function spp()
    // {
    //     return $this->hasMany('App\Models\SppModel','idbayar');
    // }
}
