<?php

namespace App\Http\Controllers;

use Database\Seeders\KelasSeeder;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mahasiswa;
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //yang semula Mahasiswa:all, diubah menjadi with() yang menyatakan relasi
        if($request->has('search')){ // Jika ingin melakukan pencarian nama
        $mahasiswas = Mahasiswa::where('Nama', 'like', "%".$request->search."%")->with('kelas')->paginate(3);
        } else { // Jika tidak melakukan pencarian nama
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswas = Mahasiswa::with('kelas')->paginate(3); // Pagination menampilkan 3 data
     }
        return view('mahasiswas.index', compact('mahasiswas'));
     }

    public function create()
    {
      $kelas = Kelas::all(); // mendapatkan data dari tabel kelas  
      return view('mahasiswas.create',['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_Lahir' => 'required',
            ]);   

            $Mahasiswa = new Mahasiswa;
            $Mahasiswa->Nim = $request->get('Nim');
            $Mahasiswa->Nama = $request->get('Nama');
            $Mahasiswa->Jurusan = $request->get('Jurusan');
            $Mahasiswa->No_Handphone = $request->get('No_Handphone');
            $Mahasiswa->Email = $request->get('Email');
            $Mahasiswa->Tanggal_Lahir = $request->get('Tanggal_Lahir'); 

            $kelas = new kelas;
            $kelas->id = $request->get('Kelas');
            //fungsi elequent untuk menambah data dengan relasi belongsTo
            $Mahasiswa->kelas()->associate($kelas);
            $Mahasiswa->save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        return view('mahasiswas.detail', ['Mahasiswa' => $Mahasiswa]);
    }

    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.edit', compact('Mahasiswa','kelas'));
    }

    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_Lahir' => 'required',
        ]);

            $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
            $Mahasiswa->Nim = $request->get('Nim');
            $Mahasiswa->Nama = $request->get('Nama');
            $Mahasiswa->Tanggal_Lahir = $request->get('Tanggal_Lahir');
            $Mahasiswa->Jurusan = $request->get('Jurusan');
            $Mahasiswa->Email = $request->get('Email');
            $Mahasiswa->No_Handphone = $request->get('No_Handphone');
            $Mahasiswa->save();

         //fungsi eloquent untuk menambah data dengan relasi belongsTo
        //  $Mahasiswas->kelas()->associate($kelas);
        //  $Mahasiswas->save();
         
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate'); 
        }

    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete(); 
        return redirect()->route('mahasiswas.index') 
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->find($Nim);
        return view('mahasiswas.nilai', compact('Mahasiswa'));
    }

    
};