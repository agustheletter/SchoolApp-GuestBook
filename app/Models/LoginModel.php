<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    use HasFactory;
    protected $table        = "tbl_login";
    protected $primaryKey   = 'idlogin';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $fillable     = ['idlogin','email','idthnajaran'];

    //relasi ke table user
    public function user()
    {
        return $this->belongsTo(User::class,'email', 'email');
    }

    //relasi ke table thnajaran
    public function thnajaran()
    {
        return $this->belongsTo('App\Models\TahunAjaranModel','idthnajaran');
    }
}
