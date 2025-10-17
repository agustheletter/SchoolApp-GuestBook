<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrtuModel  extends Model
{
    use HasFactory;

    protected $table = 'tbl_ortu';
    protected $primaryKey   = 'idortu';

    // protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     =   [
                                    'idortu',
                                    'idsiswa',

                                    //ayah
                                    'nama_ayah',
                                    'tgllahir_ayah',
                                    'pendidikan_ayah',
                                    'pekerjaan_ayah',
                                    'penghasilan_ayah',
                                    'nik_ayah',
                                    'hp_ayah',
                                    'alamat_ayah',

                                    //ibu
                                    'nama_ibu',
                                    'tgllahir_ibu',
                                    'pendidikan_ibu',
                                    'pekerjaan_ibu',
                                    'penghasilan_ibu',
                                    'nik_ibu',
                                    'hp_ibu',
                                    'alamat_ibu',

                                    //wali
                                    'nama_wali',
                                    'tgllahir_wali',
                                    'pendidikan_wali',
                                    'pekerjaan_wali',
                                    'penghasilan_wali',
                                    'nik_wali',
                                    'hp_wali',
                                    'alamat_wali',
                                ];

    public function siswa() {
        return $this->belongsTo(SiswaModel::class, 'idsiswa', 'idsiswa');
    }
}
