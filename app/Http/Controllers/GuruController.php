<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruModel;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->GuruModel = new GuruModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'guru'=> $this->GuruModel->allData(),
        ];
        return view('v_guru', $data);
    }

    public function detail($id_guru)
    {
        $data = [
            'guru'=> $this->GuruModel->detailData($id_guru),
        ];
        return view('v_detailguru', $data);
    }

    public function add()
    {
        return view('v_addguru');
    }

    public function insert()
    {
        Request()->validate([
            'nip' => 'required|unique:tbl_guru,nip|min:4|max:8',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nip.required' => 'wajib diisi !!',
            'nip.unique' => 'nip ini sudah ada !!',
            'nip.min' => 'minimal 4 karakter',
            'nip.max' => 'maksimal 8 karakter',

            'nama_guru.required' => 'wajib diisi !!',
            'nama_guru.unique' => 'nama ini sudah ada !!',
            'nama_guru.min' => 'minimal 4 karakter',
            'nama_guru.max' => 'maksimal 50 karakter',

            'mapel.required' => 'wajib diisi !!',
            'mapel.unique' => 'mapel ini sudah ada !!',
            'mapel.min' => 'minimal 4 karakter',
            'mapel.max' => 'maksimal 50 karakter',
        ]);
        // Jika Validasi tidak ada maka lakukan simpan data
        //upload gambar/foto
        $file = Request()->foto_guru;
        $fileName = Request()->nip . '.' . $file->extension();
        $file->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()->mapel,
            'foto_guru' => $fileName,
        ];

        $this->GuruModel->addData($data);
        return redirect()->route('guru')->with('pesan','Data Berhasil Di Tambahkan!!');
    }

    public function edit($id_guru)
    {
        $data = [
            'guru'=> $this->GuruModel->detailData($id_guru),
        ];
        return view('v_editguru', $data);
    }

    public function update($id_guru)
    {
        Request()->validate([
            'nip' => 'required|min:4|max:8',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nip.required' => 'wajib diisi !!',
            'nip.unique' => 'nip ini sudah ada !!',
            'nip.min' => 'minimal 4 karakter',
            'nip.max' => 'maksimal 8 karakter',

            'nama_guru.required' => 'wajib diisi !!',
            'nama_guru.unique' => 'nama ini sudah ada !!',
            'nama_guru.min' => 'minimal 4 karakter',
            'nama_guru.max' => 'maksimal 8 karakter',

            'mapel.required' => 'wajib diisi !!',
            'mapel.unique' => 'mapel ini sudah ada !!',
            'mapel.min' => 'minimal 4 karakter',
            'mapel.max' => 'maksimal 8 karakter',
        ]);
        // Jika Validasi tidak ada maka lakukan simpan data
        if (request()->foto_guru <> "") {
            // jika ingin mengganti foto
            //upload gambar/foto
            $file = Request()->foto_guru;
            $fileName = Request()->nip . '.' . $file->extension();
            $file->move(public_path('foto_guru'), $fileName);

            $data = [
                'nip' => Request()->nip,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
                'foto_guru' => $fileName,
            ];

            $this->GuruModel->editData($id_guru, $data);
        }else {
            // jika tidak ingin mengganti foto
            $data = [
                'nip' => Request()->nip,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
            ];

            $this->GuruModel->editData($id_guru, $data);
        }

      
        return redirect()->route('guru')->with('pesan','Data Berhasil Di Update!!');
    }

    public function delete($id_guru)
    {
        // hapus foto 
        $guru = $this->GuruModel->detailData($id_guru);
        if ($guru ->foto_guru <> "") {
            unlink(public_path('foto_guru') . '/' . $guru->foto_guru);
        }
        $this->GuruModel->deleteData($id_guru);
        return redirect()->route('guru')->with('pesan','Data Berhasil Di Hapus!!');

    }
}
