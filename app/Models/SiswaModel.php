<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SiswaModel extends Model
{
    public function allData()
    {
        return DB::table('tbl_siswa')->get();
    }

    public function detailData($id_siswa)
    {
        return DB::table('tbl_siswa')->where('id_siswa', $id_siswa)->first();
    }

    public function addData($data)
    {
        DB::table('tbl_siswa')->insert($data);
    }

    public function editData($id_siswa, $data)
    {
        DB::table('tbl_siswa')
        ->where('id_siswa', $id_siswa)
        ->update($data);

    }

    public function deleteData($id_siswa)
    {
        DB::table('tbl_siswa')
        ->where('id_siswa', $id_siswa)
        ->delete();
    }
}
