<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        $jurusans = Jurusan::withCount('mahasiswas')->orderBy('nama')->get();
        return view('jurusan.index',['jurusans' => $jurusans]);
    }


    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "nama"              => "required",
            "kepala_jurusan"    => "required",
            "daya_tampung"      => "required|min:10|integer",
        ]);

        $jurusan = Jurusan::create($validateData);
        Alert::success('Berhasil',"Jurusan $request->nama berhasil dibuat");
        // erakhir, user di redirect ke halaman "/jurusans#card-{$jurusan->id}" di baris 15. Halaman '/jurusans' adalah halaman index yang menampilkan semua data jurusan. Di sini terdapat tambahan hash fragment dalam bentuk card-{$jurusan->id}. Fungsinya adalah untuk membuat efek visual dari jurusan yang baru saja ditambah
        // Sebagai contoh, jika jurusan yang saat ini diproses memiliki id = 4, maka pada saat redirect akan menuju halaman '/jurusans#card-4'. Dalam CSS, terdapat pseudo selector:target untuk mencari element yang sedang diakses oleh hash fragment. Agar bisa bekerja, silahkan buka view index.jurusan.blade, lalu tambah sedikit kode di bagianawal card (yakni tag <div> pertama setelah perintah foreach)
        return redirect('/jurusans#card-{$jurusan->id}');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit',compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validateData = $request->validate([
            'nama'             => 'required',
            'kepala_jurusan'   => 'required',
            'daya_tampung'     => 'required|min:10|integer',
        ]);

        $jurusan->update($validateData);
        Alert::success('Berhasil','Jurusan $request->nama telah di update');
        return redirect('/jurusans#card-{$jurusan->id}');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        Alert::success('Berhasil',"Jurusan $jurusan->nama telah dihapus");
        return redirect('/jurusans');
    }

    public function jurusanDosen($jurusan_id)
    {
      // Tampilkan semua dosen dari 1 jurusan
      $dosens = Dosen::where('jurusan_id',$jurusan_id)->orderBy('nama')
                ->paginate(5);
      $nama_jurusan = Jurusan::find($jurusan_id)->nama;

      return view('dosen.index',[
          'dosens' => $dosens,
          'nama_jurusan' => $nama_jurusan,
      ]);
    }

    public function jurusanMahasiswa($jurusan_id)
    {
      // Tampilkan semua mahasiswa dari 1 jurusan
      $mahasiswas = Mahasiswa::where('jurusan_id',$jurusan_id)->orderBy('nama')
                    ->paginate(10);
      $nama_jurusan = Jurusan::find($jurusan_id)->nama;

      return view('mahasiswa.index',[
          'mahasiswas' => $mahasiswas,
          'nama_jurusan' => $nama_jurusan,
      ]);
    }

    // Karena menggunakan except, maka selain method index(), jurusanDosen() dan jurusanMahasiswa(),tidak bisa diakses secara bebas (user harus login terlebih dahulu). 
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index','jurusanDosen','jurusanMahasiswa'
        ]);
    }
}
