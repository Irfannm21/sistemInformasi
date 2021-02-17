@extends('layouts.app')
@section('content')

<h1 class="display-4 text-center my-5" id="judul">
  Mahasiswa {{ $nama_jurusan ?? 'Universitas ILKOOM' }}
</h1>
<div class="text-right py-4">
    @auth 
      <a href="{{ Route('mahasiswas.create')}}" class="btn btn-secondary">Tambah Mahasiswa</a>
    @endauth
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>NIM</th>
      <th>Nama Mahasiswa</th>
      <th>Jurusan Mahasiswa</th>
      @auth 
        <th>Action</th>
      @endauth
    </tr>
  </thead>
  <tbody>
    @foreach ($mahasiswas as $mahasiswa)
    <tr id="row-{{$mahasiswa->id}}">
      <th>{{$mahasiswas->firstItem() + $loop->iteration - 1}}</th>
      <td>{{$mahasiswa->nim}}</td>
      <td>
        <a href="{{ route('mahasiswas.show',['mahasiswa'=>$mahasiswa->id]) }}">
        {{$mahasiswa->nama}}</a>
      </td>
      <td>{{$mahasiswa->jurusan->nama}}</td>
     <td>
     @auth 
        <a href="{{ route('mahasiswas.edit',['mahasiswa' => $mahasiswa->id])}}" class="btn btn-secondary" title="Edit Mahasiswa"> Edit</a>
        <form action="{{ route('mahasiswas.destroy',['mahasiswa' => $mahasiswa->id])}}" method="post" class="d-inline">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger shadow btn-hapus" title="Hapus Mahasiswa" data-name="{{$mahasiswa->nama}}">Hapus</button>
        </form>
      @endauth
     </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="row">
  <div class="mx-auto mt-3">
    {{ $mahasiswas->fragment('judul')->links() }}
  </div>
</div>

@endsection
    