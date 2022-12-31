<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\UserModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'user'=> $this->UserModel->allData(),
        ];
        return view('v_user', $data);
    }

    public function detail($id_user)
    {
        $data = [
            'user'=> $this->UserModel->detailData($id_user),
        ];
        return view('v_detailuser', $data);
    }

    public function add()
    {
        return view('v_adduser');
    }

    public function insert()
    {
        Request()->validate([
            'nomor_user' => 'required|unique:tbl_user,nomor_user|min:4|max:8',
            'nama_user' => 'required',
            'email_user' => 'required',
            'foto_user' => 'required|mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nomor_user.required' => 'wajib diisi !!',
            'nomor_user.unique' => 'nomor_user ini sudah ada !!',
            'nomor_user.min' => 'minimal 4 karakter',
            'nomor_user.max' => 'maksimal 8 karakter',

            'nama_user.required' => 'wajib diisi !!',
            'nama_user.unique' => 'nama ini sudah ada !!',
            'nama_user.min' => 'minimal 4 karakter',
            'nama_user.max' => 'maksimal 50 karakter',

            'email_user.required' => 'wajib diisi !!',
            'email_user.unique' => 'mapel ini sudah ada !!',
            'email_user.min' => 'minimal 4 karakter',
            'email_user.max' => 'maksimal 50 karakter',
        ]);
        // Jika Validasi tidak ada maka lakukan simpan data
        //upload gambar/foto
        $file = Request()->foto_user;
        $fileName = Request()->nomor_user . '.' . $file->extension();
        $file->move(public_path('foto_user'), $fileName);

        $data = [
            'nomor_user' => Request()->nomor_user,
            'nama_user' => Request()->nama_user,
            'email_user' => Request()->email_user,
            'foto_user' => $fileName,
        ];

        $this->UserModel->addData($data);
        return redirect()->route('user')->with('pesan','Data User Berhasil Di Tambahkan!!');
    }

    public function edit($id_user)
    {
        $data = [
            'user'=> $this->UserModel->detailData($id_user),
        ];
        return view('v_edituser', $data);
    }

    public function update($id_user)
    {
        Request()->validate([
            'nomor_user' => 'required|min:4|max:8',
            'nama_user' => 'required',
            'email_user' => 'required',
            'foto_user' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'nomor_user.required' => 'wajib diisi !!',
            'nomor_user.unique' => 'nomor_user ini sudah ada !!',
            'nomor_user.min' => 'minimal 4 karakter',
            'nomor_user.max' => 'maksimal 8 karakter',

            'nama_user.required' => 'wajib diisi !!',
            'nama_user.unique' => 'nama_user ini sudah ada !!',
            'nama_user.min' => 'minimal 4 karakter',
            'nama_user.max' => 'maksimal 8 karakter',

            'email_user.required' => 'wajib diisi !!',
            'email_user.unique' => 'email_user ini sudah ada !!',
            'email_user.min' => 'minimal 4 karakter',
            'email_user.max' => 'maksimal 8 karakter',
        ]);
        // Jika Validasi tidak ada maka lakukan simpan data
        if (request()->foto_user <> "") {
            // jika ingin mengganti foto
            //upload gambar/foto
            $file = Request()->foto_user;
            $fileName = Request()->nomor_user . '.' . $file->extension();
            $file->move(public_path('foto_user'), $fileName);

            $data = [
                'nomor_user' => Request()->nomor_user,
                'nama_user' => Request()->nama_user,
                'email_user' => Request()->email_user,
                'foto_user' => $fileName,
            ];

            $this->UserModel->editData($id_user, $data);
        }else {
            // jika tidak ingin mengganti foto
            $data = [
                'nomor_user' => Request()->nomor_user,
                'nama_user' => Request()->nama_user,
                'email_user' => Request()->email_user,
            ];

            $this->UserModel->editData($id_user, $data);
        }

      
        return redirect()->route('user')->with('pesan','Data User Berhasil Di Update!!');
    }

    public function delete($id_user)
    {
        // hapus foto 
        $user = $this->UserModel->detailData($id_user);
        if ($user ->foto_user <> "") {
            unlink(public_path('foto_user') . '/' . $user->foto_user);
        }
        $this->UserModel->deleteData($id_user);
        return redirect()->route('user')->with('pesan','Data User Berhasil Di Hapus!!');

    }
}
