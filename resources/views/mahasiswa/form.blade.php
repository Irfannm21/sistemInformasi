@csrf
<div class="form-group row">
  <label for="nim" class="col-md-3 col-form-label text-md-right"
  title="8 digit angka NIM">
    Nomor Induk Mahasiswa </label>
  <div class="col-md-6">
    <input id="nim" type="text"
    class="form-control col-md-8 @error('nim') is-invalid @enderror"
    name="nim" value="{{ old('nim') ?? $mahasiswa->nim ?? '' }}" autofocus
    placeholder="8 digit angka NIM, contoh: 10311492">
    @error('nim')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="nama" class="col-md-3 col-form-label text-md-right">
    Nama Mahasiswa </label>
  <div class="col-md-6">
    <input id="nama" type="text"
    class="form-control col-md-8 @error('nama') is-invalid @enderror"
    name="nama" value="{{ old('nama') ?? $mahasiswa->nama ?? '' }}">
    @error('nama')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="jurusan_id" class="col-md-3 col-form-label text-md-right">
    Jurusan </label>
    <!-- Jurusan Tidak bisa diubah jika ada matakuliah yg diambil -->
    @if( ( $tombol == 'Update') AND ($mahasiswa->matakuliahs->count() > 0)) 
        <div class="col-md-6 d-flex align-items-center">
        <div class="">{{$mahasiswa->jurusan->nama}}
          <small><i>(Tidak bisa diubah karena mahasiswa sudah mengambil {{$mahasiswa->matakuliahs->count() }} matakuliah)</i></small> 
        </div>
        </div>
        <!-- Kirim jurusan awl agar tidak bermasalah dengan validaasi -->
        <input type="hidden" name="jurusan_id" id="jurusan_id" value="{{$mahasiswa->jurusan->id}}">
    @else
  <div class="col-md-6">
    <select name="jurusan_id" id="jurusan_id"
    class="custom-select col-md-5 @error('jurusan_id') is-invalid @enderror">
    @foreach ($jurusans as $jurusan)
      @if ($jurusan->id == (old('jurusan_id') ?? $dosen->jurusan_id ?? ''))
      <option value="{{ $jurusan->id }}" selected>{{ $jurusan->nama }}</option>
      @else
      <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
      @endif
    @endforeach
    </select>
    @error('jurusan_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  @endif
</div>

{{-- Trik agar bisa kembali ke halaman yang klik --}}
@isset($mahasiswa)
  <input type="hidden" name="url_asal"
  value="{{ old('url_asal') ?? url()->previous().'#row-'.$mahasiswa->id}}">
@else
  <input type="hidden" name="url_asal"
  value="{{ old('url_asal') ?? url()->previous()}}">
@endisset

<div class="form-group row mt-5">
  <div class="col-md-6 offset-md-3">
    <button type="submit" class="btn btn-primary">{{$tombol}}</button>
  </div>
</div>
