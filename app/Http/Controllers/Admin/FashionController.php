<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FashionController extends Controller
{
    //add actionを追加
    public function add()
    {
        return view('admin.fashion.create');
    }
}
