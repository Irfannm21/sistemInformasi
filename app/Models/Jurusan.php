<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    public function dosens()
    {
        return $this->hisMany('App\Models\Dosen');
    }

    public function mahasiswas()
    {
        return $this->hisMany('App\Models\Mahasiswa');
    }

    public function matakuliahs()
    {
        return $this->hasMany('App\Models\Matakuliahs');
    }
}
