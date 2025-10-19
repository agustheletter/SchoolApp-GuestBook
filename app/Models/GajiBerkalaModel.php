<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GajiBerkalaModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_gajiberkala";
    protected $primaryKey   = 'idgajiberkala';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = [
                                'idgajiberkala',
                                'idpegawai',
                                'nomorsk',
                                'masakerja_tahun',
                                'masakerja_bulan',
                                'tmtgajiberkala',
                                'gaji_pokok_lama',
                                'gaji_pokok_baru',
                                'tgl_ttd_sk',
                                'pejabat_ttd',
                            ];


    public function pegawai()
    {
        return $this->belongsTo(PegawaiModel::class,'idpegawai');
    }
}
