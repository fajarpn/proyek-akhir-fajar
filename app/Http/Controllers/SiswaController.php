<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\SiswaModel;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->SiswaModel = new SiswaModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'siswa'=> $this->SiswaModel->allData(),
        ];
        return view('v_siswa', $data);
    }

    
    public function detail($id_siswa)
    {
        $data = [
            'siswa'=> $this->SiswaModel->detailData($id_siswa),
        ];
        return view('v_detailsiswa', $data);
    }

    public function add()
    {
        return view('v_addsiswa');
    }

    public function insert()
    {
        Request()->validate([
            'nis' => 'required|unique:tbl_siswa,nis|min:4|max:8',
            'nama_siswa' => 'required',
            'kelas_siswa' => 'required',
            'foto_siswa' => 'required|mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nis.required' => 'nis wajib diisi !!',
            'nis.unique' => 'nis ini sudah ada !!',
            'nis.min' => 'nis minimal 4 karakter',
            'nis.max' => 'nis maksimal 8 karakter',

            'nama_siswa.required' => 'nama wajib diisi !!',
            'nama_siswa.unique' => 'nama siswa ini sudah ada !!',
            'nama_siswa.min' => 'nama minimal 4 karakter',
            'nama_siswa.max' => 'nama maksimal 8 karakter',

            'kelas_siswa.required' => 'wajib diisi !!',
            'kelas_siswa.unique' => 'mapel ini sudah ada !!',
            'kelas_siswa.min' => 'minimal 4 karakter',
            'kelas_siswa.max' => 'maksimal 8 karakter',
        ]);
        // Jika Validasi tidak ada maka lakukan simpan data
        //upload gambar/foto
        $file = Request()->foto_siswa;
        $fileName = Request()->nis . '.' . $file->extension();
        $file->move(public_path('foto_siswa'), $fileName);

        $data = [
            'nis' => Request()->nis,
            'nama_siswa' => Request()->nama_siswa,
            'kelas_siswa' => Request()->kelas_siswa,
            'foto_siswa' => $fileName,
        ];

        $this->SiswaModel->addData($data);
        return redirect()->route('siswa')->with('pesan','Data Siswa Berhasil Di Tambahkan!!');
    }

    public function edit($id_siswa)
    {
        $data = [
            'siswa'=> $this->SiswaModel->detailData($id_siswa),
        ];
        return view('v_editsiswa', $data);
    }

    public function update($id_siswa)
    {
        Request()->validate([
            'nis' => 'required|min:4|max:8',
            'nama_siswa' => 'required',
            'kelas_siswa' => 'required',
            'foto_siswa' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nis.required' => 'wajib diisi !!',
            'nis.unique' => 'nip ini sudah ada !!',
            'nis.min' => 'minimal 4 karakter',
            'nis.max' => 'maksimal 8 karakter',

            'nama_siswa.required' => 'wajib diisi !!',
            'nama_siswa.unique' => 'nama ini sudah ada !!',
            'nama_siswa.min' => 'minimal 4 karakter',
            'nama_siswa.max' => 'maksimal 8 karakter',

            'kelas_siswa.required' => 'wajib diisi !!',
            'kelas_siswa.unique' => 'mapel ini sudah ada !!',
            'kelas_siswa.min' => 'minimal 4 karakter',
            'kelas_siswa.max' => 'maksimal 8 karakter',
        ]);
        // Jika Validasi tidak ada maka lakukan simpan data
        if (request()->foto_siswa <> "") {
            // jika ingin mengganti foto
            //upload gambar/foto
            $file = Request()->foto_siswa;
            $fileName = Request()->nis . '.' . $file->extension();
            $file->move(public_path('foto_siswa'), $fileName);

            $data = [
                'nis' => Request()->nis,
                'nama_siswa' => Request()->nama_siswa,
                'kelas_siswa' => Request()->kelas_siswa,
                'foto_siswa' => $fileName,
            ];

            $this->SiswaModel->editData($id_siswa, $data);
        }else {
            // jika tidak ingin mengganti foto
            $data = [
                'nis' => Request()->nis,
                'nama_siswa' => Request()->nama_siswa,
                'kelas_siswa' => Request()->kelas_siswa,
            ];

            $this->SiswaModel->editData($id_siswa, $data);
        }

      
        return redirect()->route('siswa')->with('pesan','Data Berhasil Di Update!!');
    }

    public function delete($id_siswa)
    {
        // hapus foto 
        $siswa = $this->SiswaModel->detailData($id_siswa);
        if ($siswa ->foto_siswa <> "") {
            unlink(public_path('foto_siswa') . '/' . $siswa->foto_siswa);
        }
        $this->SiswaModel->deleteData($id_siswa);
        return redirect()->route('siswa')->with('pesan','Data Siswa Berhasil Di Hapus!!');

    }
}