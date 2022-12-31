<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public function allData()
    {
        return DB::table('tbl_user')->get();
    }

    public function detailData($id_user)
    {
        return DB::table('tbl_user')->where('id_user', $id_user)->first();
    }

    public function addData($data)
    {
        DB::table('tbl_user')->insert($data);
    }

    public function editData($id_user, $data)
    {
        DB::table('tbl_user')
        ->where('id_user', $id_user)
        ->update($data);

    }

    public function deleteData($id_user)
    {
        DB::table('tbl_user')
        ->where('id_user', $id_user)
        ->delete();
    }
}
