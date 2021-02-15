@csrf
<div class="form-group row">
  <label for="kode" class="col-md-3 col-form-label text-md-right"
  title="5 digit kode mata kuliah">
    Kode Mata Kuliah </label>
  <div class="col-md-6">
    <input name="kode" id="kode" type="text" autofocus
    class="form-control col-md-8 @error('kode') is-invalid @enderror"
    value="{{ old('kode') ?? $matakuliah->kode ?? '' }}"
    placeholder="5 kode mata kuliah, contoh: IX264">
    @error('kode')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="nama" class="col-md-3 col-form-label text-md-right">
    Nama Mata Kuliah </label>
  <div class="col-md-6">
    <input name="nama" id="nama" type="text"
    class="form-control col-md-8 @error('nama') is-invalid @enderror"
    value="{{ old('nama') ?? $matakuliah->nama ?? '' }}">
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

<div class="form-group row">
  <label for="dosen_id" class="col-md-3 col-form-label text-md-right">
    Dosen Pengajar </label>

  {{-- Pemeriksaan kondisi agar pilihan dosen tidak bisa diubah,
       Ini akan aktif jika form diakses dari dosens.show / halaman biodata --}}
  @if (isset($dosen))
    <div class="col-md-6 d-flex align-items-center">
        <div>{{ $dosen->nama}}</div>
    </div>
    {{-- Kirim id dosen ke form awal agar tidak bermasalah dengan validasi --}}
    <input type="hidden" name="dosen_id" id="dosen_id" value="{{$dosen->id}}">
  @else
    {{-- Ini aktif jika form diakses dari dosens.index / halaman index --}}
    <div class="col-md-6">
      <select name="dosen_id" id="dosen_id"
      class="custom-select col-md-5 @error('dosen_id') is-invalid @enderror">
      @foreach ($dosens as $dosen)
        @if($dosen->id == (old('dosen_id') ?? $matakuliah->dosen->id ?? ''))
          <option value="{{ $dosen->id }}" selected>{{ $dosen->nama }}</option>
        @else
          <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
        @endif
      @endforeach
      </select>
      @error('dosen_id')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  @endif
</div>

<div class="form-group row">
  <label for="jumlah_sks" class="col-md-3 col-form-label text-md-right">
    Jumlah SKS </label>
  <div class="col-md-6">
    <select name="jumlah_sks" id="jumlah_sks"
    class="custom-select col-md-2 @error('jumlah_sks') is-invalid @enderror">
    @for ($i = 1; $i <= 6; $i++)
       @if($i == (old('jumlah_sks') ?? $matakuliah->jumlah_sks ?? ''))
         <option value="{{ $i }}" selected>{{ $i }}</option>
       @else
         <option value="{{ $i }}">{{ $i }}</option>
       @endif
    @endfor
    </select>
    @error('jumlah_sks')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
</div>

{{-- Trik agar bisa kembali ke halaman yang klik --}}
@isset($matakuliah)
  <input type="hidden" name="url_asal"
  value="{{ old('url_asal') ?? url()->previous().'#row-'.$matakuliah->id}}">
@else
  <input type="hidden" name="url_asal"
  value="{{ old('url_asal') ?? url()->previous()}}">
@endisset

<div class="form-group row mt-5">
  <div class="col-md-6 offset-md-3">
    <button type="submit" class="btn btn-primary">{{$tombol}}</button>
  </div>
</div>
