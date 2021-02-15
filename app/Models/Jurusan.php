<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    // ni diperlukan karena kita memakai perintah mass assignment untuk menginput data jurusan di controller, yakni perintah Jurusan::create($validateData).
    // protected $fillable = ['nama','kepala_jurusan','daya_tumpeng'];
    protected $fillable=['nama','kepala_jurusan','daya_tampung'];

    public function dosens()
    {
        return $this->hasMany('App\Models\Dosen');
    }

    public function mahasiswas()
    {
        return $this->hasMany('App\Models\Mahasiswa');
    }

    public function matakuliahs()
    {
        return $this->hasMany('App\Models\Matakuliahs');
    }
}
