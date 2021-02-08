@extends('layouts.app')
@section('content')

<h1 class="display-4 text-center my-5" id="judul">
  Mata Kuliah Universitas ILKOOM
</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Kode</th>
      <th>Nama Mata Kuliah</th>
      <th>Dosen Pengajar</th>
      <th>Jumlah SKS</th>
      <th>Jurusan</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($matakuliahs as $matakuliah)
    <tr>
      <th>{{$matakuliahs->firstItem() + $loop->iteration - 1}}</th>
      <td>{{$matakuliah->kode}}</td>
      <td>
        <a href="{{ route('matakuliahs.show',
        ['matakuliah' => $matakuliah->id]) }}">{{$matakuliah->nama}}</a>
      </td>
      <td>
        <a href="{{route('dosens.show',['dosen' => $matakuliah->dosen->id])}}">
            {{$matakuliah->dosen->nama}}
        </a>
      </td>
      <td>{{$matakuliah->jumlah_sks}}</td>
      <td>{{$matakuliah->jurusan->nama}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="row">
  <div class="mx-auto mt-3">
    {{ $matakuliahs->fragment('judul')->links() }}
  </div>
</div>

@endsection
