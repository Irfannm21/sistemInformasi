@csrf
<div class="form-group row">
  <label for="nama" class="col-md-3 col-form-label text-md-right">
    Nama Jurusan </label>
  <div class="col-md-6">
    <input id="nama" type="text"
    class="form-control col-md-8 @error('nama') is-invalid @enderror"
    name="nama" value="{{ old('nama') ?? $jurusan->nama ?? '' }}"
    autofocus>
    @error('nama')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="kepala_jurusan" class="col-md-3 col-form-label text-md-right">
    Nama Kepala Jurusan </label>
  <div class="col-md-6">
    <input id="kepala_jurusan" type="text"
    class="form-control col-md-8 @error('kepala_jurusan') is-invalid @enderror"
    name="kepala_jurusan" autofocus
    value="{{ old('kepala_jurusan') ?? $jurusan->kepala_jurusan ?? '' }}">
    @error('kepala_jurusan')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="daya_tampung" class="col-md-3 col-form-label text-md-right">
    Daya Tampung Jurusan </label>
  <div class="col-md-6">
    <input id="daya_tampung" type="text"
    class="form-control col-md-2 @error('daya_tampung') is-invalid @enderror"
    name="daya_tampung" autofocus
    value="{{ old('daya_tampung') ?? $jurusan->daya_tampung ?? '' }}">
    @error('daya_tampung')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<!-- elain proses include view jurusan.form, argument ['tombol' => 'Tambah'] akan mengisi nilai variabel $tombol. Dengan teknik ini, teks untuk tombol submit bisa diubah-ubah. Misalnya menjadi 'Update' saat view form.blade.php di include dari view update nantinya. -->
<div class="form-group row mt-5">
  <div class="col-md-6 offset-md-3">
    <button type="submit" class="btn btn-primary">{{$tombol}}</button>
  </div>
</div>
