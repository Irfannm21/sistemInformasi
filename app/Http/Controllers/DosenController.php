<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = Dosen::With('jurusan')->orderBy('nama')->paginate(5);
        return view('dosen.index',['dosens' => $dosens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('dosen.create',compact('jurusans'));
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
            'nid' => 'required|alpha_num|size:8|unique:dosens,nid',
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);
        Dosen::create($validateData);
        Alert::success('Berhasil', "Dosen $request->nama berhasil dibuat");
        // Trik agar halaman kembali ke asal
        return redirect($request->url_asal);
    }

    
    // Cukup satu baris saja. Di sini kita memanfaatkan fitur route model binding, dimana parameter $dosen di baris 1 akan langsung terisi dengan object Dosen yang sedang di akses.
    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('dosen.edit',['dosen' => $dosen, 'jurusans' => $jurusans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validateData = $request->validate([
            'nid'           => 'required|alpha_num|size:8|unique:dosens,nid,'.$dosen->id,
            'nama'          => 'required',
            'jurusan_id'    => 'required|exists:App\Models\Jurusan,id',
        ]);

        $dosen->update($validateData);
        Alert::success('Berhasil',"Dosen $request->nama berhasil di update");
        // Trik Agar halaman ke awal
        return redirect($request->url_asal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        Alert::success('Berhasil',"Dosen $dosen->nama telah dihapus");
        return redirect('/dosens');
    }

    public function buatMatakuliah(Dosen $dosen)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('matakuliah.create',[
            'dosen' => $dosen,
            'jurusans' => $jurusans,
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth')->except([
            'index','show'
        ]);
    }

    public function reportPreview(Dosen $dosen)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        $data = [
            'dosen' => $dosen,
            'jurusans' => $jurusans,
        ];

        $pdf = PDF::loadView('dosen.preview',$data);
        $pdf = PDF::loadView('dosen.barcode',$data)->setPaper('A5','Potrait');
        return $pdf->stream();
    }

}
