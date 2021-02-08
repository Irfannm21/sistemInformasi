@extends('layouts.app')
@section('content')

<div class="pt-3">
  <h1 class="h2 mr-4">Informasi Mata Kuliah</h1>
</div>
<hr>
<ul>
  <li>Nama: <strong>{{$matakuliah->nama}} </strong></li>
  <li>Kode Mata Kuliah: <strong>{{$matakuliah->kode}} </strong></li>
  <li>Dosen Pengajar:
    <strong>
      <a href="{{ route('dosens.show',['dosen' => $matakuliah->dosen->id]) }}">
         {{$matakuliah->dosen->nama}}
      </a>
    </strong></li>
  <li>Jurusan: <strong>{{$matakuliah->jurusan->nama}} </strong></li>
  <li>Jumlah SKS: <strong>{{ $matakuliah->jumlah_sks }} </strong></li>
  <li>Total Mahasiswa: <strong>{{ count($mahasiswas) }} </strong></li>
</ul>
<p>Daftar Mahasiswa:</p>
<ol>
  @foreach ($mahasiswas as $mahasiswa)
    <li>
      {{$mahasiswa->nama}}
      <small>
        (<a href="{{ route('mahasiswas.show',
        ['mahasiswa'=>$mahasiswa->id]) }}">{{$mahasiswa->nim}}</a>)
      </small>
    </li>
  @endforeach
</ol>

@endsection
