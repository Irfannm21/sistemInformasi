<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="pt-3 d-flex align-items-center">
  <h1 class="h2 mr-4">Biodata Dosen</h1>

</div>
<hr>
<ul>
    <li>Nama ol: <strong>{{$dosen->nama}} </strong></li>
    <li>Nomor Induk Dosen : <strong>{{ $dosen->nid}}</strong> </li>
    <li>Jurusan : <strong>{{ $dosen->jurusan->nama}}</strong> </li>
</ul>
<p>Mengajar Matakuliah :</p>
<ol>
    @foreach($dosen->matakuliahs as $matakuliah)
    <li>
        {{$matakuliah->nama}}
      <small>
      ( <a href="{{ route('matakuliahs.show',['matakuliah' => $matakuliah->id])}}">{{ $matakuliah->kode}}</a>
      - {{$matakuliah->jumlah_sks}} SKS )  
      </small>  
    </li>
    @endforeach
</ol>
<!-- <?php
    echo DNS1D::getBarcodeHTML('13212321312', 'C128A');
?> -->
</body>
</html>

