<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    public function matakuliahs()
    {
        return $this->hasMany('App\Models\Matakuliah');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan');
    }
}
