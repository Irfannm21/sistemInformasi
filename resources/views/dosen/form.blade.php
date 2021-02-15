@csrf
<div class="form-group row">
  <label for="nid" class="col-md-3 col-form-label text-md-right"
  title="8 digit angka NID">
    Nomor Induk Dosen </label>
  <div class="col-md-6">
    <input id="nid" type="text"
    class="form-control col-md-8 @error('nid') is-invalid @enderror"
    name="nid" value="{{ old('nid') ?? $dosen->nid ?? '' }}" autofocus
    placeholder="8 digit angka NID, contoh: 99754972">
    @error('nid')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="nama" class="col-md-3 col-form-label text-md-right">
    Nama Dosen </label>
  <div class="col-md-6">
    <input id="nama" type="text"
    class="form-control col-md-8 @error('nama') is-invalid @enderror"
    name="nama" value="{{ old('nama') ?? $dosen->nama ?? '' }}">
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
</div>

{{-- Trik agar bisa kembali ke halaman yang klik --}}
@isset($dosen)
  <input type="hidden" name="url_asal"
  value="{{ old('url_asal') ?? url()->previous().'#row-'.$dosen->id}}">
@else
  <input type="hidden" name="url_asal"
  value="{{ old('url_asal') ?? url()->previous()}}">
@endisset

<div class="form-group row mt-5">
  <div class="col-md-6 offset-md-3">
    <button type="submit" class="btn btn-primary">{{$tombol}}</button>
  </div>
</div>
