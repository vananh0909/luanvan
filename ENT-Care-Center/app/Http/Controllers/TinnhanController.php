<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinnhanController extends Controller
{
    public $data = [];

    public function nguoidung()
    {

        // $this->data['title'] = "TRANG CHỦ";


        return view("tinnhan.nguoidung");
    }

    public function tinnhan()
    {

        // $this->data['title'] = "TRANG CHỦ";


        return view("tinnhan.tinnhan");
    }
}
