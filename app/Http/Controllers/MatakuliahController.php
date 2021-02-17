<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use RealRashid\SweetAlert\Facades\Alert;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matakuliahs = Matakuliah::with('dosen','jurusan')->orderBy('nama')->paginate(10);
        return view('matakuliah.index',["matakuliahs" => $matakuliahs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();
        return view('matakuliah.create',[
            'jurusans' => $jurusans,
            "dosens"   => $dosens,
        ]);  
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
            'kode'         => 'required|alpha_num|size:5|unique:matakuliahs,kode',
            'nama'         => 'required',
            'dosen_id'     => 'required|exists:App\Models\Dosen,id',
            'jurusan_id'   => 'required|exists:App\Models\Jurusan,id',
            'jumlah_sks'   => 'required|digits_between:1,6',
        ]);

        Matakuliah::create($validateData);
        Alert::success('Berhasil',"Matakuliah $request->nama berhasil dibuat");
        return redirect($request->url_asal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function show(Matakuliah $matakuliah)
    {
        $mahasiswas = $matakuliah->mahasiswas->sortBy('nama');
        return view('matakuliah.show',[
            'matakuliah' => $matakuliah,
            'mahasiswas' => $mahasiswas,
        ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function edit(Matakuliah $matakuliah)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        $dosens   = Dosen::orderBy('nama')->get();

        return view ('matakuliah.edit',[
            'matakuliah' => $matakuliah,
            'jurusans' => $jurusans,
            'dosens'    => $dosens,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        
        $validateData = $request->validate([
            'kode' => 'required|alpha_num|size:5|unique:matakuliahs,kode,' . $matakuliah->id,
            'nama'  => 'required',
            'dosen_id' => 'required|exists:App\Models\Dosen,id',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
            'jumlah_sks' => 'required|digits_between:1,6',
        ]);

        // Antipasi jika ada inputan jurusan_id yang sudah di hidden
        if ( ($matakuliah->mahasiswas()->count() > 0 ) AND ($matakuliah->jurusan_id != $request->jurusan_id )) 
        {
            Alert::success('Update Gagal',"Jurusan tidak bisa di ubah");
            return back();
        } 

        $matakuliah->update($validateData);
        Alert::success('berhasil',"Matakuliah $request->nama telah di update");
        // trik agar halaman kembali ke awal
        return redirect($request->url_asal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        Alert::success('Berhasil','Matakuliah $matakuliah->nama berhasil dihapus');
        return redirect('/matakuliahs');
    }

    public function buatMatakuliah(Dosen $dosen)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('matakuliah.create',[
            'dosen'     => $dosen,
            'jurusans'  => $jurusans, 
        ]);
    }

    public function daftarkanMahasiswa(Matakuliah $matakuliah)
    {
        // Ambil semua daftar mahasiswa dari jurusan yang sama dengan matakuliah
        $mahasiswas = Mahasiswa::where('jurusan_id',$matakuliah->jurusan_id)->orderBy('nama')->get();

        // Buat Array dari daftar mahasiswa yang sudah terdaftar sebelumnya ini kan dipakai repopulate form
        $mahasiswas_sudah_terdaftar=$matakuliah->mahasiswas->pluck('id')->all();
        return view('matakuliah.daftarkan-mahasiswa',
        [
            'matakuliah' => $matakuliah,
            'mahasiswas' => $mahasiswas,
            'mahasiswas_sudah_terdaftar' => $mahasiswas_sudah_terdaftar,
        ]);

    }

    public function prosesDaftarkanMahasiswa(Request $request, Matakuliah $matakuliah)
    {
        // Ambil semua id mahasisswa untuk jurusan yang sama dengan matakuliah
        $mahasiswa_jurusan = Mahasiswa::where('jurusan_id',$matakuliah->jurusan_id)
                            ->pluck('id')->toArray();

        $validateData = $request->validate([
            'mahasiswa.*' => 'distinct|in:' . implode(',', $mahasiswa_jurusan),
        ]);
        // Proses Mahasiswa yang di daftarkan\)
        $matakuliah->mahasiswas()->sync($validateData['mahasiswa'] ?? []);

        Alert::success('Berhasil', "Terdapat" . count($validateData['mahasiswa'] ?? []) . " mahasiswa yang mengambil $matakuliah->nama ");
        return redirect(route('matakuliahs.show',
                        ['matakuliah' => $matakuliah->id]));
    }

    public function __construct()
    {
        $this->middleware('auth')->except([
            'index','show'
        ]);
    }
}
