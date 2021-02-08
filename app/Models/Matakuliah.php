<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan');
    }

    public function dosen()
    {
        return $this->belongsTo('App\Models\Dosen');
    }

    public function mahasiswas()
    {
        return $this->belongsToMany('App\Models\Mahasiswa')->withTimestamps();
    }
}
