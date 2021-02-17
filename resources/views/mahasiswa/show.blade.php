@extends('layouts.app')
@section('content')

<div class="pt-3 d-flex align-items-center">
  <h1 class="h2 mr-4">Biodata Mahasiswa</h1>
  @auth 
        <a href="{{ route('mahasiswas.edit',['mahasiswa' => $mahasiswa->id])}}" class="btn btn-secondary mr-1" title="Edit Mahasiswa">Edit </a>
        <form action="{{ route('mahasiswas.destroy',['mahasiswa' => $mahasiswa->id])}}" method="post" class="d-inline">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger shadow btn-hapus" title="Hapus Mahasiswa" data-name="{{$mahasiswa->nama}}">Hapus</button>
        </form>
      @endauth
</div>
<hr>
<ul>
  <li>Nama: <strong>{{$mahasiswa->nama}} </strong></li>
  <li>Nomor Induk Mahasiswa: <strong>{{$mahasiswa->nim}} </strong></li>
  <li>Jurusan: <strong>{{$mahasiswa->jurusan->nama}} </strong></li>
  <li>Total Mata Kuliah:
    <strong> {{ count($matakuliahs) }}</strong>
    ({{ $matakuliahs->sum('jumlah_sks') }} SKS)
  </li>
</ul>
<p>Mengambil Mata Kuliah:</p>
<ol>
  @foreach ($matakuliahs as $matakuliah)
    <li>
      {{$matakuliah->nama}}
      <small>
      (<a href="{{ route('matakuliahs.show',
         ['matakuliah' => $matakuliah->id]) }}">{{$matakuliah->kode}}</a>
       - {{$matakuliah->jumlah_sks}} SKS)
      </small>
    </li>
  @endforeach
</ol>
@auth 
    <a href="{{ route('ambil-matakuliah',['mahasiswa' => $mahasiswa->id])}}" class="btn btn-info" title="Daftarkan Matakuliah">Ambil Matakuliah</a>
@endauth
@endsection
