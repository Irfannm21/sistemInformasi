<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        //
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
}
