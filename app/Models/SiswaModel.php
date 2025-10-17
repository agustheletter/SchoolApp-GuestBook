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

    /**
     * PENTING: Beri tahu Laravel bahwa primary key ini BUKAN auto-increment.
     */
    public $incrementing = false;

    /**
     * Kolom yang boleh diisi secara massal saat sinkronisasi.
     * Pastikan semua kolom dari migration ada di sini.
     */
    protected $fillable = [
        'idsiswa', 'namasiswa', 'nis', 'nisn', 'nik', 'tmplahir', 'tgllahir',
        'jk', 'idagama', 'photosiswa', 'idthnmasuk', 'asalsekolah', 'jalan',
        'rt', 'rw', 'dusun', 'desa', 'kecamatan', 'kabupaten', 'kodepos',
        'tlprumah', 'hpsiswa', 'email', 'jenistinggal', 'kepemilikan',
        'transportasi', 'jarak', 'lintang', 'bujur', 'nomorkk',
        'nomoraktalahir', 'anakke', 'jumlahsaudara', 'penerimakps',
        'nomorkps', 'nomorun', 'nomorijazah', 'penerimakip', 'nomorkip',
        'namakip', 'nomorkks', 'bank', 'nomorrekening', 'atasnamarekening',
        'layakpip', 'alasanlayakpip', 'abk', 'beratbadan', 'tinggibadan',
        'lingkarkepala'
    ];

    public function agama()
    {
        return $this->belongsTo('App\Models\AgamaModel','idagama');
    }

    public function tahunAjaranMasuk()
    {
        return $this->belongsTo(TahunAjaranModel::class, 'idthnmasuk', 'idthnajaran');
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
