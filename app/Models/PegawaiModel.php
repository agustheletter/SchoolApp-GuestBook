<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_pegawai';

    /**
     * Primary key dari tabel.
     */
    protected $primaryKey = 'idpegawai';

    /**
     * PENTING: Beri tahu Laravel bahwa primary key ini BUKAN auto-increment.
     */
    public $incrementing = false;

    /**
     * Kolom yang boleh diisi secara massal saat sinkronisasi.
     * Pastikan semua kolom dari migration ada di sini.
     */
    protected $fillable = [
        'idpegawai', 'nip', 'nuptk', 'rekening', 'npwp', 'nik',
        'gelardepan', 'gelarbelakang', 'namapegawai', 'tmplahir', 'tgllahir',
        'jk', 'statuskepegawaian', 'kategorikepegawaian', 'idagama',
        'golongan_darah', 'karpeg', 'askes', 'taspen', 'karis', 'jalan',
        'rt', 'rw', 'dusun', 'desa', 'kecamatan', 'kabupaten', 'kodepos',
        'tlprumah', 'hppegawai', 'email', 'namaibu', 'statusperkawinan',
        'namapasangan', 'pekerjaanpasangan', 'nippasangan', 'jml_anak',
        'photopegawai', 'statusaktif'
    ];

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'id_jabatan', 'id');
    }

    public function agama()
    {
        return $this->belongsTo(AgamaModel::class, 'id_agama', 'idagama');
    }

    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'id_pegawai', 'id');
    }
}
