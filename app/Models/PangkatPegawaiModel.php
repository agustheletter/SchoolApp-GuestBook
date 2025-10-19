<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PangkatPegawaiModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_pangkatpegawai";
    protected $primaryKey   = 'idpangkatpegawai';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = [
                                'idpangkatpegawai',
                                'idpegawai',
                                'idpangkat',
                                'nomorsk',
                                'masakerja_tahun',
                                'masakerja_bulan',
                                'tmtpangkat',
                                'angka_kredit',
                                'gaji_pokok',
                                'tgl_ttd',
                                'pejabat_ttd',
                            ];

    public function pangkat()
    {
        return $this->belongsTo(PangkatModel::class,'idpangkat');
    }

    public function pegawai()
    {
        return $this->belongsTo(PegawaiModel::class,'idpegawai');
    }
}
