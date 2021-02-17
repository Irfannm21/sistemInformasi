@extends('layouts.app')
@section('content')

<h1 class="display-4 text-center my-5" id="judul">
  Mata Kuliah Universitas ILKOOM
</h1>
  <div class="text-right py-5">
      @auth 
        <a href="{{Route('matakuliahs.create')}}" class="btn btn-secondary">Tambah Matakuliah</a>
      @endauth
  </div>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Kode</th>
      <th>Nama Mata Kuliah</th>
      <th>Dosen Pengajar</th>
      <th>Jumlah SKS</th>
      <th>Jurusan</th>
      @auth 
        <th>Action</th>
      @endauth
    </tr>
  </thead>
  <tbody>
    @foreach ($matakuliahs as $matakuliah)
    <tr id="row-{{$matakuliah->id}}">
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
      <td>
          @auth 
            <a href="{{ route('matakuliahs.edit',['matakuliah' => $matakuliah->id])}}" class="btn btn-secondary" title="Edit Matakuliah">Edit</a>
            <form action="{{route('matakuliahs.destroy',['matakuliah' => $matakuliah->id])}}" method="post" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger shadow-none btn-hapus" title="Hapus Mahasiswa" data-name="{{$matakuliah->nama}}">
                Hapus
              </button>
            </form>
          @endauth
      </td>
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
