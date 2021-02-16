<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Matakuliah;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with('jurusan')->orderBy('nama')->paginate(10);
        return view('mahasiswa.index',['mahasiswas' => $mahasiswas]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('mahasiswa.create',compact('jurusans'));
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
            'nim' => 'required|alpha_num|size:8|unique:mahasiswas,nim',
            'nama'  => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);

        // Cek apakah daya tampung jurusan sudah penuh

        $daya_tampung = Jurusan::find($request->jurusan_id)->daya_tampung;
        $total_mahasiswa = Mahasiswa::where('jurusan_id',$request->jurusan_id)->count();
        if($total_mahasiswa >= $daya_tampung){
            Alert::error('Pendaftaran Gagal', 'Sudah Melebihi daya Tampung');
            return back()->withInput();
        }

        Mahasiswa::create($validateData);
        Alert::Success('Berhasil',"Mahasiswa $request->nama berhasil dibuat");
        return redirect($request->url_asal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $matakuliahs = $mahasiswa->matakuliahs->sortBy('nama');
        return view('mahasiswa.show',[
            'mahasiswa' => $mahasiswa,
            'matakuliahs' => $matakuliahs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('mahasiswa.edit',[
            'mahasiswa' => $mahasiswa,
            'jurusans'   => $jurusans,
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validateData = $request->validate([
            'nim' => 'required|alpha_num|size:8|unique:mahasiswas,nim,'. $mahasiswa->id,
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);

        // Antisipasi jika yang edit inputan jurusan_id yang sudah di hidden
        if( ($mahasiswa->matakuliahs()->count() > 0)  AND ($mahasiswa->jurusan_id != $request->jurusan_id)) {
            Alert::error('Update gagal','Jurusan tida bisa diubah!');
            return back()->withInput();
        }

        $mahasiswa->update($validateData);
        Alert::success('Berhasil',"Mahaiswa $request->nama telah di update");
        // Trik agar halaman kembali ke halaman asal
        return redirect($request->url_asal);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }

    public function ambilMatakuliah(Mahasiswa $mahasiswa)
    {
        // Ambil semua matakuliah dari jurusan yang sama dengan mahasiswa
        $matakuliahs = Matakuliah::where('jurusan_id',$mahasiswa->jurusan_id)
                        ->orderBy('nama')->get();

        // Buat Array dari daftar jurusan yang sudah di ambil mahasiswa
        // ini akan di pakai proses repopulate form
        $matakuliahs_sudah_diambil = $mahasiswa->pluck('id')->all();

        return view('mahasiswa.ambil-matakuliah',
        [
            'mahasiswa' => $mahasiswa,
            'matakuliahs' => $matakuliahs,
            'matakuliahs_sudah_diambil' => $matakuliahs_sudah_diambil,
        ]);
    }
    
    public function prosesAmbilMatakuliah(Request $request, Mahasiswa $mahasiswa)
    {
        
        // Ambil semua id matakuliah untuk jurusan yang sama dengan mahasiswa.
        $matakuliah_jurusan = Matakuliah::where('jurusan_id',$mahasiswa->jurusan_id)
                            ->pluck('id')->toArray();

        $validateData = $request->validate([
           'matakuliah.*' => 'distinct|in:'.implode(',',$matakuliah_jurusan), 
        ]);

        // Input ke Database
        $mahasiswa->matakuliahs()->sync($validateData['matakuliah'] ?? []);

        Alert::success('Berhasil',"Terdapat " .
                        count($validateData['matakuliah'] ?? []). 
                        " Matakuliah yang diambil $mahasiswa->nama");  
        return redirect(route('mahasiswas.show', ['mahasiswa' => $mahasiswa->id]));
    }
}
