<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PegawaiModel extends Model
{
    use HasFactory;

    protected $table        = "tbl_pegawai";
    protected $primaryKey   = 'idpegawai';
    protected $keyType      = 'string';
    public $incrementing    = false;

    protected $fillable     = [
        'idpegawai',
        'nip',
        'nuptk',
        'rekening',
        'npwp',
        'nik',
        'gelardepan',
        'gelarbelakang',
        'namapegawai',
        'tmplahir',
        'tgllahir',
        'jk',
        'statuskepegawaian',
        'kategorikepegawaian',
        'idagama',
        'golongan_darah',
        'karpeg',
        'askes',
        'taspen',
        'karis',

        'jalan',
        'rt',
        'rw',
        'dusun',
        'desa',
        'kecamatan',
        'kabupaten',
        'kodepos',
        'tlprumah',
        'hppegawai',
        'email',
        'namaibu',
        'statusperkawinan',
        'namapasangan',
        'pekerjaanpasangan',
        'nippasangan',
        'jml_anak',
        'photopegawai',
        'statusaktif',
    ];

    // ================= RELASI =================

    // Agama
    public function agama()
    {
        return $this->belongsTo(AgamaModel::class, 'idagama');
    }

    // Detail kelas (jika ada)
    public function kelasdetail()
    {
        return $this->hasMany(KelasDetailModel::class, 'idpegawai', 'idpegawai');
    }

    // Mengajar (jika ada)
    public function mengajar()
    {
        return $this->hasMany(MengajarModel::class, 'idpegawai', 'idpegawai');
    }

    // Pangkat Pegawai
    public function pangkatpegawai()
    {
        return $this->hasMany(PangkatPegawaiModel::class, 'idpegawai', 'idpegawai');
    }

    // Gaji Berkala
    public function gajiberkala()
    {
        return $this->hasMany(GajiBerkalaModel::class, 'idpegawai', 'idpegawai');
    }

    // Pendidikan Pegawai
    public function pendidikanpegawai()
    {
        return $this->hasMany(PendidikanPegawaiModel::class, 'idpegawai', 'idpegawai');
    }

    // Keluarga Pegawai
    public function keluargapegawai()
    {
        return $this->hasMany(KeluargaPegawaiModel::class, 'idpegawai', 'idpegawai');
    }

    // Relasi Many-to-Many dengan Jabatan melalui tabel pivot
    public function jabatanPegawai()
    {
        return $this->hasMany(JabatanPegawaiModel::class, 'idpegawai', 'idpegawai');
    }

    // Relasi ke jabatan melalui pivot
    public function jabatan()
    {
        return $this->belongsToMany(
            JabatanModel::class,
            'tbl_jabatanpegawai', // tabel pivot
            'idpegawai',          // foreign key di pivot yang merujuk ke pegawai
            'idjabatan',          // foreign key di pivot yang merujuk ke jabatan
            'idpegawai',          // local key di tabel pegawai
            'idjabatan'           // local key di tabel jabatan (primary key)
        );
    }
}
