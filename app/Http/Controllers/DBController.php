<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DBController extends Controller
{
    public function getAllRecords()
    {
        $records = DB::table('register_part')->get();
        $records = DB::table('picking')->get();
        return $records;
    }


    public function insertRecord($data)
    {
        DB::table('register_part')->insert($data);
    }

    public function updateRecord($id, $data)
    {
        DB::table('register_part')->where('id', $id)->update($data);
    }

    public function deleteRecord($id)
    {
         DB::table('register_part')->where('id', $id)->delete();
    }


}
