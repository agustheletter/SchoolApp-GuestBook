<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_kelas";
    protected $primaryKey   = 'idkelas';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idkelas', 'kodekelas', 'namakelas','idjurusan','idtingkat'];

    //relasi ke jurusan
    public function jurusan()
    {
        return $this->belongsTo('App\Models\JurusanModel', 'idjurusan');
        //return $this->belongsTo(JurusanModel::class, 'idjurusan');
    }

    //relasi ke tingkat
    public function tingkat()
    {
        return $this->belongsTo('App\Models\TingkatModel','idtingkat');
    }

    //relasi ke siswa kelas
    public function kelasdetail()
    {
        return $this->hasMany('App\Models\KelasDetailModel','idkelas');
    }

}
